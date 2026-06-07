<?php
/**
 * Plugin Name: Auripath Embed Helper
 * Plugin URI: https://auripath.com/integrations/
 * Description: Adds a simple shortcode for embedding Auripath audio experiences on WordPress pages.
 * Version: 0.1.1
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

define('AURIPATH_EMBED_HELPER_VERSION', '0.1.1');
define('AURIPATH_EMBED_HELPER_SCRIPT_URL', 'https://app.auripath.com/wp-content/plugins/audiomagnet-saas/assets/embed/ap.js');

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

    $instance_id = 'auripath-embed-' . wp_generate_uuid4();

    wp_enqueue_script(
        'auripath-embed-helper-loader',
        AURIPATH_EMBED_HELPER_SCRIPT_URL,
        array(),
        AURIPATH_EMBED_HELPER_VERSION,
        true
    );

    $render_args = array(
        'docId'    => $doc_identifier,
        'selector' => '#' . $instance_id,
    );

    if (!empty($atts['theme'])) {
        $render_args['theme'] = sanitize_key($atts['theme']);
    }

    ob_start();
    ?>
    <div
        id="<?php echo esc_attr($instance_id); ?>"
        class="auripath-embed-helper"
        data-auripath-doc="<?php echo esc_attr($doc_identifier); ?>"
    ></div>
    <script>
        window.ap = window.ap || function () {
            (window.ap.q = window.ap.q || []).push(arguments);
        };
        window.ap('render', <?php echo wp_json_encode($render_args); ?>);
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('auripath', 'auripath_embed_helper_shortcode');
add_shortcode('auripath_embed', 'auripath_embed_helper_shortcode');
