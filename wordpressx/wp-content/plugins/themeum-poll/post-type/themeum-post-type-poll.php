<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Admin functions for the Event post type
 *
 * @author 		Themeum
 * @category 	Admin
 * @package 	Themeum-poll
 * @version     1.0
 *-------------------------------------------------------------*/

/**
 * Register post type Teacher
 *
 * @return void
 */

function themeum_poll_post_type_poll()
{
	$labels = array( 
		'name'                	=> _x( 'Themeum Poll', 'Themeum Poll', 'themeum-poll' ),
		'singular_name'       	=> _x( 'Themeum Poll', 'Themeum Poll', 'themeum-poll' ),
		'menu_name'           	=> __( 'Themeum Poll', 'themeum-poll' ),
		'parent_item_colon'   	=> __( 'Parent Themeum Poll:', 'themeum-poll' ),
		'all_items'           	=> __( 'All Themeum Poll', 'themeum-poll' ),
		'view_item'           	=> __( 'View Themeum Poll', 'themeum-poll' ),
		'add_new_item'        	=> __( 'Add New Themeum Poll', 'themeum-poll' ),
		'add_new'             	=> __( 'New Themeum Poll', 'themeum-poll' ),
		'edit_item'           	=> __( 'Edit Themeum Poll', 'themeum-poll' ),
		'update_item'         	=> __( 'Update Themeum Poll', 'themeum-poll' ),
		'search_items'        	=> __( 'Search Themeum Poll', 'themeum-poll' ),
		'not_found'           	=> __( 'No article found', 'themeum-poll' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-poll' )
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
		'menu_icon'				=> 'dashicons-feedback',
		'supports'           	=> array( 'title','editor')
		);

	register_post_type('poll',$args);

}

add_action('init','themeum_poll_post_type_poll');


/**
 * View Message When Themeum Poll
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_poll_update_message_poll( $messages ){

	global $post, $post_ID;

	$message['poll'] = array(
		0 => '',
		1 => sprintf( __('Themeum Poll updated. <a href="%s">View Themeum Poll</a>', 'themeum-poll' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-poll' ),
		3 => __('Custom field deleted.', 'themeum-poll' ),
		4 => __('Themeum Poll updated.', 'themeum-poll' ),
		5 => isset($_GET['revision']) ? sprintf( __('Themeum Poll restored to revision from %s', 'themeum-poll' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Themeum Poll published. <a href="%s">View Themeum Poll</a>', 'themeum-poll' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Themeum Poll saved.', 'themeum-poll' ),
		8 => sprintf( __('Themeum Poll submitted. <a target="_blank" href="%s">Preview Themeum Poll</a>', 'themeum-poll' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Themeum Poll scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Themeum Poll</a>', 'themeum-poll' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Themeum Poll draft updated. <a target="_blank" href="%s">Preview Themeum Poll</a>', 'themeum-poll' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_poll_update_message_poll' );


