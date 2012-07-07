<?php

include 'db/opendb.php';
include 'db/utils.php';
include 'config.php';

/**
 * php unsubscriber. Takes a uuid as a parameter in the url.
 */
$uid = htmlspecialchars($_GET["uuid"]);

if ($dbError == false) {
//prepare unsubscribe statement
    $stmt = $mysqli->prepare($unQuery);
//execute unsubscribe statement
    $stmt->bind_param('s', $uid);
    $stmt->execute();

    $res = sqliQuery($selQuery . "'" . $uid . "'");
    while ($mailR = mysqli_fetch_object($res)) {
        $mail = $mailR->$emailC;
    }
}
$file = fopen($log, 'a') or die("cannot write log. UUID: " . $uid);
if ($file != false && ($dbError == true || $sqlError == true)) {
    
    //checking if uuid already logged.
    if(checkUid($log, $uid) == false){
        fwrite($file, $uid . ":0\n");
    }
    echo $dataFail;
} else {
    fwrite($file, $uid . ":1\n");
    echo $mesIntro . $mail . $mesEnding;
}
?>
