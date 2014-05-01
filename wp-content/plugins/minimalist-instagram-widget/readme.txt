=== Minimalist Instagram Widget ===
Contributors: impression11 
Tags: Instagram, Widget, Minimalist
Requires at least: 3.6
Tested up to: 3.9
Stable tag: 1.3

A quick and efficient Instagram widget to display recent Instagram Photos & Videos.

== Description ==

Minimalist Instagram Widget displays user photos using Instagram API. With minimal styling it picks up your theme’s styling to blend in seamlessly.

To avoid API limits there is an optional cache feature which can be set to expire after a user defined amount of hours.

== Installation ==

1. Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

2. Go to “Instagram Options” under Appearance and input your Access Token (link provided to attain the Access Token).

4. Go to Widgets, drag the “Minimalist Instagram Widget” to the your sidebar and define the username of the Instagram account you want to use, how many photos you’d like to display, how many to display per row and a widget Title. Alternatively you can insert a short code into a post or page as so: [minstagram username=“ethjim” count=“2” row=“1” video=“0”], replacing the username, count and rows with your specified settings.

5. To avoid strict API limits use caching to ensure that the requests to Instagram are minimal. This will cache the results and the images; this however requires the plugin folder to the writable by the Plugin itself.

== Changelog ==

= 1.3=
* Allows shortcodes and widgets to pull photos from different Instagram accounts.
* Cleaned up the differences in code between building the cached file and displaying the images without a cache.
* Specified that using the User ID in the options page is now a legacy field and will only be used when a username is not set at a shortcode or widget.
* Adjusted the cache file name system to reflect the introduction of using usernames.


= 1.2 =
* Optional Instagram video display support in Wordpress 3.6 and over.
* Fixed spelling mistake on menu.


= 1.1 =
* Fixed bug that only allowed the plugin to display 1 photo.
* Added Instagram Caption to the Lightbox when available.
* Fixed bug with custom rows set-up.

= 1.0 =
* Initial release.