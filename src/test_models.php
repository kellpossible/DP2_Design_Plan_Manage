<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');
require_once('models/product_inventory.php');

echo("<h1>Testing Models</h1>");
$db = openDatabase(true);
echo("<br><br>");
echo("<h2>Testing Model Access</h2>");
$product_inventory = new ProductInventory($db);
echo("<h3>Product Inventory</h3>");
echo("<br>");
foreach($product_inventory as $item)
{
	echo("Name: ".$item->getName());
	echo("<br>");
}

echo "<h2>Testing: model->getItemByKey()</h2>";
$item = $product_inventory->getItemByKey(1);

$test_passed = $item->getStockLevel() == 50;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


echo "<h2>Testing: item->deleteFromDB()</h2>";
$initial_count = count($product_inventory);
$item = $product_inventory->getItemByKey(1);
$item->deleteFromDB();

$test_passed = $initial_count == (count($product_inventory) + 1);
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );

$db->close();
?>