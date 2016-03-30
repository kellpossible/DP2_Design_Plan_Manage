<?php

/** Represents an inventory item in the product inventory table.
*/
class InventoryItem extends ItemModel
{

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

		
	}


	function getName()
	{

	}

	function setName()
	{

	}

	function getCostPrice()
	{

	}

	function setCostPrice()
	{

	}

	function getSalePrice()
	{

	}

	function setSalePrice()
	{

	}

	function getStockLevel()
	{

	}

	function setStockLevel()
	{

	}
}

/** Represents the product inventory
*/
class ProductInventory extends TableModel
{
	function __construct()
	{

	}
}
?>