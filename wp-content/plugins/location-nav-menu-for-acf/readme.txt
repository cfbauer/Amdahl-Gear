=== Location "Nav Menu" for ACF ===
Contributors: psd2html
Donate link: http://psd2html.com
Tags: acf, menu, acf location
Requires at least: 4.0
Tested up to: 4.3.1
Stable tag: 1.1
Current Supported  ACF Version: 5.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Say NO to complex, inconvenient, and unpractical workarounds and easily create powerful mega-menus and custom features you've always wanted.

== Description ==
Unleash the full power of the ACF PRO plugin to extend WordPress menu functionality. With this add-on, you can display custom fields of different types directly under general menu field items while editing your menu in the admin panel. 

Advanced Custom Fields Compatibility

This add-on works smoothly with version 5+.


== Installation ==
1. From the dashboard of your site, navigate to Plugins → Add New.
2. Select the Upload option and hit "Choose File".
3. When the popup appears, select the acf-menu-location.zip file from your computer.
4. Follow the on-screen instructions and wait as the upload completes.
5. When it's finished, activate the plugin via the prompt. A message will show confirming activation was successful.


== Frequently Asked Questions ==

= How can I display a custom menu item field in the front-end? = 

Menu items in the database are stored the same way as regular posts. Therefore, fields set to menu items use the same operation logic as posts. You don't have to use any additional functions or third-party parameters. However, since the output of menu items is often implemented outside the WordPress loop, you must specify the menu item ID (i.e. $item->ID, not $item->object_id) as the second parameter of the function get_field (or the_field etc.).

= Can I add fields to a certain menu only? =

Yes, when you select the location while creating a group of fields, you can select one (or more, using the logic of the rules) from the existing WordPress menus on your website. Fields are added to all existing menus by default. 


== Changelog ==

= Version 1.1 =
* Initial release


== Upgrade Notice ==

= 1.1 =
* Initial release

== Screenshots ==

1. Back-end View