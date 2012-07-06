<?php

include 'db/opendb.php';
include 'db/sql.php';
include 'config.php';

/**
 * php unsubscriber. Takes a uuid as a parameter in the url.
 */

$uid = htmlspecialchars($_GET["UUID"]);

//prepare unsubscribe statement
$stmt = $mysqli->prepare($unQuery);
//execute unsubscribe statement
$stmt->bind_param('s', $uid);
$stmt->execute();

$res = sqliQuery($selQuery . "'" . $uid . "'");
while($mailR = mysqli_fetch_object($res)){
    $mail = $mailR->$emailC;
}

echo $mesIntro . $mail . $mesEnding;
//header("Location: http://10.0.0.117/hug4dogs/");
?>
