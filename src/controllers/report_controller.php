<?php 
require_once("controllers/controller.php")

/**
* Controls the viewing/generating of reports
*/
class ReportController extends Controller
{
	public function ViewStockReport()
	{
		echo $this->templates->render('report::stock_report', 
			[
				'product_inventory' => $this->models['product_inventory']
			]);
	}
}

?>