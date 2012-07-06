<?php

/**
 * Configuration file containing database connection info... 
 */
//The url of the database
$dbhost = 'base117.dyndns.org';

//username and password
$dbuser = 'unsubscriber';
$dbpass = 'UnSuBscr1b3r117';

//name of database - schema
$dbname = 'h4dMailList';

//Email Table Name
$emailT = 'Email';

//Email Address Column
$emailC = 'EmailAddress';

//Unsubscribed Column Name
$unsubC = 'Unsubscribed';

//UUID Column Name
$uidC = 'UUID';

//query designed for database, without the parameter.
$unQuery = "
    UPDATE " . $emailT .
    " SET " . $unsubC . " = 1
      WHERE " . $uidC . " = ?";

//Query designed to show which email address was unsubscribed.
$selQuery = "
    SELECT " . $emailC . 
    " FROM " . $emailT .
    " WHERE " . $uidC . " = ";

/*
 * The following variables, are used in order to show the user a message of the
 * type: "Success! Address: sth@sth.com has been succesfully unsubscribed from
 * newsletter database." 
 * 
 * The first variable contains the text: "Success! Address:" and the second
 * " has been ..." till end.
 */

$mesIntro = 'Success! Address: ';
$mesEnding = ' has been succesfully unsubscribed from newsletter database.';
?>
