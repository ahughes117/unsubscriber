<?php
include './config.php';
/**
 * Opens a database connection and set the character set to utf-8. 
 */
$dbError = false;

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
    $dbError = true;
} else {
    mysqli_set_charset($mysqli, "utf8");
}
?>
