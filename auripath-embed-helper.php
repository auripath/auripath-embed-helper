<?php
/**
 * Plugin Name: Auripath Embed Helper
 * Plugin URI: https://auripath.com/integrations/wordpress/
 * Description: Adds a simple shortcode for embedding Auripath audio experiences on WordPress pages.
 * Version: 0.1.5
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Auripath
 * Author URI: https://auripath.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: auripath-embed-helper
 */

if (!defined('ABSPATH')) {
    exit;
}

define('AURIPATH_EMBED_HELPER_VERSION', '0.1.5');
define('AURIPATH_EMBED_HELPER_SCRIPT_URL', 'https://app.auripath.com/wp-content/plugins/audiomagnet-saas/assets/embed/ap.js');

/**
 * Register Auripath embed assets.
 */
function auripath_embed_helper_register_assets() {
    wp_register_script(
        'auripath-embed-helper-loader',
        AURIPATH_EMBED_HELPER_SCRIPT_URL,
        array(),
        AURIPATH_EMBED_HELPER_VERSION,
        array(
            'strategy'  => 'defer',
            'in_footer' => true,
        )
    );
}
add_action('wp_enqueue_scripts', 'auripath_embed_helper_register_assets');

/**
 * Render an Auripath embed.
 *
 * Preferred usage:
 * [auripath doc="doc_xxxxxxxxx"]
 *
 * Backward-compatible usage:
 * [auripath_embed public_id="doc_xxxxxxxxx"]
 * [auripath_embed doc_id="doc_xxxxxxxxx"]
 */
function auripath_embed_helper_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'doc'       => '',
            'doc_id'    => '',
            'public_id' => '',
            'id'        => '',
            'theme'     => '',
        ),
        $atts,
        'auripath'
    );

    $doc_identifier = '';

    foreach (array('doc', 'public_id', 'doc_id', 'id') as $key) {
        if (!empty($atts[$key])) {
            $doc_identifier = trim((string) $atts[$key]);
            break;
        }
    }

    if ($doc_identifier === '') {
        return '';
    }

    /*
     * Public Auripath document IDs normally look like doc_xxxxx.
     * Numeric IDs are still allowed because the production SDK supports them,
     * but public IDs are preferred for external embeds.
     */
    if (!preg_match('/^(doc_[A-Za-z0-9_-]+|[0-9]+)$/', $doc_identifier)) {
        return '';
    }

    if (!wp_script_is('auripath-embed-helper-loader', 'registered')) {
        auripath_embed_helper_register_assets();
    }

    $instance_id = 'auripath-embed-' . wp_generate_uuid4();

    wp_enqueue_script('auripath-embed-helper-loader');

    $render_args = array(
        'docId'    => $doc_identifier,
        'selector' => '#' . $instance_id,
    );

    if (!empty($atts['theme'])) {
        $render_args['theme'] = sanitize_key($atts['theme']);
    }

    $inline_script = sprintf(
        'window.ap=window.ap||function(){(window.ap.q=window.ap.q||[]).push(arguments);};window.ap("render",%s);',
        wp_json_encode($render_args)
    );

    wp_add_inline_script(
        'auripath-embed-helper-loader',
        $inline_script,
        'after'
    );

    return sprintf(
        '<div id="%1$s" class="auripath-embed-helper" data-auripath-doc="%2$s"></div>',
        esc_attr($instance_id),
        esc_attr($doc_identifier)
    );
}

add_shortcode('auripath', 'auripath_embed_helper_shortcode');
add_shortcode('auripath_embed', 'auripath_embed_helper_shortcode');

/**
 * Add a small admin help page.
 */
function auripath_embed_helper_admin_menu() {
    add_options_page(
        __('Auripath Embed Helper', 'auripath-embed-helper'),
        __('Auripath Embed Helper', 'auripath-embed-helper'),
        'manage_options',
        'auripath-embed-helper',
        'auripath_embed_helper_admin_page'
    );
}
add_action('admin_menu', 'auripath_embed_helper_admin_menu');

/**
 * Render the admin help page.
 */
function auripath_embed_helper_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $example_shortcode = '[auripath doc="doc_xxxxxxxxx"]';
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Auripath Embed Helper', 'auripath-embed-helper'); ?></h1>

        <p>
            <?php echo esc_html__('Use this plugin to embed a hosted Auripath audio experience on a WordPress page or post.', 'auripath-embed-helper'); ?>
        </p>

        <h2><?php echo esc_html__('Shortcode', 'auripath-embed-helper'); ?></h2>

        <p>
            <?php echo esc_html__('Paste this shortcode into a Shortcode block, page, post or compatible builder field:', 'auripath-embed-helper'); ?>
        </p>

        <p>
            <input
                type="text"
                readonly
                class="large-text code"
                value="<?php echo esc_attr($example_shortcode); ?>"
            />
        </p>

        <p>
            <?php echo esc_html__('Replace doc_xxxxxxxxx with the public document ID from your Auripath account.', 'auripath-embed-helper'); ?>
        </p>

        <h2><?php echo esc_html__('How it works', 'auripath-embed-helper'); ?></h2>

        <p>
            <?php echo esc_html__('The plugin loads the hosted Auripath embed script and passes it the public document ID. Auripath then renders the player, lead capture, calls to action and listening analytics from the hosted service.', 'auripath-embed-helper'); ?>
        </p>

        <p>
            <a href="https://auripath.com/integrations/" target="_blank" rel="noopener">
                <?php echo esc_html__('Visit Auripath integrations', 'auripath-embed-helper'); ?>
            </a>
        </p>
    </div>
    <?php
}
