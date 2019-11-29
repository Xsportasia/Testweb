<?php
add_shortcode( 'themeum_smart_link', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 					=> '',
		'image' 					=> '',
		'btn_url' 					=> '',
		'height' 					=> '150px',
		'class'						=> '',
		), $atts));

		$style = '';
		$style2 = '';
		$src_image   = wp_get_attachment_image_src($image, 'blog-full');
		if ($height)
		{
			$style .= 'height:'.(int)$height.'px;';		
		}		

		if ($height)
		{
			$style2 = 'line-height:'.(int)$height.'px;';		
		}	

		if ($src_image)
		{
			$style .= 'background-image:url('.esc_url($src_image[0]).'); background-repeat: no-repeat; background-size: cover;';	
		}	

		$output = '';

	    $output .= '<div class="themeum-smart-link '.esc_attr($class).'" style="'.$style.'">';
		if ($title)
		{
			$output .= '<div class="smart-link-title pull-left">' . esc_attr($title) . '</div>';
		}
		if ($btn_url)
		{
			$output .= '<div class="pull-right" style="'.$style2.'"><a class="btn-smar-link" href="' . esc_url($btn_url) . '"><i class="fa fa-chevron-right"></i></a></div>';
		}	
		$output .= '<div class="clearfix"></div>';		
		$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Smart Link", "themeum"),
	"base" => "themeum_smart_link",
	'icon' => 'icon-thm-smart-link',
	"class" => "",
	"description" => __("Call to action shortcode.", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "attach_image",
			"heading" => __("Background Image", "themeum"),
			"param_name" => "image",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Button Title", "themeum"),
			"param_name" => "title",
			"value" => ""
			),
				
		array(
			"type" => "textfield",
			"heading" => __("Button Url", "themeum"),
			"param_name" => "btn_url",
			"value" => ""
			),

		array(
			"type" => "textfield",
			"heading" => __("Button Height Ex. 150px", "themeum"),
			"param_name" => "height",
			"value" => "",
			),


		array(
			"type" => "textfield",
			"heading" => __("Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),		

		)
	));
}