<?php




function list_the_project(){

	$projects = get_posts( array(
		    'posts_per_page'   => -1,
		    'offset'           => 0,
		    'orderby'          => 'post_date',
		    'order'            => 'DESC',
		    'post_type'        => 'poll',
		    'post_status'      => 'publish',
		    'suppress_filters' => true 
		) );

	
	$list_project = array();
	$list_project = array('All Projects'=>'');
	foreach ($projects as $post) {
	    $list_project[$post->ID] = $post->post_title;
	}
	$list_project = array_flip($list_project );

	return $list_project;
}


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Poll", "themeum-poll"),
		"base" => "themeum_poll",
		"description" => __("Themeum Poll", "themeum-poll"),
		"category" => __('Themeum', "themeum-poll"),
		"params" => array(

			array(
		        "type" => "dropdown",
		        "heading" => __("Pull Name","themeum-poll"),
		        "param_name" => "post_id",
		        "description" => __("Select Poll", "themeum-poll"),
		        "value" => list_the_project(), 
	        ),    

		array(
			"type" => "attach_image",
			"heading" => __("Insert Background Image", "themeum-poll"),
			"param_name" => "image",
			"value" => "",
			),
		array(
			"type" => "attach_image",
			"heading" => __("Insert Hover Background Image", "themeum-poll"),
			"param_name" => "image_hover",
			"value" => "",
		),

		)
	));
}

