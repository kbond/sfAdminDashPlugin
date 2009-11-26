<?php use_helper('I18N'); include_partial('sfAdminDash/header_top') ?>
<?php if (($sf_context->getModuleName() != 'sfGuardAuth') && ($sf_context->getActionName() != 'signin')): ?>
  <div id='sf_admin_menu'>    
    <?php include_component('sfAdminDash', 'menu') ?>
    <?php if (sfAdminDash::getProperty('logout') && ($sf_user->isAuthenticated())): ?>
      <div id="logout"><?php echo link_to('Logout', 'sfGuardAuth/signout') ?> <?php echo $sf_user ?></div>
    <?php endif; ?>
    <div class="clear"></div>
  </div>
<?php if(sfAdminDash::getProperty('include_path')): ?>
  <div id='sf_admin_path'>
    <strong><a href='<?php echo url_for('homepage') ?>'><?php echo sfAdminDash::getProperty('site') ?></a></strong> 
    <?php if ($sf_context->getActionName() != 'dashboard'): ?>
      <?php // TODO: use the routing object to retrieve the module ?>
      / <a href="<?php url_for('@'.$sf_context->getModuleName()); ?>"><?php echo sfAdminDash::getModuleName(); ?></a> 
      <?php if ($sf_context->getActionName() != 'index'): ?>
        / <?php echo __(ucfirst(sfAdminDash::getActionName()), array(), 'sf_admin'); ?>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <?php endif; ?>
<?php endif; ?>