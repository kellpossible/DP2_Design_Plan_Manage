<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');

$db = openDatabase();

// TESTING: for deleting Rows. 
/*echo("delete test".$db->deleteRowByColumnValue("PRODUCT_INVENTORY", "STOCK_LEVEL", 2));

// TESTING: for inserting new Row data.
$db->insertRow([
	"NAME"=>"New Item",
	"COST_PRICE"=>"15",
	"SALE_PRICE"=>"20",
	"STOCK_LEVEL"=>"1",
	"DESCRIPTION"=>"Insert item test"
	]);
*/

// TESTING: for editing data
//echo("Edit test:".$db->editValue("PRODUCT_INVENTORY", "ID", 22, "COST_PRICE", 15.99));

$db->close();
?>