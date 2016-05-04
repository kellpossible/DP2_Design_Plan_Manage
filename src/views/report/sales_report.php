<?php $this->layout('base::website_layout', [
  'title' => 'Sales Report',
  'models' => $models
  ])
 ?>

<h1>Sales report</h1>

<p>Select to view the total sales made for either the last week or the last month</p>
<form name="income_report" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
    <div class="radio">
        <label><input type="radio" value="week" name="date">Weekly</label>
    </div>
    <div class="radio">
        <label><input type="radio" value="month" name="date">Monthly</label>
    </div>
        <input type="submit" value="Create Report" class="btn btn-primary col-md-2"/>
    </form>
    <br/><br/>

<?php

    if(isset($_POST['date'])){
        $sales = $purchases->getItemsByDateRange($start, $end);
    
        foreach($sales as $item){
            $inventory_item = $item->getInventoryItem();
            $itemsArray = array(($item->getDate()->format('m-d')),$inventory_item->getSalePrice());       
            
            $dataArray[][] = $itemsArray;
        }
        $p->data = $dataArray;
        $p->chart_type = "line"; 

        // Common Options 
        $p->title = "Sales"; 
        $p->series_label = array("month"); 

        $p->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '$'; 

        $out = $p->render('c1'); 
        echo $out;
}
?>