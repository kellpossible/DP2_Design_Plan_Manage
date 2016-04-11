<?php $this->layout('base::website_layout', ['title' => 'Stock Report']) 
/** Shoes a report of the stock available in the inventory
* Takes product_inventory as a ProductInventory instance */
 ?>

<h1>Stock Report</h1>
 
<ul>
<?php foreach($product_inventory as $item): ?>
	<li><b>Product Name:</b> <?=$item->getName()?> <b>and Description:</b> <?=$item->getDescription()?></li>
<?php endforeach ?>
</ul>