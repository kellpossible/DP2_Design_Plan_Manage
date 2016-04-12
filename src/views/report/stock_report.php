<?php $this->layout('base::website_layout', ['title' => 'Stock Report']) 
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>
 
<ul>
<?php foreach($product_inventory as $item): ?>
	<li>
		<b>Product Name:</b> <?=$item->getName()?> 
		<b>Description:</b> <?=$item->getDescription()?> 
		<b>Stock Level:</b> <?=$item->getStockLevel()?>
	</li>
<?php endforeach ?>

<?php foreach($product_inventory as $item):?>
	<li>
		<b>Low Stock:</b> <?=$item->selectLowStockItems()?>
	</li>
<?php endforeach?>
</ul>
