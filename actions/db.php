<?php 
 
$MYSQL_INFO = "mysql:host=localhost;dbname=polobank";
$MYSQL_USER = "root";
$MYSQL_PASSWORD = "";

$db = new PDO($MYSQL_INFO, $MYSQL_USER, $MYSQL_PASSWORD);

function killConnection_PDO($db) {
    $db->query('KILL CONNECTION_ID()'); 
    $db = null;
}
?>