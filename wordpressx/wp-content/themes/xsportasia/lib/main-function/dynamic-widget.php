<?php

/* ****************************************************** 
				Dynamic Widget Data
********************************************************* */
add_action( 'admin_enqueue_scripts', 'register_themeum_widget_style' );
function register_themeum_widget_style(){
	wp_enqueue_media();
    wp_register_style('themeum-widget-admin', get_template_directory_uri().'/css/widget-admin.css');
    wp_enqueue_script('themeum-widget-js', get_template_directory_uri().'/js/widget-js.js', array('jquery'));
    wp_enqueue_script('themeum-post-meta', get_template_directory_uri().'/js/post-meta.js', array('jquery'));
}


// Save Action Dynamic Widgets 
if( isset($_POST['action']) ){
	if( $_POST['action']=='themeum_widget_form' ){

		$data = get_option('themeum_widget_data','');
		
		if( $_POST['sidebar-name'] != '' ){
			
			if( $data != '' ){
				$data = json_decode($data,true);
			}

			$arr['id'] = time();
			$arr['name'] = $_POST['sidebar-name'];
			$data[] = $arr;
			$data = json_encode($data);
			update_option( 'themeum_widget_data', $data );
		}

	}
}

// Delete Action Dynamic Widgets
if( isset($_POST['action-del']) ){
	if( $_POST['action-del']=='themeum_widget_form_del' ){

		$data = get_option('themeum_widget_data','');
				
		if( $data != '' ){
			$data = json_decode($data,true);
		}

		if(is_array($data)){
			$i=0;
			$target = '';
			$get_id = str_replace('themeum_wi','',$_POST['sidebar-id']);
			foreach ($data as $value) {
				if( $value["id"] == $get_id ){
					$target = $i;
				}
				$i++;
			}
			unset($data[$target]['id']);
			unset($data[$target]['name']);
			unset($data[$target]);

			$data = array_values($data);
			$data = json_encode($data);
			update_option( 'themeum_widget_data', $data );
		}
		
	}
}


// Add Dynamic Widgets to Themes
function thmtheme_widdget_init2(){
		$data = get_option('themeum_widget_data','');

		if( $data != '' ){
			$data = json_decode($data,true);
		}

		if(is_array($data)){
			foreach ($data as $value) {
					
				register_sidebar(array(
		            'name'          => $value["name"],
		            'id'            => 'themeum_wi'.esc_attr($value["id"]),
		            'description'   => __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
		            'before_title'  => '<h3 class="widget_title">',
		            'after_title'   => '</h3>',
		            'before_widget' => '<div class="thm-footer-5"><div id="%1$s" class="widget %2$s" >',
		            'after_widget'  => '</div></div>'
		            )
		        );
			}
		}

}
add_action('widgets_init','thmtheme_widdget_init2');






// Add Metabox Code Start
function themeum_wt_add_meta_box() {
	// Put here your Post Type or custom Post Type
	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'themeum_wt_sectionid',
			__( 'Select Widget', 'themeum' ),
			'themeum_wt_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'themeum_wt_add_meta_box' );



function themeum_wt_meta_box_callback( $post ) {

	wp_nonce_field( 'themeum_wt_meta_box', 'themeum_wt_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );
	echo '<label for="themeum_wt_new_field">';
	_e( 'Select Your Widget of the Post', 'themeum' );
	echo '</label> ';

	echo '<select id="themeum_wt_new_field" name="themeum_wt_new_field">';
	$data = array();
    if(is_array( $GLOBALS['wp_registered_sidebars'] )){
        foreach ($GLOBALS['wp_registered_sidebars'] as $key) {
            $var['id'] = $key['id'];
            $var['name'] = $key['name'];
            $data[] = $var;
        }
    }
       
	if(is_array($data)){
		//echo "<script>alert('a');</script>";
		//if( $value != "" ){
			foreach ($data as  $key){
				if( $key["id"] == $value ){
					echo '<option value="'.esc_attr($key["id"]).'" selected>'.esc_attr($key["name"]).'</option>';
				}else{
					echo '<option value="'.esc_attr($key["id"]).'">'.esc_attr($key["name"]).'</option>';
				}
			}
		//}
	}
	echo '</select>';
}

function themeum_wt_save_meta_box_data( $post_id ) {

	if ( ! isset( $_POST['themeum_wt_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['themeum_wt_meta_box_nonce'], 'themeum_wt_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if ( ! isset( $_POST['themeum_wt_new_field'] ) ) {
		return;
	}

	$my_data = sanitize_text_field( $_POST['themeum_wt_new_field'] );
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'themeum_wt_save_meta_box_data' );