=== Plugin Name ===
Contributors: DvanKooten
Donate link: https://dannyvankooten.com/donate/
Tags: facebook,posts,fanpage,recent posts,fb,like box alternative,widget,facebook widget,widgets,facebook updates,like button,fb posts
Requires at least: 3.7
Tested up to: 4.2.2
Stable tag: 2.0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lists most recent Facebook posts from public Facebook pages. A faster, prettier and more customizable alternative to Facebooks Like Box.

== Description ==

This plugin adds a widget, a shortcode `[recent_facebook_posts]` and a template function `recent_facebook_posts()` to your WordPress website which you can use to list your most recent Facebook posts. This plugin works with public pages and to a certain extent with personal profiles.

= Facebook Posts Widget =
Render a number of most recent Facebook page updates in any of your widget areas using the Recent Facebook Posts widget.

= Facebook Posts Shortcode =
Display a list of your most recent Facebook posts in your posts or pages using the `[recent_facebook_posts]` shortcode. Optionally, specify some arguments to customize the output.

**Features**

* SEO friendly. Your Facebook posts are rendered as plain HTML which means they are indexable by search engines, no frames or JavaScript is used.
* High performance. Facebook posts are cached for a customizable period.
* Customizable. Your Facebook updates will blend in with your theme perfectly and can be easily styled because of smart CSS selectors.
* Easy Configuration, the plugin comes with a comprehensive [installation guide](http://wordpress.org/plugins/recent-facebook-posts/installation/) and [screenshots](http://wordpress.org/plugins/recent-facebook-posts/screenshots/).
* Translation ready!

**Translations**

English (en_US) - [Danny van Kooten](https://dannyvankooten.com/)<br />
Dutch (nl_NL) - [Danny van Kooten](https://dannyvankooten.com/)<br />
Spanish (es_ES) - [Hermann Bravo](http://hbravo.com/)
Swedish (sv_SE) - [Robin Wellström](http://robinwellstrom.se/)
German (de_DE) - [Henrik Heller ](http://www.gmx.net/)
Italian (it_IT) - [Daniele Chianucci](http://frozen.me/)
Turkish (tr_TR) - Halukcan Pehlivanoğlu

_Looking for more translations.._

If you have [created your own language pack](http://codex.wordpress.org/Translating_WordPress), you can send me the language files so that I can bundle it into the Recent Facebook Posts plugin. [You can download the latest POT file here](http://plugins.svn.wordpress.org/recent-facebook-posts/trunk/languages/recent-facebook-posts.pot).

**Other Links**

* [Contribute to the Recent Facebook Posts plugin on GitHub](https://github.com/dannyvankooten/wordpress-recent-facebook-posts)
* Using MailChimp to send out email newsletters? You should [try MailChimp for WordPress](https://wordpress.org/plugins/mailchimp-for-wp/).
* Want an unobtrusive conversion booster? Have a look at the [Scroll Triggered Boxes plugin](https://wordpress.org/plugins/scroll-triggered-boxes/).
* Check out more [WordPress plugins](https://dannyvankooten.com/wordpress-plugins/) by the same author
* Follow [@DannyvanKooten](https://twitter.com/DannyvanKooten) or [@ibericode](https://twitter.com/ibericode) on Twitter.

== Installation ==

= Installing the plugin =
1. [Download the latest version of the plugin](https://downloads.wordpress.org/plugin/recent-facebook-posts.zip)
1. Upload the contents of the downloaded .zip-file to your WordPress plugin directory
1. Activate the plugin through the 'Plugins' menu in WordPress

= Registering a Facebook App =
This plugin requires a Facebook application to fetch posts from Facebook.

1. If you're not a Facebook developer yet, register as one [here](http://developers.facebook.com/apps).
1. [Create a new Facebook application](http://developers.facebook.com/apps). Fill in only the `App Name` field and click `Continue`.

= Configuring the plugin =
1. Go to *Settings > Recent Facebook* posts in your WP Admin panel.
1. Copy and paste your Facebook `App ID/API Key` and `App Secret` into the setting fields.
1. Find the numeric Facebook ID of your public Facebook page using [this website](http://findmyfacebookid.com/).
1. Copy paste the ID in the `Facebook Page ID` field.
1. Add `[recent_facebook_posts]` to the page where you would like to show a list of recent Facebook posts or use the widget.

= Extra notes =
* Take a look at the [screenshots](https://wordpress.org/extend/plugins/recent-facebook-posts/screenshots/), they will tell you which values from Facebook you need.
* The plugin works with personal profiles, but only to a certain extend. I am not actively supporting personal profiles because of many privacy settings related issues.

Ran into an error? Have a look at the [FAQ](https://wordpress.org/plugins/recent-facebook-posts/faq/) for solutions to common problems or [open an issue on GitHub](https://github.com/dannyvankooten/wordpress-recent-facebook-posts/issues).

== Frequently Asked Questions ==

= What does Recent Facebook Posts do? =
With this plugin you can show a list of the most recent Facebook posts of a public page. You can display these posts in pages, posts and widget areas by using a shortcode or widget. Have a look at my [own WordPress website](https://dannyvankooten.com/) for an example, I have a widget with my latest Facebook update in my footer.

= How to configure this plugin? =
You need to create a Facebook application for this plugin to work. Have a **close** look at the [installation instructions](https://wordpress.org/plugins/recent-facebook-posts/installation/).

= No posts are showing.. =
The plugin is only able to fetch posts from **public** pages with posts which are publicly available. Check your page its privacy settings and make sure you are using a page instead of a personal profile or group.

= I want to apply custom styling to the Facebook posts. How do I go about this? =
You can add custom CSS rules to your theme stylesheet. This file is usually located here in `/wp-content/themes/your-theme-name/style.css`.

= Does this plugin work with group posts? =
No, sorry. Recent Facebook Posts works with public pages and to a certain extent with personal profiles.

= Can I show a list of recent facebook updates in my posts or pages? =
Yes, you can use the `[recent_facebook_posts]` shortcode. Optionally, add the following attributes.

`
likes = 1 // show like count, 1 = yes, 0 = no
comments = 1 // show comment count, 1 = yes, 0 = no
excerpt_length = 140 // the number of characters to show from each post
number = 5 // number of posts to show,
show_page_link = 0 // show a link to Facebook page after posts?
el = div // which element to use as a post container?
show_link_previews = 1 // show preview of attached links?
`

*Shortcode example*
`[recent_facebook_posts number=10 likes=1 comments=1 excerpt_length=250 show_page_link=1 show_link_previews=1]`

= Do you have a function I can use in template files? =
Use `<?php recent_facebook_posts(array('likes' => 1, 'excerpt_length => 140')); ?>` in your theme files. The parameter is optional, it can be an array of the same values available for the shortcode.

= How do I change the .. at the end of the excerpt? =
You can change this using a so-called filter. Add the following snippet to your theme its `functions.php` file to change *..* into a link to the Facebook post.

`
function my_rfbp_read_more($more, $link)
{
	return '<a href="'. $link . '">Read more &raquo;</a>';
}

add_filter('rfbp_read_more', 'my_rfbp_read_more', 10, 2);
`

= How do I disable the automatic paragraphs? =
`
remove_filter('rfbp_content', 'wpautop');
`

= How do I add text to all posts? =
`
function my_rfbp_content($content, $link)
{
	return $content . " my appended text.";
}

add_filter('rfbp_content', 'my_rfbp_content', 10, 2);
`

= How do I change the time posts are cached? =
`
function my_rfbp_cache_time($time)
{
	return 3600; // 1 hour
}

add_filter('rfbp_cache_time', 'my_rfbp_cache_time');
`

== Screenshots ==

1. The Recent Facebook Posts settings screen.
2. This is where you'll find your App ID / API Key and App Secret in your [Facebook App Settings](https://developers.facebook.com/apps/).
3. This is where you'll find your Facebook Page Slug on Facebook.com.

== Changelog ==

= 2.0.8 - July 1, 2015 =

**Additions**

- Added Turkish translations, thanks to Halukcan Pehlivanoğlu!

= 2.0.7 - May 15, 2015 =

**Fixes**

- Video posts were not showing correctly

**Improvements**

- Added play icon overlay to video's

**Additions**

- Added Italian translations, thanks to [Luigi Savini](https://github.com/gigiame)
- Added Portugese translations, thanks to [Jonadabe](https://github.com/Jonadabe)

= 2.0.6 - May 15, 2015 =

**Fixes**

- Hooks were double added when using the widget

**Improvements**

- Added a notice about using the shortcode to the plugin's settings page.

**Additions**

- Added German translations, thanks to [Henrik Heller ](http://www.gmx.net/).

= 2.0.5 - March 23, 2015 =

**Additions**

- Added Swedish translations, thanks to [Robin Wellström](http://robinwellstrom.se/).

= 2.0.4 - February 19, 2015 =

**Fixes**

- Issue where settings page would just load an empty screen. ([Issue #6](https://github.com/dannyvankooten/wordpress-recent-facebook-posts/issues/6))

**Improvements**

- Updated all links to use HTTPS protocol.

= 2.0.3 - September 22, 2014 =

**Improvements**

- Now loading minified asset (.css and .js) files by default
- Added some missing text domains
- Minor improvements to settings page and settings handling.

**Additions**

- Added Spanish language, thanks [Hermann Bravo](http://hbravo.com/)
- Added `rfpb_widget_options` filter to filter all widget options. Closes [#3](https://github.com/dannyvankooten/wordpress-recent-facebook-posts/issues/3), thanks [KilukruMedia](https://github.com/KilukruMedia)
- Added [languages/recent-facebook-posts.pot](http://plugins.svn.wordpress.org/recent-facebook-posts/trunk/languages/recent-facebook-posts.pot) file for easier translating. Please send in your language files (.po and .mo) if you created any.

= 2.0.2 - September 17, 2014 =

**Fixes**

- Removed duplicate `picture` in call to Facebook API. Fixes a "Syntax error" in later API versions. Props [danielfharmonic](https://github.com/danielfharmonic).

= 2.0.1 - September 15, 2014 =

**Improvements**

- The plugin will now show a detailed error message if anything related to the connection to Facebook failed.
- Updated Dutch translation

= 2.0 - September 15, 2014 =

**Fixes**

- Fixed an issue with Facebook statuses containing Emojis

**Improvements**

- Better sanitizing throughout the plugin, using native WP functions.
- Improved inline code documentation
- Prevent direct file access
- Changing thumbnail sizes does not require a cache refresh to fetch new video images

**Additions**

- New FB configurations are now automatically tested.

= 1.8.5 - December 3, 2013 =
* Fixed: Character encoding for scandinavian languages etc.

= 1.8.4 - December 2, 2013 =
* Fixed: Empty events won't show
* Improved: a cache renewal is no longer required after changing the image size
* Improved: after changing important settings, cache will automatically be cleared
* Improved: added a *test configuration* button which performs a simple ping to Facebook.
* Improved: added an info message for new users
* Improved: filters are now added the "WordPress way", which means they can be disabled
* Improved: namespaced the trigger for renewing the cache
* Improved: added empty `index.php` files to prevent directory listings
* Improved: code clean-up

= 1.8.3 - November 17, 2013 =
* Fixed: removed weird character between comment count and timestamp

= 1.8.2 - November 17, 2013 =
* Fixed: some translated strings in settings pages were not printed.
* Improved: plugin file can no longer be access directly
* Improved: better plugin code loading
* Improved: disabled plugin directory listing
* Added: domain path
* Added: license file
* Updated Dutch translations

= 1.8.1 - November 4, 2013 =
* Fixed: link previews without images not showing
* Added: filter `rfbp_show_link_images` to hide link preview images
* Improved: Link preview CSS

= 1.8 - November 3, 2013 =
* Added: previews of attached links, with image and short description (like Facebook)
* Added: Translation files
* Added: Dutch translations
* Improved: Moved cache time to a filter.
* Improved: Removed `session_start()` call.

= 1.7.3 - October 28, 2013 =
* Added: `rfbp_read_more` filter.
* Added: `rfbp_content` filter.
* Added: option to unhook `wpautop` from `rfbp_content` filter.

= 1.7.2 - October 18, 2013 =
* Fixed: No posts showing up for Scandinavian languages
* Improved: Links will no longer show up twice
* Added: Conversion of common smileys

= 1.7.1 - October 17, 2013 =
* Fixed: fetching posts from wrong Facebook page. Sorry for the quick version push.
* Improved: default CSS

= 1.7 - October 16, 2013 =
* Fixed issue where strings with dots where turned into (broken) links.
* Improved: better linebreaks
* Improved: Now using WP Transients for caching
* Improved: Now using WP HTTP API for fetching posts, which allows for other transfer methods besides just cURL.
* Improved: No user access token is required any more. Access tokens will now *never* expire.

= 1.6 - October 7, 2013 =
* Improved code performance and readability
* Improved usability of admin settings
* Improved: cleaner HTML output
* Improved: default CSS
* Improved: image resizing
* Improved: default settings
* Added installation instructions link to admin settings
* Added many CSS classes to output
* Fixed extra double quote breaking link validation

**Important:** CSS Selectors and HTML output has changed in this version. If you're using custom styling rules you'll have to edit them after updating.

= 1.5.3 - October 3, 2013 =
* Improved: Code improvement
* Improved: UI improvement, implemented some HTML5 fields
* Improved: Moved options page back to sub-item of Settings.

= 1.5.2 - October 1, 2013 =
* Fixed: max-width in older browsers

= 1.5.1 - September 20, 2013 =
* Improved: a lot of refactoring, code clean-up, etc.
* Improved: "open link in new window" option now applies to ALL generated links

= 1.5 =
* Improved: huge performance improvement for retrieving posts from Facebook
* Improved: some code refactoring
* Improved: cache now automatically invalidated when updating settings
* Improved: settings are now sanitized before saving
* Fixed: like and comment count no longer capped at 25
* Changed links to show your appreciation for the plugin.

= 1.4 =
* Changed cache folder to the WP Content folder (outside of the plugin to prevent cache problems after updating the plugin).
* Added redirection fallbacks when headers have already been sent when trying to connect to Facebook.
* Fixed error message when cURL is not enabled.
* Improved some messages and field labels so things are more clear.
* Updated Facebook API class.

= 1.3 =
* Added Facebook icon to WP Admin menu item
* Changed the connecting to Facebook process
* Improved error messages
* Improved code, code clean-up
* Improved usability in admin area by showing notifications, removing unnecessary options, etc.
* Added notice when access token expires (starting 14 days in advance)
* Fixed: Cannot redeclare Facebook class.
* Fixed: Images not being shown when using "normal" as image source size
* Fixed: empty status updates (friends approved)

= 1.2.3 =
* Changed the way thumbnail and normal image links are generated, now works with shared photos as well.
* Added read_stream permission, please update your access token.
* Added cache succesfully updated notice

= 1.2.2 =
* Added option to hide images
* Added option to load either thumbnail or normal size images from Facebook's CDN
* Added border to image links

= 1.2.1 =
* Fixed parameter app_id is required notice before being able to enter it.

= 1.2 =
* Fixed: Reverted back to 'posts' instead of 'feed', to exclude posts from others.
* Fixed: undefined index 'count' when renewing cache file
* Fixed: wrong comment or like count for some posts
* Improved: calculation of cache file modification time to prevent unnecessary cache renewal
* Improved: error message when cURL is not enabled
* Improved: access token and cache configuration options are now only available when connected

= 1.1.2 =
* Fixed: Added spaces after the like and comment counts in the shortcode output

= 1.1.1 =
* Updated: Expanded installation instructions.
* Changed: Some code improvements
* Added: Link to Facebook numeric ID helper website.
* Added: Check if cache directory exists. If not the plugin will now automatically try to create it with the right permissions.
* Added: option to open link to Facebook Page in a new window.

= 1.1 =
* Added: Shortcode to show a list of recent facebook updates in your posts: '[recent_facebook_posts]'

= 1.0.5 =
* Added: More user-friendly error message when cURL is not enabled on your server.

= 1.0.4 =
* Improved: The way the excerpt is created, words (or links) won't be cut off now
* Fixed: FB API Error for unknown fields.
* Added: Images from FB will now be shown too. Drop me a line if you think this should be optional.

= 1.0.3 =
* Improved the way the link to the actual status update is created (thanks Nepumuk84).
* Improved: upped the limit of the call to Facebooks servers.

= 1.0.2 =
* Fixed a PHP notice in the backend area when renewing cache and fetching shared status updates.
* Added option to show link to Facebook page, with customizable text.

= 1.0.1 =
* Added error messages for easier debugging.

= 1.0 =
* Added option to load some default CSS
* Added option to show like count
* Added option to show comment count
* Improved usability. Configuring Recent Facebook Posts should be much easier now due to testing options.

= 0.1 =
* Initial release

== Upgrade Notice ==

= 2.0.1 =
Fixed issue with Emojis in Facebook statuses, updated translations and various other improvements.

= 2.0 =
Fixed issue with Emojis breaking all posts. Various other code improvements.