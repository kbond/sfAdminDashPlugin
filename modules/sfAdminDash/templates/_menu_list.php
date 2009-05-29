<?php foreach ($items as $key => $item): ?>
<?php   if (sfAdminDash::hasPermission($item, $sf_user)): ?>
<?php       include_component('sfAdminDash', 'menu_item', array('item' => $item, 'key' => $key, 'items_in_menu' => $items_in_menu)) ?>
<?php   endif; ?>
<?php endforeach; ?>