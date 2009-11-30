<?php
/**
 * sfAdminDash base components.
 *
 * @package    plugins
 * @subpackage sfAdminDash
 * @author     Ivan Tanev aka Crafty_Shadow @ webworld.bg <vankata.t@gmail.com>
 * @version    SVN: $Id: BasesfGuardAuthActions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */ 
class BasesfAdminDashComponents extends sfComponents
{

  private function set_up_variables()
  {
    $this->items = isset($this->items) ? $this->items : sfAdminDash::getItems();

    $this->categories =  isset($this->categories) ? $this->categories : sfAdminDash::getCategories();

    $this->module_link = null;
    try {
      $routing = $this->getContext()->getRouting();
    } catch (Exception $e) {
      // no module route could be generated
    }
    $this->logMessage('Module link generated to: '.$this->module_link);
  }
  
  /**
  * The main navigation
  * 
  */
  public function executeHeader()
  {
    $this->set_up_variables();
  } 

}