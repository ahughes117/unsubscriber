<?php

/**
 * Configuration file containing database connection info... 
 */
//The url of the database
$dbhost = '10.0.0.117';

//username and password
$dbuser = 'unsubscriber';
$dbpass = 'UnsuBsCr1B3R';

//name of database - schema
$dbname = 'h4dMailDummy';

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

//Queries that did not succeed to connect and interact with the database. (UUIDs)
$log = 'errors.txt';

/*
 * The following variables, are used in order to show the user a message of the
 * type: "Success! Address: sth@sth.com has been succesfully unsubscribed from
 * newsletter database." 
 * 
 * The first variable contains the text: "Success! Address:" and the second
 * " has been ..." till end.
 */

$mesIntro = '<b>Success!</b> Email Address: <b>';
$mesEnding = '</b></br>has been succesfully unsubscribed from the newsletter email database.';

/*
 *  The following variable contains a message describing that his email address
 *  has been logged and may be removed from the database in the near future...
 */

$dataFail = '</br>Your address has been logged in order to be <b>unsubscribed</b> from the newsletter email database.'

?>
