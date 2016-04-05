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
        $itemindex = $_GET['key'];
        
        $product_inventory = $this->models['product_inventory'];
            
        $item = $product_inventory->getItemByKey($itemindex);
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		
			echo $this->templates->render('inventory::edit_inventory_item', ['item' => $item]); 
		}
		
		else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
			$name = $_POST['name'];
			$description = $_POST['desc'];
			$cost_price = $_POST['cost'];
			$sale_price = $_POST['sale'];
			$stock_level = $_POST['stock'];
						
			$item->setName($name);
			$item->setDescription($description);
			$item->setCostPrice($cost_price);
			$item->setSalePrice($sale_price);
			$item->setStockLevel($stock_level);
			
			echo $this->templates->render('inventory::inventory_item_table');
			
		}
		
		else {
			//no request made
		}
	}

	/** Delete item in the product inventory */
	public function DeleteItem()
	{

	}
}
?>
