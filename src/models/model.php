<?php
require_once("data/database.php");
/** Represents a table/list of items in the database */

abstract class TableModel implements Iterator, Countable
{
	private $mockups;

	/** constructor using database instance and table_name
	the database instance needs to have a table with the table_name*/
	public function __construct($db, $table_name)
	{
		$this->mockups = array();
		$this->generateMockups();
	}

	protected function getMockups()
	{
		return $this->mockups;
	}

	protected function addMockup($mockup)
	{
		array_push($this->mockups, $mockup);
	}

	abstract protected function generateMockups();


	/*get item by primary key*/
	public function getItemByKey($pk)
	{
		foreach($this->mockups as $mockup_item)
		{
			if ($mockup_item->getPrimaryKey() == $pk)
			{
				return $mockup_item;
			}
		}

		return null;
	}

	public function addItem($item)
	{
		$this->addMockup($item);
	}

	public function deleteItem($pk)
	{

	}


	/** Iterator implementation */
	public function rewind()
	{
		return reset($this->mockups);
	}

	public function current()
	{
		return current($this->mockups);
	}

	public function key()
	{
		return key($this->mockups);
	}

	public function next()
	{
		return next($this->mockups);
	}

	public function valid()
	{
		return key($this->mockups) !== null;
	}

	public function count()
	{
		return count($this->mockups);
	}

}

/** Represents an item/row in a table of a database */
abstract class ItemModel
{
	private $pk;
	private $table_model;

	//pk = primary key
	public function __construct($table_model, $pk)
	{
		$this->pk = $pk;
		$this->table_model;
	}

	protected function getTableModel()
	{
		return $this->table_model;
	}

	//get the primary key of this item
	public function getPrimaryKey()
	{
		return $this->pk;
	}
	
	protected function getDatabaseValue($column_name)
	{

	}

	protected function setDatabaseValue($column_name, $value)
	{

	}
}
?>