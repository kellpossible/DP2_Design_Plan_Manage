<?php $this->layout('base::website_layout', [
  'title' => 'Sales Stock Report',
  'models' => $models
  ])
 ?>

<h1>Stock sold report</h1>

<p>Select to view the total stock sold for either the last week or the last month</p>
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
            $itemsArray = array($inventory_item->getName(), count($inventory_item->getName()));       
            $dataArray[][] = $itemsArray;
        }
        $p->data = $dataArray;
        $p->chart_type = "bar"; 

        // Common Options 
        $p->title = "Stock Sold"; 

        $out = $p->render('c1'); 
        echo $out;
}
?>