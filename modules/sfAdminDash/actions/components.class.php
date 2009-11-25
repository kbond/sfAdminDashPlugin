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
    $this->items = isset($this->items) ? $this->items : sfAdminDash::getItems();

    $this->cats =  isset($this->cats) ? $this->cats : sfAdminDash::getCategories();
  }
  

}