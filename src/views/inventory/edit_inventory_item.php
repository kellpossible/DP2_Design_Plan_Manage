<?php $this->layout('base::website_layout', ['title' => 'Edit Inventory Item']) 
/** show a table of items in the inventory */

?>

    <form name="edit" action="inventory\edititem?key=<?= $item->getPrimaryKey() ?>" method="post">
    
        <fieldset class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$item->getName(); ?>"/>
        
            <label for="desc">Description</label>
            <input type="text" class="form-control" id="desc" name="desc" value="<?=$item->getDescription() ?>"/>
        
            <label for="cost">Cost price</label>
            <input type="text" class="form-control" id="cost" name="cost" value="<?=$item->getCostPrice()?>"/>
            
            <label for="sale">Sale price</label>
            <input type="text" class="form-control" id="sale" name="sale" value="<?=$item->getSalePrice() ?>"/>
            
            <label for="stock">Stock level</label>
            <input type="text" class="form-control" id="stock" name="stock" value="<?=$item->getStockLevel() ?>"/>
        </fieldset>
        
        <input type="submit" value="Save Changes" class="btn btn-primary col-md-offset-10 col-md-2"/>
    </form>