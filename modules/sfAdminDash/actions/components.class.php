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

  public function executeDash_item()
  {
    $this->InitItem();
  }

  public function executeMenu_item()
  {
    $this->InitItem(sfAdminDash::getProperty('resize_mode'));
  }

  protected function parseSettings()
  {
    $this->items = sfAdminDash::getItems();

    $this->cats = sfAdminDash::getCategories();;
  }
  protected function InitItem($resize_mode = 'html')
  {
    $image = sfAdminDash::getProperty('default_image');

    if (array_key_exists('image', $this->item))
    {
      $image = $this->item['image'];
    }

    $this->item['image'] = sfAdminDash::getProperty('image_dir');

    if ($resize_mode == 'thumbnail')
    {
      $this->item['image'] .= 'small/';
    }

    //if image isn't specified - use default
    if (!array_key_exists('image', $this->item))
    {
      $this->item['image'] .= $image;
    }
    else
    {
      $this->item['image'] .= $image;
    }

    //if name isn't specified - use key
    if (!array_key_exists('name', $this->item))
    {
      $this->item['name'] = $this->key;
    }

    //if url isn't specified - use key
    if (!array_key_exists('url', $this->item))
    {
      $this->item['url'] = $this->key;
    }
    
    //if in_menu isn't specified - use true
    if (!array_key_exists('in_menu', $this->item))
    {
      $this->item['in_menu'] = true;
    }
  }
}