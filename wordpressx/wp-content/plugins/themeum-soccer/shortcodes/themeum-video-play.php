<?php
add_shortcode( 'themeum_video_play', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 		=> '',
		'color'			=> '#6f797a',
		'size'			=> '36',
		'title_margin'	=> '30px',
		'title_padding'	=> '0px 0px 0px 0px',
		'title_weight'	=> '400',
		'class'			=> '',
		'video_id'		=> '',
		), $atts));

	

	$inline_css = $output = '';

	if($color){ $inline_css .= 'color:'.esc_attr($color).';'; }
	if($size){ $inline_css .= 'font-size:'.esc_attr($size).'px;'; }
	if($title_margin){  $inline_css .= 'margin-bottom:'.esc_attr($title_margin).';';  }
	if($title_padding){  $inline_css .= 'padding:'.esc_attr($title_padding).';';  }
	if($title_weight) $inline_css .= 'font-weight:'. esc_attr($title_weight) .';';


	$output .= '<div class="themeum-title'.esc_attr($class).'">';
	    $output .= '<div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 style="'.$inline_css.'">'.esc_attr($title).'</h2>'; 
	$output .= '</div>';
	
	$output .= '<div class="embed-responsive embed-responsive-16by9">';
  		$output .= '<iframe id="player" src="http://www.youtube.com/embed/'.esc_attr( $video_id ).'" frameborder="0"></iframe>';
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Video Play", "themeum-soccer"),
	"base" => "themeum_video_play",
	'icon' => 'icon-thm-title',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum-soccer"),
	"category" => __('Themeum', "themeum-soccer"),
	"params" => array(			

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum-soccer"),
			"param_name" => "title",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Youtube Video ID", "themeum-soccer"),
			"param_name" => "video_id",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Font Size", "themeum-soccer"),
			"param_name" => "size",
			"value" => "",
			),					

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum-soccer"),
			"param_name" => "color",
			"value" => "",
			),	

		array(
			"type" => "dropdown",
			"heading" => __("Title Font Wight", "themeum-soccer"),
			"param_name" => "title_weight",
			"value" => array('Select'=>'','400'=>'400','100'=>'100','200'=>'200','300'=>'300','500'=>'500','600'=>'600','700'=>'700'),
			),				

		array(
			"type" => "textfield",
			"heading" => __("Title Margin Bottom", "themeum-soccer"),
			"param_name" => "title_margin",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Title Padding", "themeum-soccer"),
			"param_name" => "title_padding",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Custom Class ", "themeum-soccer"),
			"param_name" => "class",
			"value" => "",
			),

		)
	));
}