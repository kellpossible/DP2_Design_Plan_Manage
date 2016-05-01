<?php 
require_once("controllers/controller.php");
require_once("models/purchased_item.php"); 

/**
* Controls the viewing/generating of reports
*/

class SalesReportController extends Controller
{
	public function NewStockReport()
	{
		//if we are handling a request to view the new stock report for from the browser
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			echo $this->templates->render('report::new_sales_report', 
				[
					'purchased_item' => $this->models['purchased_item']
				]);
				
		//if we are handling a post from the new stock report form
		} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//$stock_level_less_than = $_POST['stock_level_less_than'];
			$report_url = "/index.php/Report/ViewStockReport";
			//$report_url .= "?stock_level_less_than=".$stock_level_less_than;
			//send browser to the ViewStockReport page with the 
			//stock level less than argument
			$this->redirect($report_url);
		}
	}
	public function ViewStockReport()
	{
		//check to see whether the browser passed in ViewStockReport?stock_level_less_than=xxx
        // Check to see if the browser has passed in the ViewStockReport? 
		$stock_level_less_than = NULL;
		if(isset( $_GET['//stock_level_less_than'])){
			//$stock_level_less_than = $_GET['stock_level_less_than'];
			echo $this->templates->render('report::stock_report', 
			[
				'sales_report' => $this->models['sales_report'],
				//'stock_level_less_than' => $stock_level_less_than
			]);
		} else {
			echo("invalid report arguments");
		}
		
	}
}
?>
