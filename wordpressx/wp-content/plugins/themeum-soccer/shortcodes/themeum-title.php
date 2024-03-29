<?php
add_shortcode( 'themeum_title', function($atts, $content = null) {

	extract(shortcode_atts(array(
			'title' 				=> '',
			'title_weight'			=> '',
			'color'					=> '',
			'position'				=> 'center',
			'size'					=> '',
			'title_margin'			=> '',
			'title_padding'			=> '',
			'subtitle'				=> '',
			'subtitle_size'			=> '',
			'subtitle_weight'		=> '',
			'subtitle_color'		=> '',
			'class'					=> ''
		), $atts));

	$align = $inline1 = $inline2 = $output = '';

	if($position) $align .= 'text-align:'. esc_attr( $position ) .';';

	$output .= '<div class="themeum-title  '.esc_attr( $class ).'" style="'. $align .'">';

	if ($title) {

		if($title_margin) $inline1 		.= 'margin:' . esc_attr( $title_margin ) .';';
		if($title_padding) $inline1 	.= 'padding:' . esc_attr( $title_padding ) .';';
		if($title_weight) $inline1 		.= 'font-weight:' . (int) esc_attr( $title_weight ) . ';';
		if($size) $inline1 				.= 'font-size:' . (int) esc_attr( $size ) . 'px;line-height: normal;';
		if($color) $inline1 			.= 'color:' . esc_attr( $color )  . ';';

		$output .= '<h3 class="style-title" style="'.$inline1.'">' . esc_attr( $title ) . '</h3>';
	}	

	if ($subtitle) {

		if($subtitle_size) $inline2 	.= 'font-size:' . (int) esc_attr( $subtitle_size ) . 'px;';
		if($subtitle_weight) $inline2 	.= 'font-weight:' . (int) esc_attr( $subtitle_weight ) . ';';
		if($subtitle_color) $inline2 	.= 'color:' . esc_attr( $subtitle_color )  . ';';

		$output .= '<h4 class="style-sub-title" style="'.$inline2.'">' . esc_attr( $subtitle ) . '</h4>';
	}
	
	$output .= '</div>';

	return $output;

});


# Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" 				=> esc_html__("Themeum Title", 'themeum-soccer'),
	"base" 				=> "themeum_title",
	'icon' 				=> 'icon-thm-title',
	"class" 			=> "",
	"description" 		=> esc_html__("Widget Title Heading", 'themeum-soccer'),
	"category" 			=> esc_html__('Themeum', 'themeum-soccer'),
	"params" 			=> array(

		array(
			"type" 			=> "dropdown",
			"heading" 		=> esc_html__("Position", 'themeum-soccer'),
			"param_name" 	=> "position",
			"value" 		=> array('Center'=>'center','Left'=>'left','Right'=>'right'),
			),				

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Title", 'themeum-soccer'),
			"param_name" 	=> "title",
			"value" 		=> "",
			),	

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Font Size", 'themeum-soccer'),
			"param_name" 	=> "size",
			"value" 		=> "",
			),	

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Title Font Weight", 'themeum-soccer'),
			"param_name" 	=> "title_weight",
			"value" 		=> "",
			),									

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> esc_html__("Title Color", 'themeum-soccer'),
			"param_name" 	=> "color",
			"value" 		=> "",
			),			

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Title Margin", 'themeum-soccer'),
			"param_name" 	=> "title_margin",
			"value" 		=> "",
			),

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Title Padding", 'themeum-soccer'),
			"param_name" 	=> "title_padding",
			"value" 		=> "",
			),

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Sub Title", 'themeum-soccer'),
			"param_name" 	=> "subtitle",
			"value" 		=> "",
			),	
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Sub Title Font Size", 'themeum-soccer'),
			"param_name" 	=> "subtitle_size",
			"value" 		=> "",
			),	

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Sub Title Font Weight", 'themeum-soccer'),
			"param_name" 	=> "subtitle_weight",
			"value" 		=> "",
			),									

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> esc_html__("Sub Title Color", 'themeum-soccer'),
			"param_name" 	=> "subtitle_color",
			"value" 		=> "",
			),	

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Custom Class ", 'themeum-soccer'),
			"param_name" 	=> "class",
			"value" 		=> "",
			),

		)
	));
}