<?php if ($items): ?>
<?php include_partial('dash_list', array('items' => $items)) ?>
<?php elseif ($cats): ?>
<?php foreach ($cats as $name => $cat): ?>
<?php if (sfAdminDash::hasPermission($cat, $sf_user)): ?>
<h2><?php echo $name ?></h2>
<?php include_partial('dash_list', array('items' => $cat['items'])) ?>
<?php endif; ?>
<?php endforeach; ?>
<?php else: ?>
<p>Plugin not configured.  Please see documentation.</p>
<?php endif; ?>