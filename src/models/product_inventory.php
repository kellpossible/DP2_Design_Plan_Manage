<?php
require_once("models/model.php");

/** Represents the product inventory
*/
class ProductInventory extends TableModel
{
	protected function generateMockups()
	{
		$this->addMockup(new InventoryItem($this, 0, "test item 0", 1.0, 5.2, 4, "a very serious item"));
		$this->addMockup(new InventoryItem($this, 1, "test item 1", 3.0, 7.0, 0, "not a test item"));
		$this->addMockup(new InventoryItem($this, 2, "test item 2", 4.0, 2.0, 2, "a test item oooh"));
		$this->addMockup(new InventoryItem($this, 3, "test item 3", 6.0, 100.0, 7, "a test item hurray"));
		$this->addMockup(new InventoryItem($this, 4, "test item 4", 2.0, 6.0, 1, "a test item nay"));
		$this->addMockup(new InventoryItem($this, 5, "test item 5", 1.4, 2.2, 87, "a test item yay"));
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
	function __construct(
		$product_inventory,
		$pk,
		$name, 
		$cost_price, 
		$sale_price, 
		$stock_level, 
		$description)
	{
		parent::__construct($product_inventory, $pk);
		$this->name = $name;
		$this->cost_price = $cost_price;
		$this->sale_price = $sale_price;
		$this->stock_level = $stock_level;
		$this->description = $description;
	}


	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getCostPrice()
	{
		return $this->cost_price;
	}

	public function setCostPrice($cost_price)
	{
		$this->cost_price = $cost_price;
	}

	public function getSalePrice()
	{
		return $this->sale_price;
	}

	public function setSalePrice($sale_price)
	{
		$this->sale_price = $sale_price;
	}

	public function getStockLevel()
	{
		return $this->stock_level;
	}

	public function setStockLevel($stock_level)
	{
		$this->stock_level = $stock_level;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

}
?>