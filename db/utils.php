<?php

include 'opendb.php';
//include '../config.php';
/**
 * Various sql standard functions for manipulating the database
 * Also utility functions needed for the project.
 * Update: Removed the other functions from the project, no need to have them.
 */
$sqlError = false;

function sqlUnsubscribe($aQuery, $aUid) {
    global $mysqli;
    //prepare unsubscribe statement
    $stmt = $mysqli->prepare($aQuery);
    //execute unsubscribe statement
    $stmt->bind_param('s', $aUid);
    $stmt->execute();
}

function sqliQuery($query) {
    global $mysqli;
    if ($query != "") {
        $result = $mysqli->query($query);
        if (mysqli_error($mysqli)) {
            var_dump($query, mysqli_error($mysqli));
            $sqlError = true;
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
 *
 * @param type $aFileName 
 */
function updateLogged($aUnQuery, $aFileName) {
    echo "</br><b>maintenance started</b></br>";
    $f = fopen($aFileName, 'r');
    $counter = 0;
    
    while (!feof($f)) {
        $line = fgets($f, 2048);
        $delim = ':';
        $data = str_getcsv($line, $delim);

        if ($data[1] == 0) {
            sqlUnsubscribe($aUnQuery, $data[0]);
            echo "</br>Unsubscribing: " . $data[0];
            $counter++;
        }
    }
    echo "</br><b>maintenance finished - UUIDs processed: </b>" . ($counter-1) 
            . "</br>";
}

?>
