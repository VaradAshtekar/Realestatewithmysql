<?php
/*this file contains database config */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'realestatesell');
//try connecting to the database

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//CHECK the connection
if($conn == false){
    dir('error: cant connect');
}



?>