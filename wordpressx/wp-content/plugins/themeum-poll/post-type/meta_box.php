<?php
/**
 * Admin feature for Custom Meta Box
 *
 * @author 		Themeum
 * @category 	Admin Core
 * @package 	Varsity
 *-------------------------------------------------------------*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Registering meta boxes
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'themeum_poll_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */

function themeum_poll_register_meta_boxes( $meta_boxes ){

	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'themeum_';

	/**
	 * Register Post Meta for Poll Question Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'poll-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Poll Question Settings', 'themeum-poll' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'poll'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(

			array(
				'name'          => __( 'Poll Question Set', 'themeum-poll' ),
				'id'            => "{$prefix}poll_question",
				'desc'			=> __( 'Poll Question Set', 'themeum-poll' ),
				'type'          => 'text',
				'std'           => '',
				'clone'			=> true
			),	

		)
	);


	return $meta_boxes;
}