<?php if (isset($user_actions) && $user_actions): ?>
<ul id="sf_admin_user_actions">
  <?php foreach ($user_actions as $action_name => $action): ?>
    <?php if (sfAdminDash::hasPermission($action, $sf_user)): ?>
    <li><?php echo link_to(__($action_name), $action['url']) ?></li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
<?php endif; ?>