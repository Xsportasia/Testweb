<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_shortcode('themeum_player','themeum_top_players');

function themeum_top_players($atts, $content)
{
	extract(shortcode_atts(array(
		'number_of_post'	=> 3,
		'class'				=> '',
	), $atts));

	global $post;
	$args = array(
			'post_type'			=> 'player',
			'posts_per_page' 	=> $number_of_post,
			'meta_key' 			=> 'themeum_soccer_top_player',
			'meta_value'   => '1',
			'meta_compare' => '=',
		);

	$posts = get_posts($args);

	$output = '<div id="carousel-player" class="carousel slide" data-ride="carousel">';

	$output .= '<div class="carousel-inner">';

	$i = 0;

	foreach ($posts as $post)
	{
		setup_postdata( $post );

		$position    = get_post_meta(get_the_ID(),'themeum_position',true);

		$classes = ($i==0)?'item active':'item';

		$output .= '<div class="themeum-player ' . esc_attr( $classes ). '">';
		$output .= '<div class="player-inner clearfix">';
		$output .= '<a  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'heighlights', array('class' => 'img-responsive')).'</a>';
		$output .= '<div class="player-inside clearfix">';
		$output .= '<h4 class="player-name"><a  href="'.get_permalink().'">' . get_the_title() . '</a></h4>';
		$output .= '<span class="player-position">' .esc_attr( $position ). '</span>';
		$output .= '</div>';//player-inside
		$output .= '</div>';//player-inner
		$output .= '</div>';//themeum-player

		$i++;

	}

	wp_reset_postdata();

	/*Controls */
	$output .= '<div class="player-carousel-control">';
	$output .= '<a class="left" href="#carousel-player" role="button" data-slide="prev">';
	$output .= '<i class="fa fa-angle-left"></i>';
	$output .= '</a>';
	$output .= '<a class="right" href="#carousel-player" role="button" data-slide="next">';
	$output .= '<i class="fa fa-angle-right"></i>';
	$output .= '</a>';
	$output .= '</div>'; 

	$output .= '</div>';
	$output .= '</div>';



	return $output;
}


//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Top Players", "themeum-soccer"),
		"base" => "themeum_player",
		'icon' => 'icon-thm-testimonial',
		"class" => "",
		"description" => "Themeum Top Players Shortocde",
		"category" => __("Themeum", "themeum-soccer"),
		"params" => array(


			array(
			        "type" => "textfield",
			        "heading" => __("Number of Posts","themeum-soccer"),
			        "param_name" => "number_of_post",
			        "value" => '', 
			    ),


			array(
			        "type" => "textfield",
			        "heading" => __("Add External Class","themeum-soccer"),
			        "param_name" => "class",
			        "value" => '', 
			    ),



			)

		));
}