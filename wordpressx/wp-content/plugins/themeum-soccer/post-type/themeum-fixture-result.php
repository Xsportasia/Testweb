<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Register post type Fixture-Reasult
 * @author Themeum
 * @return void
 */
function themeum_post_type_fixture_reasult(){
	$labels = array(
		'name'                	=> _x( 'Fixture & Result', 'Fixture & Result', 'themeum-soccer' ),
		'singular_name'       	=> _x( 'Fixture & Result', 'Fixture & Result', 'themeum-soccer' ),
		'menu_name'           	=> __( 'Fixture & Result', 'themeum-soccer' ),
		'parent_item_colon'   	=> __( 'Parent Fixture & Result:', 'themeum-soccer' ),
		'all_items'           	=> __( 'All Fixture & Result', 'themeum-soccer' ),
		'view_item'           	=> __( 'View Fixture & Result', 'themeum-soccer' ),
		'add_new_item'        	=> __( 'Add New Fixture & Result', 'themeum-soccer' ),
		'add_new'             	=> __( 'New Fixture & Result', 'themeum-soccer' ),
		'edit_item'           	=> __( 'Edit Fixture & Result', 'themeum-soccer' ),
		'update_item'         	=> __( 'Update Fixture & Result', 'themeum-soccer' ),
		'search_items'        	=> __( 'Search Fixture & Result', 'themeum-soccer' ),
		'not_found'           	=> __( 'No article found', 'themeum-soccer' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-soccer' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'rewrite' 				=> array( 'slug' => 'fixture_result' ),
		'menu_icon'				=> 'dashicons-list-view',
		'supports'           	=> array( 'title','editor','thumbnail','comments' )
		);
	register_post_type('fixture_reasult',$args);
}
add_action('init','themeum_post_type_fixture_reasult');


/**
 * View Message When Fixture & Reasult
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_fixture_reasult_update_message( $messages ){
	
	global $post, $post_ID;

	$message['fixture_reasult'] = array(
		0 => '',
		1 => sprintf( __('Fixture & Reasult updated. <a href="%s">View Fixture & Reasult</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-soccer' ),
		3 => __('Custom field deleted.', 'themeum-soccer' ),
		4 => __('Fixture & Reasult updated.', 'themeum-soccer' ),
		5 => isset($_GET['revision']) ? sprintf( __('Fixture & Reasult restored to revision from %s', 'themeum-soccer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Fixture & Reasult published. <a href="%s">View Fixture & Reasult</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Fixture & Reasult saved.', 'themeum-soccer' ),
		8 => sprintf( __('Fixture & Reasult submitted. <a target="_blank" href="%s">Preview Fixture & Reasult</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Fixture & Reasult scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Fixture & Reasult</a>', 'themeum-soccer' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Fixture & Reasult draft updated. <a target="_blank" href="%s">Preview Fixture & Reasult</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}
add_filter( 'post_updated_messages', 'themeum_fixture_reasult_update_message' );





/**
 * Register fixture_reasult Category Taxonomies (For Group)
 *
 * @return void
 */

function themeum_soccer_register_team_group_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Group Categories', 'taxonomy general name', 'themeum-soccer' ),
		'singular_name'     	=> _x( 'Group Category', 'taxonomy singular name', 'themeum-soccer' ),
		'search_items'      	=> __( 'Search Group Category', 'themeum-soccer' ),
		'all_items'         	=> __( 'All Group Category', 'themeum-soccer' ),
		'parent_item'       	=> __( 'Group Parent Category', 'themeum-soccer' ),
		'parent_item_colon' 	=> __( 'Group Parent Category:', 'themeum-lms' ),
		'edit_item'         	=> __( 'Edit Group Category', 'themeum-soccer' ),
		'update_item'       	=> __( 'Update Group Category', 'themeum-soccer' ),
		'add_new_item'      	=> __( 'Add New Group Category', 'themeum-soccer' ),
		'new_item_name'     	=> __( 'New Group Category Name', 'themeum-soccer' ),
		'menu_name'         	=> __( 'Group Category', 'themeum-soccer' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('team_group',array( 'fixture_reasult' ),$args);
}

add_action('init','themeum_soccer_register_team_group_taxonomy');




/**
 * Register fixture_reasult Category Taxonomies (For League)
 *
 * @return void
 */

function themeum_soccer_register_league_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'League Categories', 'taxonomy general name', 'themeum-soccer' ),
		'singular_name'     	=> _x( 'League Category', 'taxonomy singular name', 'themeum-soccer' ),
		'search_items'      	=> __( 'Search League Category', 'themeum-soccer' ),
		'all_items'         	=> __( 'All League Category', 'themeum-soccer' ),
		'parent_item'       	=> __( 'League Parent Category', 'themeum-soccer' ),
		'parent_item_colon' 	=> __( 'League Parent Category:', 'themeum-soccer' ),
		'edit_item'         	=> __( 'Edit League Category', 'themeum-soccer' ),
		'update_item'       	=> __( 'Update League Category', 'themeum-soccer' ),
		'add_new_item'      	=> __( 'Add New League Category', 'themeum-soccer' ),
		'new_item_name'     	=> __( 'New League Category Name', 'themeum-soccer' ),
		'menu_name'         	=> __( 'League Category', 'themeum-soccer' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true,
		'rewrite' => array(
            'slug' => 'league'
        ),
		);

	register_taxonomy('league',array( 'fixture_reasult','point_table' ),$args);
}

add_action('init','themeum_soccer_register_league_taxonomy');
