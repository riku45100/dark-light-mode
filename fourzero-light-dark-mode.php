<?php
/**
 * Plugin Name: FourZero Light & Dark Mode
 * Description: Lightweight light/dark/system mode with an optional native Elementor toggle widget.
 * Version: 1.2.2
 * Author: FourZero
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */
if (!defined('ABSPATH')) exit;

define('FZ_LDM_VERSION', '1.2.2');
define('FZ_LDM_URL', plugin_dir_url(__FILE__));

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('fz-ldm', FZ_LDM_URL . 'assets/fz-ldm.css', [], FZ_LDM_VERSION);
    wp_enqueue_script('fz-ldm', FZ_LDM_URL . 'assets/fz-ldm.js', [], FZ_LDM_VERSION, true);
});

add_action('admin_menu', function () {
    add_options_page('Light & Dark Mode', 'Light & Dark Mode', 'manage_options', 'fz-light-dark-mode', 'fz_ldm_settings');
});

add_action('admin_init', function () {
    register_setting('fz_ldm_settings', 'fz_ldm_default', [
        'type' => 'string',
        'default' => 'system',
        'sanitize_callback' => function ($value) {
            return in_array($value, ['light', 'dark', 'system'], true) ? $value : 'system';
        },
    ]);
});

function fz_ldm_settings() {
    if (!current_user_can('manage_options')) return;
    $default = get_option('fz_ldm_default', 'system');
    ?>
    <div class="wrap">
        <h1>FourZero Light &amp; Dark Mode</h1>
        <form method="post" action="options.php">
            <?php settings_fields('fz_ldm_settings'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Default mode</th>
                    <td>
                        <select name="fz_ldm_default">
                            <option value="system" <?php selected($default, 'system'); ?>>System</option>
                            <option value="light" <?php selected($default, 'light'); ?>>Light</option>
                            <option value="dark" <?php selected($default, 'dark'); ?>>Dark</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <hr>
        <h2>Elementor</h2>
        <p>The FourZero Light &amp; Dark Mode widget is available when Elementor is active.</p>
        <p>CSS classes: <code>fz-dark-only</code>, <code>fz-light-only</code>, <code>fz-dark-surface</code>, <code>fz-dark-button</code>, <code>fz-dark-invert</code>.</p>
    </div>
    <?php
}

add_action('wp_head', function () {
    $default = esc_js(get_option('fz_ldm_default', 'system'));
    echo '<script>document.documentElement.dataset.fzDefaultMode="' . $default . '";</script>';
});

add_action('elementor/widgets/register', function ($widgets_manager) {
    if (!class_exists('Elementor\\Widget_Base')) return;
    $file = __DIR__ . '/includes/class-fz-ldm-elementor-widget.php';
    if (!file_exists($file)) return;
    require_once $file;
    $class = 'FourZero\\LightDarkMode\\Elementor_Widget';
    if (class_exists($class)) {
        $widgets_manager->register(new $class());
    }
});
