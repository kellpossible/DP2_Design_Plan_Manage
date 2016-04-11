<?php $this->layout('base::item_form', ['form' => 'new', 'action' => '/index.php/Inventory/NewItem', 'buttonValue' => 'Add item', 'title' => 'New Item']) 
/** show a table of items in the inventory */

?>

<?php $this->start('name') ?>

    <input type="text" class="form-control" id="name" name="name"/>

<?php $this->stop() ?>

<?php $this->start('description') ?>

    <input type="text" class="form-control" id="desc" name="desc"/>

<?php $this->stop() ?>

<?php $this->start('cost') ?>

    <input type="text" class="form-control" id="cost" name="cost"/>

<?php $this->stop() ?>

<?php $this->start('sale') ?>

    <input type="text" class="form-control" id="sale" name="sale"/>

<?php $this->stop() ?>

<?php $this->start('stock') ?>

    <input type="text" class="form-control" id="stock" name="stock"/>

<?php $this->stop() ?>