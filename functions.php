<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: wpex
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/* Load child styles. */
add_action('wp_enqueue_scripts', 'total_child_enqueue_parent_theme_style');
function total_child_enqueue_parent_theme_style() {
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        WPEX_THEME_VERSION
    );
    wp_enqueue_style(
        'wpex-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->get('Version')
    );
}

// Remove built-in RSS feeds.
add_action('after_setup_theme', 'lowstressliving_setup' , 11);
function lowstressliving_setup() {
    remove_theme_support('automatic-feed-links');
}

// Remove URL field from comments.
add_filter('comment_form_default_fields', 'remove_url_comments');
function remove_url_comments($fields) {
    unset($fields['url']);
    return $fields;
}

// Enable shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');

// Add custom RSS link.
add_action('wp_head', 'add_lowstressliving_rss_link');
function add_lowstressliving_rss_link() {
    echo '<link rel="alternate" type="application/rss+xml" title="Low Stress Living" href="https://lowstressliving.com/feed/"' . " />\n";
}

// Load correct fonts. Must execute at higher priority.
add_action('wp_enqueue_scripts', 'load_lowstressliving_fonts');
function load_lowstressliving_fonts() {
    wp_enqueue_style(
        'lowstressliving-fonts',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,600i|Unna:400|Work+Sans:400',
        false
    );
}
