<?php if ($items): ?>
  <?php include_partial('dash_list', array('items' => $items)) ?>
<?php elseif ($cats): ?>
  <?php foreach ($cats as $name => $cat): ?>
    <?php if (sfAdminDash::hasPermission($cat, $sf_user)): ?>
      <h2><?php echo isset($cat['name']) ? $cat['name'] : $name ?></h2>
      <?php include_partial('dash_list', array('items' => $cat['items'])) ?>
    <?php endif; ?>
  <?php endforeach; ?>
<?php else: ?>
  sfAdminDashPlugin is not configured.  Please see <a href="http://www.symfony-project.org/plugins/sfAdminDashPlugin/0_8_1?tab=plugin_readme" title="documentation">documentation</a>.
<?php endif; ?>