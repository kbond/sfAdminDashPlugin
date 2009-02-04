<?php foreach ($items as $key => $item): ?>
<?php if (sfAdminDash::hasPermission($item, $sf_user)): ?>
<li><?php include_component('sfAdminDash', 'menu_item', array('item' => $item, 'key' => $key)) ?></li>
<?php endif; ?>
<?php endforeach; ?>