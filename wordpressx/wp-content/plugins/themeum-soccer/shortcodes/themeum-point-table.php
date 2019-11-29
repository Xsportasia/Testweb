<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_shortcode('point_table','themeum_point_table');
function sort_by_points($a, $b){
    return $b['themeum_points'] - $a['themeum_points'];
}
function sort_by_goal_difference2($a, $b){
    return $b['themeum_goals_difference'] - $a['themeum_goals_difference'];
}

function themeum_point_table($atts, $content){
	
	extract(shortcode_atts(array(
		'point_table_id' => ''
	), $atts));

	global $post;
	$args = array(
			'name'				=> $point_table_id,
			'post_type'			=> 'point_table',
			'posts_per_page' 	=> -1,
		);
	$posts = get_posts($args);

	$output = '<div class="point-table table-responsive">';
	$output .= '<table class="table table-striped">';
	
	foreach ($posts as $post){
		setup_postdata( $post );


	    $point_table    = get_post_meta(get_the_ID(),'point_table_group',true);
	    usort($point_table, 'sort_by_points');
	  

	    $frequent = array();
	    foreach ( $point_table as $value ){
	        if( !empty($frequent) ){
	            if( array_key_exists( $value['themeum_points'],$frequent ) ){
	                $frequent[$value['themeum_points']] = $frequent[$value['themeum_points']] + 1;    
	            }else{
	                $frequent[$value['themeum_points']] = 1;  
	            }
	        }else{
	            $frequent[$value['themeum_points']] = 1;
	        }
	    }

	    $serial_data = array();
	    $value_count = 0;
	    foreach ($frequent as $value) {
	        $serial_data[] = array_slice($point_table, $value_count, $value);   
	        $value_count = $value_count + $value; 
	    }

	    $marge_inline = array();
	    foreach ($serial_data as $value) {
	      usort($value, 'sort_by_goal_difference2');
	      $marge_inline[] = $value;
	    }

	    $all_point = array();
	    foreach ($marge_inline as $value1) {
	        foreach ($value1 as $value) {
	            $all_point[] = $value;
	        }
	    }
	    $i=1;

		$output .= '<thead class="point-table-head"><tr><th class="text-left">'.__('No','themeum-soccer').'</th><th class="text-left">'.__('TEAM','themeum-soccer').'</th><th>P</th><th>W</th><th>D</th><th>L</th><th>GS</th><th>GA</th><th>+/-</th><th>PTS</th></tr></thead>';
		$output .= '<tbody>';
		foreach ( $all_point as  $value ) {
			if ( $value['themeum_club_name'] ) {
				$output .= '<tr>';
				$output .= '<td class="text-left">'.$i.'</td>';
				$output .= '<td class="text-left"><img class="point-table-image" src="'.esc_url( themeum_logo_url_by_id($value['themeum_club_name']) ).'" alt="'.get_the_title($value['themeum_club_name']).'"><span>'.get_the_title($value['themeum_club_name']).'</span></td>';
				$output .= '<td>'.$value['themeum_games_played'].'</td>';
				$output .= '<td>'.$value['themeum_games_won'].'</td>';
				$output .= '<td>'.$value['themeum_games_drown'].'</td>';
				$output .= '<td>'.$value['themeum_games_lost'].'</td>';
				$output .= '<td>'.$value['themeum_goals_scored'].'</td>';
				$output .= '<td>'.$value['themeum_goals_against'].'</td>';
				$output .= '<td>'.$value['themeum_goals_difference'].'</td>';
				$output .= '<td>'.$value['themeum_points'].'</td>';
				$output .= '</tr>';

			$i++;	
			}
		}
		$output .= '</tbody>';
		

	}
	wp_reset_postdata();
	$output .= '</table>';
	$output .= '</div>';

	return $output;
}

//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Point Table", "themeum-soccer"),
		"base" => "point_table",
		'icon' => 'icon-thm-testimonial',
		"class" => "",
		"description" => "Themeum Point Table Setting",
		"category" => __("Themeum", "themeum-soccer"),
		"params" => array(

			array(
		        "type" => "dropdown",
		        "heading" => __("Select Point Table","themeum-soccer"),
		        "param_name" => "point_table_id",
		        "description" => __("Select Point Table", "themeum-soccer"),
		        "value" => themeum_all_point_table(), 
		        ),

			)

		));
}