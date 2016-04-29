<?php
require_once("models/model.php");
/** Represents the purchased item
*/

class Purchases extends TableModel
{
	public function __construct($db)
	{
		parent::__construct($db, "PURCHASES", "PurchasedItem");
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
	
	//create a new purchased item object
	function __construct($purchased_item)
	{
		parent::__construct($purchased_item);
        
        ///items from new table 
		$this->row["DATE"] = NULL;
	}
	public static function FromValues(
		$purchased_item,
		$date)
	{
		$classname = get_called_class();
		$item = new $classname($purchased_item);
		$item->setDate($date);
		return $item;
	}
    
	public function getDate()
	{
		return $this->row["DATE"];
	}
    
	public function setDate($date)
	{
		$this->row["DATE"] = $date;
	}
}
?>
