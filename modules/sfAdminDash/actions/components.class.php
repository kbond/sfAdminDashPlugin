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

    $image = (substr($image, 0, 1) == "/") ? $image : (sfAdminDash::getProperty('image_dir') . $image);

    if ($resize_mode == 'thumbnail')
    {
      $last_slash = strrpos($image, "/");
      $image = substr($image, 0, $last_slash)."/small/".substr($image, $last_slash + 1);
    }
    $this->item['image'] = $image;

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