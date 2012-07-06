<?php
include './config.php';
/**
 * Opens a database connection and set the character set to utf-8. 
 */
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
mysqli_set_charset($mysqli, "utf8");
?>
