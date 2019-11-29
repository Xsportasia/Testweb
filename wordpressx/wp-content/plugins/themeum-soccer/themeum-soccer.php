<?php
/*
* Plugin Name: Themeum Soccer
* Plugin URI: http://www.themeum.com/item/themeum-soccer
* Author: Themeum
* Author URI: http://www.themeum.com
* License - GNU/GPL V2 or Later
* Description: Themeum Soccer is a Soccer display plugin.
* Version: 2.6
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'THMRWMB_SOCCER_URL', trailingslashit( plugins_url( 'post-type/meta-box' , __FILE__ ) ) );
define( 'THMRWMB_SOCCER_DIR', trailingslashit(  plugin_dir_path( __FILE__ ). 'post-type/meta-box' ) );

define( 'THMRWMB_DIR', plugins_url('themeum-soccer') );


// Include the meta box script
require_once THMRWMB_SOCCER_DIR . 'meta-box.php';
include_once( 'post-type/meta_box.php' );


add_action( 'init', 'themeum_language_load_soccer' );
function themeum_language_load_soccer(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'themeum-soccer', false, $plugin_dir );
}


//Register Post Type (Club)
include_once( 'post-type/themeum-club.php' );
//Register Post Type (Player)
include_once( 'post-type/themeum-player.php' );
//Register Post Type (Fixture & Result)
include_once( 'post-type/themeum-fixture-result.php' );
//Register Post Type (Point Table)
include_once( 'post-type/themeum-point-table.php' );
//Register Post Type (Slider)
include_once( 'post-type/themeum-slider.php' );

//Visual Composer Extended Function List
include_once( 'shortcodes/shortcode-function-list.php' );
//Top Player Shortcode(Visual Composer)
include_once( 'shortcodes/themeum-top-player.php' );
//Point Table Shortcode(Visual Composer)
include_once( 'shortcodes/themeum-point-table.php' );
//Match Fixture Shortcode(Visual Composer)
include_once( 'shortcodes/themeum-match-fixture.php' );
//Match Blank Fixture Shortcode(Visual Composer)
include_once( 'shortcodes/themeum-blank-fixture.php' );
//Match Reasult Shortcode(Visual Composer)
include_once( 'shortcodes/themeum-match-reasult.php' );
include_once( 'shortcodes/themeum-club-ranking.php' );
include_once( 'shortcodes/themeum-recent-results.php' );
//Club Group Shortcode(Visual Composer)
include_once( 'shortcodes/themeum-club-group.php' );
include_once( 'shortcodes/themeum-video-play.php' );
include_once( 'shortcodes/themeum-league.php' );
include_once( 'shortcodes/themeum-title.php' );


include_once( 'shortcodes/themeum-slider-2.php' );


/* Include settings */
include_once( 'themeum-soccer-settings.php' );



// Add CSS for Frontend
add_action( 'wp_enqueue_scripts', 'themeum_soccer_style' );
function themeum_soccer_style(){
    wp_enqueue_style('themeum-soccer',plugins_url('assets/css/themeum-soccer.css',__FILE__));
    wp_enqueue_script('themeum-soccer-js',plugins_url('assets/js/main.js',__FILE__), array('jquery'));


    wp_enqueue_style('themeum-soccer2',plugins_url('assets/css/nanoscroller.css',__FILE__));
    wp_enqueue_script('themeum-soccer-js2',plugins_url('assets/js/jquery.nanoscroller.min.js',__FILE__), array('jquery'));
}


// Add CSS for Backend
add_action( 'admin_enqueue_scripts', 'register_themeum_soccer_style' );
function register_themeum_soccer_style(){
    wp_register_style('themeum-soccer-admin',plugins_url('assets/css/admin.css',__FILE__));
    wp_enqueue_script('themeum-soccer-js',plugins_url('assets/js/admin-main.js',__FILE__), array('jquery'));
}


/*
// Add Menu In Backend
add_action( 'admin_menu', 'register_themeum_soccer_menu' );
function register_themeum_soccer_menu(){
    $page = add_plugins_page('Themeum Soccer Settings', 'Themeum Soccer Settings', 'manage_options', 'themeum-soccer-settings','themeum_soccer_settings');
    add_action('admin_print_styles-'.$page,'enqueue_themeum_poll_style');
    add_action( 'admin_init', 'register_soccer_settings', 1 );
}
*/
function enqueue_themeum_soccer_style(){
    wp_enqueue_style('themeum-poll-admin');
}


function register_soccer_settings(){
    //register our settings
    register_setting( 'tweet_ops', 'oauth_consumer_key' );
    register_setting( 'tweet_ops', 'consumer_secret' );
    register_setting( 'tweet_ops', 'oauth_access_token' );
    register_setting( 'tweet_ops', 'oauth_access_token_secret' );
}

function themeum_soccer_settings(){
    ?>
    <form id="themeum-poll-options" role="form" method="post" action="options.php">

        <?php settings_fields('tweet_ops'); ?>
        <?php do_settings_sections('tweet_ops'); ?>

        <h2><?php _e('Twitter API Settings', 'themeum-soccer'); ?></h2>

        <div class="form-group">
            <label><?php _e('Twitter API Help', 'themeum-soccer'); ?></label>
            <a target="_blank" class="button button-primary" href="https://code.google.com/p/socialauth-android/wiki/Twitter">Step by Step Guide to Get Twitter consumer key and secrets</a>
        </div>    
    
        <div class="form-group">
            <label for="oauth_consumer_key"><?php _e('Consumer Key', 'themeum-soccer'); ?></label>
            <input type="text" class="form-control" id="oauth_consumer_key" name="oauth_consumer_key" value="<?php echo get_option('oauth_consumer_key'); ?>" />
        </div>
        <div class="form-group">
            <label for="consumer_secret"><?php _e('Consumer Secret', 'themeum-soccer'); ?></label>
            <input type="text" class="form-control" id="consumer_secret" name="consumer_secret" value="<?php echo get_option('consumer_secret'); ?>" />
        </div>
        <div class="form-group">
            <label for="oauth_access_token"><?php _e('Access Token', 'themeum-soccer'); ?></label>
            <input type="text" class="form-control" id="oauth_access_token" name="oauth_access_token" value="<?php echo get_option('oauth_access_token'); ?>" />
        </div>
        <div class="form-group">
            <label for="oauth_access_token_secret"><?php _e('Access Token Secret', 'themeum-soccer'); ?></label>
            <input type="text" class="form-control" id="oauth_access_token_secret" name="oauth_access_token_secret" value="<?php echo get_option('oauth_access_token_secret'); ?>" />
        </div>
        <?php submit_button(); ?>
    </form>
    <?php
}
function beackend_theme_update_notice()
{
    wp_enqueue_style('woonotice',plugins_url('assets/css/woonotice.css',__FILE__));
}
add_action( 'admin_print_styles', 'beackend_theme_update_notice' );