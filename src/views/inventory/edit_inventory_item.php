<?php $this->layout('base::website_layout', ['title' => 'Edit Inventory Item']) 
/** show a table of items in the inventory */?>

    <form name="edit" action="<?php echo "Inventory\EditItem?item=$itemindex"; ?>" method="post">
    
        <fieldset class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="<?php $product_inventory->getName(); ?>"/>
        
            <label for="desc">Description</label>
            <input type="text" class="form-control" id="desc" value="<?php $product_inventory->getDescription() ?>"/>
        
            <label for="cost">Cost price</label>
            <input type="text" class="form-control" id="cost" value="<?php $product_inventory->getCostPrice()?>"/>
            
            <label for="sale">Sale price</label>
            <input type="text" class="form-control" id="sale" value="<?php $product_inventory->getSalePrice() ?>"/>
            
            <label for="stock">Stock level</label>
            <input type="text" class="form-control" id="stock" value="<?php $product_inventory->getStockLevel() ?>"/>
        </fieldset>
        
        <input type="submit" value="Save Changes" class="btn btn-primary"/>	
    </form>