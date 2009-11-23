<?php

class sfAdminDashComponents extends sfComponents
{
  public function executeDash()
  {
    $this->parseSettings();
  }

  public function executeMenu()
  {
    $this->parseSettings();
  }

  protected function parseSettings()
  {
    $this->items = sfAdminDash::getItems();

    $this->cats = sfAdminDash::getCategories();;
  }
  

}