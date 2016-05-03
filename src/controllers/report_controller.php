<?php
require_once("controllers/controller.php");
require_once("models/product_inventory.php");
require_once("models/purchases.php");
require_once('vendor/autoload.php');
require_once('lib/inc/chartphp_dist.php');
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
    
    public function GetDateSelected()
    {
        $start = new DateTime();
        if(isset($_POST['date']))
        {
            $date = $_POST['date'];
            
            if($date=="week"){
                $start->modify('-1 week');
            }
            else{
                $start->modify('-1 month');
            }
            
        }     
        $start->format(DATE_RFC3339);  
        
        return $start;
    }
    
    public function GetDateNow()
    {
         
        $end = new DateTime();   
        $end->format(DATE_RFC3339);
        
        return $end;
    }	

    public function SalesIncomeReport()
    {
        $this->requireLogin("/index.php/Report/SalesIncomeReport");
        
        $dataArray = array(array(array()));
        
        $p = new chartphp(); 
        
        echo $this->templates->render('report::income_report',
        [
            'start'=>$this->GetDateSelected(),
            'end'=>$this->GetDateNow(),
            'p'=>$p,
            'date'=>$date,
            'dataArray'=>$dataArray,
            'purchases' => $this->models['purchases'],
            'product_inventory' => $this->models['product_inventory'],
            'models' => $this->models
        ]);
    }
    
    
    public function SalesStockReport()
    {
        $this->requireLogin("/index.php/Report/SalesStockReport");
        
        $p = new chartphp(); 
        
        
        echo $this->templates->render('report::sales_stock_report',
        [
            'p'=>$p,
            'date'=>$date,
            'purchases' => $this->models['purchases'],
            'models' => $this->models
        ]);
        
    }
    
    public function SalesReport()
    {
        $this->requireLogin("/index.php/Report/SalesStockReport");
        
        $p = new chartphp(); 
        
        
        echo $this->templates->render('report::sales_report',
        [
            'p'=>$p,
            'date'=>$date,
            'purchases' => $this->models['purchases'],
            'models' => $this->models
        ]);
        
    }
    
    public function MostSoldReport()
    {
    	$this->requireLogin("/index.php/Report/MostSoldReport");
    	
    		$data= NULL;
		if(isset( $_POST['data'])){
			$data = $_GET['getMostSold($data)'];
			echo $this->templates->render('report::most_sold_report',
			[
				'purchases' => $this->models['purchases'],
				'data' => $data,
				'models' => $this->models
			]);
		} else {
			echo("invalid report arguments");
		}
    }
    
     public function LeastSoldReport()
    {
    	$this->requireLogin("/index.php/Report/LeastSoldReport");
    	
    		$data= NULL;
		if(isset( $_POST['data'])){
			$data = $_GET['getLeastSold($data)'];
			echo $this->templates->render('report::least_sold_report',
			[
				'purchases' => $this->models['purchases'],
				'data' => $data,
				'models' => $this->models
			]);
		} else {
			echo("invalid report arguments");
		}
    }

	//using the example found here: http://code.stephenmorley.org/php/creating-downloadable-csv-files/
	public function DownloadSalesReportCSV()
	{
		$this->requireLogin("/index.php/Report/DownloadSalesReportCSV");

		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=sales_report.csv');

		echo "testing";

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Product Name', 'Stock Level', 'Total Sales', 'Total Revenue'));

		foreach($this->models[ProductInventory::getModelName()] as $item)
		{
			$item_name = $item->getName();
			$item_stock_level = (int)$item->getStockLevel();
			$purchases = $this->models[Purchases::getModelName()];
			$total_sales = $purchases->countByInventoryItem($item->getPrimaryKey());
			$item_sale_price = (float)$item->getSalePrice();
			$total_revenue = $item_sale_price * ((float)$total_sales);

			fputcsv($output, array($item_name,
				strval($item_stock_level),
				strval($total_sales),
				strval($total_revenue)));

		}

		fclose($output);

	}
}
?>
