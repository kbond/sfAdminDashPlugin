<?php

class sfAdminDash {

	public static function itemInMenu($item)
	{
		if(!isset($item['in_menu'])) return true;

	  return $item['in_menu'];	
	}
	
	public static function hasItemsMenu($items)
	{
		foreach($items as $item)
		{
			if(self::itemInMenu($item))
			{
				return true;
			}
		}
		
		return false;
	}
	
  public static function getItems()
  {
    return self::getProperty('items');
  }

  public static function getCategories()
  {    
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
  
  public static function getModuleName()
  {
  	$modulename = sfContext::getInstance() -> getModuleName();
  	$translation = self::getProperty("translator", array());
  	
  	if(isset($translation[$modulename]))
  	{
  		if(is_array($translation[$modulename]))
  		{	
  			return empty($translation[$modulename]["title"]) ? $modulename : $translation[$modulename]["title"];	
  		}
  		else
  		{
  			return $translation[$modulename];
  		}
  	}
  	return $modulename;
  }
  
  public static function getActionName()
  {
  	$modulename = sfContext::getInstance() -> getModuleName();
  	$actionname = sfContext::getInstance() -> getActionName();
  	$translation = self::getProperty("translator", array());
  	
  	return isset($translation[$modulename]["actions"][$actionname]) ? $translation[$modulename]["actions"][$actionname] : $actionname;
  }
}