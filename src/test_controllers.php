<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once('data/database.php');
require_once('models/product_inventory.php');
require_once('controllers/inventory_controller.php');
require_once('vendor/autoload.php');


$db = openDatabase();
$product_inventory = new ProductInventory($db, "PRODUCT_INVENTORY");
$models = ['product_inventory' => $product_inventory];

$templates = new League\Plates\Engine();
$templates->addFolder('base', 'views/base');
$templates->addFolder('inventory', 'views/inventory');
$templates->addFolder('user', 'views/user');

$inventory_controller = new InventoryController($templates, $models);
$inventory_controller->ViewInventory();




$db->close()
?>