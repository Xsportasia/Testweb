<?php
/*
* Plugin Name: Themeum Poll
* Plugin URI: http://www.themeum.com/item/themeum-poll
* Author: Themeum
* Author URI: http://www.themeum.com
* License - GNU/GPL V2 or Later
* Description: Themeum Poll is a Poll display plugin.
* Version: 1.8
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'THMRWMB_POLL_URL', trailingslashit( plugins_url( 'post-type/meta-box' , __FILE__ ) ) );
define( 'THMRWMB_POLL_DIR', trailingslashit(  plugin_dir_path( __FILE__ ). 'post-type/meta-box' ) );

// Include the meta box script
include_once( 'post-type/meta_box.php' );

include_once( 'assets/menu.php' );


add_action( 'init', 'themeum_language_load_poll' );
function themeum_language_load_poll(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'themeum-poll', false, $plugin_dir );
}



//Register Post Type (Poll)
include_once( 'post-type/themeum-post-type-poll.php' );
include_once( 'shortcodes/poll-shortcode.php' );


//Shortcode
add_shortcode('themeum_poll', function( $atts, $content = null ){   
    extract( shortcode_atts( array( 'post_id' => '','image' => '','image_hover' => ''), $atts ) );                               
    return ThemeumPoll::get_pull_html( $post_id,$image,$image_hover);
});


class ThemeumPoll{

    public static function get_pull_html( $post_id = 1,$image = '',$image_hover = ''){

        $output = $image_style = $image_style_hover = '';

        $args = array('p' => $post_id,'post_type' => 'poll');
        $query = new WP_Query($args);
        $src_image   = wp_get_attachment_image_src($image, 'full'); 
        $src_image_hover   = wp_get_attachment_image_src($image_hover, 'full');

        if ( $src_image[0] != "" ) {
           $image_style = 'style = "background-image: url('.esc_url($src_image[0]).');background-repeat:no-repeat;background-size:cover;"';
        }else{
           $image_style = 'style="background-color: #222;"';
        }

        if ( $src_image_hover[0] != "" ) {
           $image_style_hover = 'style = "background-image: url('.esc_url($src_image_hover[0]).');background-repeat:no-repeat;background-size:cover;"';
        }else{
           $image_style_hover = 'style="background-color: #222;"';
        }
        while ( $query->have_posts() ) :  $query->the_post();

            $poll_question = rwmb_meta('themeum_poll_question');
            
            //$output = print_r($poll_question , true);

            $output .= '<div class="themeum-poll" '.$image_style.'>';

            $output .= '<div class="themeum-poll-title">'.get_the_title().'</div>';
            $output .= '<div class="themeum-poll-question">';

            $output .= '<form name="poll-form" action="'.esc_url(admin_url('admin-ajax.php')).'" method="POST" id="poll-form">';
            $output .= '<input type="hidden" name="poll_id" value="'.get_the_ID().'">';
            $output .= '<input type="hidden" name="action" value="poll_form">';

                foreach ($poll_question as $value){
                        $output .= '<p><input type="radio" name="question" value="'.$value.'">'.$value.'</p>';
                    }

            $output .= wp_nonce_field( 'poll_nonce_action', 'poll_nonce_field',true,false );

            $output .= '<button id="project-submit" class="poll-submit" >'.__('Submit','themeum-poll').'</button>';
            $output .= '</form>';
            $output .= '</div>';
            $output .= '</div>';


            $output .= '<div id="pull-reasult-html" class="themeum-poll-hover" '.$image_style_hover.'></div>';
           
        endwhile;

        wp_reset_postdata();

        return $output;
    }   

}// End of Class 


 function poll_form(){

        if ( !isset($_POST['poll_nonce_field']) || !wp_verify_nonce( $_POST['poll_nonce_field'], 'poll_nonce_action' ) ) {
           print 'Sorry, your nonce did not verify.';
           exit;
        }else{
            if(isset($_POST['poll_id']) && isset($_POST['question'])){
                
                $reasult = get_post_meta( $_POST['poll_id'] , $_POST['question'] , true );
                if( $reasult != '' ){
                    $reasult = intval($reasult) + 1;
                    update_post_meta( $_POST['poll_id'], $_POST['question'], $reasult );        
                }else{
                    update_post_meta( $_POST['poll_id'], $_POST['question'], '1' );  
                }
            }


            // Return JSON data
            $args = array('p' => $_POST['poll_id'],'post_type' => 'poll');
            $query = new WP_Query($args);
            $output = '';

            while ( $query->have_posts() ) :  $query->the_post();
                
                $poll_question = rwmb_meta('themeum_poll_question'); 
                $total_poll = 0;
                $percent_data = array();
                
                    foreach($poll_question as $value){
                        $reasult = get_post_meta( get_the_ID() , $value , true );
                        if($reasult == ''){ $reasult = 0; }
                        $total_poll = $total_poll + intval($reasult);
                        $percent_data[] = $reasult;
                    }

                    $final_percent = array();
                    foreach($percent_data as $value){
                        $final_percen[] = (($value/$total_poll)*100);
                    }
                    $output .= '<div class="themeum-poll-reasult-wrap table-responsive">';
                    $output .= '<table class="themeum-poll-result table">';
                    $output .= '<thead><tr><th>'.__('Result','themeum-poll').'</th><th>'.__('Total Vote','themeum-poll').'('.$total_poll.')</th></tr></thead>';
                    $output .= '<tbody>';
                    for($i=0; $i <count($percent_data) ; $i++) { 
                        $output .= '<tr><td class="poll-question">'.$poll_question[$i].'</td>
                        <td class="poll-percent">'.sprintf("%.2f", $final_percen[$i]).'%</td>
                        <td class="poll-total">'.$percent_data[$i].'</td></tr>';
                    }
                    $output .= '</tbody>';
                    $output .= '</table>';
                    $output .= '</div>';

            endwhile;

            wp_reset_postdata();

            echo $output;



        }          

    }
add_action('wp_ajax_poll_form', 'poll_form');
add_action('wp_ajax_nopriv_poll_form', 'poll_form');  



// Add CSS for Frontend
add_action( 'wp_enqueue_scripts', 'themeum_poll_style' );
function themeum_poll_style(){
    wp_enqueue_style('themeum-poll',plugins_url('assets/css/themeum-poll.css',__FILE__));
    wp_enqueue_script('themeum-poll-js',plugins_url('assets/js/main.js',__FILE__), array('jquery'));
}


// Add CSS for Backend
add_action( 'admin_enqueue_scripts', 'register_themeum_poll_style' );
function register_themeum_poll_style(){
    wp_register_style('themeum-poll-admin',plugins_url('assets/css/admin.css',__FILE__));
}