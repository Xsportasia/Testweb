<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);


/* ====================================================
 * ================ WPSOCCER_HEX2RGBA =================
 * ====================================================*/
if(!function_exists('wpsoccer_hex2rgb')):
    function wpsoccer_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);

       return $rgb[0].','.$rgb[1].','.$rgb[2];
    }
endif;
# end hex


global $themeum_options;

$output = '';

if ($themeum_options['header-fixed']){

	if(isset($headerbg)){
		$output .= '#masthead.sticky{ background-color: rgba('.esc_attr(themeum_hex2rgb($headerbg)).',.95); }';
	}
	$output .= '#masthead.sticky{ position:fixed; z-index:99999;margin:0 auto 30px; width:100%;box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.22);}';
	$output .= '#masthead.sticky #header-container{ padding:0;transition: padding 200ms linear; -webkit-transition:padding 200ms linear;}';
	$output .= '#masthead.sticky .navbar.navbar-default{ background: rgba(255,255,255,.95); border-bottom:1px solid #f5f5f5}';
}



/* ===================================================
* ================= Quick Stylesheet =================
* ====================================================*/

if( $themeum_options['logo-width'] ){
    $output .= '.logo-wrapper .navbar-brand>img{ width: '. (int) esc_attr( $themeum_options['logo-width']) .'px; }';
}  

if( $themeum_options['logo-height'] ){
    $output .= '.logo-wrapper .navbar-brand>img{ height: '. (int) esc_attr( $themeum_options['logo-height']) .'px; }';
} 

# Mainmenu ...
if(isset($themeum_options['main_menu_bg'])){
	$output .= '.site-header{ background-color: '. esc_attr( $themeum_options['main_menu_bg'] ) .' }';
}
if(isset($themeum_options['mainmenu_text_color'])){
	$output .= '#main-menu .nav>li>a{ color: '. esc_attr( $themeum_options['mainmenu_text_color'] ) .' }';
}

if(isset($themeum_options['mainmenu_text_hover_color'])){
	$output .= '#main-menu .nav>li>a:hover{ color: '. esc_attr( $themeum_options['mainmenu_text_hover_color'] ) .' }';
}

if(isset($themeum_options['sub_menu_bg'])){
	$output .= '#main-menu .nav>li:hover>ul{ background-color: '. esc_attr( $themeum_options['sub_menu_bg'] ) .' }';
}

if(isset($themeum_options['sub_menu_text_color'])){
	$output .= '#main-menu .nav>li>ul li a{ color: '. esc_attr( $themeum_options['sub_menu_text_color'] ) .' }';
}
if(isset($themeum_options['sub_menu_text_hv_color'])){
	$output .= '#main-menu .nav>li>ul li a:hover{ color: '. esc_attr( $themeum_options['sub_menu_text_hv_color'] ) .' }';
}
if(isset($themeum_options['sub_menu_text_hover_color'])){
	$output .= '#main-menu .nav>li>ul li:hover{ background-color: '. esc_attr( $themeum_options['sub_menu_text_hover_color'] ) .' }';
}

# Secondary menu ...
$secondary_menu_bg = esc_attr($themeum_options['secondary_menu_bg']);
if(isset($secondary_menu_bg)){
    $output .= '.secondary-menu-wrap{ background-color: rgba('.wpsoccer_hex2rgb($secondary_menu_bg).',.6); }';
}
if(isset($themeum_options['secondary_menu_text_color'])){
	$output .= '#menu-secondary-menu.navbar-nav>li>a{ color: '. esc_attr( $themeum_options['secondary_menu_text_color'] ) .' }';
}
if(isset($themeum_options['secondary_menu_text_hover_color'])){
	$output .= '#menu-secondary-menu.navbar-nav>li>a:hover{ color: '. esc_attr( $themeum_options['secondary_menu_text_hover_color'] ) .' }';
}
if(isset($themeum_options['secondary-padding-top'])){
	$output .= '.secondary-menu-wrap{ padding-top: '. (int) esc_attr($themeum_options['secondary-padding-top']) .'px; }';
}

if(isset($themeum_options['secondary-padding-bottom'])){
	$output .= '.secondary-menu-wrap{ padding-bottom: '. (int) esc_attr($themeum_options['secondary-padding-bottom']) .'px; }';
}
# Secondary menu end...

# Banner Section
if(isset($themeum_options['banner-text-color'])){
	$output .= '.sub-title-inner h2, .matech-team .title h4, .match-banner .score, .match-detail-league-title{ color: '. esc_attr( $themeum_options['banner-text-color'] ) .' }';
}

if(isset($themeum_options['banner-padding-top'])){
	$output .= '.sub-title{ padding-top: '. (int) esc_attr($themeum_options['banner-padding-top']) .'px !important; }';
}

if(isset($themeum_options['banner-padding-bottom'])){
	$output .= '.sub-title{ padding-bottom: '. (int) esc_attr($themeum_options['banner-padding-bottom']) .'px !important; }';
}

if(isset($themeum_options['banner-margin-bottom'])){
	$output .= '.sub-title{ margin-bottom: '. (int) esc_attr($themeum_options['banner-margin-bottom']) .'px; }';
}
# end Banner 

#Footer Background...
$footer_background_color = esc_attr($themeum_options['footer_background_color']);
if(isset($footer_background_color)){
    $output .= '.footer-wrap-inner{ background-color: rgba('.wpsoccer_hex2rgb($footer_background_color).',.6); }';
}
if(isset($themeum_options['footer_text_color'])){
	$output .= '.footer-wrap-inner,.copyright,.footer-wrap  .widget h3.widget_title{ color: '. esc_attr( $themeum_options['footer_text_color'] ) .' }';
}
if(isset($themeum_options['footer_link_color'])){
	$output .= '.footer-wrap .footer-wrap-inner a, .copyright a, .footer-wrap .footer-wrap-inner .widget ul li a, .footer-wrap .footer-wrap-inner .widget.widget_rss ul li a { color: '. esc_attr( $themeum_options['footer_link_color'] ) .' }';
}
if(isset($themeum_options['footer_link_hover_color'])){
	$output .= '.footer-wrap .footer-wrap-inner a:hover, .copyright a:hover, .footer-wrap .footer-wrap-inner .widget ul li a:hover, .footer-wrap .footer-wrap-inner .widget.widget_rss ul li a:hover { color: '. esc_attr( $themeum_options['footer_link_hover_color'] ) .'!important }';
}


/* ===================================================
* ================= Quick Stylesheet end =================
* ====================================================*/


if(isset($themeum_options['header-padding-top'])){
	$output .= '.site-header{ padding-top: '. (int) esc_attr($themeum_options['header-padding-top']) .'px; }';
}

if(isset($themeum_options['header-height'])){
	$output .= '.site-header{ min-height: '. (int) esc_attr($themeum_options['header-height']) .'px; }';
}

if(isset($themeum_options['header-padding-bottom'])){
	$output .= '.site-header{ padding-bottom: '. (int) esc_attr($themeum_options['header-padding-bottom']) .'px; }';
}

if(isset($themeum_options['footer-bg'])){
	$output .= '#footer{ background: '.esc_attr($themeum_options['footer-bg']) .'; }';
}

if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
	$output .= "body {
		background: #fff;
		display: table;
		width: 100%;
		height: 100%;
		min-height: 100%;
	}";
}


if(isset($themeum_options['custom-css'])){
   $output .= $themeum_options['custom-css'];
}

echo $output;