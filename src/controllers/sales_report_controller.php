<?php 
require_once("controllers/controller.php");
require_once("models/product_inventory.php");
require_once("models/purchased_item.php"); 
require_once("lib/inc/chartphp_dist.php");

/**
* Controls the viewing/generating of reports
*/

class SalesReportController extends Controller
{
	
    
    private function InitialiseGraph()
    {
        //$p = new chartphp();
    }
    
    
    
    
    public function SalesIncomeReport()
    {
        $this->InitialiseGraph()
            echo "test";
        $p->data = array(array(array("2010/10",48.25),array("2011/01",238.75),array("2011/02",95.50),array("2011/03",300.50),array("2011/04",286.80),array("2011/05",400)));
$p->chart_type = "bar"; 

// Common Options 
$p->title = "Bar Chart"; 
$p->xlabel = "My X Axis"; 
$p->ylabel = "My Y Axis"; 
$p->export = false; 
$p->options["legend"]["show"] = true; 
$p->series_label = array('Q1','Q2','Q3');  

$out = $p->render('c1'); 
?> 
    }
}
?>
