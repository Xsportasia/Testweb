<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_shortcode('club_group','themeum_club_group');

function themeum_club_group($atts, $content){
	
	extract(shortcode_atts(array(
		'title' 		=> '',
		'group_id' 		=> '',
		'league_id'		=> '',
		'column'		=> '12',
	), $atts));

	global $post;
	$output = '';


		$args = array(
			'post_type'			=> 'fixture_reasult',
			'posts_per_page' 	=> -1,
			'tax_query' => array(
								array(
									'taxonomy' => 'league',
									'field'    => 'slug',
									'terms'    => $league_id,
								),
							),
			'meta_key'          => 'themeum_datetime',
			'orderby'           => 'meta_value',
			'order'             => 'ASC'
		);
		if(is_numeric($group_id)){
			$args = array(
				'post_type'			=> 'fixture_reasult',
				'posts_per_page' 	=> -1,
				'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'league',
										'field'    => 'slug',
										'terms'    => $league_id,
									),
									array(
										'taxonomy' => 'team_group',
										'field'    => 'slug',
										'terms'    => $group_id,
									),
								),
				'meta_key'          => 'themeum_datetime',
				'orderby'           => 'meta_value',
				'order'             => 'ASC'
			);
		}
		$posts = get_posts($args);


		$team_id_list = array();
		foreach ($posts as $post){
			setup_postdata( $post );
			$team_1    = get_post_meta(get_the_ID(),'team_1_group',true);
			$team_2    = get_post_meta(get_the_ID(),'team_2_group',true);
    		$team_id_list[] = $team_1["themeum_club_name1"];
    		$team_id_list[] = $team_2["themeum_club_name2"];
	    }
	    wp_reset_postdata();
	    $team_id_list = array_unique($team_id_list);


	    $args2 = array();
	    if(is_array($team_id_list)){
		    $args2 = array(
				'post_type'			=> 'club',
				'post__in'			=> $team_id_list,
				'posts_per_page' 	=> -1,
			);	
	    }
	    $posts2 = get_posts($args2);
	    $count = count($posts2);



		$output .= '<div class="fixture-teams">';
		    $output .= '<div class="fixture-teams-list result-list">';
		        
		        $output .= '<div class="row">';
		            $output .= '<h3 class="fixture-title">'.esc_attr( $title ).'</h3>';
		        $output .= '</div>';
		       

		        $x=0;
		        $j=0;
		        $difference = (12/$column);
		       	foreach ($posts2 as $poster){
		       		setup_postdata( $poster );
		       		$club_logo = get_post_meta($poster->ID,'themeum_club_logo',true);
		       		
		       		if($j==0 || $difference == $x ){
		       			$output .= '<div class="row fixture-team-inner clearfix">';
		       			$x=0;
		       		}

					$src = wp_get_attachment_image_src( get_post_thumbnail_id( $poster->ID ), 'full' );
		       		$output .= '<div class="col-sm-'.esc_attr( $column ).' paddingleft">';
		                if ( has_post_thumbnail($poster->ID) && ! post_password_required() ) { 
		                	$output .= '<img width="40" class="pull-left" src="'.esc_url( $src[0] ).'"> ';
		            	}
		                
		                $output .= '<h4>'.get_the_title($poster->ID).'</h4>';
		            $output .= '</div>';

		            if($x==($difference-1) || $count == $x ){
		            	$output .= '</div>';
		            }
		            $x++;
		            $j++;

		       	}
		       	wp_reset_postdata();	    

		    $output .= '</div>';
		$output .= '</div>';




	return $output;
}


//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Club Group", "themeum-soccer"),
		"base" => "club_group",
		'icon' => 'icon-thm-reasult',
		"class" => "",
		"description" => "Themeum Club Group Shortocde",
		"category" => __("Themeum", "themeum-soccer"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Put Here Title", "themeum-soccer"),
				"param_name" => "title",
				"description" => __("Put here Title", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Put here League Slug", "themeum-soccer"),
				"param_name" => "league_id",
				"description" => __("Put here League Slug", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Put here Group ID", "themeum-soccer"),
				"param_name" => "group_id",
				"description" => __("Put here Group ID", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Number of Column", "themeum-soccer"),
				"param_name" => "column",
				"value" => array('Select'=>'','Column 1'=>'12','Column 2'=>'6','Column 3'=>'4','Column 4'=>'3'),
				),		




			)

		));
}