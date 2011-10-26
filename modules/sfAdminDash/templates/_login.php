<?php
  use_helper('I18N');
  use_stylesheet('/sfAdminDashPlugin/css/default.css');
?>

<div id="ctr" align="center">
  <div class="login clear">
    <div class="login-form">
      <form action="<?php echo url_for(sfAdminDash::getProperty('login_route', '@sf_guard_signin')); ?>" method="post">
        <div class="form-block clear">
		      <h2><?php echo __('Login panel', array(), 'sf_admin_dash'); ?></h2>
          <?php echo $form->renderGlobalErrors(); ?>
          <?php if(isset($form['_csrf_token'])): ?>
            <?php echo $form['_csrf_token']->render(); ?>
			    <?php endif; ?>
          <div class="inputlabel"><?php echo $form['username']->renderLabel(__('Username', array(), 'sf_admin_dash')); ?>:</div>
          <div>
            <?php echo $form['username']->renderError(); ?>
            <?php echo $form['username']->render(array('class' => 'inputbox')); ?>
          </div>
          <div class="inputlabel"><?php echo $form['password']->renderLabel(__('Password', array(), 'sf_admin_dash')); ?>:</div>
          <div>
            <?php echo $form['password']->renderError(); ?>
            <?php echo $form['password']->render(array('class' => 'inputbox')); ?>
          </div>
          <div class="inputlabel">
            <?php echo $form['remember']->renderLabel(__('Remember?', array(), 'sf_admin_dash')); ?>
            <?php echo $form['remember']->render(array('class' => 'inputcheck')); ?>
          </div>
          <div align="left"><input type="submit" name="submit" class="button clear" value="<?php echo __('Login', array(), 'sf_admin_dash'); ?>" /></div>
        </div>
      </form>
    </div>
    <div class="login-text">
      <div class="ctr"><img alt="Security" src="<?php echo image_path(sfAdminDash::getProperty('web_dir', '/sfAdminDashPlugin').'/images/login_security.png'); ?>" /></div>
      <p><?php echo __('Welcome to', array(), 'sf_admin_dash'); ?> <?php echo sfAdminDash::getProperty('site'); ?></p>
      <p><?php echo __('Use a valid username and password to gain access to the administration console.', array(), 'sf_admin_dash'); ?></p>
    </div>
  </div>
</div>


<script type="text/javascript">
(function (window, document) {

    var autofocus_login = function() {
        var is_focused = false,
            elms = ['<?php echo $form['username']->renderId(); ?>',
                    '<?php echo $form['password']->renderId(); ?>'];

        for (var i=0; i<elms.length; i++) {
            var elm = document.getElementById(elms[i]);
            if (typeof elm !== 'undefined') {
                if (elm.value != elm.defaultValue) {
                     is_focused = true;
                }
            }
        }

        if (is_focused != true) {
            document.getElementById(elms[0]).focus()
        }
    }

    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready( autofocus_login );
    } else {
        window.onload = autofocus_login;
    }

}(this, this.document))
</script>