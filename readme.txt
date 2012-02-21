=== KNR MultiFeed ===
Contributors: k_nitin_r
Tags: news, feeds, rss
Requires at least: 3.3.0
Tested up to: 3.3.1
Stable tag: 0.6

The KNR MultiFeed plugin enables users to display multiple news feeds within the same widget.

== Description ==

The KNR MultiFeed plugin enables users to display multiple news feeds within the same widget. The widget randomizes the items displayed in the widget or displaying them in chronological order (experimental).

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload knr-multifeed files to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. KNR MultiFeed used with a shortcode and as a widget

== Frequently Asked Questions ==

= How can I use a shortcode? =

In a page or a post, simply add your shortcode in as follows

Example 1

[knrmultifeed]
http://www.n4express.com/blog/?feed=rss2
[/knrmultifeed]

Example 2

[knrmultifeed itemlimit="20" selecttype="Chronological"]
http://www.n4express.com/blog/?feed=rss2
http://www.n4express.com/blog/?feed=comments-rss2
[/knrmultifeed]

= Where can I ask questions? =

Shoot an email to k.nitin.r [at] gmail.com

== Changelog ==

= 0.1 =
* The first version.

= 0.2 =
* Experimental - introduced selection order random or chronological

= 0.3 =
* Added experimental Atom feed support

= 0.4 =
* Fixed PHP notices

= 0.5 =
* Added shortcode support
* Fixed bug in chronological sort operation

= 0.6 =
* Fixed bug in random sort operation