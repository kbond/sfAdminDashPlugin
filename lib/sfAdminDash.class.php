<?php
/**
 * sfAdminDash main class
 *
 * @package    plugins
 * @subpackage sfAdminDash
 * @author     kevin
 * @version    SVN: $Id$
 */
class sfAdminDash
{

  /**
   * Check if the item is allowed to go in the menu
   *
   * @param array $item
   *
   * @return boolean
   */
  public static function itemInMenu($item)
  {
    return isset($item['in_menu']) ? $item['in_menu'] : true;
  }

  /**
   * Return the user actions from the sf_admin_dash configuration
   *
   * @return array
   */
  public static function getUserActions()
  {
    $actions = self::getProperty('user_actions');

    return $actions;
  }

  /**
   * Check if there is at least one item in the supplied array that is allowed to go in the menu
   *
   * @param array $items
   *
   * @return boolean
   */
  public static function hasItemsMenu($items)
  {
    foreach($items as $item)
    {
      if (self::itemInMenu($item))
      {
        return true;
      }
    }

    return false;
  }


  /**
   * Return the items from the sf_admin_dash configuration
   *
   * @return array
   *
   * @see sfAdminDash::initItem()  All items are initialized before being returned through this method
   * @see sfAdminDash::getProperty()
   */
  public static function getItems()
  {
    $items = self::getProperty('items', array());
    array_walk($items, array(__CLASS__, 'initItem'));

    return $items;
  }


  /**
   * Return all items from the configuration, conbining the one from the plain items array and the categories
   *
   * @return array
   *
   * @see sfAdminDash::getItems()
   * @see sfAdminDash::getCategories()
   * @see sfAdminDash::getProperty()
   */
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


  /**
   * Return the categories as defined in the configuration, initializing their items (if they have any)
   *
   * @see sfAdminDash::initItem()
   * @see sfAdminDash::getProperty()
   */
  public static function getCategories()
  {
    $categories = self::getProperty('categories', array());
    foreach ($categories as $category_name => $category_data)
    {
      if (isset($category_data['items']))
      {
        array_walk($categories[$category_name]['items'], array(__CLASS__, 'initItem'));
      }
    }

    return $categories;
  }


  /**
   * A proxy method for sfConfig::get(), used bacause it's more readible this way
   *
   * @param string $name The name of the config value we want
   * @param mixed $default The default value to be returned if the config option is not set
   *
   * @return mixed
   */
  public static function getProperty($name, $default = null)
  {
    return sfConfig::get('app_sf_admin_dash_'.$name, $default);
  }


  /**
   * A proxy method for sfConfig::set(), userd because it's more convenient
   *
   * @param string $name The name of the config value we want to set
   * @param mixed $value Guess what ;)
   */
  public static function setProperty($name, $value)
  {
    sfConfig::set('app_sf_admin_dash_'.$name, $value);
  }


  /**
   * Check if the user the necessary credentials to see this particular item
   *
   * @param array $item
   * @param sfUser $user
   */
  public static function hasPermission($item, $user)
  {
    if (!$user->isAuthenticated())
    {
      return false;
    }

    return isset($item['credentials']) ? $user->hasCredential($item['credentials']) : true;
  }


  /**
   * Check if the supplied route exists
   *
   * @param string $route
   * @param sfContext $context
   *
   * @return boolean
   */
  public static function routeExists($route, sfContext $context)
  {
    try
    {
      $context->getRouting()->generate($route);
      return true;
    }
    catch (Exception $e)
    {
      return false;
    }
  }


  /**
   * Get the current module name (as defined in the sfAdminDash configuration), if possible, with translation
   * If no specific name was found for the module name, it is returned as is
   *
   * @param sfContext $context
   *
   * @return string
   */
  public static function getModuleName(sfContext $context)
  {
    $modulename = $context -> getModuleName();
    $translation = self::getProperty("translator", array());

    if (isset($translation[$modulename]))
    {
      if (is_array($translation[$modulename]))
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


  /**
   * Get the current action name, with translatio, if possible
   *
   * @param sfContext $context
   *
   * @return string
   */
  public static function getActionName(sfContext $context)
  {
    $modulename = $context -> getModuleName();
    $actionname = $context -> getActionName();
    $translation = self::getProperty("translator", array());

    return isset($translation[$modulename]["actions"][$actionname]) ? $translation[$modulename]["actions"][$actionname] : $actionname;
  }


  /**
   * This function primes the item for use, making sure all required fields are set
   *
   * @param array $item The item data, sent by reference
   * @param string|integer $key  The key that points to the specific item
   */
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