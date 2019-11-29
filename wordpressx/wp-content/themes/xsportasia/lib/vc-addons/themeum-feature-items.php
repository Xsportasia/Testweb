<?php
add_shortcode( 'themeum_feature_items', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'image'				=> '',
		'title'				=> '',
		'title_size'		=> '18',
		'title_margin'		=> '10px 0 10px 0',
		'text_margin'		=> '10px 0 10px 0',
		'text'				=> '',
		'text_size'			=> '16',
		'color'				=> '#000',
		'text_color'		=> '#000',
		'class'				=> '',
		), $atts));

	$src_image   = wp_get_attachment_image_src($image, 'full');


		$output = $style = $style2 = '';

		if($title_size != '' ){ $style .= 'font-size:'.esc_attr((int)$title_size).'px;'; }
		if($title_margin != '' ){ $style .= 'margin:'.esc_attr($title_margin).';'; }
		if($color != '' ){ $style .= 'color:'.esc_attr($color).';'; }

		if($text_size != '' ){ $style2 .= 'font-size:'.esc_attr((int)$text_size).'px;'; }
		if($text_margin != '' ){ $style2 .= 'margin:'.esc_attr($text_margin).';'; }
		if($text_color != '' ){ $style2 .= 'color:'.esc_attr($text_color).';'; }


		$output .= '<div class="themeum-feature-item">';
			$output .= '<div class="media">';	
			$output .= '<div class="icon media-left"><img src="'.esc_url($src_image[0]).'" alt="icon"></div>';
			$output .= '<div class="media-body">';	
			$output .= '<h4 style="'.$style.'">'.balanceTags($title).'</h4>';
			$output .= '<p style="'.$style2.'">'.esc_html($text).'</p>';
			$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Feature Items", "themeum"),
	"base" => "themeum_feature_items",
	'icon' => 'icon-thm-image-caption',
	"description" => __("Feature Items is Display Here.", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "attach_image",
			"heading" => __("Insert Image", "themeum"),
			"param_name" => "image",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum"),
			"param_name" => "title",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title Font Size", "themeum"),
			"param_name" => "title_size",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title Margin", "themeum"),
			"param_name" => "title_margin",
			"value" => ""
			),			

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum"),
			"param_name" => "color",
			"value" => "",
			),	

		array(
			"type" => "textarea",
			"heading" => __("Text", "themeum"),
			"param_name" => "text",
			"value" => "",
			),														

		array(
			"type" => "textfield",
			"heading" => __("Text Font Size", "themeum"),
			"param_name" => "text_size",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Text Margin", "themeum"),
			"param_name" => "text_margin",
			"value" => ""
			),		

		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "themeum"),
			"param_name" => "text_color",
			"value" => "",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Custom Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),	

		)
	));
}