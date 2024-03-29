<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');
require_once('models/product_inventory.php');
require('vendor/autoload.php');

$db = openDatabase(true);
$product_inventory = new ProductInventory($db, "PRODUCT_INVENTORY");

$templates = new League\Plates\Engine();
$templates->addFolder('base', 'views/base');
$templates->addFolder('inventory', 'views/inventory');
$templates->addFolder('user', 'views/user');
$templates->addFolder('report', 'views/report');
echo $templates->render('inventory::inventory_item_table', 
			[
				'product_inventory' => $product_inventory
			]);


$db->close();


?>