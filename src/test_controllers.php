<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require( 'php_error.php' );
\php_error\reportErrors();


require_once('data/database.php');
require_once('models/product_inventory.php');
require_once('controllers/inventory_controller.php');
require_once('vendor/autoload.php');


$db = openDatabase(true);
$models = array();
$models[Users::getModelName()] = new Users($db, $models);
$models[ProductInventory::getModelName()] = new ProductInventory($db, $models);

$templates = new League\Plates\Engine();
$templates->addFolder('base', 'views/base');
$templates->addFolder('inventory', 'views/inventory');
$templates->addFolder('user', 'views/user');
$templates->addFolder('report', 'views/report');

$inventory_controller = new InventoryController($templates, $models);
$inventory_controller->ViewInventory();


$inventory_controller->NewItem();
$inventory_controller->EditItem();


$db->close()
?>
