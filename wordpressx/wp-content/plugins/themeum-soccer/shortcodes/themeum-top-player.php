<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; # Exit if accessed directly
}

add_shortcode('themeum_player','themeum_top_players');

function themeum_top_players($atts, $content)
{
	extract(shortcode_atts(array(
		'style' 			=> 'style1',
		'title' 			=> '',
		'overlay'			=> 'yes',
		'number'			=> '12',
		'count'				=> '4',
		'time'              => '3000',
        'disable_slider'    => '', 	
	), $atts));

	if($disable_slider == 'enable'){
        $time = 'false';
    }

	global $post;
	$args = array(
			'post_type'			=> 'player',
			'meta_key' 			=> 'themeum_soccer_top_player',
			'meta_value' 		=> '1',
			'posts_per_page' 	=> $number,
		);

	$posts = get_posts($args);
	$output = '';


	if ( $style == 'style1' ) {
		$output .= '<div id="carousel-player" class="carousel slide" data-ride="carousel">';
		$output .= '<div class="carousel-inner">';

		$i = 0;

		foreach ($posts as $post)
		{
			setup_postdata( $post );

			$position    = get_post_meta($post->ID,'themeum_position',true);
		    $img = get_post_meta($post->ID,'themeum_player_image', true);
		    $src_image   = wp_get_attachment_image_src($img, 'heighlights');

		    if(isset($src_image) && !empty($src_image)){
			$classes = ($i==0)?'item active':'item';
			
				$output .= '<div class="themeum-player ' . esc_attr($classes) . '">';
				$output .= '<div class="player-inner clearfix">';
				$output .= '<div class="themeum-overlay-wrap '.esc_attr($overlay).'">';
				
		            $output .= '<a  href="'.get_permalink().'"><img src="'.esc_url($src_image[0]).'" alt="'.get_the_title().'"></a>';
		        
				$output .= '</div>';//themeum-overlay-wrap
				$output .= '<div class="themeum-overlay-inner">';
				$output .= '<div class="player-inside clearfix">';
				$output .= '<h4 class="player-name"><a  href="'.get_permalink().'">' . get_the_title() . '</a></h4>';
				$output .= '<span class="player-position">' . esc_attr($position) . '</span>';
				$output .= '</div>';//player-inside
				$output .= '</div>';//themeum-overlay-inner
				$output .= '</div>';//player-inner
				$output .= '</div>';//themeum-player

			$i++;
			}
		}

		wp_reset_postdata();

		/* Controls */
		$output .= '<div class="player-carousel-control">';
		$output .= '<a class="left" href="#carousel-player" role="button" data-slide="prev">';
		$output .= '<i class="fa fa-angle-left"></i>';
		$output .= '</a>';
		$output .= '<a class="right" href="#carousel-player" role="button" data-slide="next">';
		$output .= '<i class="fa fa-angle-right"></i>';
		$output .= '</a>';
		$output .= '</div>'; 

		$output .= '</div>'; #carousel-player
		$output .= '</div>'; # carousel-inner

	}else {

		$output .= '<div id="carousel-player" class="carousel slide" data-ride="carousel">';
		$output .= '<div class="carousel-inner">';

		$output .= '<div class="themeum-title themeum-title-black">'; 
			$output .= '<div class="top-player-list-cont themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 class="top-player-wrap">'.esc_attr($title).'</h2>'; 

			/*Controls */
			$output .= '<div class="recent-result-control">';
			$output .= '<a class="left recent-result-carousel-control" href="#carousel-player" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
			$output .= '<a class="right recent-result-carousel-control" href="#carousel-player" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>';
			$output .= '</div>'; 
		$output .= '</div>'; //.themeum-title

		$output .= '<div class="themeum-recent-result-inner">';
		$output .= '<div class="carousel-inner" role="listbox">';

		$x = 0;
		$i = 0;
		$j = 1;

		foreach ($posts as $post){

			$img 				= get_post_meta($post->ID,'themeum_player_image', true);
			$src_image   		= wp_get_attachment_image_src($img, 'heighlights');
			$match_played     	= get_post_meta($post->ID,'themeum_match_played', true);

			setup_postdata( $post );

			$classes = ( $i==0 )?'item active':'item';	
				if( $i==0 || $x == $count ){
					$output .= '<div class="' .$classes. '">';
					$output .= '<ul class="club-ranking-inner">';
					$x=0;
				}
				
				$output .= '<div class="themeum-player">';		
				$output .= '<li class="clearfix"><span>'.$j.'<img class="img-responsive" src="'.esc_url($src_image[0]).'"><a  href="'.get_permalink().'">' . get_the_title() . '</a></span><span class="total-match-played">'. $match_played .'</span> </li>';	
				$output .= '</div>';

				if( $x == ($count-1) ){
					$output .= '</ul>';
					$output .= '</div>';
				}

			$i++;
			$j++;
			$x++;	
		}

		$output .= '</div>'; # carousel
		$output .= '</div>'; # carousel-inner

		$output .= '</div>'; # carousel
		$output .= '</div>'; # themeum-club-ranking
		wp_reset_postdata();
	}

    // JS time
    $output .= "<script type='text/javascript'>jQuery(document).ready(function() { jQuery('#carousel-player').carousel({ interval: ".esc_attr($time)." }) });</script>";
	return $output;
}


# Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" 			=> __("Top Players", "themeum-soccer"),
		"base" 			=> "themeum_player",
		'icon' 			=> 'icon-thm-testimonial',
		"class" 		=> "",
		"description" 	=> "Themeum Top Players Shortocde",
		"category" 		=> __("Themeum", "themeum-soccer"),
		"params" 		=> array(

			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Style", "themeum"),
				"param_name" 	=> "style",
				"value" 		=> array( 'Select'=>'','Style1'=>'style1','Style2'=>'style2' ),
			),

			array(
				"type" 			=> "textfield",
				"heading" 		=> __("Title", "themeum-soccer"),
				"param_name" 	=> "title",
				"value" 		=> "",
			),

			array(
	            "type" 			=> "textfield",
	            "heading" 		=> __("Number of Slide Ex. 10", "themeum-soccer"),
	            "param_name" 	=> "number",
	            "value" 		=> "",
            ),	

            array(
			"type" 				=> "textfield",
			"heading" 			=> __("Count Number for Carousel", "themeum-soccer"),
			"param_name" 		=> "count",
			"value" 			=> "",
			),	
	
			array(
				"type" 			=> "dropdown",
				"heading" 		=> __("Image Overlay", "themeum-soccer"),
				"param_name" 	=> "overlay",
				"value" 		=> array('Select'=>'','YES'=>'yes','NO'=>'no'),
			),

	        array(
	            "type" 			=> "checkbox",
	            "class" 		=> "",
	            "heading" 		=> __("Disable Slider: ","themeum-soccer"),
	            "param_name" 	=> "disable_slider",
	            "value" 		=> array ( __('Disable','themeum') => 'enable'),
	            "description" 	=> __("If you want disable slide check this.","themeum-soccer"),
	        ),

	        array(
	            "type" 			=> "textfield",
	            "heading" 		=> __("Sliding Time(Milliseconds Ex: 4000)", "themeum-soccer"),
	            "param_name" 	=> "time",
	            "value" 		=> "",
            ),			
		)

	));
}