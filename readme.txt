=== Auripath Embed Helper ===
Contributors: auripath
Tags: audio, embed, b2b, content, analytics
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 0.1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Embed Auripath audio experiences on WordPress pages using a simple shortcode.

== Description ==

Auripath Embed Helper lets WordPress site owners embed a hosted Auripath audio experience using a simple shortcode.

Auripath turns existing B2B PDFs, guides, reports, brochures, white papers and sales assets into embedded audio experiences with lead capture, calls to action, listening analytics, conversion tracking and webhook-based lead sync.

This plugin does not recreate the player inside WordPress. It loads the Auripath production embed script and renders the selected hosted audio experience on the page.

Basic usage:

`[auripath doc="doc_xxxxxxxxx"]`

The `doc` value should be the public Auripath document ID from your Auripath account.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/auripath-embed-helper/`, or install the plugin zip through the WordPress admin.
2. Activate the plugin in WordPress.
3. Add the shortcode to a page, post or block:

`[auripath doc="doc_xxxxxxxxx"]`

== Frequently Asked Questions ==

= Does this plugin store lead data in WordPress? =

No. Lead capture, player rendering and analytics are handled by the hosted Auripath experience.

= Do I need an Auripath document ID? =

Yes. The shortcode needs a public Auripath document ID, usually beginning with `doc_`.

= Does this plugin convert PDFs? =

No. This plugin only helps embed an existing hosted Auripath audio experience on a WordPress site.

== Changelog ==

= 0.1.1 =
* Added production Auripath SDK support.
* Added `[auripath doc="..."]` shortcode.
* Added backward-compatible `[auripath_embed]` shortcode.
* Added public document ID validation.

= 0.1.0 =
* Initial prototype.
