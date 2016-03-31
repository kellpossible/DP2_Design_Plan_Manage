<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');
require_once('models/product_inventory.php');

echo("<h1>Database Stuff</h1>");
$db = openDatabase();
echo("<br><br>");
echo("<h1>Model Stuff</h1>");
$product_inventory = new ProductInventory($db, "PRODUCT_INVENTORY");
echo("<h2>Product Inventory</h2>");
echo("<br>");
foreach($product_inventory as $item)
{
	echo("Name: ".$item->getName());
	echo("<br>");
}

$db->close();
?>