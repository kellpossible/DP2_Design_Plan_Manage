<?php
require_once("data/database.php")
/** Represents a table/list of items in the database */

class TableModel
{
	/** constructor using database instance and table_name
	the database instance needs to have a table with the table_name*/
	function __construct($db, $table_name)
	{

	}


	/*get item by primary key*/
	function getItemByKey($pk)
	{

	}

	//get an item by its name
	function getItemByName($name)
	{

	}

	function deleteItem($pk)
	{

	}

}

/** Represents an item/row in a table of a database */
class ItemModel
{
	//pk = primary key
	function __construct($table_model, $pk)
	{

	}

	//get the primary key of this item
	function getPrimaryKey()
	{

	}
	
	function getDatabaseValue($column_name)
	{

	}

	function setDatabaseValue($column_name, $value)
	{

	}
}
?>