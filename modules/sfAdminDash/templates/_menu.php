<?php if ($items): ?>
<ul>
  <li class="node"><a href="#">Menu</a>
    <ul>
      <?php include_partial('sfAdminDash/menu_list', array('items' => $items)) ?>
    </ul>
  </li>
</ul>
<?php elseif ($cats): ?>
<ul>
  <?php foreach ($cats as $name => $cat): ?>
  <?php if (sfAdminDash::hasPermission($cat, $sf_user)): ?>
  <li class="node"><a href="#"><?php echo $name ?></a>
    <ul>
      <?php include_partial('sfAdminDash/menu_list', array('items' => $cat['items'])) ?>
    </ul>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>  
</ul>
<?php else: ?>
Plugin not configured.  Please see documentation.
<?php endif; ?>