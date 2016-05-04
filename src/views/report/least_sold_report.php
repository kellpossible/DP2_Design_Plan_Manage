<?php $this->layout('base::website_layout', [
  'title' => 'Least Sold Items Report',
  'models' => $models
  ]);   
    
?>

<h1>Least Sold Items Report</h1>

<form name="least_sold_report" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
    <div class="radio col-md-offset-10">
        <label><input type="radio" value="-6 days" name="date">Weekly</label>
    </div>
    <div class="radio col-md-offset-10">
        <label><input type="radio" value="-1 month" name="date">Monthly</label>
    </div>
        <input type="submit" value="Create Report" class="btn btn-primary col-md-offset-10 col-md-2"/>
    </form>
    <br/><br/>

<?php
//ideally want to be using a function like that 
   // $sold_items = $purchases->getSoldItemsLessThan("STOCK_LEVEL", $sold_level_less_than);
   
    if(isset($_POST['date'])){
    //created a dummy data array of "Sold Items" (product => amount of product sold)
        $data = array("Dove"=>190,"Sukin" =>48, "Colgate"=>330,"..."=>1, "Dove Fresh"=>39, "Libra"=>68);
    
    //sorted in accending order based off the value (least to most products sold)
        asort($data);
       
        echo "<ol>";
    
            foreach($data as $product => $product_value)
            {  
                echo "<li>" $product . " : " . $product_value . " units sold. </li>";
            }
    
        echo "</ol>";
    }
?>
