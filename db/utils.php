<?php

include 'opendb.php';
//include '../config.php';
/**
 * Various sql standard functions for manipulating the database
 * Also utility functions needed for the project.
 * Update: Removed the other functions from the project, no need to have them.
 */

function sqlUnsubscribe($aQuery, $aUid) {
    global $mysqli;
    //prepare unsubscribe statement
    $stmt = $mysqli->prepare($aQuery);
    //execute unsubscribe statement
    $stmt->bind_param('s', $aUid);
    $stmt->execute();
    if (mysqli_error($mysqli)) {
        return true;
    } else {
        return false;
    }
}

function sqliQuery($query) {
    global $mysqli;
    if ($query != "") {
        $result = $mysqli->query($query);
        if (mysqli_error($mysqli)) {
            var_dump($query, mysqli_error($mysqli));
            $sqlError = true;
        } else {
            $sqlError = false;
        }
        return $result;
    } else {
        return null;
    }
}

/**
 * Checks whether a String exists in a file line by line.
 * Returns true or false.
 * 
 * @param type $aFile
 * @param type $aUid
 * @return boolean 
 */
function checkUid($aFileName, $aUid) {

    $f = new SplFileObject($aFileName);
    $f->setFlags(SplFileObject::DROP_NEW_LINE);

    $match = false;
    foreach ($f as $line) {
        if (false !== stripos($line, $aUid)) {
            $match = true;
            break;
        }
    }
    if (true === $match) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function parses the log file, tries to update all lines that end up 
 * with :0 and then replaces the 0 with 1.
 * 
 * @param type $aUnQuery
 * @param type $aFileName 
 */
function updateLogged($aUnQuery, $aFileName) {
    echo "</br><b>maintenance started</b></br>";
    $fileAr = file($aFileName);
    $uidCtr = 0;

    foreach ($fileAr as $i => $elem) {
        $line = $fileAr[$i];
        $delim = ':';
        $data = str_getcsv($line, $delim);

        if ($data[1] == 0) {
            $sqlError = sqlUnsubscribe($aUnQuery, $data[0]);
            if($sqlError == false){
                $data[1] = 1;
                $fileAr[$i] = $data[0] . $delim . $data[1] . "\n";
                echo "</br>Unsubscribing: " . $data[0];
                $uidCtr++;
            } else {
                echo "</br>Error with database connection.";
                break;
            }
        }
    }
    file_put_contents($aFileName, implode('', $fileAr), LOCK_EX);
    
    echo "</br><b>maintenance finished - UUIDs processed: </b>" . ($uidCtr - 1)
    . "</br>";
}

?>
