<?php foreach ($items as $key => $item): ?>
  <?php if (sfAdminDash::hasPermission($item, $sf_user)): sfAdminDash::initItem($key, $item, sfAdminDash::getProperty('resize_mode'));?>
    <?php if(($items_in_menu && $item['in_menu']) || (!$items_in_menu && !$item['in_menu'])): ?>
      <li <?php echo $item['in_menu']? 'class="item"':'class="item-menu"';?>>
        <a href="<?php echo url_for($item['url']) ?>">
          <?php if (sfAdminDash::getProperty('resize_mode') == 'html'): ?>
            <?php echo image_tag($item['image'], array('alt' => $item['name'], 'width' => '16', 'height' => '16')) ?>
          <?php else: ?>
            <?php echo image_tag($item['image'], array('alt' => $item['name'])) ?>
          <?php endif; ?>
          <span><?php echo $item['name'] ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endif; ?>
<?php endforeach; ?>