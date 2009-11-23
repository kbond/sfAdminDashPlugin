<div class="cpanel">
  <?php foreach ($items as $key => $item): ?>
    <?php if (sfAdminDash::hasPermission($item, $sf_user)): sfAdminDash::initItem($key, $item); ?>
      <div style="float: left">
        <div class="icon">
          <a href="<?php echo url_for($item['url']) ?>">    
            <?php echo image_tag($item['image'], array('alt' => $item['name'])) ?>
            <span><?php echo $item['name'] ?></span>
          </a>
        </div>        
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  <div class="clear"></div>
</div>