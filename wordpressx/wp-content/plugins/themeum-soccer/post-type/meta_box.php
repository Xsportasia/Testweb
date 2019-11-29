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

add_filter( 'rwmb_meta_boxes', 'themeum_soccer_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */

function themeum_soccer_register_meta_boxes( $meta_boxes ){

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
		'id' 		=> 'player-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Player Profile Settings', 'themeum-soccer' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'player'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(

			array(
				'name'  		=> __( 'Top Player', 'themeum-soccer' ),
				'id'    		=> "themeum_soccer_top_player",
				'desc'  		=> __( 'Top Player', 'themeum-soccer' ),
				'type'  		=> 'checkbox',
				'std'   		=> 0
			),	

			array(
				'name'          => __( 'Full Name', 'themeum-soccer' ),
				'id'            => "themeum_full_name",
				'desc'			=> __( 'Full Name', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),

			// Present player imag
			array(
				'name'             => __( 'Player Image', 'themeum-soccer' ),
				'id'               => "themeum_player_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array(
				'name'          => __( 'Select Position', 'themeum-soccer' ),
				'id'            => "themeum_position",
				'desc'			=> __( 'Select Position of the Player', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
				),

			// Number of Jersey 
			array(
				'name'          => __( 'Jersey Number', 'themeum-soccer' ),
				'id'            => "jersey_number",
				'desc'			=> __( 'Jersey Number', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),

			// Number of match Played
			array(
				'name'          => __( 'Match Played', 'themeum-soccer' ),
				'id'            => "themeum_match_played",
				'desc'			=> __( 'Match Played(ex: 32)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),

			// Present Club Logo
			array(
				'name'             => __( 'Present Club Logo', 'themeum-soccer' ),
				'id'               => "themeum_club_logo",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),

			array(
					'name'   => __( '<b>Player Info</b>', 'themeum-soccer' ),
					'id'     => 'personal_info_group',
					'type'   => 'group',
					'fields' => array(			
							array(
								'name'          => __( 'Player Information Level', 'themeum-soccer' ),
								'id'            => "themeum_information_level",
								'desc'			=> __( 'Player Information Level(ex: Weight)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),

							array(
								'name'          => __( 'Player Information Data', 'themeum-soccer' ),
								'id'            => "themeum_information_data",
								'desc'			=> __( 'Player Information Data(ex: 65kg)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),			
					),
					'clone'  => true,
				),



			array(
					'name'   => __( '<b>Player Statistics</b>', 'themeum-soccer' ),
					'id'     => 'personal_statistics_group',
					'type'   => 'group',
					'fields' => array(			
							array(
								'name'          => __( 'Player Statistics Level', 'themeum-soccer' ),
								'id'            => "themeum_statistics_level",
								'desc'			=> __( 'Player Statistics Level(ex: Total Matches)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),

							array(
								'name'          => __( 'Player Statistics Statistics', 'themeum-soccer' ),
								'id'            => "themeum_statistics_data",
								'desc'			=> __( 'Player Statistics statistics(ex: 62)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),			
					),
					'clone'  => true,
				),
	


			array(
				'name'          => __( 'Social Profile(facebook)', 'themeum-soccer' ),
				'id'            => "themeum_facebook",
				'desc'			=> __( 'Social Profile(facebook)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),
			array(
				'name'          => __( 'Social Profile(twitter)', 'themeum-soccer' ),
				'id'            => "themeum_twitter",
				'desc'			=> __( 'Social Profile(twitter)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),
			array(
				'name'          => __( 'Social Profile(google_plus)', 'themeum-soccer' ),
				'id'            => "themeum_google_plus",
				'desc'			=> __( 'Social Profile(google_plus)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),
			array(
				'name'          => __( 'Social Profile(instagram)', 'themeum-soccer' ),
				'id'            => "themeum_instagram",
				'desc'			=> __( 'Social Profile(instagram)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),
			array(
				'name'          => __( 'Social Profile(youtube)', 'themeum-soccer' ),
				'id'            => "themeum_youtube",
				'desc'			=> __( 'Social Profile(youtube)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),
			array(
				'name'          => __( 'Social Profile(vimeo)', 'themeum-soccer' ),
				'id'            => "themeum_vimeo",
				'desc'			=> __( 'Social Profile(vimeo)', 'themeum-soccer' ),
				'type'          => 'text',
				'std'           => '',
			),
			


		)
	);


	

	$meta_boxes[] = array(
		'id' 		=> 'club-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Club Settings', 'themeum-soccer' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'club'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(
							// Club Banner
							array(
								'name'             => __( 'Club Banner', 'themeum-soccer' ),
								'id'               => "themeum_club_banner",
								'type'             => 'image_advanced',
								'max_file_uploads' => 1,
							),	

							// Club Type
							array(
								'name'          => __( 'Club Type', 'themeum-soccer' ),
								'id'            => "themeum_club_type",
								'desc'			=> __( 'Club Type Ex. Football', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),	

							//Squad List
							array(
								'name'       => __( 'Squad List', 'themeum-soccer' ),
								'id'         => 'themeum_squads',
								'type'       => 'post',
								'post_type'  => 'player',
								'field_type' => 'select_advanced',
								'query_args' => array(
									'post_status'    => 'publish',
									'posts_per_page' => '-1',
								),
								'multiple'    => true,
							),					

							// Club Information	
							array(
									'name'   => __( '<b>Club Information</b>', 'themeum-soccer' ),
									'id'     => 'club_info_group',
									'type'   => 'group',
									'fields' => array(			
											array(
												'name'          => __( 'Club Information Level', 'themeum-soccer' ),
												'id'            => "themeum_club_information_level",
												'desc'			=> __( 'Club Information Level(ex: Name)', 'themeum-soccer' ),
												'type'          => 'text',
												'std'           => '',
											),

											array(
												'name'          => __( 'Club Information Data', 'themeum-soccer' ),
												'id'            => "themeum_club_information_data",
												'desc'			=> __( 'Club Information Data(ex: Barcelona)', 'themeum-soccer' ),
												'type'          => 'text',
												'std'           => '',
											),			
									),
									'clone'  => true,
								),

							//social button	
							array(
								'name'          => __( 'Social Profile(facebook)', 'themeum-soccer' ),
								'id'            => "themeum_club_facebook",
								'desc'			=> __( 'Social Profile(facebook)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),
							array(
								'name'          => __( 'Social Profile(twitter)', 'themeum-soccer' ),
								'id'            => "themeum_club_twitter",
								'desc'			=> __( 'Social Profile(twitter)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),
							array(
								'name'          => __( 'Social Profile(google_plus)', 'themeum-soccer' ),
								'id'            => "themeum_club_google_plus",
								'desc'			=> __( 'Social Profile(google_plus)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),
							array(
								'name'          => __( 'Social Profile(instagram)', 'themeum-soccer' ),
								'id'            => "themeum_club_instagram",
								'desc'			=> __( 'Social Profile(instagram)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),
							array(
								'name'          => __( 'Social Profile(youtube)', 'themeum-soccer' ),
								'id'            => "themeum_club_youtube",
								'desc'			=> __( 'Social Profile(youtube)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),
							array(
								'name'          => __( 'Social Profile(vimeo)', 'themeum-soccer' ),
								'id'            => "themeum_club_vimeo",
								'desc'			=> __( 'Social Profile(vimeo)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),						

							//Honour
							array(
								'name'   => __( '<b>Honours Fields</b>', 'themeum-soccer' ),
								'id'     => 'honours_group',
								'type'   => 'group',
								'fields' => array(	
									array(
										'name' => __( 'League Title Number', 'themeum-soccer' ),
										'id'   => 'themeum_title_number',
										'desc' => __( 'League Title Number', 'themeum-soccer' ),
										'type' => 'text',
										'std'  => '',
									),
									array(
										'name' => __( 'League Title', 'themeum-soccer' ),
										'id'   => 'themeum_league',
										'desc' => __( 'League Title', 'themeum-soccer' ),
										'type' => 'text',
										'std'  => '',
									),
									array(
										'name'          => __( 'Year List', 'themeum-soccer' ),
										'id'            => "themeum_year_list",
										'desc'			=> __( 'Year List (ex: 2011,2013)', 'themeum-soccer' ),
										'type'          => 'textarea',
										'std'           => '',
									),
													
								),
								'clone'  => true,
							),
							
							// photo gallery
							array(
								'name'             => __( 'Photo Gallery Image Upload', 'themeum-soccer' ),
								'id'               => "themeum_club_gallery_images",
								'type'             => 'image_advanced',
								'max_file_uploads' => 80,
							),

							// Jersey
							array(
									'name'   => __( '<b>Jersey Kit</b>', 'themeum-soccer' ),
									'id'     => 'jersey_group',
									'type'   => 'group',
									'fields' => array(			
											array(
												'name'          => __( 'Jersey Type', 'themeum-soccer' ),
												'id'            => "jersey_type",
												'desc'			=> __( 'Jersey Type(ex: Home Kit)', 'themeum-soccer' ),
												'type'          => 'text',
												'std'           => '',
											),

											// Club Banner URL
											array(
												'name' => __( 'Jersey Image URL', 'themeum-soccer' ),
												'id'   => "themeum_club_jersey",
												'desc' => __( 'Jersey Image URL Description', 'themeum-soccer' ),
												'type' => 'url',
												'std'  => '',
											),	
											array(
												'name' => __( 'Jersey Image LINK', 'themeum-soccer' ),
												'id'   => "themeum_club_jersey_link",
												'desc' => __( 'Jersey Image Link', 'themeum-soccer' ),
												'type' => 'url',
												'std'  => '',
											),	

									),
									'clone'  => true,
								),



		)
	);




	$meta_boxes[] = array(
		
		'id' 		=> 'fixture-reasult-post-meta',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Fixture Result Settings', 'themeum-soccer' ),
		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'fixture_reasult'),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',
		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,
		// List of meta fields
		'fields' 	=> array(
						// Team One
						array(
								'name'   => __( '<b>Team 1</b>', 'themeum-soccer' ),
								'id'     => 'team_1_group',
								'type'   => 'group',
								'fields' => array(		
										array(
												'name'       => __( 'Club Name', 'themeum-soccer' ),
												'id'         => 'themeum_club_name1',
												'desc' => __( 'Club Name', 'themeum-soccer' ),
												'type'       => 'post',
												'post_type'  => 'club',
												'field_type' => 'select_advanced',
												'query_args' => array(
													'post_status'    => 'publish',
													'posts_per_page' => '-1',
												),
												'multiple'    => false
											),
										array(
												'name'       => __( 'Player List', 'themeum-soccer' ),
												'id'         => 'themeum_player_list1',
												'desc' => __( 'Player List', 'themeum-soccer' ),
												'type'       => 'post',
												'post_type'  => 'player',
												'field_type' => 'select_advanced',
												'query_args' => array(
													'post_status'    => 'publish',
													'posts_per_page' => '-1',
												),
												'multiple'    => true
											),
										array(
												'name'       => __( 'Substitutes Player List', 'themeum-soccer' ),
												'id'         => 'themeum_substitutes_player_list',
												'desc' => __( 'Substitutes Player List', 'themeum-soccer' ),
												'type'       => 'post',
												'post_type'  => 'player',
												'field_type' => 'select_advanced',
												'query_args' => array(
													'post_status'    => 'publish',
													'posts_per_page' => '-1',
												),
												'multiple'    => true
											),
										// Club Formation
										array(
											'name' => __( 'Club Formation', 'themeum-soccer' ),
											'id'   => 'themeum_formation1',
											'desc' => __( 'Club Formation', 'themeum-soccer' ),
											'type' => 'text',
											'std'  => "4-4-2",
											),		
											
										),
								
							),
						
						// Team Two
						array(
								'name'   => __( '<b>Team 2</b>', 'themeum-soccer' ),
								'id'     => 'team_2_group',
								'type'   => 'group',
								'fields' => array(	
											//club name
											array(
													'name'       => __( 'Club Name', 'themeum-soccer' ),
													'id'         => 'themeum_club_name2',
													'desc' => __( 'Club Name', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'club',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
													'multiple'    => false
												),
											//player list
											array(
													'name'       => __( 'Player List', 'themeum-soccer' ),
													'id'         => 'themeum_player_list2',
													'desc' => __( 'Player List', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
													'multiple'    => true
												),
											//Substitutes Player List
											array(
													'name'       => __( 'Substitutes Player List', 'themeum-soccer' ),
													'id'         => 'themeum_substitutes_player_list2',
													'desc' => __( 'Substitutes Player List', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
													'multiple'    => true
												),
											// Club Formation
											array(
												'name' => __( 'Club Formation', 'themeum-soccer' ),
												'id'   => 'themeum_formation2',
												'desc' => __( 'Club Formation', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "4-4-2",
												),			
												
											),
											
											
								
							),

							
							// Date Time
							array(
								'name'       => __( 'Match Datetime', 'themeum-soccer' ),
								'id'         => 'themeum_datetime',
								'type'       => 'datetime',
								'js_options' => array(
									'stepMinute'     => 1,
									'showTimepicker' => true,
								),
							),

							// Date Time GMT
							array(
								'name'      => __( 'Time GMT', 'themeum-soccer' ),
								'id'        => 'themeum_gmt',
								'type'      => 'text',
								'std'  		=> "",
								'placeholder' => __( 'Time GMT Ex(GMT 6+)', 'themeum-soccer' ),
							),


							// Final Goal
							array(
								'name'      => __( 'Final Goal', 'themeum-soccer' ),
								'id'        => 'themeum_goal_count',
								'type'      => 'text',
								'std'  		=> "",
								'placeholder' => __( 'Final Goal Team1:Team2 Ex(3:2)', 'themeum-soccer' ),
							),


							//Club Name
							array(
									'name'       => __( 'Home Ground Club Name', 'themeum-soccer' ),
									'id'         => 'themeum_home_ground',
									'desc' => __( 'Club Name', 'themeum-soccer' ),
									'type'       => 'post',
									'post_type'  => 'club',
									'field_type' => 'select_advanced',
									'query_args' => array(
										'post_status'    => 'publish',
										'posts_per_page' => '-1',
									),
									'multiple'    => false
								),

							

							// Match Result
							array(
								'name'   => __( '<b>Match Result</b>', 'themeum-soccer' ),
								'id'     => 'match_result_group',
								'type'   => 'group',
								'clone'  => true,
								'fields' => array(
											
											// Club 1 Total Goal
											array(
												'name' => __( 'Team 1', 'themeum-soccer' ),
												'id'   => 'themeum_team1_data',
												'desc' => __( 'Put Here Team 1 Data', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "",
												),
											// Type Of Moment
											array(
												'name'        => __( 'Select Type', 'themeum-soccer' ),
												'id'          => 'themeum_select',
												'type' => 'text',
												'std'  => "",
												),
											// Club 2 Total Goal
											array(
												'name' => __( 'Team 2', 'themeum-soccer' ),
												'id'   => 'themeum_team2_data',
												'desc' => __( 'Put Here Team 2 Data', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "",
												),	
											
								),			
								
							),

							// Goal Timing
							array(
								'name'   => __( '<b>Goal Timing And Goal Details</b>', 'themeum-soccer' ),
								'id'     => 'goal_timing_group',
								'type'   => 'group',
								'clone'  => true,
								'fields' => array(

											// SELECT Team
											array(
												'name'        => __( 'Select Team', 'themeum-soccer' ),
												'id'          => "themeum_select_team",
												'type'        => 'select',
												'options'     => array(
													'value1' => __( 'Team 1', 'themeum-soccer' ),
													'value2' => __( 'Team 2', 'themeum-soccer' ),
												),
												'multiple'    => false,
												'placeholder' => __( 'Select Team', 'themeum-soccer' ),
											),
											
											// Time of Goal 
											array(
												'name' => __( 'Time of Goal', 'themeum-soccer' ),
												'id'   => 'themeum_time_of_goal',
												'desc' => __( 'Time of Goal (ex: 45) in minutes', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "",
												),
											
											//Player Select
											array(
													'name'       => __( 'Player List', 'themeum-soccer' ),
													'id'         => 'themeum_goal_player',
													'desc' 		 => __( 'Player List', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
												),		
								),			
								
							),







							
							// Time of Goal 
							array(
								'name' => __( 'Extra Time', 'themeum-soccer' ),
								'id'   => 'themeum_extra_time',
								'desc' => __( 'Time of Goal (ex: 45) in minutes', 'themeum-soccer' ),
								'type' => 'text',
								'std'  => "",
								),
							
							
							// Goal Timing Extra Time
							array(
								'name'   => __( '<b>Extra Timing Goal:</b>', 'themeum-soccer' ),
								'id'     => 'goal_extra_timing',
								'type'   => 'group',
								'clone'  => true,
								'fields' => array(

											// SELECT Team
											array(
												'name'        => __( 'Select Team', 'themeum-soccer' ),
												'id'          => "themeum_extra_select_team",
												'type'        => 'select',
												'options'     => array(
													'value1' => __( 'Team 1', 'themeum-soccer' ),
													'value2' => __( 'Team 2', 'themeum-soccer' ),
												),
												'multiple'    => false,
												'placeholder' => __( 'Select Team', 'themeum-soccer' ),
											),
											
											// Time of Goal 
											array(
												'name' => __( 'Time of Goal', 'themeum-soccer' ),
												'id'   => 'themeum_extra_time_of_goal',
												'desc' => __( 'Time of Goal (ex: 45) in minutes', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "",
												),
											
											//Player Select
											array(
													'name'       => __( 'Player List', 'themeum-soccer' ),
													'id'         => 'themeum_extra_goal_player',
													'desc' 		 => __( 'Player List', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
												),		
								),			
								
							),











						
							// Match Timeline
							array(
								'name'   => __( '<b>Match Timeline</b>', 'themeum-soccer' ),
								'id'     => 'match_timeline',
								'type'   => 'group',
								'clone'  => true,
								'fields' => array(
											
											// Time of Goal 
											array(
												'name' => __( 'Timeline Time', 'themeum-soccer' ),
												'id'   => 'themeum_timeline_time',
												'desc' => __( 'Timeline Time (ex: 45) in minutes', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "",
												),

											// Type Of Moment
											array(
												'name'        => __( 'Select Type', 'themeum-soccer' ),
												'id'          => 'themeum_select',
												'type'        => 'select',
												'options'     => array(
																	'Yellow Card'	=> __( 'Yellow Card','themeum-soccer' ),
																	'Double Yellow'	=> __( 'Double Yellow','themeum-soccer' ),
																	'Red Card'	=> __( 'Red Card','themeum-soccer' ),
																	'Free Kick'	=> __( 'Free Kick','themeum-soccer' ),
																	'Panalty'	=> __( 'Panalty','themeum-soccer' ),
																	'Corner Kick'	=> __( 'Corner Kick','themeum-soccer' ),
																	'Goal'	=> __( 'Goal','themeum-soccer' ),
																	'Goal Shot'	=> __( 'Goal Shot','themeum-soccer' ),
																	'Foul'	=> __( 'Foul','themeum-soccer' ),
																	'Handball'	=> __( 'Handball','themeum-soccer' ),
																	'Start First Half'	=> __( 'Start First Half','themeum-soccer' ),
																	'Start Second Half'	=> __( 'Start Second Half','themeum-soccer' ),
																	'Throw'	=> __( 'Throw','themeum-soccer' ),
																	'Off Side'	=> __( 'Off Side','themeum-soccer' ),
																	'Extra Time 1'	=> __( 'Extra Time 1','themeum-soccer' ),
																	'Extra Time 2'	=> __( 'Extra Time 2','themeum-soccer' ),
																),
												),
											
											//Player list
											array(
													'name'       => __( 'Player List', 'themeum-soccer' ),
													'id'         => 'themeum_player',
													'desc' => __( 'Player List', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
													'std'  => "",
													'multiple'    => false
												),

													
								),			
								
							),
							// Substitutes
							array(
								'name'   => __( '<b>Match Substitutes</b>', 'themeum-soccer' ),
								'id'     => 'match_substitutes',
								'type'   => 'group',
								'clone'  => true,
								'fields' => array(
											// Time of Goal 
											array(
												'name' => __( 'Timeline Time', 'themeum-soccer' ),
												'id'   => 'themeum_timeline_time',
												'desc' => __( 'Timeline Time (ex: 45) in minutes', 'themeum-soccer' ),
												'type' => 'text',
												'std'  => "",
												),

											// SELECT Team
											array(
												'name'        => __( 'Select Team', 'your-prefix' ),
												'id'          => "themeum_select_team",
												'type'        => 'select',
												'options'     => array(
													'value1' => __( 'Team 1', 'themeum-soccer' ),
													'value2' => __( 'Team 2', 'themeum-soccer' ),
												),
												'multiple'    => false,
												'placeholder' => __( 'Select Team', 'themeum-soccer' ),
											),

											
											//Player Substitutes in
											array(
													'name'       => __( 'Player in(Substitutes)', 'themeum-soccer' ),
													'id'         => 'themeum_player_in',
													'desc' => __( 'Player in(Substitutes)', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
													'std'  => "",
													'multiple'    => false
												),
											//Player list
											array(
													'name'       => __( 'Player Out(Substitutes)', 'themeum-soccer' ),
													'id'         => 'themeum_player_out',
													'desc' => __( 'Player Out(Substitutes)', 'themeum-soccer' ),
													'type'       => 'post',
													'post_type'  => 'player',
													'field_type' => 'select_advanced',
													'query_args' => array(
														'post_status'    => 'publish',
														'posts_per_page' => '-1',
													),
													'std'  => "",
													'multiple'    => false
												),

													
								),			
								
							),






		)
	);



	$meta_boxes[] = array(
		'id' 		=> 'point_table-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Point Table Settings', 'themeum-soccer' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'point_table'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(




			array(
					'name'   => __( '<b>Point Table Setting</b>', 'themeum-soccer' ),
					'id'     => 'point_table_group',
					'type'   => 'group',
					'fields' => array(			
							
							//Club Name
							array(
								'name'       => __( 'Club Name', 'themeum-soccer' ),
								'id'         => 'themeum_club_name',
								'desc' => __( 'Club Name', 'themeum-soccer' ),
								'type'       => 'post',
								'post_type'  => 'club',
								'field_type' => 'select_advanced',
								'query_args' => array(
									'post_status'    => 'publish',
									'posts_per_page' => '-1',
								),
								'multiple'    => false
							),

							//Games Played(P)
							array(
								'name'          => __( 'Games Played(P)', 'themeum-soccer' ),
								'id'            => "themeum_games_played",
								'desc'			=> __( 'Total Number of Games Played(P)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),	

							//Games Won(W)
							array(
								'name'          => __( 'Games Won(W)', 'themeum-soccer' ),
								'id'            => "themeum_games_won",
								'desc'			=> __( 'Total Number of Games Won(W)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),	

							//Games Drown(D)
							array(
								'name'          => __( 'Games Drown(D)', 'themeum-soccer' ),
								'id'            => "themeum_games_drown",
								'desc'			=> __( 'Total Number of Games Drown(D)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),	

							//Games Lost(L)
							array(
								'name'          => __( 'Games Lost(L)', 'themeum-soccer' ),
								'id'            => "themeum_games_lost",
								'desc'			=> __( 'Total Number of Games Lost(L)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),	

							//Goals Scored(GS)
							array(
								'name'          => __( 'Goals Scored(GS)', 'themeum-soccer' ),
								'id'            => "themeum_goals_scored",
								'desc'			=> __( 'Total Number of Goals Scored(GS)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),

							//Goals Against(GA)
							array(
								'name'          => __( 'Goals Against(GA)', 'themeum-soccer' ),
								'id'            => "themeum_goals_against",
								'desc'			=> __( 'Total Number of Goals Against(GA)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),

							//Goals Difference(+/-)
							array(
								'name'          => __( 'Goals Difference(+/-)', 'themeum-soccer' ),
								'id'            => "themeum_goals_difference",
								'desc'			=> __( 'Total Number of Goals Difference(+/-)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),

							//Points(Pts)
							array(
								'name'          => __( 'Points(Pts)', 'themeum-soccer' ),
								'id'            => "themeum_points",
								'desc'			=> __( 'Total Number of Points(Pts)', 'themeum-soccer' ),
								'type'          => 'text',
								'std'           => '',
							),

					),
					'clone'  => true,
				),


			


		)
	);















	$meta_boxes[] = array(
		'id' 		=> 'slider-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Slider Settings', 'themeum-soccer' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'slider'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(




							// SELECT Type
							array(
								'name'        => __( 'Select Type', 'themeum-soccer' ),
								'id'          => "select_type",
								'type'        => 'select',
								'options'     => array(
									'value1' => __( 'Classic Description', 'themeum-soccer' ),
									'value2' => __( 'Match Reasult', 'themeum-soccer' ),
									'value3' => __( 'Upcoming Matches', 'themeum-soccer' ),
								),
								'multiple'    => false,
							),


							// Slider Type
							array(
								'name'        => __( 'Slider Type', 'themeum-soccer' ),
								'id'          => "slider_type",
								'type'        => 'text',
								'std'  		  => "",
								'placeholder' => __( 'ex: FIFA World Cup', 'themeum-soccer' ),
							),


							array(
								'name'   => __( '<b>Match Reasult/Upcoming Matches</b>', 'themeum-soccer' ),
								'id'     => 'reasult_group',
								'type'   => 'group',
								'name'   => __( 'Match Reasult/Upcoming Matches', 'themeum-soccer' ),
								'fields' => array(

										array(
												'name'       => __( 'Team Name 1', 'themeum-soccer' ),
												'id'         => 'themeum_team_name1',
												'desc' => __( 'Team Name', 'themeum-soccer' ),
												'type'       => 'post',
												'post_type'  => 'club',
												'field_type' => 'select_advanced',
												'query_args' => array(
													'post_status'    => 'publish',
													'posts_per_page' => '-1',
												),
												'multiple'    => false
											),
										
										array(
												'name'       => __( 'Team Name 2', 'themeum-soccer' ),
												'id'         => 'themeum_team_name2',
												'desc' => __( 'Team Name', 'themeum-soccer' ),
												'type'       => 'post',
												'post_type'  => 'club',
												'field_type' => 'select_advanced',
												'query_args' => array(
													'post_status'    => 'publish',
													'posts_per_page' => '-1',
												),
												'multiple'    => false
											),
										// Date Time
										array(
											'name'       => __( 'Match Datetime', 'themeum-soccer' ),
											'id'         => 'themeum_datetime',
											'type'       => 'datetime',
											'js_options' => array(
												'stepMinute'     => 1,
												'showTimepicker' => true,
											),
										),
										// Goal score
										array(
											'name' => __( 'Goal', 'rwmb' ),
											'id'   => 'themeum_goal',
											'desc' => __( 'Goal', 'rwmb' ),
											'type' => 'text',
											'std'  => "",
											'placeholder' => __( 'Goal Team1:Team2 Ex(3:2)', 'themeum-soccer' ),
											),	



									)
								),
								
								array(
								'name'   => __( '<b>Classic Description</b>', 'themeum-soccer' ),
								'id'     => 'classic_group',
								'type'   => 'group',
								'fields' => array(
										// Goal score
										array(
											'name' => __( 'Short Description:', 'themeum-soccer' ),
											'id'   => 'themeum_short_description',
											'desc' => __( 'Put Here Short Description:', 'themeum-soccer' ),
											'type' => 'textarea',
											'std'  => "",
											),
									)),

		)
	);













	return $meta_boxes;
}