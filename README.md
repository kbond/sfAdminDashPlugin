#sfAdminDashPlugin

##Overview

I found for all my symfony projects which had backends I had to create a 
menu to access all the various modules.  This plugin automates the 
process by using a configuration file.

###Requirements:

[sfJqueryReloadedPlugin](http://www.symfony-project.org/plugins/sfJqueryReloadedPlugin)
This plugin depends on sfJqueryReloadedPlugin to create the dropdown
menu and manipulate the view. If this plugin is not yet installed,
the symfony plugin dependency system will install it when you install
sfAdminDashPlugin.

##How to use

###Step 1 - install plugin

Install the plugin, publish the assets and clear the cache.

    $ symfony plugin:install sfAdminDashPlugin
    $ symfony plugin:publish-assets
    $ symfony cc

Then activate the sfAdminDash module in the application's *settings.yml*

    # in application/config/settings.yml
    enabled_modules:          [default, sfAdminDash]

###Step 2 - setup theme

Add the plugin's header and footer to your application's global 
layout:

    <!-- in application/templates/layout.php -->
    <body>
      <?php include_component('sfAdminDash', 'header'); ?>
      <?php echo $sf_content ?>
      <?php include_partial('sfAdminDash/footer'); ?>
    </body>


If you have admin generator modules, deactivate the default admin 
generator theme in each module's *generator.yml* by setting the css 
property.  You can either point the css property to a real stylesheet or 
just disable it.

    # in application/modules/admin_generated_module/config/generator.yml
    generator:
      class: sfPropelGenerator
      param:
        model_class:           Article
        theme:                 admin
        non_verbose_templates: true
        with_show:             false
        singular:              ~
        plural:                ~
        route_prefix:          article
        with_propel_route:     true
        css:                   false   # disable the default css

        config:
          actions: ~
          fields:  ~
          list:    ~
          filter:  ~
          form:    ~
          edit:    ~
          new:     ~

In the future I would like to create an actual theme by overriding the 
default files but I found an issue when trying to do this (see [my 
ticket](http://trac.symfony-project.org/ticket/5697))


  At this point your modules should be styled with the joomla-like 
theme.  There should also be a warning saying *sfAdminDashPlugin not configured. Please 
see documentation.*  We will fix that soon.

###Step 3 (optional) - setup the dashboard

Set your application's *homepage* in your application's *routing.yml* to:

    # in application/config/routing.yml
    homepage:
      url:   /
      param: { module: sfAdminDash, action: dashboard }

###Step 4 - set global plugin configuration

The plugin's *app.yml* file looks like this:

    # in plugins/sfAdminDashPlugin/config/app.yml
    all:
      sf_admin_dash:
        web_dir:                      /sfAdminDashPlugin
        image_dir:                    /sfAdminDashPlugin/images/icons/
        default_image:                config.png
        dashboard_url:                @homepage
        resize_mode:                  thumbnail
        site:                         My Site Name
        include_path:                 true
        include_assets:               true
        include_jquery:               true
        include_jquery_no_conflict:   false
        login_route:                  @sf_guard_signin
        logout:                       true
        logout_route:                 @sf_guard_signout

* web_dir - Where the plugin's default css/javascript/images are kept.
* image_dir - Where your images for the dash/menu items are kept - 
images should be 48x48.
* default_image - The default item image if none is specified - this 
must be in the *image_dir* folder.
* resize_mode - How the image will be resized for the menu items.
    * thumbnail - Looks for a directory inside *image_dir* called *small* 
for an image with the same name - it should be 16x16px.
    * html - Resizes the image with the html *img* tag width/height attributes.
* site - What you would like the site name to be (shows up in the *path 
bar* as a link and on the login page).
* include_path - Whether to generate path "breadcrumbs". Those are meant mainly for the admin generator.
* include_assets - Whether the plugin's assets (css and js) should be included. Leave this to true unless you intend to reskin the plugin.
* include_jquery - Whether to include jquery. Depends on sfJqueryReloadedPlugin.
* include_jquery_no_conflict - In case you are using another JS framework in you website, you should set this to true. It will prevent jQuery from interfering.
* login_route - The route to the login action, defaults to the sfGuardPlugin's.
* logout -  Whether a logout link will be shown.
* logout_route - The route to the logout action, defaults to the sfGuardPlugin's.

You can override these settings as you see fit.

###Step 5 - configure the dashboard/menu items

Items are controlled by your application's *app.yml* file.  The best way 
to show how to use this is with an example:

  I have created a backend application with 2 admin modules: *Comment* and *Article*.

  To create dashboard/menu items for these modules I will use this configuration:

    # in application/config/app.yml
    all:
      sf_admin_dash:
        items:
          Articles:
            url:              article
          Comments:
            url:              comment

This creates 2 items on the dashboard and a *Menu* dropdown.  The url 
property should be an internal URI.  You can also set credentials and an 
image.  The *image* property can be just the image name - the plugin will look 
for it in the folder specified in the global settings. Alternatively you can 
also specify an absolute path, like so ``image: /somefolder/someimage.jpg``.

  The credential property can be used to hide options from users who do 
not have specific credentials.  This gives the ability for different 
users to see different options.  The format for this is the same as when 
setting credentials in *security.yml*.
  
  **NOTE:  This just prevents the user from seeing the item.  You still 
need to setup the same credentials in *security.yml* to prevent the user 
from accessing the module.**

Here is an example configuration:

    # in application/config/app.yml
    all:
      sf_admin_dash:
        items:
          Articles:
            url:              article
            image:            book.png
            credentials:      [[admin, publisher]]
          Comments:
            url:              comment
            image:            textcloud.png
            credentials:      [admin]

The above example shows the *Articles* item only to users with the 
**admin** or **publisher** credential and the *Comments* item only to 
users with the **admin** credential.  The images are self explanatory.  

Packaged with this plugin is a small library of images that can be used.


You can group items into categories as well by embedding the items into 
a *category name* property under *categories* property:

    # in application/config/app.yml
    all:
      sf_admin_dash:
        categories:
          Blog:
            items:
              Articles:
                url:          article
                image:        book.png
                credentials:  [[admin, publisher]]
              Comments:
                url:          comment
                image:        textcloud.png
                credentials:  [admin]
          Category2:
            items:
              ...

Category names are not only seperated on the dashboard but they have 
their own dropdown menu.

  You can set credentials to entire categories like so:

    # in application/config/app.yml
    all:
      sf_admin_dash:
        categories:
          Blog:
            credentials:      [ admin ]
            items:
              Articles:
                url:          article
                image:        book.png
              Comments:
                url:          comment
                image:        textcloud.png

This hides the entire category from the user if they don't have the 
**admin** credential.

By default the plugin header prints a cookie trail in the format "module / action".
To make module and action names more user-friendly you can overwrite them using the 
"translator" property like so:

    # in application/config/app.yml
    all:
      sf_admin_dash:
        translator:
          sfGuardUser:                # the module we are translating
            title:            Users   # title for that module
            actions:                  # actions array
              editUser:       edit    # here we specify each action and its translation

###Step 6 (optional) - setting up login screen

Packaged with this plugin is a partial called *login*.  Currently, it only works 
with sfGuardPlugin. Include it like this:

    // in application/modules/sfGuardAuth/templates/signinSuccess.php
    <?php include_partial('sfAdminDash/login', array('form' => $form)); ?>

###Step 7 (optional) - setting up User actions

User actions can be optionally set in *app.yml*:

    # in application/config/app.yml
    all:
      sf_admin_dash:
        user_actions:
          "New Ticket":       
            url:              @cms_ticket_new 
          "My Tickets":       
            url:              @cms_ticket
          "Clear cache":
            url:              @clear_app_cache  
            credentials:      [ admin ]    

These show up as a list of links next to the logout button.  Override the _user_actions partial if you wish to add some kind of logic to the action display.

###todo
* use an actual admin generator theme
* clean up css

Feel free to email suggestions/bugs.
