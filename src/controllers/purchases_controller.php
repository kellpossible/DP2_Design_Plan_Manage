<?php
require_once("controllers/controller.php");
require_once("models/purchases.php");
require('vendor/autoload.php');

/**
 * Controls the manipulation and viewing of the sale
 */
class PurchasesController extends Controller
{
    /** View the sale data as table layout */
    public function ViewSale($params = array())
    {
        echo $this->templates->render('purchases::view_purchase',//the view to render (see views/purchases/view_purchase.php)
            [
                'purchases' => $this->models['purchases'] //the model to use (see models/purchases.php
            ]);
    }

    /** Form to create a new sale in the using the sale model */
    public function NewSale($params = array())
    {

        // Check if the data is coming from the form (post)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_inventory = rand(1,20);
            $date =  (new DateTime('now'))->format('Y-m-d');
            //new instance of InventoryItem to add new item into the db
            $purchased_item = $this->models['purchases'];
            $item = $purchased_item->newItem();
            $item->setDate($date);
            $item->setProductId($id_inventory);

            $item->insertIntoDB();

            // redirect to listing page after publishing new sale record
            $this->redirect("/index.php/purchases/ViewSale");
        } else { //or accessed directly using a browser (get)
            // render form for new sale
            echo $this->templates->render('purchases::send_purchase');
        }

    }

}

?>