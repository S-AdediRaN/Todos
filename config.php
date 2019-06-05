<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'jan');
define('DB_PASSWORD', 'janspass');
define('DB_NAME', 'codespace');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$sql = "CREATE TABLE`todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(100) NOT NULL,
  `todoitem` varchar(255) NOT NULL,
  `itemdone` varchar(100) NOT NULL,
  `itemindex` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


$sql = "CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if ($mysqli->query($sql) === TRUE) {
    echo "Table todolist created successfully";
} else {
}
?>