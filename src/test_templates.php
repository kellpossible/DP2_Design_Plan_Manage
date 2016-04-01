<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');
require_once('models/product_inventory.php');
require('vendor/autoload.php');

$db = openDatabase();
$product_inventory = new ProductInventory($db, "PRODUCT_INVENTORY");

$templates = new League\Plates\Engine();
$templates->addFolder('base', 'views/base');
$templates->addFolder('inventory', 'views/inventory');
$templates->addFolder('user', 'views/user');
echo $templates->render('inventory::edit_inventory_item');


$db->close()


?>