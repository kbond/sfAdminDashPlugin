<?php if ($items): ?>
<ul>
  <?php if(sfAdminDash::hasItemsMenu($items)): ?>
  <li class="node"><a href="#">Menu</a>
    <ul>
      <?php include_partial('sfAdminDash/menu_list', array('items' => $items, 'items_in_menu' => true)) ?>
    </ul>
  </li>
  <?php  endif; ?>
  <?php include_partial('sfAdminDash/menu_list', array('items' => $items, 'items_in_menu' => false)) ?>
</ul>
<?php elseif ($cats): ?>
<ul>
  <?php foreach ($cats as $name => $cat): ?>
  <?php   if (sfAdminDash::hasPermission($cat, $sf_user)): ?>
  <?php     if(sfAdminDash::hasItemsMenu($cat['items'])): ?>
  <li class="node"><a href="#"><?php echo $name ?></a>
    <ul>
      <?php include_partial('sfAdminDash/menu_list', array('items' => $cat['items'], 'items_in_menu' => true)) ?>
    </ul>
  </li>
  <?php     endif; ?>
  <?php   endif; ?>
  <?php endforeach; ?>
  <?php foreach ($cats as $name => $cat): ?>
      <?php include_partial('sfAdminDash/menu_list', array('items' => $cat['items'], 'items_in_menu' => false)) ?>
  <?php endforeach; ?>
</ul>
<?php else: ?>
Plugin not configured.  Please see documentation.
<?php endif; ?>