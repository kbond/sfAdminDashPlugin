<?php use_helper('I18N'); ?>
<?php
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
?>

<?php foreach ($items as $key => $item): ?>
  <?php if (sfAdminDash::hasPermission($item, $sf_user)): ?>
    <?php if (($items_in_menu && $item['in_menu']) || (!$items_in_menu && !$item['in_menu'])): ?>
      <li <?php echo $item['in_menu']? 'class="item"':'class="item-menu"'; ?>>
        <a href="<?php echo url_for($item['url']) ?>" title="<?php echo __($item['name']); ?>">
          <?php if (sfAdminDash::getProperty('resize_mode') == 'thumbnail'): ?>
            <?php echo image_tag(substr($item['image'], 0, strrpos($item['image'], '/')).'/small/'.substr($item['image'], strrpos($item['image'], '/') + 1), array('alt' => $item['name'], 'width' => '16', 'height' => '16')); ?>
          <?php else: ?>
            <?php echo image_tag($item['image'], array('alt' => $item['name'], 'width' => '16', 'height' => '16')); ?>
          <?php endif; ?>
          <span><?php echo __($item['name']); ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endif; ?>
<?php endforeach; ?>
