<?php
use ProductInventory;
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');
require_once('models/product_inventory.php');
require_once('models/user.php');
require_once('models/purchases.php');




echo("<h1>Testing Models</h1>");
$db = openDatabase(true);
echo("<br><br>");

function test_pass(&$test_a)
{

}


$models = array();
$models[ProductInventory::getModelName()] = new ProductInventory($db, $models);
$models[Purchases::getModelName()] = new Purchases($db, $models);
$models[Users::getModelName()] = new Users($db, $models);

$product_inventory = $models[ProductInventory::getModelName()];
$users = $models[Users::getModelName()];
$purchases = $models[Purchases::getModelName()];

/*
Tesing accessing the model using the foreach iterator
*/
echo("<h2>Testing Model Access</h2>");
echo("<h3>Product Inventory</h3>");
echo("<br>");
foreach($product_inventory as $item)
{
	echo("Name: ".$item->getName());
	echo("<br>");
}

/*
Testing getting an item from the model by its key value
*/
echo "<h2>Testing: model->getItemByKey()</h2>";
$item = $product_inventory->getItemByKey(1);

$test_passed = $item->getStockLevel() == 50;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

/*
Testing deleting a row from the database using the model
*/
echo "<h2>Testing: item->deleteFromDB()</h2>";
$initial_count = count($product_inventory);
$item = $product_inventory->getItemByKey(1);
$item->deleteFromDB();

$test_passed = $initial_count == (count($product_inventory) + 1);
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

/*
Testing inserting a row into the database using the model
*/
echo "<h2>Testing: item->insertIntoDB()</h2>";
$initial_count = count($product_inventory);
$item = InventoryItem::FromValues(
	$product_inventory,
	"Test Item Insertion",
	10,
	20,
	54,
	"Test Item Insertion Description"
	);

$item->insertIntoDB();

$test_passed = ( $initial_count + 1 ) == count($product_inventory);
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

/*
Testing that when an item doesn't exist, getItemByKey returns a null value
*/
echo "<h2>Testing: item->getItemByKey() not exist</h2>";
$item = $product_inventory->getItemByKey(1);
$test_passed = $item == NULL;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

/*
Testing the process of editing an item and updating the database
to reflect the changes using the pushValuesToDB() method
*/
echo "<h2>Testing: Edit item and item->pushValuesToDB()</h2>";
$item = $product_inventory->getItemByKey(2);
$item->setStockLevel(65);
$item->pushValuesToDB();

$item->pullValuesFromDB();
$test_passed = $item->getStockLevel() == 65;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

echo "<h2>Testing: item->pullValuesFromDB()</h2>";
$item = $product_inventory->getItemByKey(2);
$item->setStockLevel(50);
$item->pullValuesFromDB();

$test_passed = $item->getStockLevel() == 60;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


echo "<h2>Testing: user model</h2>";
echo "<table>\n";
foreach($users as $user)
{
	echo "<tr>\n";
	echo sprintf(
		"<td>USERNAME: %s</td><td>PASSWORD: %s</td><td>FULL_NAME: %s</td>",
		$user->getUsername(),
		$user->getPassword(),
		$user->getFullName());
}
echo "</table>\n<br>\n";

$user = $users->getItemByKey(1);
$test_passed = $user->getUsername() == "tester";
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


echo "<h2>Testing: purchases model</h2>";
echo "<table>\n";
foreach($purchases as $purchased_item)
{
	echo "<tr>\n";
	$inventory_item = $purchased_item->getInventoryItem();
	$item_name = "";
	if (is_null($inventory_item))
	{
		$item_name = sprintf("Missing Item (ID = %s)", $purchased_item->getID_Inventory());
	} else {
		$item_name = $inventory_item->getName();
	}
	echo sprintf(
		"<td>Item Name: %s</td><td>Date: %s</td>",
		$item_name,
		$purchased_item->getDate()->format(DATE_RFC3339));
}
echo "</table>\n<br>\n";

echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


$db->close();
?>
