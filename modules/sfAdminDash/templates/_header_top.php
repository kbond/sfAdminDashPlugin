<?php use_stylesheet(sfAdminDash::getProperty('web_dir').'/css/default.css' , 'first') ?>

<?php if (sfAdminDash::getProperty('include_jquery')): ?>
<?php use_javascript(sfAdminDash::getProperty('web_dir').'/js/jquery-1.3.1.min.js', 'first') ?>
<?php endif; ?>
<?php use_javascript(sfAdminDash::getProperty('web_dir').'/js/sf_admin_dash') ?>

<div id='sf_admin_theme_header'>
  <a href='<?php echo url_for('homepage') ?>'><?php echo image_tag(sfAdminDash::getProperty('web_dir').'/images/header_text', array('alt' => 'Home')) ?></a>
</div>