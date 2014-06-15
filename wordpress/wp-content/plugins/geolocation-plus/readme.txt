=== Geolocation Plus ===
Contributors: adrianshort, frsh, mdawaffe, automattic
Tags: georss, geolocation, maps, geotag, geo, mapping
Requires at least: 2.9.2
Tested up to: 3.9.1
Stable tag: 0.1.5.1
License: GPLv2 or later

Geolocation Plus lets you geotag your posts, shows a map on the post page and serves a GeoRSS feed of all geotagged posts on your site.

== Description ==

The Geolocation Plus plugin allows WordPress users to geotag their posts using the Edit Post page or any geo-enabled WordPress mobile applications such as WordPress for iPhone, WordPress for Android, or WordPress for BlackBerry.

Visitors see a short description of the address either before, after, or at a custom location within the post. Hovering over the address reveals a map that displays the post's exact location.

It serves a [GeoRSS feed](http://en.wikipedia.org/wiki/GeoRSS) of all geotagged posts on your site, allowing geo-aware RSS readers to display the location of your post or otherwise aggregate your geotagged content.

This plugin is forked from [Geolocation](http://wordpress.org/extend/plugins/geolocation/) by [Chris Boyd](http://profiles.wordpress.org/frsh/) and contributors. If you don't need a GeoRSS feed then you might be better just to use the original plugin.

Development work on this fork was commissioned by [Talk About Local](http://talkaboutlocal.org.uk/) as part of the [HypARlocal](http://talkaboutlocal.org.uk/ar/) project to make local news content available on augmented reality platforms.

HypARlocal is funded by [NESTA's Destination Local](http://www.nesta.org.uk/destination_local) and the [Nominet Trust](http://www.nominettrust.org.uk/).

== Installation ==

1. Upload the `geolocation-plus` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Modify the display settings as needed on the Settings > Geolocation Plus page.

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png

== Changelog ==

= 0.1 =
* Initial release.

= 0.1.1 =
* Added ability to turn geolocation on and off for individual posts.
* Admin Panel no longer shows up when editing a page.
* Removed display of latitude and longitude on mouse hover.
* Map link color now defaults to your theme.
* Clicking map link now (properly) does nothing.

= 0.1.2 =
Privately-released alpha.

= 0.1.3 =
Privately-released beta.

= 0.1.4 =
* Added GeoRSS feed at http://example.org/wp-content/plugins/geolcation-plus/georss.php

= 0.1.5 =
* Add dc namespace so feeds validate

