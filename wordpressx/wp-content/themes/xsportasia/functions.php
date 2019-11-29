<?php
define('THEMEUMNAME', wp_get_theme()->get( 'Name' ));
define('THMCSS', get_template_directory_uri().'/css/');
define('THMJS', get_template_directory_uri().'/js/');

if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
// Include the meta box script
require_once (get_template_directory().'/lib/meta-box/meta-box.php');
}
require_once (get_template_directory().'/lib/metabox.php');

/*-------------------------------------------------------
*			Custom Widgets and VC shortocde Include
*-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/widgets/image_widget.php');
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');
require_once( get_template_directory()  . '/lib/widgets/popular-news.php');
require_once( get_template_directory()  . '/lib/widgets/follow_us_widget.php');

require_once( get_template_directory()  . '/lib/vc-addons/fontawesome-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-heading.php');
require_once( get_template_directory()  . '/lib/vc-addons/shortcode-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-highlight.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-video-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-popular-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-latest-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-gallery.php');
require_once( get_template_directory()  . '/lib/vc-addons/twitter.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-breaking-news.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-latest-match.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-social-button.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-heading-black.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-featured.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-smart-link.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-feature-items.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-post-slider.php');
require_once( get_template_directory()  . '/lib/vc-addons/wc-latest-products.php');

/*-------------------------------------------------------
 *				Redux Framework Options Added
 *-------------------------------------------------------*/

global $themeum_options; 

if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/admin/framework.php' );
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/theme-options/admin-config.php' );
}

/*-------------------------------------------------------
 *				Login and Register
 *-------------------------------------------------------*/
require get_template_directory() . '/lib/registration.php';


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => 'Primary Menu',
	'secondary_nav' => 'Secondary Navigation'
) );


/*-------------------------------------------*
 *				woocommerce support
 *------------------------------------------*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/*-------------------------------------------*
 *				title tag
 *------------------------------------------*/
add_theme_support( 'title-tag' );
add_theme_support( 'post-formats', array( 'link', 'quote' ) );
/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
//Main Navigation
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );



/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/wpsoccer-register.php');


/*-------------------------------------------------------
 *			Themeum Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');

/*--------------------------------------------------------------
 * 					AJAX login System
 *-------------------------------------------------------------*/	
require_once( get_template_directory()  . '/lib/main-function/ajax-login.php');


/*--------------------------------------------------------------
 * 	Theme Activation Hook (create login and registration page)
 *-------------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/login-registration.php');


/*--------------------------------------------------------------
 * 	Theme Activation Hook (Dynamic Widget)
 *-------------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/dynamic-widget.php');


//Gallery Shortcode
add_filter('post_gallery', 'themeum_post_gallery', 10, 2);
function themeum_post_gallery($output, $attr) {
	global $post;

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => ''
		), $attr));

	$id = intval($id);
	if ('RAND' == $order) $orderby = 'none';
	if (!empty($include)) {
		$include = preg_replace('/[^0-9,]+/', '', $include);
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}

	if (empty($attachments)) return '';

	$output = '<div class="themeum-gallery">';
	$output .= '<div id="postSlider" class="gallery-controll flexslider">';
	$output .= '<ul class="slides">';

	foreach ($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'blog-full');
		$output .= '<li class="all-slides">';
		$output .= '<img src="'.esc_url($img[0]).'" alt="'.__('image','themeum').'" />';
		$output .= '</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';

    //Controllers
	$output .= '<div id="flexCarousel" class="gallery-controll-thumb flexslider">';
	$output .= '<ul class="slides gallery-thumb-image">';

	foreach ($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'blog-thumb');
		$output .= '<li>';
		$output .= '<img class="img-responsive" src="'. esc_url($img[0]) .'" alt="'.__('image','themeum').'" />';
		$output .= '</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	

	return $output;
}

# Shop Page Column Set
function loop_columns() {
return 3; 
}
add_filter('loop_shop_columns', 'loop_columns');
