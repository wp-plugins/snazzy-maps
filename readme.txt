=== Snazzy Maps ===
Contributors: atmistinc
Donate link: https://snazzymaps.com/about
Tags: google,maps,google maps,styled maps,styles,color,schemes,themes
Requires at least: 2.8
Tested up to: 4.2.2
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Apply styles to your Google Maps with the official Snazzy Maps WordPress plugin.

== Description ==

[Snazzy Maps](https://snazzymaps.com/plugins) adds styles to your existing Google Maps with the click of a button. 

**Features**

- Browse through hundreds of free styles.
- Quickly apply styles to all of the Google Maps on your WordPress site.
- Works with most Google Maps plugins.
- Access your favorites from Snazzy Maps by signing up for an [API key](https://snazzymaps.com/account/developer).
- Build and customize your own styles on Snazzy Maps and access them through the plugin.
- Free to use for personal and open source projects. Affordable licenses for businesses.

*Please note this plugin does not add a Google Map to your page. It simply adds styles to any existing maps that you
already have on your site.*

== Installation ==

1. Install Snazzy Maps by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Access Appearance > Snazzy Maps in the WordPress menu.
1. Choose a collection of styles in the 'Explore' tab.
1. Apply your chosen style by clicking 'Enable' in the 'Site Styles' page.
1. Enjoy your newly styled Snazzy Maps!

*Please note this plugin does not add a Google Map to your page. It simply adds styles to any existing maps that you
already have on your site.*

== Frequently Asked Questions ==

= Is the plugin free to use? =

The Snazzy Maps plugin is free to use for personal and open source projects. Business licenses are available for
single and multiple sites and can be purchased at https://snazzymaps.com/plugins

= How do I add a Google Map to my page? =

This plugin does not add a Google Map to your page. It simply adds styles to your existing maps. If you haven't
added a map yet, search [WordPress Plugins](https://wordpress.org/plugins) for a suitable Google Maps plugin.

= What are some compatible Google Maps plugins? =

We've tested our plugin with the following Google Maps plugins. If you find another plugin that works please send us an email at support@snazzymaps.com.

- [WP Google Maps](https://wordpress.org/plugins/wp-google-maps/)
- [Comprehensive Google Map Plugin](https://wordpress.org/plugins/comprehensive-google-map-plugin/)
- [Leaflet Maps Marker](https://wordpress.org/plugins/leaflet-maps-marker/)
- [WP Google Map Plugin](https://wordpress.org/plugins/wp-google-map-plugin/)
- [Map List Pro](https://codecanyon.net/item/map-list-pro-google-maps-location-directories/2620196/)
- [WP Flexible Map](https://wordpress.org/plugins/wp-flexible-map/)
- [Basic Google Maps Placemarks](https://wordpress.org/plugins/basic-google-maps-placemarks/)
- [Pronamic Google Maps](https://wordpress.org/plugins/pronamic-google-maps/)
- [Robo Maps](https://wordpress.org/plugins/robo-maps/)
- [Google Routeplanner](https://wordpress.org/plugins/google-routeplaner/)
- [WPMU DEV Google Maps](https://premium.wpmudev.org/project/wordpress-google-maps-plugin/)

= Snazzy Maps doesn't work with my Google Maps plugin! =

The Snazzy Maps plugin cannot apply styles to maps created using the Google Maps Embed API. This is because of 
fundamental limitations on the way IFrames work on the web. We cannot access the map within Google's IFrame and cannot 
apply any styles to it. Sorry! Switching to a WordPress plugin that uses Google's JavaScript API will work instead.

The following plugins will not work with the Snazzy Maps WordPress plugin:

- [Geo Mashup](https://wordpress.org/plugins/geo-mashup/)
- [Embed Google Map](https://wordpress.org/plugins/embed-google-map/)

If you happen to find any other map plugins that don't work please send us an email at support@snazzymaps.com.

= How can I access my favorites or private styles from SnazzyMaps.com? =

1. Sign up for an account at [SnazzyMaps.com](https://snazzymaps.com).
1. Click your email address in the top left corner.
1. Click the developer menu item on the left side.
1. Click the "Generate API Key" button.
1. Copy the long generated API Key.
1. Paste the key into the 'Settings' tab in the Snazzy Maps plugin.
1. You should now be able to access your favorites and private styles in the 'Explore' tab by changing the first filter dropdown.

== Screenshots ==

1. Explore hundreds of different styles.
2. Select a style to use for the Google Maps on your site.
3. Your Google Map is now a Snazzy Map!

== Changelog ==

= 1.1.1 =
Release Date: July 21st, 2015

* Bug Fix: Renamed the Services_JSON class to fix a redeclare class error when working with other plugins.

= 1.1.0 =
Release Date: June 15th, 2015

* New Feature: Added search to the explore tab.
* Bug Fix: Updated save style to properly work with unicode characters.
* Bug Fix: Changed all include to include_once because of redeclared errors.

= 1.0.6 =
Release Date: May 11th, 2015

* Bug Fix: Added support for Google Maps asynchronous loading.

= 1.0.5 =
Release Date: April 24th, 2015

* Bug Fix: Updated snazzymaps.js to copy over the existing Google Maps prototype during our constructor override.

= 1.0.4 =
Release Date: April 16th, 2015

* Bug Fix: Moved snazzymaps.js from the footer to the head to support additional themes.
* Bug Fix: Changed the add_theme_page capability from edit_themes to manage_options.

= 1.0.3 =
Release Date: April 8th, 2015

* Bug Fix: Added some javascript to support more browsers and Google Maps plugins.
* Bug Fix: Fixed up some PHP warning messages on the plugin pages.

= 1.0.2 =
Release Date: March 25th, 2015

* Bug Fix: Updated the plugin to work with older PHP and WordPress versions. We now support PHP 5.0.5 and later and WordPress 2.8 and later.

= 1.0.1 =
Release Date: March 17th, 2015

* Bug Fix: Resolved the "headers already sent" issue that occurred when submitting POSTs with certain themes.

= 1.0.0 =
Release Date: March 1st, 2015

* Initial Release!

== Upgrade Notice ==

There is no need to upgrade just yet.