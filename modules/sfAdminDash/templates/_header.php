<?php
/**
* We need to make sure this plugin is backward compatible. 
* In the original version, this template was invoked by include_partial(),
* which means that now it won't work. Therefore, we set a variable in the 
* component code, and if it is not present - we call the component
*/

if (!isset($called_from_component)):
  include_component('sfAdminDash', 'header');
else:


  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
  /** @var string|null Link to the module (for breadcrumbs) */ $module_link = $sf_data->getRaw('module_link');
  /** @var string|null Link to the action (for breadcrumbs) */ $action_link = $sf_data->getRaw('action_link');


if ($sf_user->isAuthenticated()): ?> 
  <div id='sf_admin_theme_header'>
    <a href='<?php echo url_for(sfAdminDash::getProperty('dashboard_url')); ?>'><?php echo image_tag(sfAdminDash::getProperty('web_dir').'/images/header_text', array('alt' => 'Home')); ?></a>
  </div>

  <div id='sf_admin_menu'>    
    <?php include_partial('sfAdminDash/menu', array('items' => $items, 'categories' => $categories)); ?>
    
    <?php if (sfAdminDash::getProperty('logout') && $sf_user->isAuthenticated()): ?>
      <div id="logout"><?php echo link_to(__('Logout', null, 'sf_admin_dash'), sfAdminDash::getProperty('logout_route', '@sf_guard_signout ')); ?> <?php echo $sf_user; ?></div>
    <?php endif; ?>
    <?php include_partial('sfAdminDash/user_actions', array('user_actions' => $user_actions)) ?>
    <div class="clear"></div>
  </div>

  <?php if (sfAdminDash::getProperty('include_path')): ?>
    <div id='sf_admin_path'>
      <strong>
        <?php echo link_to(sfAdminDash::getProperty('site'), sfAdminDash::getProperty('dashboard_url')) ?>
      </strong>
      <?php if ($sf_context->getModuleName() != 'sfAdminDash' && $sf_context->getActionName() != 'dashboard'): ?>
        / <?php echo null !== $module_link ? link_to($module_link_name, $module_link) : $module_link_name; ?>
        <?php if (null != $action_link): ?>
          / <?php echo link_to(__(ucfirst($action_link_name)), $action_link); ?>
        <?php endif ?>
      <?php endif; ?>
    </div>
  <?php endif; // if breadcrumbs are enabled ?>
  
  
  <div id="sf_admin_dash_hidden_filters_translation" style="display: none;"><?php echo __('Filters', null, 'sf_admin_dash')?></div>
  
<?php endif; // if user is authenticated ?>


<?php endif; // if called from component