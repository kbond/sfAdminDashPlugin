<?php 
  use_helper('I18N');
  /** @var string|null Link to the module (for breadcrumbs) */ $module_link;
?> 

<?php if ($sf_user->isAuthenticated()): ?> 
  <div id='sf_admin_theme_header'>
    <a href='<?php echo url_for('homepage') ?>'><?php echo image_tag(sfAdminDash::getProperty('web_dir').'/images/header_text', array('alt' => 'Home')); ?></a>
  </div>

  <div id='sf_admin_menu'>    
    <?php include_partial('sfAdminDash/menu', array('items' => $items, 'categories' => $categories)); ?>
    
    <?php if (sfAdminDash::getProperty('logout') && $sf_user->isAuthenticated()): ?>
      <div id="logout"><?php echo link_to(__('Logout', null, 'sf_admin_dash'), 'sfGuardAuth/signout'); ?> <?php echo $sf_user; ?></div>
    <?php endif; ?>
    <div class="clear"></div>
  </div>

  <?php if (sfAdminDash::getProperty('include_path')): ?>
    <div id='sf_admin_path'>
      <strong><a href='<?php echo url_for('homepage'); ?>'><?php echo sfAdminDash::getProperty('site'); ?></a></strong> 
      <?php if ($sf_context->getModuleName() != 'sfAdminDash' && $sf_context->getActionName() != 'dashboard'): ?>
        <?php if (null != $module_link): ?>
          / <a href="<?php echo $module_link ?>"><?php echo sfAdminDash::getModuleName(); ?></a> 
          <?php if ($sf_context->getActionName() != 'index'): ?>
            / <?php echo __(ucfirst(sfAdminDash::getActionName()), array(), 'sf_admin'); ?>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

<?php endif; ?>