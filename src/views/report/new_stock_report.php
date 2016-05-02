<?php $this->layout('base::website_layout', [
  'title' => 'New Stock Report',
  'models' => $models]);
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>

 <p> Select the relevant information to generate a report</p>


<form name="new_stock_report" action="/index.php/Report/NewStockReport" method="post">
  <fieldset>
    <legend>Stock Level Less Than</legend>
    <input type="text" class="form-control" id="stock_level_less_than" name="stock_level_less_than" value="5"/>
  </fieldset>

  <input type="submit" value="Create Report" class="btn btn-primary col-md-offset-10 col-md-2"/>
</form>
