<?php
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
?>


<?php if (count($items)): ?>
  <ul>
    <?php if (sfAdminDash::hasItemsMenu($items)): ?>
    <li class="node"><a href="#">Menu</a>
      <ul>
        <?php include_partial('sfAdminDash/menu_list', array('items' => $items, 'items_in_menu' => true)); ?>
      </ul>
    </li>
    <?php  endif; ?>
    <?php include_partial('sfAdminDash/menu_list', array('items' => $items, 'items_in_menu' => false)); ?>
  </ul>
<?php endif; ?>
<?php if (count($categories)): ?>
  <ul>
    <?php foreach ($categories as $name => $category): ?>
    <?php   if (sfAdminDash::hasPermission($category, $sf_user)): ?>
    <?php     if (sfAdminDash::hasItemsMenu($category['items'])): ?>
    <li class="node"><a href="#"><?php echo __(isset($category['name']) ? $category['name'] : $name) ?></a>
      <ul>
        <?php include_partial('sfAdminDash/menu_list', array('items' => $category['items'], 'items_in_menu' => true)) ?>
      </ul>
    </li>
    <?php     endif; ?>
    <?php   endif; ?>
    <?php endforeach; ?>
    <?php foreach ($categories as $name => $category): ?>
        <?php include_partial('sfAdminDash/menu_list', array('items' => $category['items'], 'items_in_menu' => false)) ?>
    <?php endforeach; ?>
  </ul>
<?php elseif (!count($items)): ?>
  <?php echo __('sfAdminDashPlugin is not configured.  Please see the %documentation_link%.', array('%documentation_link%'=>link_to(__('documentation', null, 'sf_admin_dash'), 'http://www.symfony-project.org/plugins/sfAdminDashPlugin?tab=plugin_readme', array('title' => __('documentation', null, 'sf_admin_dash')))), 'sf_admin_dash'); ?>
<?php endif; ?>
