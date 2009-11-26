<?php

class sfAdminDash {

	public static function itemInMenu($item)
	{
	  return isset($item['in_menu']) ? $item['in_menu'] : true;	
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
    $items = self::getProperty('items', array());         
    array_walk($items, 'sfAdminDash::initItem');
    
    return $items;
  }
  
  public static function getAllItems()
  {
    $items = self::getItems();
    
    foreach (self::getCategories() as $category)
    {
      if (isset($category['items']))
      {
        $items = array_merge($items, $category['items']);
      }
    }
    
    return $items;
  }

  public static function getCategories()
  {    
    $categories = self::getProperty('categories', array());
    foreach ($categories as $category_name => $category_data)
    {
      if (isset($category_data['items']))
      {            
        array_walk($categories[$category_name]['items'], 'sfAdminDash::initItem');
      }
    }
    
    return $categories;
  }

  public static function getProperty($val, $default = null)
  {
    return sfConfig::get('app_sf_admin_dash_'.$val, $default);
  }

  public static function hasPermission($item, $user)
  {
    if (!$user->isAuthenticated())
    {
      return false;
    }

    if ($item instanceof sfOutputEscaper)
    {
      $item->getRawValue();
    }
    
    if (!array_key_exists('credentials', $item))
    {
      return true;
    }

    return $user->hasCredential($item['credentials']);
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
    // we should check if we can get the module name from the item representing it in the dash menu
    else foreach (self::getAllItems() as $key => $item)
    {                          
      if (($modulename == $key || $modulename == $item['url']))
      {
        if (isset($item['name']))
        {
          return $item['name']; // yay, we got the name!
        }
        else
        {
          break; // we found our item, but it didn't have a special name, break from the search
        }
      }
    }

  	return $modulename;
  }
  
  public static function getMainRoteForRoteCollection(sfWebRequest $request)
  {
    
  }
  
  public static function getActionName()
  {
  	$modulename = sfContext::getInstance() -> getModuleName();
  	$actionname = sfContext::getInstance() -> getActionName();
  	$translation = self::getProperty("translator", array());
  	
  	return isset($translation[$modulename]["actions"][$actionname]) ? $translation[$modulename]["actions"][$actionname] : $actionname;
  }
  
  public static function initItem(&$item, $key)
  {
    $image = isset($item['image']) ? $item['image'] : sfAdminDash::getProperty('default_image');
    $image = (substr($image, 0, 1) == '/') ? $image : (sfAdminDash::getProperty('image_dir') . $image);

    $item['image'] = $image;

    //if name isn't specified - use key
    $item['name'] = isset($item['name']) ? $item['name'] : $key;

    //if url isn't specified - use key
    $item['url'] = isset($item['url']) ? $item['url'] : $key;    
    
    //if in_menu isn't specified - use true
    $item['in_menu'] = isset($item['in_menu']) ? $item['in_menu'] : true;
  }  
}