<?php
if (in_array('sfAdminDash', sfConfig::get('sf_enabled_modules', array())))
{
  $this->dispatcher->connect('context.load_factories', array('sfAdminDashConfig', 'listenToContextLoadFactoriesEvent'));
  
  if (true == sfAdminDash::getProperty('include_jquery_no_conflict'))
  {
    
    $this->dispatcher->connect('response.filter_content', array('sfAdminDashConfig', 'listenToResponseFilterContentEvent'));
  }
}