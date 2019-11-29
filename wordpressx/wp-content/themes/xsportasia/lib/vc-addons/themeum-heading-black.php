<?php
add_shortcode( 'themeum_heading_black', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 		=> '',
		'color'			=> '#6f797a',
		'bg_color'		=> '#000',
		'size'			=> '36',
		'title_margin'	=> '30px',
		'title_padding'	=> '13px 0px 13px 0px',
		'title_weight'	=> '400',
		'class'			=> '',
		), $atts));

	$inline_css = $output = '';

	if($color){ $inline_css .= 'color:'.esc_attr($color).';'; }
	if($bg_color){ $inline_css .= 'background-color:'.esc_attr($bg_color).';'; }
	if($size){ $inline_css .= 'font-size:'.esc_attr($size).'px;'; }
	if($title_margin){  $inline_css .= 'margin-bottom:'.esc_attr($title_margin).';';  }
	if($title_padding){  $inline_css .= 'padding:'.esc_attr($title_padding).';';  }
	if($title_weight) $inline_css .= 'font-weight:'. esc_attr($title_weight) .';';

	$output .= '<div class="themeum-title themeum-title-black '.esc_attr($class).'">';
	    $output .= '<div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 style="'.$inline_css.'">'.esc_attr($title).'</h2>'; 
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Title Heading Black", "themeum"),
	"base" => "themeum_heading_black",
	'icon' => 'icon-thm-title',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(			

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum"),
			"param_name" => "title",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Font Size", "themeum"),
			"param_name" => "size",
			"value" => "",
			),					

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum"),
			"param_name" => "color",
			"value" => "",
			),		

		array(
			"type" => "colorpicker",
			"heading" => __("Title Background Color", "themeum"),
			"param_name" => "bg_color",
			"value" => "",
			),	

		array(
			"type" => "dropdown",
			"heading" => __("Title Font Wight", "themeum"),
			"param_name" => "title_weight",
			"value" => array('Select'=>'','400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
			),				

		array(
			"type" => "textfield",
			"heading" => __("Title Margin Bottom", "themeum"),
			"param_name" => "title_margin",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Title Padding", "themeum"),
			"param_name" => "title_padding",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Custom Class ", "themeum"),
			"param_name" => "class",
			"value" => "",
			),

		)
	));
}