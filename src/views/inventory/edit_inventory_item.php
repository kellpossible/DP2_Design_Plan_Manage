<?php $this->layout('base::item_form', ['form' => 'edit','action' => 'test_controllers.php?key='.$item->getPrimaryKey().'', 'buttonValue' => 'Save Changes', 'title' => 'Edit Item']) 
/** show a table of items in the inventory */

?>

<?php $this->start('name') ?>

    <input type="text" class="form-control" id="name" name="name" value="<?=$item->getName(); ?>"/>

<?php $this->stop() ?>

<?php $this->start('description') ?>

    <input type="text" class="form-control" id="desc" name="desc" value="<?=$item->getDescription() ?>"/>

<?php $this->stop() ?>

<?php $this->start('cost') ?>

    <input type="text" class="form-control" id="cost" name="cost" value="<?=$item->getCostPrice()?>"/>

<?php $this->stop() ?>

<?php $this->start('sale') ?>

    <input type="text" class="form-control" id="sale" name="sale" value="<?=$item->getSalePrice() ?>"/>

<?php $this->stop() ?>

<?php $this->start('stock') ?>

    <input type="text" class="form-control" id="stock" name="stock" value="<?=$item->getStockLevel() ?>"/>

<?php $this->stop() ?>