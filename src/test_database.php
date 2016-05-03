<?php
use DateTime;
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('data/database.php');

$db = openDatabase(true);

// TESTING: for deleting Rows.
//echo("delete test".$db->deleteRowByColumnValue("PRODUCT_INVENTORY", "STOCK_LEVEL", 2));

// TESTING: for inserting new Row data.
echo "<h1>Testing</h1>";
$db->insertRow([
	"NAME"=>"New Item",
	"COST_PRICE"=>"15",
	"SALE_PRICE"=>"20",
	"STOCK_LEVEL"=>"1",
	"DESCRIPTION"=>"Insert item test"
	]);


echo "<h2>selectRowByColumnValue</h2>";
$test_passed = $db->selectRowByColumnValue("PRODUCT_INVENTORY", "NAME", "New Item")["SALE_PRICE"] == 20;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


echo "<h2>editRow with selectRowValues</h2>";
$row = $db->selectRowByColumnValue("PRODUCT_INVENTORY", "NAME", "New Item");
$row["SALE_PRICE"] = 30;
unset($row["ID"]);
$db->editRow("PRODUCT_INVENTORY", "NAME", "New Item", $row);

$test_passed = $db->selectRowByColumnValue("PRODUCT_INVENTORY", "NAME", "New Item")["SALE_PRICE"] == 30;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


echo "<h2>editRow single value</h2>";
$row = [
	"SALE_PRICE" => 50
];
$db->editRow("PRODUCT_INVENTORY", "NAME", "New Item", $row);

$test_passed = $db->selectRowByColumnValue("PRODUCT_INVENTORY", "NAME", "New Item")["SALE_PRICE"] == 50;
//$test_passed = true;
echo "Test Passed: ".( ($test_passed) ? 'true' : 'false' );


echo "<h2>getRows</h2>";
$rows = $db->getRows("PRODUCT_INVENTORY");
echo "<table>";
foreach($rows as $row)
{
	echo "<tr>";
	foreach($row as $column_name=>$column_value)
	{
		echo sprintf("<td>%s = %s </td>\n", $column_name, $column_value);
	}

	echo "</tr>\n";
}
echo "</table>";



echo "<h2>Testing Time Range</h2>";
echo "<br>";
$d1 = new DateTime("2016-05-01 00:00:00"); //start date
$d2 = new DateTime("now");
echo "From ";
echo $d1->format(DATE_RFC3339);
echo " To ";
echo $d2->format(DATE_RFC3339);
echo "<br>";
$range_rows = $db->getRowsByRange("PURCHASES", "DATE", $d1->format(DATE_RFC3339), $d2->format(DATE_RFC3339));
echo print_r($range_rows);

echo "<h2>Select High Stock</h2>";
$rows = $db->selectHighStockItems("PRODUCT_INVENTORY", "STOCK_LEVEL", "50");
echo "<table>";
foreach($rows as $row)
{
	echo "<tr>";
	foreach($row as $column_name=>$column_value)
	{
		if($column_name != "STOCK_LEVEL")
			echo sprintf("<td>%s = %s </td>\n", $column_name, $column_value);
		else
			echo sprintf("<td>%s = <strong>%s<strong> </td>\n", $column_name, $column_value);
	}

	echo "</tr>\n";
}
echo "</table>";

echo "<h2>Select Low Stock</h2>";
$rows = $db->selectLowStockItems("PRODUCT_INVENTORY", "STOCK_LEVEL", "50");
echo "<table>";
foreach($rows as $row)
{
	echo "<tr>";
	foreach($row as $column_name=>$column_value)
	{
		if($column_name != "STOCK_LEVEL")
			echo sprintf("<td>%s = %s </td>\n", $column_name, $column_value);
		else
			echo sprintf("<td>%s = <strong>%s<strong> </td>\n", $column_name, $column_value);
	}

	echo "</tr>\n";
}
echo "</table>";


// TESTING: for editing data
//echo("Edit test:".$db->editValue("PRODUCT_INVENTORY", "ID", 22, "COST_PRICE", 15.99));


$db->close();
?>
