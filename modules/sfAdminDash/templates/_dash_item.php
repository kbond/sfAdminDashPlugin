<div class="icon">
  <a href="<?php echo url_for($item['url']) ?>">    
    <?php echo image_tag($item['image'], array('alt' => $item['name'])) ?>
    <span><?php echo $item['name'] ?></span>
  </a>
</div>