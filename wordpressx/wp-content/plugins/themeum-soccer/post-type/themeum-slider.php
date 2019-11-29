<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Register post type Slider
 * @author Themeum
 * @return void
 */
function themeum_post_type_slider(){
	$labels = array(
		'name'                	=> _x( 'Slider', 'Slider', 'themeum-soccer' ),
		'singular_name'       	=> _x( 'Slider', 'Slider', 'themeum-soccer' ),
		'menu_name'           	=> __( 'Slider', 'themeum-soccer' ),
		'parent_item_colon'   	=> __( 'Parent Slider:', 'themeum-soccer' ),
		'all_items'           	=> __( 'All Slider', 'themeum-soccer' ),
		'view_item'           	=> __( 'View Slider', 'themeum-soccer' ),
		'add_new_item'        	=> __( 'Add New Slider', 'themeum-soccer' ),
		'add_new'             	=> __( 'New Slider', 'themeum-soccer' ),
		'edit_item'           	=> __( 'Edit Slider', 'themeum-soccer' ),
		'update_item'         	=> __( 'Update Slider', 'themeum-soccer' ),
		'search_items'        	=> __( 'Search Slider', 'themeum-soccer' ),
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
		'menu_icon'				=> 'dashicons-images-alt',
		'supports'           	=> array( 'title','thumbnail' )
		);

	register_post_type('slider',$args);

}

add_action('init','themeum_post_type_slider');


/**
 * View Message When Themeum Slider
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_soccer_update_message_slider( $messages ){
	
	global $post, $post_ID;

	$message['slider'] = array(
		0 => '',
		1 => sprintf( __('Slider updated. <a href="%s">View Slider</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-soccer' ),
		3 => __('Custom field deleted.', 'themeum-soccer' ),
		4 => __('Slider updated.', 'themeum-soccer' ),
		5 => isset($_GET['revision']) ? sprintf( __('Slider restored to revision from %s', 'themeum-soccer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Slider published. <a href="%s">View Slider</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Slider saved.', 'themeum-soccer' ),
		8 => sprintf( __('Slider submitted. <a target="_blank" href="%s">Preview Slider</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Slider scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slider</a>', 'themeum-soccer' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Slider draft updated. <a target="_blank" href="%s">Preview Slider</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}
add_filter( 'post_updated_messages', 'themeum_soccer_update_message_slider' );