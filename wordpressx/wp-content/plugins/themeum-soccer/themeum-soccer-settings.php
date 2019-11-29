<?php
/**
 * Plugins Settings List
 *
 * @author 		Themeum
 * @category 	Admin Settings
 * @package 	Soccer
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * Soccer Single Template
 *
 * @return string
 */

function themeum_soccer_player_template($single_template) {
	global $post;
	if ($post->post_type == 'player') {
		$single_template = dirname( __FILE__ ) . '/templates/template-player.php';
	}
	return $single_template;
}
add_filter( "single_template", "themeum_soccer_player_template" ) ;

function themeum_soccer_club_template($single_template) {
	global $post;
	if ($post->post_type == 'club') {
		$single_template = dirname( __FILE__ ) . '/templates/template-club.php';
	}
	return $single_template;
}
add_filter( "single_template", "themeum_soccer_club_template" ) ;


function themeum_soccer_fixture_reasult_template($single_template) {
	global $post;
	if ($post->post_type == 'fixture_reasult') {
		$single_template = dirname( __FILE__ ) . '/templates/template-fixture_reasult.php';
	}	
	return $single_template;
}
add_filter( "single_template", "themeum_soccer_fixture_reasult_template" ) ;


    

add_filter('template_include', 'themeum_taxonomy_template');
function themeum_taxonomy_template( $template ){
    if( is_tax('league') ){
        $template = dirname( __FILE__ ).'/templates/taxonomy-league.php';
    }
    return $template;
}





function themeum_soccer_point_table_template($single_template) {
	global $post;
	if ($post->post_type == 'point_table') {
		$single_template = dirname( __FILE__ ) . '/templates/template-point_table.php';
	}
	return $single_template;
}
add_filter( "single_template", "themeum_soccer_point_table_template" ) ;