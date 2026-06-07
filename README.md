# Auripath Embed Helper

Auripath Embed Helper is a small WordPress plugin that lets site owners embed hosted Auripath audio experiences using a shortcode.

Auripath turns existing B2B PDFs, guides, reports, brochures, white papers and sales assets into embedded audio experiences with lead capture, calls to action, listening analytics, conversion tracking and webhook-based lead sync.

## Usage

Add this shortcode to a WordPress page, post or shortcode block:

[auripath doc="doc_xxxxxxxxx"]

Replace doc_xxxxxxxxx with the public document ID from your Auripath account.

## How it works

The plugin renders a small mount element on the WordPress page and loads the hosted Auripath embed script from the production Auripath app.

The hosted Auripath app handles player rendering, audio delivery, lead capture, calls to action, listening analytics, conversion tracking and webhook-based lead sync.

The plugin does not store leads, audio files or analytics data in WordPress.

## WordPress admin help page

After activation, shortcode instructions are available in WordPress under Settings > Auripath Embed Helper.


## External service disclosure

This plugin connects to the hosted Auripath service at `https://app.auripath.com/`.

When a page containing the Auripath shortcode is viewed, the plugin loads the Auripath embed script from the hosted Auripath service. The public document ID in the shortcode is passed to Auripath so the hosted service can return the correct player, lead capture form, calls to action and analytics behaviour for that document.

The plugin itself does not store leads, audio files or analytics data in WordPress.

Auripath privacy policy: https://auripath.com/privacy-policy/
Auripath terms: https://auripath.com/terms/

## Shortcodes

Preferred shortcode:

[auripath doc="doc_xxxxxxxxx"]

Backward-compatible shortcode:

[auripath_embed public_id="doc_xxxxxxxxx"]

## License

GPLv2 or later.
