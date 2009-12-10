<?php
/**
 * sfAdminDash base actions.
 *
 * @package    plugins
 * @subpackage sfAdminDash
 * @author     Ivan Tanev aka Crafty_Shadow @ webworld.bg <vankata.t@gmail.com>
 * @version    SVN: $Id$
 */ 
class BasesfAdminDashActions extends sfActions
{
 
 /**
  * Executes the index action, which shows a list of all available modules
  *
  */
  public function executeDashboard()
  {    
    $this->items = sfAdminDash::getItems();

    $this->categories = sfAdminDash::getCategories();    
  } 
  
}