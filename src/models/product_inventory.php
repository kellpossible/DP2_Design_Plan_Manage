<?php
//TODO: inherit from database object
//to give generic method for setting a property in the database
	class InventoryItem
	{

		//create a new inventory item object
		function __construct(
			$primary_key,
			$name, 
			$cost_price, 
			$sale_price, 
			$stock_level, 
			$description)
		{

			
		}

		function getPrimaryKey()
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


	class ProductInventory
	{
		function __construct()
		{

		}


		//Returns an InventoryItem according to its primary key
		function getInventoryItemByKey($primary_key)
		{

		}

		//Returns an InventoryItem according to its name
		function getInventoryItemByName($primary_key)
		{

		}
	}
?>