<?php
require_once("controllers/controller.php");
require_once("models/product_inventory.php");
require_once("models/purchases.php");
/**
* Controls the viewing/generating of reports
*/
class ReportController extends Controller
{
	public function NewStockReport()
	{
		$this->requireLogin("/index.php/Report/NewStockReport");
		//if we are handling a request to view the new stock report for from the browser
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			echo $this->templates->render('report::new_stock_report',
				[
					'product_inventory' => $this->models['product_inventory'],
					'models' => $this->models
				]);
		//if we are handling a post from the new stock report form
		} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$stock_level_less_than = $_POST['stock_level_less_than'];
			$report_url = "/index.php/Report/ViewStockReport";
			$report_url .= "?stock_level_less_than=".$stock_level_less_than;
			//send browser to the ViewStockReport page with the
			//stock level less than argument
			$this->redirect($report_url);
		}
	}
	public function ViewStockReport()
	{
		$this->requireLogin("/index.php/Report/ViewStockReport");
		//check to see whether the browser passed in ViewStockReport?stock_level_less_than=xxx
		$stock_level_less_than = NULL;
		if(isset( $_GET['stock_level_less_than'])){
			$stock_level_less_than = $_GET['stock_level_less_than'];
			echo $this->templates->render('report::stock_report',
			[
				'product_inventory' => $this->models['product_inventory'],
				'stock_level_less_than' => $stock_level_less_than,
				'models' => $this->models
			]);
		} else {
			echo("invalid report arguments");
		}
	}

	public function DownloadSalesReportCSV()
	{
		$this->requireLogin("/index.php/Report/DownloadSalesReportCSV");
		echo $this->models[Purchases::getModelName()]->countByInventoryItem(12);
	}
}
?>
