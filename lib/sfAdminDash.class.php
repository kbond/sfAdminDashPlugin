<?php

class sfAdminDash {

  public static function getItems()
  {
    return self::getProperty('items');
  }

  public static function getCategories()
  {
    $categories = self::getProperty('categories');
    
    return self::getProperty('categories');
  }

  public static function getProperty($val)
  {
    return sfConfig::get('app_sf_admin_dash_'.$val);
  }

  public static function hasPermission($item, $user)
  {
    if (!$user->isAuthenticated())
    {
      return true;
    }

    if (!key_exists('credentials', $item))
    {
      return true;
    }

    if ($user->hasCredential($item['credentials']))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}