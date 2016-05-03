<?php
require_once("models/model.php");
require_once("models/purchases.php");

/** Represents the product inventory
*/
class ProductInventory extends TableModel
{
	public function __construct($db, &$models)
	{
		parent::__construct($db, $models, "PRODUCT_INVENTORY", "InventoryItem");
	}

	public static function getModelName()
	{
		return "product_inventory";
	}
}


/** Represents an inventory item in the product inventory table.
*/
class InventoryItem extends ItemModel
{
	/* mock variables, in the future this will grab and set values in the database
	using the getDatabaseValue and setDatabaseValue methods on ItemModel */
	private $product_inventory;
	private $name;
	private $cost_price;
	private $sale_price;
	private $stock_level;
	private $description;

	//create a new inventory item object
	function __construct($product_inventory)
	{
		parent::__construct($product_inventory);
		$this->row["NAME"] = NULL;
		$this->row["COST_PRICE"] = NULL;
		$this->row["SALE_PRICE"] = NULL;
		$this->row["STOCK_LEVEL"] = NULL;
		$this->row["DESCRIPTION"] = NULL;
	}

	public static function FromValues(
		$product_inventory,
		$name,
		$cost_price,
		$sale_price,
		$stock_level,
		$description)
	{
		$classname = get_called_class();
		$item = new $classname($product_inventory);
		$item->setName($name);
		$item->setCostPrice($cost_price);
		$item->setSalePrice($sale_price);
		$item->setStockLevel($stock_level);
		$item->setDescription($description);
		return $item;
	}

	public function getName()
	{
		return $this->row["NAME"];
	}

	public function setName($name)
	{
		$this->row["NAME"] = $name;
	}

	public function getCostPrice()
	{
		return $this->row["COST_PRICE"];
	}

	public function setCostPrice($cost_price)
	{
		$this->row["COST_PRICE"] = $cost_price;
	}

	public function getSalePrice()
	{
		return $this->row["SALE_PRICE"];
	}

	public function setSalePrice($sale_price)
	{
		$this->row["SALE_PRICE"] = $sale_price;
	}

	public function getStockLevel()
	{
		return $this->row["STOCK_LEVEL"];
	}

	public function setStockLevel($stock_level)
	{
		$this->row["STOCK_LEVEL"] = $stock_level;
	}

	public function getDescription()
	{
		return $this->row["DESCRIPTION"];
	}

	public function setDescription($description)
	{
		$this->row["DESCRIPTION"] = $description;
	}


	// public function deleteFromDB()
	// {
	// 	parent::deleteFromDB();
	// 	$purchases = $this->table_model->getModel(Purchases::getModelName());
	// 	$purchase_items = $purchases->getItemsByValue("ID_INVENTORY", $this->getPrimaryKey());
	// 	foreach ($purchase_items as $purchase_item)
	// 	{
	// 		echo $purchase_item->getID_Inventory();
	// 		$purchase_item->deleteFromDB();
	// 	}
	// }

}
?>
