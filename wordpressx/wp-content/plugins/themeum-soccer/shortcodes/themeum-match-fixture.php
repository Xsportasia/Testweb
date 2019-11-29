<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_shortcode('match_fixture','themeum_match_fixture');

function themeum_match_fixture($atts, $content){
	
	extract(shortcode_atts(array(
		'league_table_id' 	=> '',
		'group_id' 			=> '',
		'title_table' 		=> '',
		'class' 			=> ''
	), $atts));

	global $post;
	$args = array(
			'post_type'			=> 'fixture_reasult',
			'posts_per_page' 	=> -1,
			'tax_query' => array(
								array(
									'taxonomy' => 'league',
									'field'    => 'slug',
									'terms'    => $league_table_id,
								),
							),
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
									'terms'    => $league_table_id,
								),
								array(
									'taxonomy' => 'team_group',
									'field'    => 'slug',
									'terms'    => $group_id,
								),
							),
		);
	}
	$posts = get_posts($args);


            $output = '<div class="fixture-teams '.$class.'">';
                $output .= '<div class="fixture-teams-list">';
                    $output .= '<div class="row">';
                        $output .= '<h3 class="fixture-title">'.esc_attr( $title_table ).'</h3>';
                    $output .= '</div>';



					foreach ($posts as $post){
						setup_postdata( $post );
						$team_1_group    = get_post_meta(get_the_ID(),'team_1_group',true);
						$team_2_group    = get_post_meta(get_the_ID(),'team_2_group',true);
						$home_ground     = get_post_meta(get_the_ID(),'themeum_home_ground',true);
						$datetime    	 = get_post_meta(get_the_ID(),'themeum_datetime',true);
						$gmt 	   	 	 = get_post_meta(get_the_ID(),'themeum_gmt',true);

	                    $output .= '<div class="row fixture-team-inner clearfix">';
	                        $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
	                        $output .= '<a href="'.get_the_permalink($team_1_group['themeum_club_name1']).'">';
	                        	if($team_1_group['themeum_club_name1'] != ''){
	                            	$output .= '<img width="40" class="pull-left" src="'.esc_url( themeum_logo_url_by_id($team_1_group['themeum_club_name1'])).'" alt="'.esc_attr( themeum_get_title_by_id($team_1_group['themeum_club_name1']) ).'"> ';
	                            }
	                            if($team_1_group['themeum_club_name1'] != ''){
	                            	$output .= '<h4>'.esc_attr( themeum_get_title_by_id($team_1_group['themeum_club_name1']) ).'</h4>';
	                            } 
	                        $output .= '</a>';
	                        $output .= '</div>';

	                        $output .= '<div class="col-xs-4 col-sm-4 status text-center"> '.date_i18n( 'Y-M-d h:i A', strtotime($datetime));
	                        	if($home_ground != '' ){
	                        		$output .= '<span>'.esc_attr( themeum_get_title_by_id($home_ground) ).'</span>';
	                        	}
	                        $output .= '</div>';
	                        $output .= '<div class="col-xs-4 col-sm-4 text-right">';
	                        $output .= '<a href="'.get_the_permalink($team_2_group['themeum_club_name2']).'">';
	                            if($team_2_group['themeum_club_name2'] != ''){
	                            	$output .= '<img width="40" class="pull-right" src="'.esc_url( themeum_logo_url_by_id($team_2_group['themeum_club_name2']) ).'" alt="'.esc_attr( themeum_get_title_by_id($team_2_group['themeum_club_name2']) ).'"> ';
	                            }
	                            if($team_2_group['themeum_club_name2'] != ''){
	                            	$output .= '<h4>'.esc_attr( themeum_get_title_by_id($team_2_group['themeum_club_name2']) ).'</h4>';
	                            }
	                        $output .= '</a>';
	                        $output .= '</div>';
	                    $output .= '</div>';
	                }
					wp_reset_postdata();


                $output .= '</div>';
            $output .= '</div>';

	return $output;
}


//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Match Fixture", "themeum-soccer"),
		"base" => "match_fixture",
		'icon' => 'icon-thm-testimonial',
		"class" => "",
		"description" => " Match Fixture Setting",
		"category" => __("Themeum", "themeum-soccer"),
		"params" => array(

				array(
			        "type" => "textfield",
			        "heading" => __("Title of the Table","themeum-soccer"),
			        "param_name" => "title_table",
			        "description" => __("Title of the Table", "themeum-soccer"),
			        "value" => '', 
			        ),

				array(
			        "type" => "textfield",
			        "heading" => __("Leagues Category Slug","themeum-soccer"),
			        "param_name" => "league_table_id",
			        "description" => __("Put here Leagues Category Slug", "themeum-soccer"),
			        "value" => '', 
			        ),

				array(
			        "type" => "textfield",
			        "heading" => __("Group Category Slug","themeum-soccer"),
			        "param_name" => "group_id",
			        "description" => __("Put here Group Category Slug", "themeum-soccer"),
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