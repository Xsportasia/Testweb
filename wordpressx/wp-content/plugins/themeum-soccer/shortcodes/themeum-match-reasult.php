<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_shortcode('match_reasult','themeum_match_reasult');

function themeum_match_reasult($atts, $content){
	
	extract(shortcode_atts(array(
		'title' 			=> '',
		'group_id' 			=> '',
		'league_id'			=> '',
		'reasult_number'	=> '',
		'class'				=> '',
	), $atts));

	global $post;
	$output = '';
	if( $reasult_number == '' ){
		$reasult_number = -1;
	}

		$args = array(
			'post_type'			=> 'fixture_reasult',
			'posts_per_page' 	=> $reasult_number,
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
				'posts_per_page' 	=> $reasult_number,
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




	
	            $output .= '<div class="fixture-teams '.esc_attr( $class ).'">';
                $output .= '<div class="fixture-teams-list result-list">';
                	if ($title) {
                		$output .= '<div class="row">';
		                    $output .= '<h3 class="fixture-title">'.esc_attr( $title ).'</h3>';
		                $output .= '</div>';
                	}

                	foreach ($posts as $post){
							setup_postdata( $post );
							
							$match_result    = get_post_meta(get_the_ID(),'themeum_goal_count',true);

							$team_1    = get_post_meta(get_the_ID(),'team_1_group',true);
							$team_2    = get_post_meta(get_the_ID(),'team_2_group',true);

							if( $match_result != '' ){
								$output .= '<a class="results-link" href="'.get_permalink().'">';
								$output .= '<div class="row fixture-team-inner clearfix">';
		                        $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
		                            $output .= '<img width="40" class="pull-left" src="'.esc_url( themeum_logo_url_by_id($team_1["themeum_club_name1"]) ).'" alt="'.esc_attr( themeum_get_title_by_id($team_1["themeum_club_name1"]) ).'"> ';
		                            $output .= '<h4>'.esc_attr( themeum_get_title_by_id($team_1["themeum_club_name1"]) ).'</h4>';
		                        $output .= '</div>';
		                        
		                        $gmt = get_post_meta(get_the_ID(),'themeum_gmt',true);
		                        $sports_date = date_format(date_create(get_post_meta(get_the_ID(),"themeum_datetime",true)), 'd M Y h:i A').' '.esc_attr( $gmt );
		                        
		                        $output .= '<div class="col-xs-4 col-sm-4 status text-center"> '.esc_attr( $match_result ).' <span class="match-date">'.esc_attr(date_i18n( 'Y-M-d h:i A', strtotime($sports_date))).'</span></div> ';
		                        $output .= '<div class="col-xs-4 col-sm-4 text-right">';
		                            $output .= '<img width="40" class="pull-right" src="'.esc_url( themeum_logo_url_by_id($team_2["themeum_club_name2"]) ).'" alt="'.esc_attr( themeum_get_title_by_id($team_2["themeum_club_name2"]) ).'">';
		                            $output .= '<h4>'.esc_attr( themeum_get_title_by_id($team_2["themeum_club_name2"]) ).'</h4>                                           ';
		                        $output .= '</div>                                            ';
		                    	$output .= '</div>';
		                    	$output .= '</a>';
							}
							
						}
					wp_reset_postdata();

                $output .= '</div>';
            	$output .= '</div>';



	return $output;
}


//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Match Result", "themeum-soccer"),
		"base" => "match_reasult",
		'icon' => 'icon-thm-reasult',
		"class" => "",
		"description" => "Themeum Match Reasult Shortocde",
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
				"heading" => __("Put here Group Slug", "themeum-soccer"),
				"param_name" => "group_id",
				"description" => __("Put here Group Slug", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Number of Reasult Show", "themeum-soccer"),
				"param_name" => "reasult_number",
				"description" => __("Number of Reasult Show", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Add External Class", "themeum-soccer"),
				"param_name" => "class",
				"value" => "",
				),

			)

		));
}