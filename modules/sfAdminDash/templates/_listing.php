<div class="cpanel">
  <?php foreach ($items as $key => $item): ?>
  <div style="float: left">
    <?php include_component('sfAdminDash', 'item', array('item' => $item, 'key' => $key)) ?>
  </div>
  <?php endforeach; ?>
  <br style="clear: both" />
</div>