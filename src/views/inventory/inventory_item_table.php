<?php $this->layout('base::website_layout', ['title' => 'Product Inventory']) 
/** show a table of items in the inventory */
/* Uses the alternative syntax structure: http://php.net/manual/en/control-structures.alternative-syntax.php according to the recommendation here: http://platesphp.com/templates/syntax/
* Takes product_inventory as a ProductInventory instance */

 ?>

<table class='table table-hover'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Sale price</th>
                <th>Cost price</th>
                <th>Stock level</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
    
        <?php foreach($product_inventory as $item): ?>
           <tr>
                <td><?=$item->getName() ?></td>
                <td><?=$item->getSalePrice() ?></td>
                <td><?=$item->getCostPrice() ?></td>
                <td><?=$item->getStockLevel() ?></td>
                <td><?=$item->getDescription() ?></td>
                <td><a href="inventory\.......?item=$itemindex">Edit</a></td>
                <td><a href="#">Delete</a></td>
            </tr>
        <?php endforeach ?>
</table>