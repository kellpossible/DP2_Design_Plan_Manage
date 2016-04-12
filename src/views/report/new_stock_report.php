<?php $this->layout('base::website_layout', ['title' => 'Stock Report', 'buttonValue' => 'Sumbit']) 
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>
 
 <p> Select the relevant information to generate a report</p>
 
 <?php $this->start('name')?>
 <input type="text" class="form-control" id="name" name="name" value="<?=$item->getName(); ?>"/>
<?php $this->stop() ?>

<?php $this->start('description') ?>

    <input type="text" class="form-control" id="desc" name="desc" value="<?=$item->getDescription() ?>"/>

<?php $this->stop() ?>

<?php $this->start('all')?>
<input type="checkbox" class="form-control" id="all" name="all"<?=$item->getName(); ?>"/>
<?php $this->stop() ?>

<fieldset>
  <legend> Time Specifications</legend>
  
  <?php $this->start('time')?>
  <input type="radio"  class="form-control" id="week" name="week"<?=$item->getDate(); ?>"/>
  <label for="week"> The past 7 days </label>
  <?php $this-> stop() ?>
  
  <?php $this->start('time')?>
  <input type="radio"  class="form-control"  id="month" name="month"<?=$item->getDate(); ?>"/>
  <label for="month"> The past 30 days </label>
  <?php $this-> stop() ?>
  
</fieldset>

<fieldset>
  <legend>Stock Level</legend>
  
  <?php $this->start('stock')?>
  <input type="radio" class="form-control"  id="less_than_10" name="less_than_10"<?=$item->getStockLevel(); ?>"/>
  <label for="less_than_10"> Less than 10</label>
  <?php $this-> stop() ?>

  <?php $this->start('stock')?>
  <input type="radio" class="form-control"  id="greater_than_10" name="greater_than_10"<?=$item->getStockLevel(); ?>"/>
  <label for="greater_than_10"> Greater than 10</label>
  <?php $this-> stop() ?>
</fieldset>
