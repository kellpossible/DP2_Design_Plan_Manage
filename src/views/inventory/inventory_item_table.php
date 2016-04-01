<?php $this->layout('base::website_layout', ['title' => 'Product Inventory']) 
/** show a table of items in the inventory */
/* Uses the alternative syntax structure: http://php.net/manual/en/control-structures.alternative-syntax.php according to the recommendation here: http://platesphp.com/templates/syntax/ */

 ?>

<h1>Product Inventory</h1>
 
<ul>
<?php foreach($product_inventory as $item): ?>
	<li><b>Product Name:</b> <?=$item->getName()?> <b>and Description:</b> <?=$item->getDescription()?></li>
<?php endforeach ?>
</ul>