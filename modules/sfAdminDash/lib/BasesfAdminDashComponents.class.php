<?php
/**
 * sfAdminDash base components.
 *
 * @package    plugins
 * @subpackage sfAdminDash
 * @author     Ivan Tanev aka Crafty_Shadow @ webworld.bg <vankata.t@gmail.com>
 * @version    SVN: $Id$
 */ 
class BasesfAdminDashComponents extends sfComponents
{

  /**
  * put your comment there...
  * 
  */
  private function set_up_variables()
  {
    $this->items      = sfAdminDash::getItems();
    $this->categories = sfAdminDash::getCategories();
       
    if (
          sfAdminDash::routeExists($this->module_link = $this->getContext()->getModuleName()         , $this->getContext()) ||
          sfAdminDash::routeExists($this->module_link = $this->getContext()->getModuleName().'/index', $this->getContext()) 
       )
    { 
      $this->module_link_name = sfAdminDash::getModuleName($this->getContext()); 
    }
    else
    {
      $this->module_link = null;
      
    }

    if ($this->getContext()->getActionName() != 'index' && null !== $this->module_link)
    {
      $this->action_link = $this->getContext()->getRouting()->getCurrentInternalUri();
      $this->action_link_name = sfAdminDash::getActionName($this->getContext());
    }
    else
    {
      $this->action_link = null;
    }
  }
  
  
  /**
  * The main navigation component for the sfAdminDash plugin
  */  
  public function executeHeader()
  {
    $this->set_up_variables();
  } 

}