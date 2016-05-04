<?php

$this->layout('base::website_layout', ['title' => 'Purchase'])

?>
<table class='table table-hover'>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Date</th>
            </tr>
        </thead>
    
        <?php foreach($purchased_item as $item): ?>
           <tr>
                <td><?=$item->getID_inventory() ?></td>
                <td><?=$item->getDate() ?></td>
             </tr>
        <?php endforeach ?>
</table>
