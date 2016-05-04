<?php $this->layout('base::website_layout', [
  'title' => 'Stock Report',
  'models' => $models
  ])
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>
<?php $selected_stock_items = $product_inventory->getItemsByLessThan("STOCK_LEVEL", $stock_level_less_than); ?>
<table class="table table-hover sortable-theme-bootstrap" data-sortable>

  <thead>
    <tr>
      <th>Product Name</th>
      <th>Description</th>
      <th>Stock Level</th>
    </tr>
  </thead>
  <?php foreach($selected_stock_items as $item): ?>
  <tr>
    <td><?=$item->getName()?></td>
    <td><?=$item->getDescription()?></td>
    <td><?=$item->getStockLevel()?></td>
  </tr>
  <?php endforeach ?>
</table>

<?php //echo(print_r($selected_stock_items)); ?>
