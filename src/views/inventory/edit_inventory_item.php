<?php $this->layout('base::item_form', [
  'title' => 'Edit Item',
  'form' => [
    'title' => 'Edit Item',
    'action' => '/index.php/Inventory/EditItem/?key='.$item->getPrimaryKey().'',
    'button_label' => 'Save Changes',
    'id' => 'edit',
    'inputs' => [
      [
        'id' => 'name',
        'label' => 'Name',
        'type' => 'text',
        'value' => $item->getName()
      ],
      [
        'id' => 'desc',
        'label' => 'Description',
        'type' => 'text',
        'value' => $item->getDescription()
      ],
      [
        'id' => 'cost',
        'label' => 'Cost Price',
        'type' => 'text',
        'value' => $item->getCostPrice()
      ],
      [
        'id' => 'sale',
        'label' => 'Sale Price',
        'type' => 'text',
        'value' => $item->getSalePrice()
      ],
      [
        'id' => 'stock',
        'label' => 'Stock Level',
        'type' => 'text',
        'value' => $item->getStockLevel()
      ]
    ]
  ],
  'models' => $models]);
/** show a table of items in the inventory */

?>
