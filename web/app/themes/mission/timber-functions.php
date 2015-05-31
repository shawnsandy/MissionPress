<?php
/**
 * Timber theme functions file
 * @package Wordpress
 * @subpackage Theme
 * @since 0.1
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 */

/**
 * twig functions
 */
add_filter('get_twig', 'add_to_twig');
add_filter('timber_context', 'add_to_context');

define('THEME_URL', get_template_directory_uri());

function get_wp_template($template) {

}

/**
 *
 * @param type $data
 * @return string
 */
// function detect_mobiles() {
// 	return new Mobile_Detect();
// }

function add_to_context($data) {
	//default twig file
	$twig_base = 'base.twig';
	//theme twig replace base twig as default template
	if (file_exists(trailingslashit(get_template_directory()).'/views/theme.twig')) {
		$twig_base = 'theme.twig';
	}

	/* this is where you can add your own data to Timber's context object */
	$data['foo']          = 'bar';
	$data['theme_url']    = get_stylesheet_directory_uri();
	$data['parent_theme_url']    = get_template_directory_uri();
	$data['is_logged_in'] = is_user_logged_in();
	$data['theme_mod']    = get_theme_mods();
	//$data['options']      = wp_load_alloptions();
	$data['site_url']     = site_url();
	$data['is_home']      = is_home();

	//pico theme variables converted to wordpress
	$data['config']           = get_theme_mods();
	$data['base_dir']         = WP_CONTENT_DIR;
	$data['base_url']         = get_bloginfo('wpurl');
	$data['theme_dir']        = get_stylesheet_directory();
	$data['parent_theme_dir'] = get_template_directory();
	$data['site_title']       = get_bloginfo('name');
	$data['site_description'] = get_bloginfo('description');
	$data['sample_widget']    = 'Please go to -- Admin > Apperance widgets and place any widgets you want to appear on your home page here';
	$data['meta']             = '';
	$data['pages']            = '';
	$data['is_front_page']    = is_front_page();
	$data['base_twig']        = $twig_base;

	//sidebars
	$sidebars['sidebar']      = Timber::get_widgets('primary-sidebar');
	$sidebars['secondary']    = Timber::get_widgets('secondary-sidebar');	
	$sidebars['home_sidebar'] = Timber::get_widgets('home-sidebar');
	$sidebars['footer_links'] = Timber::get_widgets('footer-links');
	$sidebars['footer_1'] = Timber::get_widgets('footer-1');
	$sidebars['footer_2'] = Timber::get_widgets('footer-2');
	$sidebars['footer_3'] = Timber::get_widgets('footer-3');
	$sidebars['footer_links'] = Timber::get_widgets('footer-links');
	$sidebars['contact_us'] = Timber::get_widgets('contact-us');
	$sidebars['features'] = Timber::get_widgets('feature');
	$sidebars['cover'] = Timber::get_widgets('cover');
	$sidebars['pitch'] = Timber::get_widgets('pitch');
	$sidebars['offline'] = Timber::get_widgets('offline');
	$sidebars['offline_message'] = Timber::get_widgets('offline_mesasge');

	
        
	$sidebars['primary_menu'] = new TimberMenu('primary');

	$data['sidebars'] = $sidebars;

	$mobile_press = new Mobile_Detect();

	if ($mobile_press->isMobile()) {
		//        /** get the wp template */
		//        add_filter('template_include', 'get_wp_template');
		/**
		 * mobile twig baase template
		 */

		if (file_exists(trailingslashit(get_template_directory()).'views/mobile/mobile.twig')) {
			$twig_base = 'mobile/mobile.twig';
		}
	}

	if ($mobile_press->isTablet() AND file_exists(trailingslashit(get_template_directory()).'views/mobile/tablet.twig')) {
		$twig_base = 'mobile/tablet.twig';
	}
	/**
	 * some variables for mobile
	 * {{ mobile.tablet }}
	 * {% if mobile.tablet %}do something {% endif %}
	 */
	$mobile['is_mobile'] = true;
	$mobile['tablet']    = $mobile_press->isTablet();
	$mobile['android']   = $mobile_press->isAndroidOS();
	$mobile['ios']       = $mobile_press->isiOS();
	$mobile['iphone']    = $mobile_press->isiPhone();
	$mobile['ipad']      = $mobile_press->isiPad();
	$data['mobile']      = $mobile;
	// endif;
        
        /**
         * get them options
         * title_tagline - Site Title & Tagline
colors - Colors
header_image - Header Image
background_image - Background Image
nav - Navigation
static_front_page - Static Front Page
         */
        
        $option['title_tagline']  = get_theme_mod('site_offline', 'A Simple Wordpress them toolkit');
        $option['theme_logo']  = '';
        $option['']  = '';
        $option['background']  = '';
        $data['option'] = $option;

	return $data;
        
        

}

function add_to_twig($twig) {
	/* this is where you can add your own fuctions to twig */
	$twig->addExtension(new Twig_Extension_StringLoader());
	$twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
	return $twig;
}

function myfoo($text) {
	$text .= ' bar!';
	return $text;
}
/**
 * add any header styles here
 */
function header_styles() {
	ob_start()
	?>
<link rel="shortcut icon" href="<?php echo Theme_Function::file_uri('images/favicon.ico');?>">

	<?php
	return ob_get_clean();
}

function timber_widgets($index = 'primary-sidebar') {
	ob_start();
	dynamic_sidebar($index);
	return ob_get_clean();
}
