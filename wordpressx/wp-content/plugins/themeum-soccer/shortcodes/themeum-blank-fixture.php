<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_shortcode('match_blank_fixture','themeum_blank_match_fixture');

function themeum_blank_match_fixture($atts, $content){
	
	extract(shortcode_atts(array(
		'team_1_group' => '',
		'team_2_group' => '',
		'home_ground'  => '',
		'datetime'		=> '',
		'title_table'  => '',
		'team1_type'	=> 'custom',
		'team2_type'	=> 'custom',
		'venue_type'	=> 'custom',
		'venue_name'	=> '',
		'team_1'		=> '',
		'team_2'		=> '',
		'padding'		=> '60px 0px',
	), $atts));

    $output = '<div class="fixture-teams" style="padding:'.esc_attr( $padding ).';">';
        $output .= '<div class="fixture-teams-list">';
            
	        if( $title_table != '' ){
	            $output .= '<div class="row">';
	                $output .= '<h3 class="fixture-title">'.esc_attr( $title_table ).'</h3>';
	            $output .= '</div>';            	
            }

                $output .= '<div class="row fixture-team-inner clearfix">';
                    
                	if( $team1_type == 'custom' ){
	                    $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
	                        $output .= '<img width="40" class="pull-left" src="'.THMRWMB_DIR.'/assets/images/blank-team-icon.png"> ';
	                        if($team_1_group){
	                        	$output .= '<h4>'.esc_attr($team_1_group).'</h4>';
	                        } 
	                    $output .= '</div>';
                	}else{
                		$output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
	                        $output .= '<img width="40" class="pull-left" src="'.esc_url( themeum_logo_url_by_id($team_1) ).'"> ';
	                        if($team_1_group){
	                        	$output .= '<h4>'.esc_attr( themeum_get_title_by_id($team_1) ).'</h4>';
	                        } 
	                    $output .= '</div>';	
                	}



                    $output .= '<div class="col-xs-4 col-sm-4 status text-center"> '.esc_html( $datetime );
                    	
                    if( $venue_type == 'custom' ){
                    	if($home_ground){
                    		$output .= '<span>'.esc_attr( $home_ground ).'</span>';
                    	}
                    }else{
                    	$output .= '<span>'.esc_attr( themeum_get_title_by_id($venue_name) ).'</span>';
                    }

                    $output .= '</div>';

                    if( $team2_type == 'custom' ){
	                    $output .= '<div class="col-xs-4 col-sm-4 text-right">';
	                        $output .= '<img width="40" class="pull-right" src="'.THMRWMB_DIR.'/assets/images/blank-team-icon.png"> ';
	                        if($team_2_group){
	                        	$output .= '<h4>'.esc_attr( $team_2_group ).'</h4>';
	                        }
	                    $output .= '</div>';
                	}else{
                		$output .= '<div class="col-xs-4 col-sm-4 text-right">';
	                        $output .= '<img width="40" class="pull-right" src="'.esc_url( themeum_logo_url_by_id($team_2) ).'"> ';
	                        if($team_2_group){
	                        	$output .= '<h4>'.esc_attr( themeum_get_title_by_id($team_2) ).'</h4>';
	                        }
	                    $output .= '</div>';
                	}


                $output .= '</div>';

        $output .= '</div>'; //fixture-teams-list
    $output .= '</div>'; //fixture-teams

	return $output;
}



function themeum_get_club_list(){

	$result = get_posts( array(
	    'posts_per_page'   => -1,
	    'offset'           => 0,
	    'orderby'          => 'post_date',
	    'order'            => 'DESC',
	    'post_type'        => 'club',
	    'post_status'      => 'publish'
	) );

	$list_project = array();

	foreach ($result as $post) {
	    $list_project[$post->ID] = $post->post_title;
	}
	$list_project = array_flip($list_project );

return $list_project;
}



//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {




	vc_map(array(
		"name" => __("Blank Fixture", "themeum-soccer"),
		"base" => "match_blank_fixture",
		'icon' => 'icon-thm-blank_fixture',
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
					"type" => "dropdown",
					"heading" => __("Select Type", "themeum-soccer"),
					"param_name" => "team1_type",
					"value" => array('Select'=>'','Custom'=>'custom','Dynamic'=>'dynamic'),
					),		


				array(
			        "type" => "textfield",
			        "heading" => __("Team 1 Name(Custom)","themeum-soccer"),
			        "param_name" => "team_1_group",
			        "description" => __("Brazil", "themeum-soccer"),
			        "value" => '',
			        "dependency" => Array("element" => "team1_type","value" => array("custom"))
			        ),
		

				// Team 1 listing
				array(
			        "type" => "dropdown",
			        "heading" => __("Team Name 1(Dynamic)","themeum-soccer"),
			        "param_name" => "team_1",
			        "description" => __("Eelect your Team Name", "themeum-soccer"),
			        "value" => themeum_get_club_list(),
			        "dependency" => Array("element" => "team1_type","value" => array("dynamic"))
			        ),

				array(
					"type" => "dropdown",
					"heading" => __("Select Type", "themeum-soccer"),
					"param_name" => "team2_type",
					"value" => array('Select'=>'','Custom'=>'custom','Dynamic'=>'dynamic'),
					),

				array(
			        "type" => "textfield",
			        "heading" => __("Team 2 Name(Custom)","themeum-soccer"),
			        "param_name" => "team_2_group",
			        "description" => __("Brazil", "themeum-soccer"),
			        "value" => '',
			        "dependency" => Array("element" => "team2_type","value" => array("custom"))
			        ),	

			    // Team 2 listing
				array(
			        "type" => "dropdown",
			        "heading" => __("Team Name 2(Dynamic)","themeum-soccer"),
			        "param_name" => "team_2",
			        "description" => __("Eelect your Team Name", "themeum-soccer"),
			        "value" => themeum_get_club_list(), 
			        "dependency" => Array("element" => "team2_type","value" => array("dynamic"))
			        ),				

				array(
			        "type" => "textfield",
			        "heading" => __("Date","themeum-soccer"),
			        "param_name" => "datetime",
			        "description" => __("23 April, 13:00 EST", "themeum-soccer"),
			        "value" => '', 
			        ),	

				array(
					"type" => "dropdown",
					"heading" => __("Venue Type", "themeum-soccer"),
					"param_name" => "venue_type",
					"value" => array('Select'=>'','Custom'=>'custom','Dynamic'=>'dynamic'),
					),

				array(
			        "type" => "textfield",
			        "heading" => __("Venue","themeum-soccer"),
			        "param_name" => "home_ground",
			        "description" => __("Allez", "themeum-soccer"),
			        "value" => '',
			        "dependency" => Array("element" => "venue_type","value" => array("custom"))
			        ),

				array(
			        "type" => "dropdown",
			        "heading" => __("Venue Name","themeum-soccer"),
			        "param_name" => "venue_name",
			        "description" => __("Eelect your Team Name", "themeum-soccer"),
			        "value" => themeum_get_club_list(),
			        "dependency" => Array("element" => "venue_type","element" => "venue_type","value" => array("dynamic"))
			        ),

				array(
			        "type" => "textfield",
			        "heading" => __("Padding","themeum-soccer"),
			        "param_name" => "padding",
			        "description" => __("ex: 60px 0px", "themeum-soccer"),
			        "value" => '', 
			        ),

			)

		));
}