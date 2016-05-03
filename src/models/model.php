<?php
require_once("data/database.php");
/** Represents a table/list of items in the database */

abstract class TableModel implements Iterator, Countable
{
	protected $db;
	protected $table_name;
	protected $item_class;
	protected $models;
	private $rows;



	/** constructor using database instance and table_name
	the database instance needs to have a table with the table_name*/
	public function __construct($db, &$models, $table_name, $item_class)
	{
		$this->db = $db;
		$this->table_name = $table_name;
		$this->item_class = $item_class;
		$this->models = &$models;
	}

	public static abstract function getModelName();

	public function getModel($model_name)
	{
		return $this->models[$model_name];
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
		if ($row != NULL)
		{
			return $this->itemFromRow($row);
		} else {
			return NULL;
		}

	}

	/** count purchases which correspond to a single inventory item */
	public function countByColumnValue($column_name, $column_value)
	{
		return $this->db->countRowsByColumnValue($this->table_name, $column_name, $column_value);
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

	public function newItem()
	{
		$item_class = $this->item_class;
		return new $item_class($this);
	}


	public function rowArraysToItemArray($rows)
	{
		$items = array();
		$item_class = $this->item_class;

		foreach ($rows as $row)
		{
			$item = $item_class::FromRowArray($this, $row);
			array_push($items, $item);
		}

		return $items;
	}

	public function getItemsByValue($column_name, $value)
	{
		$selected_rows = $this->db->selectEqualTo(
			$this->table_name,
			$column_name,
			$value);

		return $this->rowArraysToItemArray($selected_rows);
	}


	public function getItemsByLessThan($column_name, $less_than_value)
	{
		//todo: check that this is a valid column name for this table
		$selected_rows = $this->db->selectLessThan(
			$this->table_name,
			$column_name,
			$less_than_value);

		return $this->rowArraysToItemArray($selected_rows);
	}

	public function getItemsByGreaterThan($column_name, $greater_than_value)
	{
		$selected_rows = $this->db->selectGreaterThan(
			$this->table_name,
			$column_name,
			$less_than_value);


		return $this->rowArraysToItemArray($selected_rows);
	}

	function phpDateToSqliteDate($php_date)
	{
		return $date->format(DATE_RFC3339);
	}

	function sqliteDateToPhpDate($sqlite_date)
	{
		return new DateTime($sqlite_date);
	}

	public function getItemsByRange($column_name, $minmum, $maximum)
	{
		$minimum_val = $minmum;
		$maximum_val = $maximum;
		if ($minimum instanceof DateTime)
		{
			$minimum_val = $this->phpDateToSqliteDate($minimum);
		}

		if ($maximum instanceof DateTime)
		{
			$maximum_val = $this->phpDateToSqliteDate($maximum);
		}

		$selected_rows = $this->db->getRowsByRange(
			$this->table_name,
			$column_name,
			$minimum_val,
			$maximum_val);


		return $this->rowArraysToItemArray($selected_rows);
	}
}

/** Represents an item/row in a table of a database */
abstract class ItemModel
{
	protected $row;
	protected $table_model;
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
		return $this->row;
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
	public function pullValuesFromDB()
	{
		$row = $this->db->selectRowByColumnValue(
			$this->table_model->getTableName(),
			$this->pk_name,
			$this->getPrimaryKey()
			);
		$this->setFromRowDictionary($row);
	}

	/** Push the values in this object into the database */
	public function pushValuesToDB()
	{
		$row = $this->getRowDictionary();
		unset($row[$this->pk_name]); //we don't want to change the ID
		$this->db->editRow(
			$this->table_model->getTableName(),
			$this->pk_name,
			$this->getPrimaryKey(),
			$row);
	}

	/* Insert this object as a row into the database */
	public function insertIntoDB()
	{
		$row = $this->getRowDictionary();
		unset($row[$this->pk_name]); //we don't want to set the ID
		$this->pk = $this->db->insertRow($row);
	}

	/* Delete this object from the database */
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
