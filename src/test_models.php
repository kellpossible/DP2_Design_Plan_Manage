<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');
require_once('models/product_inventory.php');

echo("<h1>Testing Models</h1>");
$db = openDatabase(true);
echo("<br><br>");

/*
Tesing accessing the model using the foreach iterator
*/
echo("<h2>Testing Model Access</h2>");
$product_inventory = new ProductInventory($db);
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
$item = $product_inventory->getItemByKey(2);

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
//$test_passed = true;
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
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

/*
Testing that when an item doesn't exist, getItemByKey returns a null value
*/
echo "<h2>Testing: item->getItemByKey() not exist</h2>";
$item = $product_inventory->getItemByKey(1);
$test_passed = $item == NULL;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

/*
Testing the process of editing an item and updating the database
to reflect the changes using the pushValuesToDB() method
*/
echo "<h2>Testing: Edit item and item->pushValuesToDB()</h2>";
$item = $product_inventory->getItemByKey(2);
$item->setStockLevel(60);
$item->pushValuesToDB();

$test_passed = $item->getStockLevel() == 60;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

$db->close();
?>