<?php
/**
 * Plugin Name: Artisan Scroll-Progress Navigation
 * Description: High-performance scroll indicator for Heritage Oakwood Journals.
 * Version: 1.1
 * Author: Francisco Garay
 */

if (!defined('ABSPATH')) exit;

class ArtisanScrollProgress {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'settings_init']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_footer', [$this, 'render_button']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    public function add_admin_menu() {
        add_options_page('Artisan Scroll Settings', 'Scroll Progress', 'manage_options', 'artisan_scroll', [$this, 'settings_page']);
    }

    public function enqueue_admin_assets($hook) {
        if ($hook !== 'settings_page_artisan_scroll') return;
        wp_enqueue_media();
    }

    public function settings_init() {
        register_setting('artisan_scroll_group', 'artisan_scroll_settings', [$this, 'sanitize_settings']);
        add_settings_section('artisan_main_section', 'Configuration', null, 'artisan_scroll');

        add_settings_field('post_types', 'Enable for Post Types', [$this, 'post_types_render'], 'artisan_scroll', 'artisan_main_section');
        add_settings_field('brand_color', 'Progress Ring Color', [$this, 'color_field_render'], 'artisan_scroll', 'artisan_main_section');
        add_settings_field('custom_icon', 'Custom Button Icon', [$this, 'icon_field_render'], 'artisan_scroll', 'artisan_main_section');
        add_settings_field('position', 'Button Position', [$this, 'position_field_render'], 'artisan_scroll', 'artisan_main_section');
    }

    public function sanitize_settings($input) {
        $new_input = [];
        $new_input['brand_color'] = sanitize_hex_color($input['brand_color']);
        $new_input['position'] = in_array($input['position'], ['left', 'right']) ? $input['position'] : 'right';
        $new_input['post_types'] = is_array($input['post_types']) ? array_map('sanitize_text_field', $input['post_types']) : [];
        $new_input['custom_icon'] = esc_url_raw($input['custom_icon']);
        return $new_input;
    }

    public function post_types_render() {
        $options = get_option('artisan_scroll_settings')['post_types'] ?? ['product', 'post'];
        $pts = ['post', 'page', 'product'];
        foreach($pts as $pt) {
            $checked = in_array($pt, $options) ? 'checked' : '';
            echo "<label><input type='checkbox' name='artisan_scroll_settings[post_types][]' value='$pt' $checked> " . ucfirst($pt) . "</label><br>";
        }
    }

    public function color_field_render() {
        $val = get_option('artisan_scroll_settings')['brand_color'] ?? '#8b5a2b';
        echo "<input type='color' name='artisan_scroll_settings[brand_color]' value='$val'>";
    }

    public function position_field_render() {
        $val = get_option('artisan_scroll_settings')['position'] ?? 'right';
        echo "<select name='artisan_scroll_settings[position]'>
                <option value='right' " . selected($val, 'right', false) . ">Bottom-Right</option>
                <option value='left' " . selected($val, 'left', false) . ">Bottom-Left</option>
              </select>";
    }

    public function icon_field_render() {
        $val = get_option('artisan_scroll_settings')['custom_icon'] ?? '';
        ?>
        <input type="text" name="artisan_scroll_settings[custom_icon]" id="art_icon" value="<?php echo esc_url($val); ?>" class="regular-text">
        <input type="button" id="art_upload_btn" class="button" value="Upload Icon">
        <script>
        jQuery(document).ready(function($){
            $('#art_upload_btn').click(function(e) {
                e.preventDefault();
                var image = wp.media({ multiple: false }).open().on('select', function() {
                    $('#art_icon').val(image.state().get('selection').first().toJSON().url);
                });
            });
        });
        </script>
        <?php
    }

    public function settings_page() {
        echo "<form action='options.php' method='post'><h2>Artisan Scroll Settings</h2>";
        settings_fields('artisan_scroll_group');
        do_settings_sections('artisan_scroll');
        submit_button();
        echo "</form>";
    }

    public function enqueue_assets() {
        $settings = get_option('artisan_scroll_settings');
        if (!is_singular($settings['post_types'] ?? ['product', 'post'])) return;

        wp_enqueue_style('artisan-scroll-css', plugins_url('style.css', __FILE__));
        wp_enqueue_script('artisan-scroll-js', plugins_url('script.js', __FILE__), [], '1.0.0', true);
        wp_localize_script('artisan-scroll-js', 'artisanVars', [
            'color' => $settings['brand_color'] ?? '#8b5a2b',
        ]);
    }

    public function render_button() {
        $settings = get_option('artisan_scroll_settings');
        if (!is_singular($settings['post_types'] ?? ['product', 'post'])) return;
        $icon = $settings['custom_icon'] ?? '';
        $pos = $settings['position'] ?? 'right';
        ?>
        <div id="artisan-scroll-top" class="artisan-hidden artisan-<?php echo esc_attr($pos); ?>">
            <svg class="progress-ring" width="50" height="50">
                <circle class="progress-ring__circle" stroke-width="3" fill="transparent" r="22" cx="25" cy="25"/>
            </svg>
            <div class="artisan-icon-container">
                <?php if ($icon): ?>
                    <img src="<?php echo esc_url($icon); ?>" width="22" height="22">
                <?php else: ?>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"></polyline></svg>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
new ArtisanScrollProgress();