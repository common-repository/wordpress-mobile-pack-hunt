=== Wordpress Mobile Pack + HUNT ===
Contributors: Hunt Team based on a previous work of jamesgpearce, andreatrasatti, edent
Tags: mobile, mobile web, mobile internet, wireless, pda, iphone, android, webkit, wap, dotMobi, theme, blackberry, admob, mobile adsense, qr-code, device, switcher, cellular, palm, nokia
Requires at least: 2.5
Tested up to: 3.1
Stable tag: 1.0.5


The Wordpress Mobile Pack + HUNT plugin is a modified version of the popular toolkit to help mobilize your WordPress site and blog.
== Description ==

The Wordpress Mobile Pack + HUNT is a complete toolkit to help mobilize your WordPress site. It has a mobile switcher, themes, widgets, and mobile admin panel.
This version differs from original WordPress Mobile Pack on the way that only accepts Hunt as adserver, and ads are showing on header and footer, regardless of widget positioning.
This version it's meant for Hunt client's alone.

It includes a mobile switcher to select themes based on the type of user that is visiting the site, a selection of mobile themes, extra widgets, device adaptation and a mobile administration panel to allow users to edit the site or write new posts when out and about.

The pack has been tested on WordPress 2.5.1, 2.6.5, 2.7.1, 2.8.6, 2.9.2, and 3.0. It has been tested on WordPress MU 2.6 in the 'plugins', rather than 'mu_plugins', mode. PHP 5.x is also highly recommended, although the plugin also works with PHP 4.3.

Features include:

* All original Wordpress Mobile Pack features v1.2.4
* Mobile ad serving capability using HUNT ad server technology 

== Installation ==

This section describes how to install the plugin and get it working.

1. Create your account at huntmads.com, include the mobile site you will use the plugin in, and take note of the IDs of the site and both zones (header and footer).
2. UNZIP the plugin /wordpress-mobile-pack-hunt to your local drive, take note of the location.
3. Upload the unzipped plugin folder to your wordpress installation, in the plugins path, /wp-content/plugins.
4. Activate the Wordpress Mobile Pack + HUNT plugin by loggin as admin and navigating to the to your plugins admin page at /wp-admin/plugins.php .
5. Go to Appearence and set your preferences on the widget tab and the Mobile Switcher admin pages.
6. Make sure to include your Site ID and Zone IDs in /wp-admin/widgets.php under HUNT Mobile Ads.

== Frequently Asked Questions ==

= Is this plugin for everybody? =
This plugin it's only intented for wordpress webmasters which want to adapt their site to mobile devices, and want to monetize the traffic with HUNT ad server.

= Where can I get help using this plugin? = 
Please visit the plugin project page at: http://wordpress.org/extend/plugins/wordpress-mobile-pack-hunt/

= Where should I register to get my HUNT publisher account? = 
Please visit http://www.huntmads.com and look for the publisher section

= I got my HUNT Publisher account, but don't know how to pull the Site ID and Zone IDs! = 
Please visit http://www.huntmads.com and review the implementation section for help installing and configuring this plugin.

= I got my HUNT Publisher account, and pulled the IDs, where in this plugin should I input them? = 
Please follow this simple steps:

1. Login to your WP with the admin, and navigate to the wordpress widgets admin page at /wp-admin/widgets.php
2. Locate the HUNT Mobile Ads widget and drag it to any widget area, i.e.: Primary Widget Area.
3. Expand the HUNT Mobile Ads widget in the Widget area where you dropped it, and fill in the Site ID, and Zones IDs in the input fields, save.

You are done, ads will show in your WP mobile version briefly and you will be able to see the traffic and revenue in HUNT reporting engine.



== Known issues ==

* On a WordPress MU installation, it is not possible to configure the favicon for each site independently within the single mobile theme. You are advised to create multiple derived themes from the mobile base theme, and configure the favicons separately for each.
* Note that if you use a desktop theme that provides unusual, additional page templates, the default mobile theme will not have the corresponding logic. The mobile theme will fall back to showing a default posting list. However, you are able to create new mobile templates just as for the desktop theme. (Copy archives.php as a simple example of an auxiliary page template.)
* If you are using a desktop domain and a mobile domain, it is not currently possible to host them on different sub-directory locations (eg `http://mysite.com/blog/` but `http://mysite.mobi/`). Both versions of the site must either be at the top-level of the domain or in the same sub-directory.
* W3 Total Cache does not play well with mobile plugins, you can read how to make it work at [Getting W3 Total cache to work with WordPress Mobile Pack](http://blog.trasatti.it/2010/04/getting-w3-total-cache-to-work-with.html) until a new release comes (very soon!)

== Changelog ==
= 1.0.5 =
* Fixed the curl warning

= 1.0.4 =
* Readme.txt file ammended
* Fixed 2 internal broken links

= 1.0.3 =
* Minor text changes

= 1.0.2 =
* Readme.txt file ammended 

= 1.0.1 =
* Fixed footer_hook on mobile theme. Now shows only ads if mobile theme is selected


= 1.0.1 =
* added cURL Support


