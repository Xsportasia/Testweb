<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Register post type Club
 * @author Themeum
 * @return void
 */
function themeum_post_type_club(){
	$labels = array(
		'name'                	=> _x( 'Club', 'Club', 'themeum-soccer' ),
		'singular_name'       	=> _x( 'Club', 'Club', 'themeum-soccer' ),
		'menu_name'           	=> __( 'Club', 'themeum-soccer' ),
		'parent_item_colon'   	=> __( 'Parent Club:', 'themeum-soccer' ),
		'all_items'           	=> __( 'All Club', 'themeum-soccer' ),
		'view_item'           	=> __( 'View Club', 'themeum-soccer' ),
		'add_new_item'        	=> __( 'Add New Club', 'themeum-soccer' ),
		'add_new'             	=> __( 'New Club', 'themeum-soccer' ),
		'edit_item'           	=> __( 'Edit Club', 'themeum-soccer' ),
		'update_item'         	=> __( 'Update Club', 'themeum-soccer' ),
		'search_items'        	=> __( 'Search Club', 'themeum-soccer' ),
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
		'menu_icon'				=> 'dashicons-screenoptions',
		'supports'           	=> array( 'title','editor','thumbnail' )
		);

	register_post_type('club',$args);

}

add_action('init','themeum_post_type_club');


/**
 * View Message When Club
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_club_update_message( $messages ){
	
	global $post, $post_ID;

	$message['club'] = array(
		0 => '',
		1 => sprintf( __('Club updated. <a href="%s">View Club</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-soccer' ),
		3 => __('Custom field deleted.', 'themeum-soccer' ),
		4 => __('Club updated.', 'themeum-soccer' ),
		5 => isset($_GET['revision']) ? sprintf( __('Club restored to revision from %s', 'themeum-soccer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Club published. <a href="%s">View Club</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Club saved.', 'themeum-soccer' ),
		8 => sprintf( __('Club submitted. <a target="_blank" href="%s">Preview Club</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Club scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Club</a>', 'themeum-soccer' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Club draft updated. <a target="_blank" href="%s">Preview Club</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}
add_filter( 'post_updated_messages', 'themeum_club_update_message' );