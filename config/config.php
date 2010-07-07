<?php
/**
* This file is part of the sfAdminDash package
*/



if (in_array('sfAdminDash', sfConfig::get('sf_enabled_modules', array())) && sfAdminDash::getProperty('include_assets'))
{
  // the plugin module is in the enabled modules, add assets:
  $this->dispatcher->connect('context.load_factories', array('sfAdminDashConfig', 'listenToContextLoadFactoriesEvent'));
  
  if (true == sfAdminDash::getProperty('include_jquery_no_conflict'))
  {
    // if include_jquery_no_conflict is set to true, we need to modify the response content
    $this->dispatcher->connect('response.filter_content', array('sfAdminDashConfig', 'listenToResponseFilterContentEvent'));
  }
}