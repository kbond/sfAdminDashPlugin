<?php
/**
* We need to make sure this plugin is backward compatible. 
* The in the original, this template was invoked by "include_partial",
* which means that now it won't work. Therefore, we set a variable in the 
* component code, and if it is not present - we call the component
*/

if (!isset($called_from_component)):
  include_component('sfAdminDash', 'header');
else:
?>


<?php 
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
  /** @var string|null Link to the module (for breadcrumbs) */ $module_link = $sf_data->getRaw('module_link');
  /** @var string|null Link to the action (for breadcrumbs) */ $action_link = $sf_data->getRaw('action_link');
?> 

<?php if ($sf_user->isAuthenticated()): ?> 
  <div id='sf_admin_theme_header'>
    <a href='<?php echo url_for('homepage') ?>'><?php echo image_tag(sfAdminDash::getProperty('web_dir').'/images/header_text', array('alt' => 'Home')); ?></a>
  </div>

  <div id='sf_admin_menu'>    
    <?php include_partial('sfAdminDash/menu', array('items' => $items, 'categories' => $categories)); ?>
    
    <?php if (sfAdminDash::getProperty('logout') && $sf_user->isAuthenticated()): ?>
      <div id="logout"><?php echo link_to(__('Logout', null, 'sf_admin_dash'), sfAdminDash::getProperty('logout_route', '@sf_guard_signout ')); ?> <?php echo $sf_user; ?></div>
    <?php endif; ?>
    <?php if ($user_actions): ?>
      <?php include_partial('sfAdminDash/user_actions', array('user_actions' => $user_actions)) ?>
    <?php endif; ?>
    <div class="clear"></div>
  </div>

  <?php if (sfAdminDash::getProperty('include_path')): ?>
    <div id='sf_admin_path'>
      <strong><a href='<?php echo url_for('homepage'); ?>'><?php echo sfAdminDash::getProperty('site'); ?></a></strong> 
      <?php if ($sf_context->getModuleName() != 'sfAdminDash' && $sf_context->getActionName() != 'dashboard'): ?>
        / <?php echo null !== $module_link ? link_to($module_link_name, $module_link) : $module_link_name; ?>
        <?php if (null != $action_link): ?>
          / <?php echo link_to(__(ucfirst($action_link_name), null, 'sf_admin'), $action_link); ?>
        <?php endif ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>


<?php endif; // BC check if ?>