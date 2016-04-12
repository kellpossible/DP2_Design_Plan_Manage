<?php 
require_once("controllers/controller.php");
require_once("models/product_inventory.php"); 
/**
* Controls the viewing/generating of reports
*/
class ReportController extends Controller
{
	public function NewStockReport()
	{
		//if we are handling a request to view the new stock report for from the browser
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			echo $this->templates->render('report::new_stock_report', 
				[
					'product_inventory' => $this->models['product_inventory']
				]);
		//if we are handling a post from the new stock report form
		} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$stock_level_less_than = $_POST['stock_level_less_than'];
			$report_url = "/index.php/Report/ViewStockReport";
			$report_args = "?stock_level_less_than=".$stock_level_less_than;
			//send browser to the ViewStockReport page with the 
			//stock level less than argument
			$this->redirect($report_url.$report_args);
		}
	}
	public function ViewStockReport()
	{
		//check to see whether the browser passed in ViewStockReport?stock_level_less_than=xxx
		$stock_level_less_than = NULL;
		if(isset( $_GET['stock_level_less_than'])){
			$stock_level_less_than = $_GET['stock_level_less_than'];
		}
		echo $this->templates->render('report::stock_report', 
			[
				'product_inventory' => $this->models['product_inventory'],
				'stock_level_less_than' => $stock_level_less_than
			]);
	}
}
?>
