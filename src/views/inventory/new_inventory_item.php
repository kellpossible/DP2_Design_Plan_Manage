<?php $this->layout('base::item_form', [
  'title' => 'New Item',
  'form' => [
    'title' => 'New Item',
    'action' => '/index.php/Inventory/NewItem',
    'button_label' => 'Add item',
    'id' => 'new',
    'inputs' => [
      [
        'id' => 'name',
        'label' => 'Name',
        'type' => 'text'
      ],
      [
        'id' => 'desc',
        'label' => 'Description',
        'type' => 'text'
      ],
      [
        'id' => 'cost',
        'label' => 'Cost Price',
        'type' => 'text'
      ],
      [
        'id' => 'sale',
        'label' => 'Sale Price',
        'type' => 'text'
      ],
      [
        'id' => 'stock',
        'label' => 'Stock Level',
        'type' => 'text'
      ]
    ]
  ],
  'models' => $models]);
/** show a table of items in the inventory */

?>
