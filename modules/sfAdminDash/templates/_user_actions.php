<ul id="sf_admin_user_actions">
  <?php foreach ($user_actions as $key =>$action): ?>
  <li><?php echo link_to(__($key), $action['url']) ?></li>
  <?php endforeach; ?>
</ul>