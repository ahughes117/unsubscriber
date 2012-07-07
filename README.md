unsubscriber
============

A short php - mysql unsubscriber. Takes a uuid as a parameter embedded in the URL, unsubscribes the email address from a mysql database by changing a flag and confirms the user about it. Very "soft coded" configuration file.

Also new added feature is an offline database logger. All uuids are logged. The ones unsubscribing succesfully are logged into log file with the ending :1. Any other failed updates to the database, mainly because of connectivity issues are logged into the log file with the ending :0. 

To execute the failed updates once the connection is restored, the user may log onto the unsubscriber with the parameter ?maintenance=1 in the url.

Example:
http://myfantasticurl.com/unsubscriber.php?maintenance=1