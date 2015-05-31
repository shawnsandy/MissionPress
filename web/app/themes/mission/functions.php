<?php

/**
 * BJ functions and definitions
 *
 * @package BJ
 * @since BJ 1.0
 */
/** just icase we need a config file; */
if ($bj_config = locate_template('config.php')) {
    include_once $bj_config;
}

// solution for possible missing PHP constants, for WP 3.0 and higher only
// http://codex.wordpress.org/Determining_Plugin_and_Content_Directories

if (!defined('WP_CONTENT_URL')) {
    define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
}

if (!defined('WP_CONTENT_DIR')) {
    define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
}

if (!defined('WP_PLUGIN_URL')) {
    define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');
}

if (!defined('WP_PLUGIN_DIR')) {
    define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
}

if (!defined('WPMU_PLUGIN_URL')) {
    define('WPMU_PLUGIN_URL', WP_CONTENT_URL . '/mu-plugins');
}

if (!defined('WPMU_PLUGIN_DIR')) {
    define('WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins');
}

/**
 * Check if site is online
 */
$mission_theme_offline = get_theme_mod('site_offline', false);



/**
 * ******************************plugin activations*****************************
 */
if (file_exists(get_template_directory() . '/plugins/theme-plugins.php')) {
    include_once get_template_directory() . '/plugins/theme-plugins.php';
}

/* * **************************************************************************** */

function install_guide($templates) {
    $tpl = get_template_directory() . '/install-guide.php';
    load_template($tpl);
}

// if (!class_exists('cwp') OR !class_exists('al_manager') OR !$wp_version > 3.4):
//     add_filter('template_include', 'install_guide');
//     return;
// endif;

/**
 * CSF FUNCTIONS
 */
// if (file_exists(WP_PLUGIN_DIR.'/al-manager/vendor/core-wp/csf_functions.php')):
// include_once WP_PLUGIN_DIR.'/al-manager/vendor/core-wp/csf_functions.php';
//  else :
// if (defined('CWP_PATH') and file_exists(CWP_PATH.'/csf_functions.php')) {
// 	include_once CWP_PATH.'/csf_functions.php';
// }
// endif;

/**
 * ***************THEME OPTIONS *************************************************
 */
if (file_exists(get_template_directory() . '/presskit-functions.php')):
    include_once get_template_directory() . '/presskit-functions.php';
endif;

/**
 * Timber functions
 */
if (file_exists(get_template_directory() . '/timber-functions.php')):
    include_once get_template_directory() . '/timber-functions.php';
endif;

/**
 * ******************************************************************************
 * custom functions create this file and add your own custom functions
 */
/**
 * ******************************************************************************
 */
/**
 * ******************************************************************************
 * toolbox functions theme functions
 */
// if (file_exists(TEMPLATEPATH.'/theme_functions.php')) {
// 	include_once TEMPLATEPATH.'/theme_functions.php';
// }

/**
 * ******************************************************************************
 */
if (!function_exists('bj_setup')):

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * @since BJ 1.0
     */
    function bj_setup() {

        /**
         * Custom template tags for this theme.
         */
        //require (get_template_directory().'/inc/template-tags.php');

        /**
         * Custom functions that act independently of the theme templates
         */
        //require( get_template_directory() . '/inc/tweaks.php' );

        /**
         * Custom Theme Options
         */
        //require( get_template_directory() . '/inc/theme-options/theme-options.php' );

        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * If you're building a theme based on BJ, use a find and replace
         * to change 'bj' to the name of your theme in all the template files
         */
        //load_theme_textdomain('bj', get_template_directory().'/languages');
    }

endif; // bj_setup
add_action('after_setup_theme', 'bj_setup');

/**
 * Enqueue scripts and styles
 */
function bj_scripts() {
    global $post;

    //wp_enqueue_style( 'style', get_stylesheet_uri() );
    //wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image($post->ID)) {
        wp_enqueue_script('keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20120202');
    }
}

add_action('wp_enqueue_scripts', 'bj_scripts');

/**
 * composer test
 */
// $client = new GuzzleHttp\Client();
// $res    = $client->get('https://api.github.com/user', [
// 	'auth' => ['username', 'password']
// 	]);
// echo $res->getStatusCode();// 200
// echo $res->getHeader('content-type');
// // 'application/json; charset=utf8'
// echo $res->getBody();// {"type":"User"...'
// var_export($res->json());
// $foo = new MpLoader\foo();
// $mobile = new Mobile_Detect();
// if (!$mobile->isMobile()) {
// 	echo "<h1>Mobile detected</h1>";
// 	;
// }
//$foo->print_it();


/**
 * check for wp-autoload
 * load the functions
 */
if (class_exists("mp_autoload")):


    /**
     * Include Theme customizer defaults
     */
    include_once get_template_directory() . '/inc/mission-theme-settings.php';

//$amenu = MpLoader\Admin\Menu::factory();
    $press_adminbar = MpLoader\Admin\PostMenus::factory()->create_nodes();

//create a custom post 
    $press_sample = MpLoader\Post\CustomTypes::factory('indeshop')->register_post_type('Indie Shop');

//load the 2 default widgets
    $press_widget = MpLoader\Utilities\Widget::factory();
    $press_widget->default_widget();
    $press_widget->add_widget('footer 1', 'footer-1', 'Add footer 1');
    $press_widget->add_widget('footer 2', 'footer-2', 'Add footer 2');
    $press_widget->add_widget('footer 3', 'footer-3', 'Add footer 3');
    $press_widget->add_widget('footer links', 'footer-links', 'Add links for the footer');
    $press_widget->add_widget('contact us', 'contact-us', 'Contact information');
    $press_widget->add_widget('feature', 'feature', 'Feature Widget');
    $press_widget->add_widget('cover', 'cover', 'Cover Page');
    $press_widget->add_widget('pitch', 'pitch', 'Elevator pitch');   
    
    //conditional theme widgets
    
    $press_widget->add_widget('offline', 'offline', 'Offline Cover');
    $press_widget->add_widget('offline message', 'offline_message', 'Offline Message');

    
endif;

/**
 * adds all post functions
 */
add_theme_support('post-formats', array('aside', 'gallery', 'video', 'link', 'image', 'quote', 'status'));

add_theme_support('post-thumbnails');

//* Replace WordPress login logo with your own
//add_action('login_head', 'pwc_custom_login_logo');
//function pwc_custom_login_logo() {
//   
//     echo '<style type="text/css">
//        h1 a { background-image:url('. get_bloginfo( 'template_directory' ) .'/images/pwc-web-logo.png) !important; }
//    </style>';
//    
//    
//}


if ($mission_theme_offline == true && !is_admin() && !current_user_can('manage_options')) {

    add_action('template_include', 'mission_site_offline');
    add_filter('body_class', 'mission_offline_class');
}

// Add specific CSS class by filter

function mission_offline_class($classes) {
    // add 'class-name' to the $classes array
    $classes[] = 'site offline';
    // return the $classes array
    return $classes;
}

function mission_site_offline() {
    $tpl = get_template_directory() . '/site-offline.php';
    load_template($tpl);
}

/**
 * Titain Framework
 */
include_once get_template_directory() . '/inc/titan-framework.php';
