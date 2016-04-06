<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');

$db = openDatabase();

//echo("".$db->checkTableExists("PRODUCT_INVENTORY"));
echo("delete test".$db->deleteRowByColumnValue("PRODUCT_INVENTORY", "STOCK_LEVEL", 2));
//$db->exec('DELETE FROM PRODUCT_INVENTORY WHERE STOCK_LEVEL="50"');
$db->insertRow([
	"NAME"=>"New Item",
	"COST_PRICE"=>"15",
	"SALE_PRICE"=>"20",
	"STOCK_LEVEL"=>"1",
	"DESCRIPTION"=>"Insert item test"
	]);

$db->close();
?>