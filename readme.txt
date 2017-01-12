=== Misaaq ===
Contributors: Amir Haji Ali Khamse
Tags: misaaq, mahdavaiat
Requires at least: 3.7
Tested up to: 4.7
Stable tag: 1
License: GPLv2 or later

Akismet checks your comments against the Akismet Web service to see if they look like spam or not.

== Description ==

Akismet checks your comments against the Akismet Web service to see if they look like spam or not and lets you review the spam it catches under your blog's "Comments" admin screen.

Major features in Akismet include:

* Automatically checks all comments and filters out the ones that look like spam.
* Each comment has a status history, so you can easily see which comments were caught or cleared by Akismet and which were spammed or unspammed by a moderator.
* URLs are shown in the comment body to reveal hidden or misleading links.
* Moderators can see the number of approved comments for each user.
* A discard feature that outright blocks the worst spam, saving you disk space and speeding up your site.

PS: You'll need an [Akismet.com API key](https://akismet.com/get/) to use it.  Keys are free for personal blogs; paid subscriptions are available for businesses and commercial sites.

== Installation ==

Upload the Akismet plugin to your blog, Activate it, then enter your [Akismet.com API key](https://akismet.com/get/).

1, 2, 3: You're done!

== Changelog ==

= 3.2 =
*Release Date - 6 September 2016*

* Added a WP-CLI module. You can now check comments and recheck the moderation queue from the command line.
* Stopped using the deprecated jQuery function `.live()`.
* Fixed a bug in `remove_comment_author_url()` and `add_comment_author_url()` that could generate PHP notices.
* Fixed a bug that could cause an infinite loop for sites with very very very large comment IDs.
* Fixed a bug that could cause the Akismet widget title to be blank.

= 3.1.11 =
*Release Date - 12 May 2016*

* Fixed a bug that could cause the "Check for Spam" button to skip some comments.
* Fixed a bug that could prevent some spam submissions from being sent to Akismet.
* Updated all links to use https:// when possible.
* Disabled Akismet debug logging unless WP_DEBUG and WP_DEBUG_LOG are both enabled.

= 3.1.10 =
*Release Date - 1 April 2016*

* Fixed a bug that could cause comments caught as spam to be placed in the Pending queue.
* Fixed a bug that could have resulted in comments that were caught by the core WordPress comment blacklist not to have a corresponding History entry.
* Fixed a bug that could have caused avoidable PHP warnings in the error log.
