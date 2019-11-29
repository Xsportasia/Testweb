<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Register post type Point Table
 * @author Themeum
 * @return void
 */
function themeum_post_type_point_table(){
	$labels = array(
		'name'                	=> _x( 'Point Table', 'Point Table', 'themeum-soccer' ),
		'singular_name'       	=> _x( 'Point Table', 'Point Table', 'themeum-soccer' ),
		'menu_name'           	=> __( 'Point Table', 'themeum-soccer' ),
		'parent_item_colon'   	=> __( 'Parent Point Table:', 'themeum-soccer' ),
		'all_items'           	=> __( 'All Point Table', 'themeum-soccer' ),
		'view_item'           	=> __( 'View Point Table', 'themeum-soccer' ),
		'add_new_item'        	=> __( 'Add New Point Table', 'themeum-soccer' ),
		'add_new'             	=> __( 'New Point Table', 'themeum-soccer' ),
		'edit_item'           	=> __( 'Edit Point Table', 'themeum-soccer' ),
		'update_item'         	=> __( 'Update Point Table', 'themeum-soccer' ),
		'search_items'        	=> __( 'Search Point Table', 'themeum-soccer' ),
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
		'menu_icon'				=> 'dashicons-grid-view',
		'supports'           	=> array( 'title','thumbnail' )
		);

	register_post_type('point_table',$args);

}

add_action('init','themeum_post_type_point_table');


/**
 * View Message When Point Table
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_point_table_update_message( $messages ){
	
	global $post, $post_ID;

	$message['point_table'] = array(
		0 => '',
		1 => sprintf( __('Point Table updated. <a href="%s">View Point Table</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-soccer' ),
		3 => __('Custom field deleted.', 'themeum-soccer' ),
		4 => __('Point Table updated.', 'themeum-soccer' ),
		5 => isset($_GET['revision']) ? sprintf( __('Point Table restored to revision from %s', 'themeum-soccer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Point Table published. <a href="%s">View Point Table</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Point Table saved.', 'themeum-soccer' ),
		8 => sprintf( __('Point Table submitted. <a target="_blank" href="%s">Preview Point Table</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Point Table scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Point Table</a>', 'themeum-soccer' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Point Table draft updated. <a target="_blank" href="%s">Preview Point Table</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}
add_filter( 'post_updated_messages', 'themeum_point_table_update_message' );




/**
 * Register fixture_reasult Category Taxonomies (For Group)
 *
 * @return void
 */

function themeum_soccer_register_team_group()
{
	$labels = array(
		'name'              	=> _x( 'Group Categories', 'taxonomy general name', 'themeum-soccer' ),
		'singular_name'     	=> _x( 'Group Category', 'taxonomy singular name', 'themeum-soccer' ),
		'search_items'      	=> __( 'Search Group Category', 'themeum-soccer' ),
		'all_items'         	=> __( 'All Group Category', 'themeum-soccer' ),
		'parent_item'       	=> __( 'Group Parent Category', 'themeum-soccer' ),
		'parent_item_colon' 	=> __( 'Group Parent Category:', 'themeum-soccer' ),
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

	register_taxonomy('point_group',array( 'point_table' ),$args);
}

add_action('init','themeum_soccer_register_team_group');



