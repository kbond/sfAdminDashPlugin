<div class="cpanel">
  <?php foreach ($items as $key => $item): ?>
  <?php if (sfAdminDash::hasPermission($item, $sf_user)): ?>
  <div style="float: left">
    <?php include_component('sfAdminDash', 'dash_item', array('item' => $item, 'key' => $key)) ?>
  </div>
  <?php endif; ?>
  <?php endforeach; ?>
  <div class="clear"></div>
</div>