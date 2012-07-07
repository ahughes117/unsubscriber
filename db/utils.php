<?php
include 'opendb.php';
/**
 * Various sql standard functions for manipulating the database
 * Also utility functions needed for the project.
 * Update: Removed the other functions from the project, no need to have them.
 */

$sqlError = false;

function sqliQuery($query) {
    global $mysqli;
    if ($dbError == false && $query != "") {
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
function checkUid($aFile, $aUid){
    
    $f = new SplFileObject($aFile);
    $f->setFlags(SplFileObject::DROP_NEW_LINE);
    
    $match = false;
    foreach($f as $line){
        if(false !== stripos($line, $aUid)){
            $match = true;
            break;
        }
    }
    if(true === $match){
        return true;
    } else {
        return false;
    }
}

?>
