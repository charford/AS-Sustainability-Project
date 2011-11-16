<?php
//details for mysql server connection below
$host = "localhost";
$username = "asadmin";
$password = "aspassword";
$db_name = "asadmin";
                               //with group members...
//connect to mysql db
mysql_connect("$host", "$username", "$password")or die("can't connect to db");
mysql_select_db("$db_name")or die("cannot select db");
?>
