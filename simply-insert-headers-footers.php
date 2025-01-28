<?php
/*
Plugin Name: Simply Insert Headers and Footers
Plugin URI: https://wpsatkhira.com
Description: A simple plugin to insert custom codes into the header, body, and footer of your WordPress site.
Version: 1.0
Author: WordPress Satkhira Community
Author URI: https://wpsatkhira.com
License: GPL2
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Add menu item to the admin menu
function sihaf_add_admin_menu() {
    add_menu_page(
        'Simply Insert Headers and Footers',
        'Insert Headers & Footers',
        'manage_options',
        'sihaf-settings',
        'sihaf_settings_page',
        'dashicons-editor-code',
        100
    );
}
add_action('admin_menu', 'sihaf_add_admin_menu');

// Register settings
function sihaf_register_settings() {
    register_setting('sihaf_settings_group', 'sihaf_header_code');
    register_setting('sihaf_settings_group', 'sihaf_body_code');
    register_setting('sihaf_settings_group', 'sihaf_footer_code');
}
add_action('admin_init', 'sihaf_register_settings');

// Settings page content
function sihaf_settings_page() {
    ?>
    <div class="wrap">
        <h1>Simply Insert Headers and Footers</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('sihaf_settings_group');
            do_settings_sections('sihaf_settings_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Header Code</th>
                    <td>
                        <textarea name="sihaf_header_code" rows="10" cols="50"><?php echo esc_textarea(get_option('sihaf_header_code')); ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Body Code</th>
                    <td>
                        <textarea name="sihaf_body_code" rows="10" cols="50"><?php echo esc_textarea(get_option('sihaf_body_code')); ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Footer Code</th>
                    <td>
                        <textarea name="sihaf_footer_code" rows="10" cols="50"><?php echo esc_textarea(get_option('sihaf_footer_code')); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Add header code
function sihaf_add_header_code() {
    echo get_option('sihaf_header_code');
}
add_action('wp_head', 'sihaf_add_header_code');

// Add body code
function sihaf_add_body_code() {
    echo get_option('sihaf_body_code');
}
add_action('wp_body_open', 'sihaf_add_body_code');

// Add footer code
function sihaf_add_footer_code() {
    echo get_option('sihaf_footer_code');
}
add_action('wp_footer', 'sihaf_add_footer_code');
