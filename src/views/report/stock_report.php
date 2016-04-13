<?php $this->layout('base::website_layout', ['title' => 'Stock Report']) 
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>
 
<ul>
<?php $selected_stock_items = $product_inventory->getItemsByLessThan("STOCK_LEVEL", $stock_level_less_than); ?>
<?php //echo(print_r($selected_stock_items)); ?>
<?php foreach($selected_stock_items as $item): ?>
	<li>
		<b>Product Name:</b> <?=$item->getName()?> 
		<b>Description:</b> <?=$item->getDescription()?> 
		<b>Stock Level:</b> <?=$item->getStockLevel()?>
	</li>
<?php endforeach ?>
</ul>
