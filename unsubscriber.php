<?php

include 'db/opendb.php';
include 'db/utils.php';
include 'config.php';

/**
 * php unsubscriber. Takes a uuid as a parameter in the url.
 */
$uid = htmlspecialchars($_GET["uuid"]);
$maintenance = htmlspecialchars($_GET["maintenance"]);

if ($maintenance == 1) {
    //echo $unQuery . $log;
    updateLogged($unQuery, $log);
}

if ($dbError == false) {
    sqlUnsubscribe($unQuery, $uid);

    $res = sqliQuery($selQuery . "'" . $uid . "'");
    while ($mailR = mysqli_fetch_object($res)) {
        $mail = $mailR->$emailC;
    }
}
$file = fopen($log, 'a') or die("cannot write log. UUID: " . $uid);
if ($maintenance != 1) {
    if ($file != false && $dbError == true) {

        //checking if uuid already logged.
        if (checkUid($log, $uid) == false) {
            fwrite($file, $uid . ":0\n");
        }
        echo $dataFail;
    } else if ($mail == null && $uid != null) {
        echo "Wrong UUID. Your email address is possibly not registered in this database.";
    } else {
        if (checkUid($log, $uid) == false) {
            fwrite($file, $uid . ":1\n");
        }
        echo $mesIntro . $mail . $mesEnding;
    }
}
?>
