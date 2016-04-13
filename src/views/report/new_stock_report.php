<?php $this->layout('base::website_layout', ['form' => 'new_stock_report','action' => '/index.php/Report/ViewStockReport', 'buttonValue' => 'Save Changes', 'title' => 'New Stock Report']);
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>
 
 <p> Select the relevant information to generate a report</p>
 

<form name="new_stock_report" action="/index.php/Report/NewStockReport" method="post">
  <!-- <input type="text" class="form-control" id="name" name="name" value=""/> -->

 <!--  <fieldset>
    <legend> Time Specifications</legend>
    
    <input type="radio"  class="form-control" id="week" name="week"/>
    <label for="week"> The past 7 days </label>
    
    <input type="radio"  class="form-control"  id="month" name="month"/>
    <label for="month"> The past 30 days </label>
    
  </fieldset>
 -->
  <fieldset>
    <legend>Stock Level Less Than</legend>
    <input type="text" class="form-control" id="stock_level_less_than" name="stock_level_less_than" value="5"/>
  </fieldset>

  <input type="submit" value="Create Report" class="btn btn-primary col-md-offset-10 col-md-2"/>  
</form>
