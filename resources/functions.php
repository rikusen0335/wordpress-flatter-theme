<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);



/* Custom functions */
function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more( $more ) {
    return " ...";
}
add_filter('excerpt_more', 'custom_excerpt_more' );


function get_lowest_category ($sbjcat = '', $taxonomy = 'category') {
    /* 参考 https://www.kimagure-weblog.net/wordpress/category-name001/ */

    $cats = get_the_category();
    $current_cat = '';

    foreach ( $cats as $cat ) {
        if ( ! $current_cat || cat_is_ancestor_of( $current_cat, $cat ) ) {
            $current_cat = $cat;
        }
    }

    return $current_cat -> name;
}


function get_category_structure () {
    /* 参考 https://ja.wordpress.org/support/topic/%E8%A6%AA%E3%80%81%E5%AD%90%E3%80%81%E5%AD%AB%E3%81%AE%E9%A0%86%E3%81%A7%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%82%92%E8%A1%A8%E7%A4%BA%E3%81%97%E3%81%9F%E3%81%84/ */

    $post_cats = get_the_category();
    if($post_cats){
        $bottom_cat = $post_cats[0];
        $bottom_anc = get_ancestors($bottom_cat->term_id, 'category');
        foreach ($post_cats as $index => $cat) {
            if ($index > 0) {
            $anc = get_ancestors($cat->term_id, 'category');
                if(count($anc) > count($bottom_anc)){
                    $bottom_cat = $cat;
                    $bottom_anc = $anc;
                }
            }
        }

        $bottom_anc = array_reverse($bottom_anc);
    }

    return [$bottom_anc, $bottom_cat];
}
/* End of custom functioins */



/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);