<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_shortcode('themeum_league','themeum_league_data');

function themeum_league_data($atts, $content){
	
	extract(shortcode_atts(array(
		'title' 		=>	'',
		'fixture'		=>	'',
		'fixture_id'	=>	'',
		'result'		=>	'',
		'result_id'		=>	'',
		'standings'		=>	'',
		'standings_id'	=>	'',
		'teams'			=>	'',
		'teams_id'		=>	'',
	), $atts));

$output = '';




$output .= '<div class="match-details">';
	$output .= '<div class="container">';
	    $output .= '<div class="match-details-inner">';
	        $output .= '<div class="match-details-tab" role="tabpanel">';
	            

	            $output .= '<div class="fixture-middles text-center">';
	                $output .= '<h3>'.esc_attr($title).'</h3>';
	            $output .= '</div>';
	            
	            $output .= '<ul class="nav nav-tabs match-details-tab-nav" role="tablist">';
	                if( $fixture_id != '' ){ $output .= '<li role="presentation" class="active"><a href="#fixtures" aria-controls="fixtures" role="tab" data-toggle="tab">'.esc_attr($fixture).'</a></li>'; }
	                if( $result_id != '' ){ $output .= '<li role="presentation"><a href="#results" aria-controls="results" role="tab" data-toggle="tab">'.esc_attr($result).'</a></li>'; }
	                if( $standings_id != '' ){ $output .= '<li role="presentation"><a href="#standings" aria-controls="standings" role="tab" data-toggle="tab">'.esc_attr($standings).'</a></li>'; }
	                if( $teams_id != '' ){ $output .= '<li role="presentation"><a href="#teams" aria-controls="teams" role="tab" data-toggle="tab">'.esc_attr($teams).'</a></li>'; }
	            $output .= '</ul>';


	            $output .= '<div class="tab-content match-details-tab-content">';




	                /* ********************************* Fixture *********************************** */
	                if( $fixture_id != '' ){
		                $output .= '<div role="tabpanel" class="tab-pane fade in active" id="fixtures">';
		                	
		                	$args = array(
	                                      'post_type'     => 'page',
	                                      'posts_per_page'  => 1,
	                                      'name'		=> $fixture_id
	                                    );
	                        $posts = get_posts($args);

                              foreach ($posts as $post){
                                setup_postdata( $post );
                                	$output .= apply_filters('the_content', get_the_content());
                                    }
                              wp_reset_postdata();

		                $output .= '</div>'; 
	                }
	                /* ********************************* Fixture *********************************** */




	                /* ********************************* Results *********************************** */
	                if( $result_id != '' ){
		                $output .= '<div role="tabpanel" class="tab-pane fade in" id="results">';
		                    
		                    $args = array(
	                                      'post_type'     => 'page',
	                                      'posts_per_page'  => 1,
	                                      'name'		=> $result_id
	                                    );
	                        $posts = get_posts($args);

                              foreach ($posts as $post){
                                setup_postdata( $post );
                                	$output .= apply_filters('the_content', get_the_content());
                                    }
                              wp_reset_postdata();

		                $output .= '</div>';
	            	}
	                /* ********************************* Results *********************************** */



	                /* ********************************* Standing *********************************** */
	                if( $standings_id != '' ){
		                $output .= '<div role="tabpanel" class="tab-pane fade in" id="standings">';
		                    
		                    $args = array(
	                                      'post_type'     => 'page',
	                                      'posts_per_page'  => 1,
	                                      'name'		=> $standings_id
	                                    );
	                        $posts = get_posts($args);

                              foreach ($posts as $post){
                                setup_postdata( $post );
                                	$output .= apply_filters('the_content', get_the_content());
                                    }
                              wp_reset_postdata();

		                $output .= '</div>';
		            }
	                /* ********************************* Standing *********************************** */




	                /* ********************************* Team Start ********************************* */
	                if( $teams_id != '' ){
		                $output .= '<div role="tabpanel" class="tab-pane fade in" id="teams">';
		                    
		                    $args = array(
	                                      'post_type'     => 'page',
	                                      'posts_per_page'  => 1,
	                                      'name'		=> $teams_id
	                                    );
	                        $posts = get_posts($args);

                              foreach ($posts as $post){
                                setup_postdata( $post );
                                	$output .= apply_filters('the_content', get_the_content());
                                    }
                              wp_reset_postdata();

		                $output .= '</div>';
	            	}
	                /* ********************************* Team Start ********************************* */



	            $output .= '</div>';


	        $output .= '</div>';
	    $output .= '</div>';
	$output .= '</div>';
$output .= '</div>';




return $output;
}


//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("League", "themeum-soccer"),
		"base" => "themeum_league",
		'icon' => 'icon-thm-reasult',
		"class" => "",
		"description" => "Themeum League Information Shortocde",
		"category" => __("Themeum", "themeum-soccer"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Put Here Main Title", "themeum-soccer"),
				"param_name" => "title",
				"description" => __("Put here Title", "themeum-soccer"),
				"value" => "",
				),




			array(
				"type" => "textfield",
				"heading" => __("Fixture Title", "themeum-soccer"),
				"param_name" => "fixture",
				"description" => __("Put here Title", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Select Fixture Page", "themeum-soccer"),
				"param_name" => "fixture_id",
				"description" => __("Select The Fixture Page.", "themeum-soccer"),
				"value" => themeum_all_page_list(),
				),





			array(
				"type" => "textfield",
				"heading" => __("Result Title", "themeum-soccer"),
				"param_name" => "result",
				"description" => __("Put here Result Title", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Select Result Page", "themeum-soccer"),
				"param_name" => "result_id",
				"description" => __("Select The Result Page.", "themeum-soccer"),
				"value" => themeum_all_page_list(),
				),




			array(
				"type" => "textfield",
				"heading" => __("Standings Title", "themeum-soccer"),
				"param_name" => "standings",
				"description" => __("Put here Standings Title", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Select Standings Page", "themeum-soccer"),
				"param_name" => "standings_id",
				"description" => __("Select The Standings Page.", "themeum-soccer"),
				"value" => themeum_all_page_list(),
				),




			array(
				"type" => "textfield",
				"heading" => __("Teams Title", "themeum-soccer"),
				"param_name" => "teams",
				"description" => __("Put here Teams Title", "themeum-soccer"),
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Select Teams Page", "themeum-soccer"),
				"param_name" => "teams_id",
				"description" => __("Select The Teams Page.", "themeum-soccer"),
				"value" => themeum_all_page_list(),
				),



			)

		));
}