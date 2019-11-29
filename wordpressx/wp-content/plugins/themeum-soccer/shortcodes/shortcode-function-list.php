<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// Return @list_point_table 
function themeum_all_point_table(){
    $projects = get_posts( array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_type'        => 'point_table',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    ) );

    $list_point_table = array();

    if(is_array($projects)){
        $list_point_table['sad'] = 'Select One';
        foreach ($projects as $post) {
            $list_point_table[$post->post_name] = $post->post_title;
        }   
    }
    $list_point_table = array_flip($list_point_table );

    return $list_point_table;
}


// Return @themeum_get_title_by_id
function themeum_get_title_by_id($id){
 return get_the_title($id);
}


// themeum_logo_url_by_id
function themeum_logo_url_by_id($id){
    /*if(isset(wp_get_attachment_image_src(get_post_meta( $id,'themeum_club_logo',true ))[0])){
        return wp_get_attachment_image_src(get_post_meta( $id,'themeum_club_logo',true ))[0];
    }else{
        return '';
    }*/
    if($id!=''){
        return wp_get_attachment_url( get_post_thumbnail_id($id) );
    }else{
        return '';
    }
    
}

// Attachment Url By id
function themeum_attachment_url($id){
   if(wp_get_attachment_image_src($id)){
       $img = wp_get_attachment_image_src($id);
       return $img[0];
   }else{
       return '';
   }
}



// Attachment Url By id Full Image
function themeum_attachment_url_full($id,$type){
    if(wp_get_attachment_image_src($id,$type)){
        $img = wp_get_attachment_image_src($id,$type);
        return $img[0];
    }else{
        return '';
    }
}


function themeum_player_info($player_list1){

    $list1_array = array();
    $list2_array = array();

    if(is_array($player_list1)){
        global $post;
        $args = array(
                'post__in'          => $player_list1,
                'post_type'         => 'player',
                'post_status'       => 'publish',
                'posts_per_page'    => -1,
            );
        $posts = get_posts($args); 

        foreach ($posts as $post){
            setup_postdata( $post );
            $data = array();
            $full_name    = get_post_meta($post->ID,'themeum_full_name',true);
            $player_image    = get_post_meta($post->ID,'themeum_player_image',true);


            $player_image = themeum_attachment_url($player_image);
            $player_image_full = esc_attr(get_post_meta( $post->ID , 'themeum_player_image', true ));
            $player_image_full = wp_get_attachment_image_src( $player_image_full , 'player-thumb'); 
            $position    = get_post_meta($post->ID,'themeum_position',true);
            $jersey    = get_post_meta($post->ID,'jersey_number',true);
            $personal_info    = get_post_meta($post->ID,'personal_info_group',true);

            $data['name'] = $full_name;
            $data['image'] = $player_image;
            $data['fullimage'] = $player_image_full[0];
            $data['position'] = $position;
            $data['jersey'] = $jersey;
            $data['url'] = get_the_permalink();

            $i=1;
            $new_all = array();
            foreach ($personal_info as $value) {
                $new_all[] = $value;
                $i++;
            }
            $data['other'] = $new_all;

            $list1_array[] = $data;
        }
        wp_reset_postdata();

        return $list1_array;
    }
}



function themeum_class_name($string){
    $css_class = '';
    switch($string){
        case 'Yellow Card':
            $css_class = 'yellow-card';
            break;
        case 'Double Yellow':
            $css_class = 'double-yellow';
            break;
            case 'Red Card':
            $css_class = 'red-card';
            break;
            case 'Free Kick':
            $css_class = 'free-kick';
            break;
            case 'Panalty':
            $css_class = 'panalty';
            break;
            case 'Corner Kick':
            $css_class = 'corner-kick';
            break;
            case 'Goal':
            $css_class = 'goal';
            break;
            case 'Goal Shot':
            $css_class = 'goal-shot';
            break;
            case 'Foul':
            $css_class = 'foul';
            break;
            case 'Handball':
            $css_class = 'handball';
            break;
            case 'Start First Half':
            $css_class = 'start-first-half';
            break;
            case 'Start Second Half':
            $css_class = 'start-second-half';
            break;
            case 'Throw':
            $css_class = 'throw';
            break;
            case 'Off Side':
            $css_class = 'off-side';
            break;
            case 'Extra Time 1':
            $css_class = 'extra-time-1';
            break;
            case 'Extra Time 2':
            $css_class = 'extra-time-2';
            break;
        default:
            break;
    }
    return $css_class;
}


// List of League
function themeum_league_list(){
    global $wpdb;
    $sql = "SELECT * FROM `".$wpdb->prefix."term_taxonomy` INNER JOIN `".$wpdb->prefix."terms` ON `".$wpdb->prefix."term_taxonomy`.`term_taxonomy_id`=`".$wpdb->prefix."terms`.`term_id` AND `".$wpdb->prefix."term_taxonomy`.`taxonomy`='league'";
    $results = $wpdb->get_results( $sql );

    $cat_list = '';
    foreach ($results as $value) {
        $cat_list[get_the_title()] = $value->post_name;
    }
    return $cat_list;
}



// List of Group
function themeum_group_list(){
    global $wpdb;
    $sql = "SELECT * FROM `".$wpdb->prefix."term_taxonomy` INNER JOIN `".$wpdb->prefix."terms` ON `".$wpdb->prefix."term_taxonomy`.`term_taxonomy_id`=`".$wpdb->prefix."terms`.`term_id` AND `".$wpdb->prefix."term_taxonomy`.`taxonomy`='team_group'";
    $results = $wpdb->get_results( $sql );

    $cat_list = '';
    foreach ($results as $value) {
        $cat_list[get_the_title()] = $value->post_name;
    }
    return $cat_list;
}



function themeum_all_page_list(){

        global $post;
        $args = array(
                'post_type'         => 'page',
                'post_status'       => 'publish',
                'posts_per_page'    => -1,
            );
        $posts = get_posts($args);
        $array = array();

        foreach ($posts as $post){
            setup_postdata( $post );

            $array[get_the_title()] = $post->post_name;

        }
        wp_reset_postdata();

        return $array;
}
