<?php

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Tweet", "themeum"),
		"base" => "themeum_tweet",
		"description" => __("Themeum Tweet", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Username", "themeum"),
				"param_name" => "username",
				"value" => "themeum",
				),

      array(
        "type" => "textfield",
        "heading" => __("Number of Post Show", "themeum"),
        "param_name" => "count",
        "value" => "6",
        ),

        array(
          'type' => 'checkbox',
          'heading' => __( 'Show Avatar', 'themeum' ),
          'param_name' => 'avatar',
          'value' => array( __( 'avatar', 'themeum' ) => true )
        ),		

        array(
          'type' => 'checkbox',
          'heading' => __( 'Tweet Time', 'themeum' ),
          'param_name' => 'tweet_time',
          'value' => array( __( 'Tweet Time', 'themeum' ) => true )
        ),	

      array(
        "type" => "attach_image",
        "heading" => __("Insert Background Image", "themeum"),
        "param_name" => "image",
        "value" => "",
        ),

		  array(
        "type" => "textfield",
        "heading" => __("Add Class", "themeum"),
        "param_name" => "add_class",
        "value" => "",
      ),
		)
	));
}
