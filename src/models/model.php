<?php

/** Represents a table/list of items in the database */
class TableModel
{
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