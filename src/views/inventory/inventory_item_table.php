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
                <td><a href="/index.php/Inventory/EditItem?key=<?=$item->getPrimaryKey()?>" class="btn btn-default">Edit</a></td>
                <td><a href="#myModal" id="delete" class="btn btn-default" data-toggle="modal" data-target="#myModal" data-cost="<?=$item->getCostPrice() ?>" data-id="<?=$item->getPrimaryKey()?>" data-name="<?=$item->getName() ?>" data-desc="<?=$item->getDescription() ?>" data-sale="<?=$item->getSalePrice() ?>">Delete</a></td>
            </tr>
        <?php endforeach ?>
</table>

<!-- Modal -->



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
            </div>
            <div class="modal-body">
                  <p>Name: <span id="name"></span></p>
                  <p>Description: <span id="desc"></span></p>
                  <p>Cost price: <span id="cost"></span></p>
                  <p>Sale price: <span id="sale"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a id="linkdelete" class="btn btn-default"> Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#delete", function () {
        
            var key = $(this).data('id');
            var name =($(this).data('name')); 
            var cost = $(this).data('cost');        
            var sale = $(this).data('sale');
            var desc = $(this).data('desc');

            document.getElementById('name').innerHTML = name;
            document.getElementById('cost').innerHTML = cost;
            document.getElementById('sale').innerHTML = sale;
            document.getElementById('desc').innerHTML = desc;
        
            document.getElementById("linkdelete").href = "/index.php/Inventory/DeleteItem?key=" + key;
        });
    
</script>