<?php $this->layout('base::website_layout', ['title' => $title]) ;
/** show a table of items in the inventory */
 echo $this->e($title) . ' this is the title of the page';
?>

<form name="<?=$this->e($form)?>" action="<?=$this->e($action)?>" method="post">
    
        <fieldset class="form-group">
            <label for="name">Name</label>
            <?=$this->section('name')?>
            <?php ?>
        
            <label for="desc">Description</label>
            <?=$this->section('description')?>
        
            <label for="cost">Cost price</label>
            <?=$this->section('cost')?>
            
            <label for="sale">Sale price</label>
            <?=$this->section('sale')?>
            
            <label for="stock">Stock level</label>
            <?=$this->section('stock')?>
        </fieldset>
        
        <input type="submit" value="<?=$this->e($buttonValue)?>" class="btn btn-primary col-md-offset-10 col-md-2"/>	
    </form>