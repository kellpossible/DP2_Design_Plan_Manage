<?php
require_once("data/database.php");
/** Represents a table/list of items in the database */

abstract class TableModel implements Iterator, Countable
{
	protected $db;
	protected $table_name;
	protected $item_class;
	private $rows;


	/** constructor using database instance and table_name
	the database instance needs to have a table with the table_name*/
	public function __construct($db, $table_name, $item_class)
	{
		$this->db = $db;
		$this->table_name = $table_name;
		$this->item_class = $item_class;
	}


	private function itemFromRow($row)
	{
		$item_class = $this->item_class;
		return $item_class::FromRowArray($this, $row);
	}


	/*get item by primary key*/
	public function getItemByKey($pk)
	{
		$row = $this->db->selectRowByColumnValue(
			$this->table_name,
			$this->getPKName(),
			$pk);
		return $this->itemFromRow($row);
	}

	protected function pullRows()
	{
		$this->rows = $this->db->getRows($this->table_name);
	}

	/** Iterator implementation */
	public function rewind()
	{
		//$this->iterator_start_number_of_rows = count($this);
		$this->pullRows();
		return reset($this->rows);
	}

	public function current()
	{
		return $this->itemFromRow(current($this->rows));
	}

	public function key()
	{
		return key($this->rows);
	}

	public function next()
	{
		return next($this->rows);
	}

	public function valid()
	{
		return key($this->rows) !== null;//count($this->rows) == count($this); //todo: if start number of rows == current number of rows
	}

	public function count()
	{
		return $this->db->getNumberOfRows($this->table_name);
	}

	public function getDatabase()
	{
		return $this->db;
	}

	public function getTableName()
	{
		return $this->table_name;
	}

	public function getPKName()
	{
		return "ID";
	}
}

/** Represents an item/row in a table of a database */
abstract class ItemModel
{
	protected $row;
	private $table_model;
	private $db;
	private $pk_name;

	//pk = primary key
	public function __construct(
		$table_model)
	{
		$this->table_model = $table_model;
		$this->db = $table_model->getDatabase();
		$this->pk_name = $table_model->getPKName();
		$this->row = [
			"ID" => NULL
		];
	}

	public static function FromRowArray($table_model, $row)
	{
		$classname = get_called_class();
		$item = new $classname($table_model);
		$item->setFromRowDictionary($row);
		return $item;
	}

	public static function FromDB($table_model, $pk)
	{
		$classname = get_called_class();
		$item = new $classname($table_model);
		$item->setPrimaryKey($pk);
		$item->pullValuesFromDB();
		return $item;
	}


	protected function getTableModel()
	{
		return $this->table_model;
	}

	//get the primary key of this item
	public function getPrimaryKey()
	{
		return $this->row[$this->pk_name];
	}

	protected function setPrimaryKey($pk)
	{
		$this->row[$this->pk_name] = $pk;
	}

	protected function getRowDictionary()
	{
		return [
			$this->pk_name=>$this->row[$this->pk_name]
		];
	}
	protected function setFromRowDictionary($row)
	{
		//TODO: throw an error when the column name is not in $row already.
		foreach($row as $column_name=>$column_value)
		{
			$this->row[$column_name] = $column_value;
		}
	}

	/** Pull values from the database into this object*/
	protected function pullValuesFromDB()
	{
		$row = $this->db->selectRowByColumnValue(
			$this->table_model->getTableName(),
			$this->pk_name,
			$this->getPrimaryKey()
			);
		$this->setFromRowDictionary($row);
	}

	/** Push the values in this object into the database */
	protected function pushValuesToDB()
	{
		$row = $this->getRowDictionary();
		unset($row[$table_model->getPKName()]); //we don't want to change the ID
		$this->db->editRow($row);
	}

	public function insertIntoDB()
	{
		$row = $this->getRowDictionary();
		unset($row[$this->pk_name]); //we don't want to set the ID
		$this->pk = $this->db->insertRow($row);
	}

	public function deleteFromDB()
	{
		$this->db->deleteRowByColumnValue(
			$this->table_model->getTableName(),
			$this->pk_name,
			$this->row[$this->pk_name]
			);
	}
}
?>