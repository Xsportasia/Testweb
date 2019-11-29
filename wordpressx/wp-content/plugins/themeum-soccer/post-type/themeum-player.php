<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Register post type Player
 * @author Themeum
 * @return void
 */
function themeum_post_type_player(){
	$labels = array(
		'name'                	=> _x( 'Player', 'Player', 'themeum-soccer' ),
		'singular_name'       	=> _x( 'Player', 'Player', 'themeum-soccer' ),
		'menu_name'           	=> __( 'Player', 'themeum-soccer' ),
		'parent_item_colon'   	=> __( 'Parent Player:', 'themeum-soccer' ),
		'all_items'           	=> __( 'All Player', 'themeum-soccer' ),
		'view_item'           	=> __( 'View Player', 'themeum-soccer' ),
		'add_new_item'        	=> __( 'Add New Player', 'themeum-soccer' ),
		'add_new'             	=> __( 'New Player', 'themeum-soccer' ),
		'edit_item'           	=> __( 'Edit Player', 'themeum-soccer' ),
		'update_item'         	=> __( 'Update Player', 'themeum-soccer' ),
		'search_items'        	=> __( 'Search Player', 'themeum-soccer' ),
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
		'menu_icon'				=> 'dashicons-groups',
		'supports'           	=> array( 'title','editor','thumbnail' )
		);

	register_post_type('player',$args);

}

add_action('init','themeum_post_type_player');


/**
 * View Message When Themeum Player
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_soccer_update_message( $messages ){
	
	global $post, $post_ID;

	$message['player'] = array(
		0 => '',
		1 => sprintf( __('Player updated. <a href="%s">View Player</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-soccer' ),
		3 => __('Custom field deleted.', 'themeum-soccer' ),
		4 => __('Player updated.', 'themeum-soccer' ),
		5 => isset($_GET['revision']) ? sprintf( __('Player restored to revision from %s', 'themeum-soccer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Player published. <a href="%s">View Player</a>', 'themeum-soccer' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Player saved.', 'themeum-soccer' ),
		8 => sprintf( __('Player submitted. <a target="_blank" href="%s">Preview Player</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Player scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Player</a>', 'themeum-soccer' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Player draft updated. <a target="_blank" href="%s">Preview Player</a>', 'themeum-soccer' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}
add_filter( 'post_updated_messages', 'themeum_soccer_update_message' );