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
	public function ViewInventory($params=array())
	{
		$this->requireLogin("/index.php/Inventory/ViewInventory");
		echo $this->templates->render('inventory::inventory_item_table',
			[
				'product_inventory' => $this->models['product_inventory'],
				'models' => $this->models
			]);
	}

	/** Form to create a new item in the product inventory */
	public function NewItem($params=array())
	{
		/* You'll need to check to see if this is a form submission or just a request to get the form (a GET or a POST). In the case of it being a form submission, something like $_POST() to get the values of the form and update the database with the new item*/
		$this->requireLogin("/index.php/Inventory/NewItem");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $description = $_POST['desc'];
      $cost_price = $_POST['cost'];
      $sale_price = $_POST['sale'];
      $stock_level = $_POST['stock'];

  //new instance of InventoryItem to add new item into the db


      $product_inventory = $this->models['product_inventory'];
      $item = $product_inventory->newItem();

      $item->setName($name);
      $item->setDescription($description);
      $item->setCostPrice($cost_price);
      $item->setSalePrice($sale_price);
      $item->setStockLevel($stock_level);
      $item->insertIntoDB();

      $this->redirect("/index.php/Inventory/ViewInventory");
    } else {
      echo $this->templates->render('inventory::new_inventory_item', ['models' => $this->models]);
    }
	}

	/** Form to edit an item in the product inventory */
  /** Function checks if get or post is requested, grabs the item from the database depending on the key passed through the URL. If the edit link is clicked from the inventory table view the GET will run and render the edit template view and pass through the item data for the view to access with $this->e($item) */
	public function EditItem($params=array())
	{
		$this->requireLogin("/index.php/Inventory/ViewInventory");
    //Checking if there is a key paramater in the URL when edititem is accessed.
    if(isset( $_GET['key'])){
      $itemindex = $_GET['key'];
      $product_inventory = $this->models['product_inventory'];

      $item = $product_inventory->getItemByKey($itemindex);

      if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        echo $this->templates->render('inventory::edit_inventory_item', ['item' => $item, 'models' => $this->models]);
      }

      else if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        //Accessing the POST variables from the form using the html 'name' input
        $name = $_POST['name'];
        $description = $_POST['desc'];
        $cost_price = $_POST['cost'];
        $sale_price = $_POST['sale'];
        $stock_level = $_POST['stock'];


        //setting the value on the selected item
        $item->setName($name);
        $item->setDescription($description);
        $item->setCostPrice($cost_price);
        $item->setSalePrice($sale_price);
        $item->setStockLevel($stock_level);
        $item->pushValuesToDB();


        $this->redirect("/index.php/Inventory/ViewInventory");

      }

      else {
          //no request made
      }

    }
    else {
        $this->ViewInventory();
    }
	}

	/** Delete item in the product inventory */
	public function DeleteItem($params=array())
	{
		$this->requireLogin("/index.php/Inventory/NewItem");
    if(isset( $_GET['key'])){
      $itemindex = $_GET['key'];

      $product_inventory = $this->models['product_inventory'];
      $item = $product_inventory->getItemByKey($itemindex);
      $item->deleteFromDB();

      $this->redirect("/index.php/Inventory/ViewInventory");
    }
	}
}
?>
