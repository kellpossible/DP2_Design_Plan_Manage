<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');

$db = openDatabase();
$db->populateDatabase();


echo("".$db->checkTableExists("PRODUCT_INVENTORY"));


$db->close();
?>