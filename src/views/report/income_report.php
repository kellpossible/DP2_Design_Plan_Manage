<?php $this->layout('base::website_layout', [
  'title' => 'Sales Income Report',
  'models' => $models
  ]);   
    
?>

<h1>Sales income report</h1>

<form name="income_report" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
    <div class="radio col-md-offset-10">
        <label><input type="radio" value="week" name="date">Weekly</label>
    </div>
    <div class="radio col-md-offset-10">
        <label><input type="radio" value="month" name="date">Monthly</label>
    </div>
        <input type="submit" value="Create Report" class="btn btn-primary col-md-offset-10 col-md-2"/>
    </form>
    <br/><br/>

<?php

    if(isset($_POST['date'])){
        $salesIncome = $purchases->getItemsByDateRange($start, $end);
    
        foreach($salesIncome as $item){
            $inventory_item = $item->getInventoryItem();
            $itemsArray = array($inventory_item->getName(), $inventory_item->getCostPrice());
            $dataArray[][] = $itemsArray;
    }
    //print_r($dataArray);
        $p->data = $dataArray;
        $p->chart_type = "bar"; 

        // Common Options 
        $p->title = "Income"; 
        $p->xlabel = "Product"; 
        $p->ylabel = "Income made"; 

        $out = $p->render('c1'); 
        echo $out;
}
?>