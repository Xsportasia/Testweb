<?php
/*
* Plugin Name: Themeum Tweet
* Plugin URI: http://www.themeum.com/item/themeum-tweet
* Author: Themeum
* Author URI: http://www.themeum.com
* License - GNU/GPL V2 or Later
* Description: Themeum Tweet is a Twitter feed display/slider plugin.
* Version: 1.1
*/

if( !class_exists('TwitterAPIExchange') ) include_once( plugin_dir_path( __FILE__ ).'library/TwitterAPIExchange.php' );

class Themeum_Tweet extends WP_Widget {

        /**
        * Register widget with WordPress.
        */
        public function __construct() {
            parent::__construct(
                'themeum_tweet', // Base ID
                'Themeum Tweet', // Name
                array( 'description' => __( 'Twitter feed display widget'), ) // Args
                );
        }

        /*
		* Prepare feeds
		*/			
		private static function prepareTweet( $string )
        {
			//Url
           $pattern = '/((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/i';
           $replacement = '<a target="_blank" class="tweet_url" href="$1">$1</a>';
           $string = preg_replace($pattern, $replacement, $string);

			//Search
           $pattern = '/[\#]+([A-Za-z0-9-_]+)/i';
           $replacement = ' <a target="_blank" class="tweet_search" href="https://twitter.com/search?q=$1">#$1</a>';
           $string = preg_replace($pattern, $replacement, $string);

			//Mention
           $pattern = '/\s[\@]+([A-Za-z0-9-_]+)/i';
           $replacement = ' <a target="_blank" class="tweet_mention" href="http://twitter.com/$1">@$1</a>';
           $string = preg_replace($pattern, $replacement, $string);	

           return $string;
       }


		//Function for converting time
       private static function timeago( $time )
       {
           return human_time_diff( strtotime( $time ), current_time( 'timestamp' ) );
       }

       private static function getTweetsData( $params )
       {

        $settings = array(
            'consumer_key'                  => get_option('oauth_consumer_key'),
            'consumer_secret'               => get_option('consumer_secret'),
            'oauth_access_token'            => get_option('oauth_access_token'),
            'oauth_access_token_secret'     => get_option('oauth_access_token_secret')
            );

        if( empty($settings['consumer_key']) )
        {
            return NULL;
        }           
        elseif( empty($settings['consumer_secret']) )
        {
            return NULL;
        } 
        elseif( empty($settings['oauth_access_token']) )
        {
            return NULL;
        } 
        elseif( empty($settings['oauth_access_token_secret']) )
        {
            return NULL;
        } 

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?include_entities=true&include_rts=true&screen_name='.$params['username'].'&count='. $params['count'];
        $requestMethod = 'GET';

        $api = new TwitterAPIExchange($settings);
        return $api->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

    }

    public static function getTweets( $username = 'themeum', $post_numb, $image, $add_class )
    {

        $themeum_tweet = array(
            'username' => $username,
            'count'    => 30
            );
        
       $twitter_data = self::getTweetsData($themeum_tweet);

       // if( $twitter_data ){
            //Cache path


            $cache_path =  plugin_dir_path( __FILE__ ).'cache';

            if(!file_exists($cache_path)) mkdir($cache_path);
            
            $themeum_tweet = 'themeum-tweet.cache';
            $exp_time = 15*60; //seconds
            $time = time();
            
            if(file_exists($cache_path.'/'.$themeum_tweet)){
                $filemtime = filemtime($cache_path.'/'.$themeum_tweet) + ($exp_time);
                if( ($filemtime < $time) ) {
                    file_put_contents($cache_path.'/'.$themeum_tweet, $twitter_data);
                } else {
                    $twitter_data = file_get_contents($cache_path.'/'.$themeum_tweet);
                }
            }else {
                file_put_contents($cache_path.'/'.$themeum_tweet, $twitter_data);
            }
            
            $tweets = json_decode($twitter_data);
               
            $output = $image_style = '';
            $src_image   = wp_get_attachment_image_src($image, 'full'); 
            if ( $src_image[0] != "" ) {
               $image_style = 'style = "background-image: url('.esc_url($src_image[0]).');background-repeat:no-repeat;background-size:cover;"';
            }
            $output .= '<div class="themeum-twitter-shortcode '.$add_class.'" '.$image_style.'>';
			$output .= '<ul class="themeum-twitter">';
                if(is_array($tweets)){
                    $i = 1;
                    foreach( $tweets as $value ){
                        if($post_numb >= $i){

                        $output .= '<li>';
                            $output .= '<div class="tweet-content media">';
                                $output .= '<span class="social-icon pull-left">';
                                $output .= '<i class="fa fa-twitter"></i>';
                                $output .= '</span>';
                                $output .= '<div class="media-body">';
                                $output .= self::prepareTweet($value->text);
                                //if( $tweet_time ) { 
                                    $output .= '<span class="tweet-time">';
                                        $output .= self::timeago( $value->created_at );
                                    $output .= '</span>';
                                 //  }
                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '<div class="clearfix"></div>';
                        $output .= '</li>';
                        $i++;
                        
                        }
                    }
                } 
            $output .= '</ul>';
            $output .= '</div>';
            return $output;

        	// }else{
         //        return '<p class="themeum-tweet-alert"><strong>Wrong Twitter API Settings.</strong><br />Please check Themeum Tweet Settings under Plugins menu.</p>';
         //    }   

    }

} // End of Classy



//Shortcode
add_shortcode('themeum_tweet', function( $atts, $content = null )
{
    extract( shortcode_atts( 
        array( 
            'username'      => 'themeum',
            'image'         => '',
            'add_class'     => '',       
            'count'         => 6,		
        ), $atts ) );                               

    return Themeum_Tweet::getTweets( $username, $count, $image, $add_class );
});



add_action( 'wp_enqueue_scripts', 'themeum_tweet_style' );

function themeum_tweet_style(){
    wp_enqueue_style('themeum-tweet',plugins_url('assets/css/themeum-tweet.css',__FILE__));
}

if(is_admin()){
    add_action( 'admin_init', 'register_themeum_tweet_style' );
    add_action( 'admin_menu', 'register_themeum_tweet_menu' );
}

function register_themeum_tweet_style(){
    wp_register_style('themeum-tweet-admin',plugins_url('assets/css/admin.css',__FILE__));
}

function register_themeum_tweet_menu(){
    $page = add_plugins_page('Themeum Tweet Settings', 'Themeum Tweet Settings', 'manage_options', 'themeum-tweet-settings','themeum_tweet_settings');
    add_action('admin_print_styles-'.$page,'enqueue_themeum_tweet_style');
    add_action( 'admin_init', 'register_tweet_settings', 1 );
}

function enqueue_themeum_tweet_style(){
    wp_enqueue_style('themeum-tweet-admin');
}

function register_tweet_settings(){
    //register our settings
    register_setting( 'tweet_ops', 'oauth_consumer_key' );
    register_setting( 'tweet_ops', 'consumer_secret' );
    register_setting( 'tweet_ops', 'oauth_access_token' );
    register_setting( 'tweet_ops', 'oauth_access_token_secret' );
}

function themeum_tweet_settings(){
    ?>
    <form id="themeum-tweet-options" role="form" method="post" action="options.php">

        <?php settings_fields('tweet_ops'); ?>
        <?php do_settings_sections('tweet_ops'); ?>

        <h2><?php _e('Twitter API Settings', 'themeum-tweet'); ?></h2>

        <div class="form-group">
            <label><?php _e('Twitter API Help', 'themeum-tweet'); ?></label>
            <a target="_blank" class="button button-primary" href="https://code.google.com/p/socialauth-android/wiki/Twitter">Step by Step Guide to Get Twitter consumer key and secrets</a>
        </div>    
    
        <div class="form-group">
            <label for="oauth_consumer_key"><?php _e('Consumer Key', 'themeum-tweet'); ?></label>
            <input type="text" class="form-control" id="oauth_consumer_key" name="oauth_consumer_key" value="<?php echo get_option('oauth_consumer_key'); ?>" />
        </div>
        <div class="form-group">
            <label for="consumer_secret"><?php _e('Consumer Secret', 'themeum-tweet'); ?></label>
            <input type="text" class="form-control" id="consumer_secret" name="consumer_secret" value="<?php echo get_option('consumer_secret'); ?>" />
        </div>
        <div class="form-group">
            <label for="oauth_access_token"><?php _e('Access Token', 'themeum-tweet'); ?></label>
            <input type="text" class="form-control" id="oauth_access_token" name="oauth_access_token" value="<?php echo get_option('oauth_access_token'); ?>" />
        </div>
        <div class="form-group">
            <label for="oauth_access_token_secret"><?php _e('Access Token Secret', 'themeum-tweet'); ?></label>
            <input type="text" class="form-control" id="oauth_access_token_secret" name="oauth_access_token_secret" value="<?php echo get_option('oauth_access_token_secret'); ?>" />
        </div>
        <?php submit_button(); ?>
    </form>
    <?php
}