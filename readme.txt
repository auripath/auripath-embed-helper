=== Auripath Embed Helper ===
Contributors: auripath
Tags: pdf, tracking, audio, embed, analytics, b2b, marketing, sales, lead-capture, shortcode, cta
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 0.1.5
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add Auripath to WordPress and turn B2B PDFs into trackable audio experiences with lead capture, CTAs and listening analytics.

== Description ==

Auripath Embed Helper lets WordPress site owners embed hosted Auripath audio experiences using a simple shortcode.

Auripath turns B2B PDFs, guides, reports, brochures, white papers and sales assets into embedded audio experiences that capture leads, show who listened, track CTA clicks and help sales follow up with stronger prospects.

Instead of treating every PDF download like the same level of interest, Auripath helps marketing and sales teams see which leads actually consumed the content.

Use it to add a hosted Auripath player to WordPress pages, posts or landing pages.

Basic usage:

`[auripath doc="doc_xxxxxxxxx"]`

The `doc` value should be the public Auripath document ID from your Auripath account.

This plugin does not recreate the Auripath player inside WordPress. It loads the Auripath production embed script and renders the selected hosted audio experience on the page.

Typical use cases include:

* Add embedded audio to a B2B PDF, guide, report or sales asset.
* Capture leads around existing content.
* Track listening behavior and CTA clicks.
* Give sales a clearer reason to follow up.
* Add a read-or-listen experience to WordPress landing pages.
* Reuse PDFs your team already paid to create.

== External Service Disclosure ==

This plugin connects to the hosted Auripath service at `https://app.auripath.com/`.

When a page containing the Auripath shortcode is viewed, the plugin loads the Auripath embed script from the hosted Auripath service. The public document ID in the shortcode is passed to Auripath so the hosted service can return the correct player, lead capture form, calls to action and analytics behavior for that document.

The plugin itself does not store leads, audio files or analytics data in WordPress.

Auripath privacy policy: https://auripath.com/privacy/
Auripath terms: https://auripath.com/terms/

== Installation ==

1. Install Auripath Embed Helper from the WordPress Plugin Directory, or upload the plugin folder to `/wp-content/plugins/auripath-embed-helper/`.
2. Activate the plugin in WordPress.
3. In your Auripath account, copy the public document ID for the hosted audio experience you want to embed.
4. Add the shortcode to a page, post or block:

`[auripath doc="doc_xxxxxxxxx"]`

5. Replace `doc_xxxxxxxxx` with your Auripath public document ID.

== Frequently Asked Questions ==

= What does this plugin do? =

It adds a simple WordPress shortcode for embedding a hosted Auripath audio experience on a WordPress page or post.

= Does this plugin convert PDFs inside WordPress? =

No. PDF processing, audio generation, player rendering, lead capture and analytics are handled by the hosted Auripath service.

= Does this plugin store lead data in WordPress? =

No. The plugin itself does not store leads, audio files or analytics data in WordPress.

= Do I need an Auripath account? =

Yes. You need an Auripath document ID to embed a hosted Auripath audio experience.

= What is the shortcode? =

Use:

`[auripath doc="doc_xxxxxxxxx"]`

Replace `doc_xxxxxxxxx` with the public document ID from your Auripath account.

= Can I use this for PDF tracking? =

Yes. Auripath can help B2B teams track content engagement around PDF-based assets by showing listening behavior, lead capture activity and CTA clicks from hosted Auripath experiences.

= Can I use this with landing pages? =

Yes. You can place the shortcode inside WordPress pages, posts, shortcode blocks or compatible page builder fields.

== Screenshots ==

1. Add an Auripath document ID using a simple shortcode in the WordPress editor.
2. Track listening behavior, lead capture and CTA clicks in Auripath.
3. Auripath Embed Helper includes a simple shortcode reference page in WordPress admin.

== Useful Links ==

* Auripath: https://auripath.com/
* How Auripath Works: https://auripath.com/how-it-works/
* Auripath Use Cases: https://auripath.com/use-cases/
* B2B Lead Signal Stack: https://auripath.com/lead-signal-stack/

== Changelog ==

= 0.1.5 =
* Replaced plugin-generated raw script output with WordPress script enqueue and inline script APIs.
* Updated the Auripath privacy policy URL.

= 0.1.4 =
* Updated Tested up to header for Plugin Check.

= 0.1.3 =
* Clarified external service disclosure for WordPress.org review.

= 0.1.2 =
* Added a small admin help page with shortcode instructions.

= 0.1.1 =
* Added production Auripath SDK support.
* Added `[auripath doc="..."]` shortcode.
* Added backward-compatible `[auripath_embed]` shortcode.
* Added public document ID validation.

= 0.1.0 =
* Initial prototype.
