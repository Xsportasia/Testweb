<?php 
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('thmtheme_widdget_init')):

    function thmtheme_widdget_init()
    {

        register_sidebar(array( 'name'          => __( 'Sidebar', 'themeum' ),
            'id'            => 'sidebar',
            'description'   => __( 'Widgets in this area will be shown on Sidebar.', 'themeum' ),
            'before_title'  => '<div class="themeum-title"><div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 class="widget_title">',
            'after_title'   => '</h2></div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div>'
            )
        );

        global $woocommerce;

        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'themeum' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'themeum' ),
                'before_title'  => '<div class="themeum-title"><div class="themeum-title-icon"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div><h2 class="widget_title">',
                'after_title'   => '</h2></div>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }        

        register_sidebar(array( 
                    'name'          => __( 'Footer 1', 'themeum' ),
                    'id'            => 'thm-footer-1',
                    'description'   => __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
                    'before_title'  => '<h3 class="widget_title">',
                    'after_title'   => '</h3>',
                    'before_widget' => '<div class="thm-footer-1"><div id="%1$s" class="widget %2$s" >',
                    'after_widget'  => '</div></div>'
                    )
        );        

        register_sidebar(array( 
                    'name'          => __( 'Footer 2', 'themeum' ),
                    'id'            => 'thm-footer-2',
                    'description'   => __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
                    'before_title'  => '<h3 class="widget_title">',
                    'after_title'   => '</h3>',
                    'before_widget' => '<div class="thm-footer-2"><div id="%1$s" class="widget %2$s" >',
                    'after_widget'  => '</div></div>'
                    )
        );        

        register_sidebar(array( 
                    'name'          => __( 'Footer 3', 'themeum' ),
                    'id'            => 'thm-footer-3',
                    'description'   => __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
                    'before_title'  => '<h3 class="widget_title">',
                    'after_title'   => '</h3>',
                    'before_widget' => '<div class="thm-footer-3"><div id="%1$s" class="widget %2$s" >',
                    'after_widget'  => '</div></div>'
                    )
        );        

        register_sidebar(array( 
                    'name'          => __( 'Footer 4', 'themeum' ),
                    'id'            => 'thm-footer-4',
                    'description'   => __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
                    'before_title'  => '<h3 class="widget_title">',
                    'after_title'   => '</h3>',
                    'before_widget' => '<div class="thm-footer-4"><div id="%1$s" class="widget %2$s" >',
                    'after_widget'  => '</div></div>'
                    )
        );        

        register_sidebar(array( 
                    'name'          => __( 'Footer 5', 'themeum' ),
                    'id'            => 'thm-footer-5',
                    'description'   => __( 'Widgets in this area will be shown before Footer.' , 'themeum'),
                    'before_title'  => '<h3 class="widget_title">',
                    'after_title'   => '</h3>',
                    'before_widget' => '<div class="thm-footer-5"><div id="%1$s" class="widget %2$s" >',
                    'after_widget'  => '</div></div>'
                    )
        );

    }
    
    add_action('widgets_init','thmtheme_widdget_init');

endif;




/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/

if(!function_exists('themeum_style')):

    function themeum_style(){
        global $themeum_options;

        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',false,'all');
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css',false,'all');
        wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css',false,'all');
        wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/css/owl.theme.css',false,'all');
        wp_enqueue_style( 'owl.transitions', get_template_directory_uri() . '/css/owl.transitions.css',false,'all');
        wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css',false,'all');
        wp_enqueue_style( 'mejs-skins', get_template_directory_uri() . '/css/mejs-skins.css',false,'all');
        wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css',false,'all');
        wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css',false,'all');
        wp_enqueue_style( 'thm-woocommerce', get_template_directory_uri() . '/css/woocommerce.css',false,'all');
        wp_enqueue_style( 'thm-main', get_template_directory_uri() . '/css/main.css',false,'all');
        wp_enqueue_style( 'thm-responsive', get_template_directory_uri() . '/css/responsive.css',false,'all');
        wp_enqueue_style('thm-style',get_stylesheet_uri());
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('owl.carousel.min',THMJS.'owl.carousel.min.js',array(),false,true);
        wp_enqueue_script('wow.min',THMJS.'wow.min.js',array(),false,true);
        wp_enqueue_script('jquery.countdown',THMJS.'jquery.countdown.min.js',array(),false,true);
        wp_enqueue_script('jquery.prettyPhoto',THMJS.'jquery.prettyPhoto.js',array(),false,true);
        wp_enqueue_script('jquery.flexslider-min',THMJS.'jquery.flexslider-min.js',array(),false,true);
        wp_enqueue_script('cloud-zoom',THMJS.'cloud-zoom.js',array(),false,true);
        wp_enqueue_media();
       

        if( isset($themeum_options['custom-preset-en']) ) {
            wp_enqueue_style( 'themeum-preset', get_template_directory_uri(). '/css/presets/preset' . $themeum_options['preset'] . '.css', array(),false,'all' );       
        }else {
            wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        }

        # Custom StyleSheet
        wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');

        wp_enqueue_script('main',THMJS.'main.js',array(),false,true);

    }
    add_action('wp_enqueue_scripts','themeum_style');
endif;

add_action('enqueue_block_editor_assets', 'themeum_action_enqueue_block_editor_assets' );
function themeum_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'themeum-gutenberg-editor-font-awesome-styles', get_template_directory_uri() . '/css/font-awesome.css', null, 'all' );
    wp_enqueue_style( 'thm-style', get_stylesheet_uri() );
    wp_enqueue_style( 'themeum-gutenberg-editor-customizer-styles', get_template_directory_uri() . '/css/gutenberg-editor-custom.css', null, 'all' );
    wp_enqueue_style( 'themeum-gutenberg-editor-styles', get_template_directory_uri() . '/css/gutenberg-custom.css', null, 'all' );
}

if(!function_exists('soccer_admin_style')):
    function soccer_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_parent_theme_file_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }
    add_action('admin_enqueue_scripts','soccer_admin_style');
endif;

/*
if(!function_exists('themeum_style_admin')):
    function themeum_style_admin(){
            //wp_enqueue_script('adsScriptss', get_template_directory_uri() . '/js/image-uploader.js');
    }
    add_action('admin_enqueue_scripts','themeum_style_admin');
endif;
*/
/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'themeum_plugins_include');

if(!function_exists('themeum_plugins_include')):

    function themeum_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => 'WPBakery Visual Composer',
                    'slug'                  => 'js_composer',
                    'source'                => 'http://demo.themeum.com/wordpress/plugins/js_composer.zip',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => esc_html__( 'Qubely Blocks – Full-fledged Gutenberg Toolkit', 'themeum' ),
                    'slug'                  => 'qubely',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => true,
                    'force_deactivation'    => false
                ),
                array(
                    'name'                  => 'Themeum Demo Importer',
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-demo-importer.zip',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                
                array(
                    'name'                  => 'Themeum Poll',
                    'slug'                  => 'themeum-poll',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-poll.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                                 
                array(
                    'name'                  => 'Themeum soccer',
                    'slug'                  => 'themeum-soccer',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-soccer.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                 
                array(
                    'name'                  => esc_html__( 'WP Mega Menu', 'winkel' ),
                    'slug'                  => 'wp-megamenu',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-megamenu.zip'),
                ), 
                array(
                    'name'                  => 'Group Meta Box',
                    'slug'                  => 'meta-box-group',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/meta-box-group.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => 'Woocoomerce', // The plugin name
                    'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
                    'required'              => false, // If false, the plugin is only 'recommended' instead of required
                    'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.0.4.zip', // If set, overrides default API URL and points to an external URL
                ),                 
                array(
                    'name'                  => 'MailChimp for WordPress',
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.0.7.zip',
                ),                                 
                array(
                    'name'                  => 'Widget Importer Exporter',
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip',
                ),
                array(
                    'name'                  => 'Themeum Tweet',
                    'slug'                  => 'themeum-tweet',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-tweet.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                )

            );
    $config = array(
            'domain'            => 'themeum',           // Text domain - likely want to be the same as your theme.
            'default_path'      => '',                           // Default absolute path to pre-packaged plugins
            'parent_menu_slug'  => 'themes.php',                 // Default parent menu slug
            'parent_url_slug'   => 'themes.php',                 // Default parent URL slug
            'menu'              => 'install-required-plugins',   // Menu slug
            'has_notices'       => true,                         // Show admin notices or not
            'is_automatic'      => false,                        // Automatically activate plugins after installation or not
            'message'           => '',                           // Message to output right before the plugins table
            'strings'           => array(
                        'page_title'                                => __( 'Install Required Plugins', 'themeum' ),
                        'menu_title'                                => __( 'Install Plugins', 'themeum' ),
                        'installing'                                => __( 'Installing Plugin: %s', 'themeum' ), // %1$s = plugin name
                        'oops'                                      => __( 'Something went wrong with the plugin API.', 'themeum'),
                        'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                        'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                        'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                        'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                        'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                        'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                        'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                        'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                        'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                        'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                        'return'                                    => __( 'Return to Required Plugins Installer', 'themeum'),
                        'plugin_activated'                          => __( 'Plugin activated successfully.','themeum'),
                        'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'themeum' ) // %1$s = dashboard link
                )
    );

    tgmpa( $plugins, $config );

    }

endif;