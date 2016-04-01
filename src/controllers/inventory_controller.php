<?php 
require_once("controllers/controller.php");  	
require_once("models/product_inventory.php"); 
require('vendor/autoload.php');

/**
* Controls the manipulation and viewing of the product inventory
*/
class InventoryController extends Controller
{
	/** View the product inventory as a table */
	public function ViewInventory()
	{
		echo $this->templates->render('inventory::inventory_item_table', 
			[
				'product_inventory' => $this->models['product_inventory']
			]);
	}

	/** Form to create a new item in the product inventory */
	public function NewItem()
	{
		/* You'll need to check to see if this is a form submission or just a request to get the form (a GET or a POST). In the case of it being a form submission, something like $_POST() to get the values of the form and update the database with the new item*/
	}

	/** Form to edit an item in the product inventory */
	public function EditItem()
	{

	}

	/** Delete item in the product inventory */
	public function DeleteItem()
	{

	}
}
?>
