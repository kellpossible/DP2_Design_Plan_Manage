<?php
require_once("models/model.php");
require_once("models/product_inventory.php");
/** Represents the purchased item
*/

class Purchases extends TableModel
{
	public function __construct($db, &$models)
	{
		parent::__construct($db, $models, "PURCHASES", "PurchasedItem");
	}

	public static function getModelName()
	{
		return "purchases";
	}


	/** count purchases which correspond to a single inventory item */
	public function countByInventoryItem($id_inventory)
	{
		return $this->countByColumnValue("ID_INVENTORY", $id_inventory);
	}
}
/** Represents an inventory item in the product inventory table.
*/

class PurchasedItem extends ItemModel
{
	/* mock variables, in the future this will grab and set values in the database
	using the getDatabaseValue and setDatabaseValue methods on ItemModel */

	private $purchased_item;
	private $date;
	private $id_inventory;

	//create a new purchased item object
	function __construct($purchased_item)
	{
		parent::__construct($purchased_item);

        ///items from new table
		$this->row["DATE"] = NULL;
		$this->row["ID_INVENTORY"] = NULL;
	}
	public static function FromValues(
		$purchased_item,
		$date,
		$id_inventory)
	{
		$classname = get_called_class();
		$item = new $classname($purchased_item);
		$item->setDate($date);
		$item->setID_inventory($id_inventory);
		return $item;
	}

	public function getDate()
	{
		return $this->table_model->sqliteDateToPhpDate($this->row["DATE"]);
	}

	public function setDate(DateTime $date)
	{
		$this->row["DATE"] = $this->table_model->phpDateToSqliteDate($date);
	}

	public function getID_inventory()
	{
		return $this->row["ID_INVENTORY"];
	}

	public function setID_inventory($id_inventory)
	{
		$this->row["ID_INVENTORY"] = $id_inventory;
	}

	public function getInventoryItem()
	{
		$product_inventory = $this->table_model->getModel(ProductInventory::getModelName());
		return $product_inventory->getItemByKey($this->getID_inventory());
	}
}
?>
