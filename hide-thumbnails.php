<?php

/*
 * Plugin Name:         Hide Thumbnails - Disable Thumbnail from Post
 * Plugin URI:          https://wordpress.org/plugins/hide-thumbnails/
 * Description:         Disable thumbnails from posts of your website.
 * Version:             1.4.17
 * Requires at least:   4.4
 * Requires PHP:        7.0
 * Tested up to:        6.6
 * Author:              Mehraz Morshed
 * Author URI:          https://profiles.wordpress.org/mehrazmorshed/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         hide-thumbnails
 * Domain Path:         /languages
 */

/**
 * Hide Thumbnails is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Hide Thumbnails is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hide_thumbnails_load_textdomain() {
    load_plugin_textdomain( 'hide-thumbnails', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'hide_thumbnails_load_textdomain' );


function hide_thumbnails_option_page() {

    add_menu_page( 'Hide Thumbnails Option', 'Hide Thumbnails', 'manage_options', 'hide-thumbnails', 'hide_thumbnails_create_page', 'dashicons-admin-plugins', 101 );
}
add_action( 'admin_menu', 'hide_thumbnails_option_page' );

function hide_thumbnails_style_settings() {

    wp_enqueue_style( 'hide-thumbnails-settings', plugins_url( 'css/hide-thumbnails-settings.css', __FILE__ ), false, "1.0.0" );
}
add_action( 'admin_enqueue_scripts', 'hide_thumbnails_style_settings' );

function hide_thumbnails_create_page() {
    ?>
    <div class="hide_thumbnails_main">
        <div class="hide_thumbnails_body hide_thumbnails_common">
            <h1 id="page-title"><?php esc_attr_e( 'Settings', 'hide-thumbnails' ); ?></h1>
            <form action="options.php" method="post">
                <?php wp_nonce_field( 'update-options' ); ?>

                <!-- Hide thumbnails -->
                <label for="hide-thumbnails-option"><?php esc_attr_e( 'Thumbnail Option', 'hide-thumbnails' ); ?></label>

                <label class="radios">
                    <input type="radio" name="hide-thumbnails-option" id="hide-thumbnails-option-no" value="false" <?php if( get_option( 'hide-thumbnails-option' ) == 'false' ) { echo 'checked="checked"'; } ?>>
                    <span><?php _e( 'Enable - Show Thumbnails', 'hide-thumbnails' ); ?></span>
                </label>

                <label class="radios">
                    <input type="radio" name="hide-thumbnails-option" id="hide-thumbnails-option-yes" value="true" <?php if( get_option( 'hide-thumbnails-option' ) == 'true' ) { echo 'checked="checked"'; } ?>>
                    <span><?php _e( 'Disable - Hide Thumbnails', 'hide-thumbnails' ); ?></span>
                </label>

                <!--  -->
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="hide-thumbnails-option">
                <br>
                <input class="button button-primary" type="submit" name="submit" value="<?php _e( 'Save Changes', 'hide-thumbnails' ) ?>">
            </form>
        </div>
        <div class="hide_thumbnails_aside hide_thumbnails_common">
            <!-- about plugin author -->
            <h2 class="aside-title"><?php esc_attr_e( 'About Plugin Author', 'hide-thumbnails' ); ?></h2>
            <div class="author-card">
                <a class="link" href="https://profiles.wordpress.org/mehrazmorshed/" target="_blank">
                    <img class="center" src="<?php print plugin_dir_url( __FILE__ ) . '/img/author.png'; ?>" width="128px">
                    <h3 class="author-title"><?php esc_attr_e( 'Mehraz Morshed', 'hide-thumbnails' ); ?></h3>
                    <h4 class="author-title"><?php esc_attr_e( 'WordPress Developer', 'hide-thumbnails' ); ?></h4>
                </a>
                <h1 class="author-title">
                    <a class="link" href="https://www.facebook.com/mehrazmorshed" target="_blank"><span class="dashicons dashicons-facebook"></span></a>
                    <a class="link" href="https://twitter.com/mehrazmorshed" target="_blank"><span class="dashicons dashicons-twitter"></span></a>
                    <a class="link" href="https://www.linkedin.com/in/mehrazmorshed" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>
                    <a class="link" href="https://www.youtube.com/@mehrazmorshed" target="_blank"><span class="dashicons dashicons-youtube"></span></a>
                </h1>
            </div>
            <!-- other useful plugins -->
            <h3 class="aside-title"><?php esc_attr_e( 'Other Useful Plugins', 'hide-thumbnails' ); ?></h3>
            <div class="author-card">
                <a class="link" href="https://wordpress.org/plugins/turn-off-comments/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Turn Off Comments', 'hide-thumbnails' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/hide-admin-navbar/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Hide Admin Navbar', 'hide-thumbnails' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/tap-to-top/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Tap To Top', 'hide-thumbnails' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/customized-login/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Custom Login Page', 'hide-thumbnails' ) ?></b>
                </a>
            </div>
            <!-- donate to this plugin -->
            <h3 class="aside-title"><?php esc_attr_e( 'Hide thumbnails', 'hide-thumbnails' ); ?></h3>
            <a class="link" href="https://www.buymeacoffee.com/mehrazmorshed" target="_blank">
                <button class="button button-primary btn"><?php esc_attr_e( 'Donate To This Plugin', 'hide-thumbnails' ); ?></button>
            </a>
        </div>
    </div>
    <?php
}

if( get_option( 'hide-thumbnails-option' ) == 'true' ) {
// Hide all thumbnails
    function hide_thumbnails() {
        return false;
    }
    add_filter('post_thumbnail_id', 'hide_thumbnails');
}

function hide_thumbnails_plugin_activation() {

    add_option( 'hide_thumbnails_plugin_do_activation_redirect', true );
}
register_activation_hook( __FILE__, 'hide_thumbnails_plugin_activation' );

function hide_thumbnails_plugin_redirect() {

    if( get_option( 'hide_thumbnails_plugin_do_activation_redirect', false ) ) {

        delete_option( 'hide_thumbnails_plugin_do_activation_redirect' );

        if ( !isset( $_GET['active-multi'] ) ) {

            wp_safe_redirect( admin_url( 'admin.php?page=hide-thumbnails' ) );
            exit;
        }
    }
}
add_action( 'admin_init', 'hide_thumbnails_plugin_redirect' );