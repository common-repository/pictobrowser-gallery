=== PictoBrowser ===
Contributors: tie82
Tags: flickr, picasa, flash, gallery, flash gallery, pictobrowser, image, photo
Donate Link: http://blog.endlich-wochenen.de/?p=343
Requires at least: 2.7
Tested up to: 2.8.4
Stable tag: trunk

This plugin shows Picasa and Flickr web galleries in Wordpress using Pictobrowser

== Description ==

This plugin shows Picasa and Flickr web galleries in Wordpress using [Pictobrowser](http://pictobrowser.com/).
Only the album ID and its user ID are needed to show an album inside your Wordpress Blog.

How to retrieve the needed ids and insert an album??

Flickr:

1. Visit an album on flickr you want publish in your blog, e.g. http://www.flickr.com/photos/rougerouge/sets/872426/
1. you can retrieve username (rougerouge) and album id (872426) from this link, but you need to convert the username into a user id
this is done by [idgettr.com](http://idgettr.com/) (in this case the user id is 90537551@N00)
1. click on the icon, paste the ids and insert the gallery :)

Picasa:

1. Visit an album on picasa you want publish in your blog, e.g. http://picasaweb.google.com/ksandrmusic/uaprsK
you can retrieve user id (ksandrmusic) and album name (uaprsK) from this link, but you need to convert the album name into a album id
1. this is done if you take a look on the rss feed link, it is valid on the right side on the picasa album page, e.g. http://picasaweb.google.com/data/feed/base/user/ksandrmusic/albumid/5320841682690406545?alt=rss&kind=photo&hl=de so the album id is 5320841682690406545
1. click on the icon, paste the ids and insert the gallery :)

== Installation ==

1. Unzip and upload plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use the TinyMCE Button to add the PictoBrowser tag in your post or create it manually like this:

For Flickr: [pictobrowser type="flickr" userID="90537551@N00" albumID="872426"]

For Picasa: [pictobrowser type="picasa" userID="math.krueger" albumID="5366215130417176209"]

== Screenshots ==

1. Preview of the gallery
2. Preview of post popup
3. Preview of general settings

== Changelog ==

= 0.3.1 =
* correct plugin path

= 0.3 =
* add more settings to configure PictoBrowser

= 0.2 =
* scrap the old code and reimplement it (based on Pro Player WP addon from Isa Goksu)
* add picasa support
* first public version

= 0.1 =
* first version
* implement flickr support