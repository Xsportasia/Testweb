<?php
/**
 * Display Single Teacher 
 *
 * @author    Themeum
 * @category  Template
 * @package   Soccer
 * @version     1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
  exit; // Exit if accessed directly

get_header();
?>

<section id="main" class="clearfix">

    <?php 
      $banner_img = get_post_meta($post->ID,'themeum_club_banner', true);
      $banner_src_image   = wp_get_attachment_image_src($banner_img, 'full');

      if(!empty($banner_img)) { ?>
      <div class="player-profile-banner" style="background-image:url(<?php echo esc_url($banner_src_image[0]);?>);background-size: cover;background-position: 50% 50%;padding:150px 0 90px">
          <div class="container">
              <h2 class="player-profile-title"><?php the_title(); ?></h2>
          </div> <!--container-->   
      </div><!--player-profile-banner-->
      <?php } else { ?>
        <div class="player-profile-banner" style="background-color:#444;padding:150px 0 90px">
          <div class="container">
              <h2 class="player-profile-title"><?php the_title(); ?></h2>
          </div> <!--container-->   
      </div><!--player-profile-banner-->
      <?php } ?>


    <div class="club-profile">      
        <div class="container">   
            <div class="club-profile-inner">    
                <div class="row"> 
                <?php while(have_posts()): the_post(); 
                  
                  $club_type                = get_post_meta(get_the_ID(),'themeum_club_type',true);
                  $squadlist                = get_post_meta(get_the_ID(),'themeum_squads');
                  $club_info                = get_post_meta(get_the_ID(),'club_info_group',true);
                  $personal_statistics      = get_post_meta(get_the_ID(),'personal_statistics_group',true);

                  //social share
                  $facebook     = get_post_meta(get_the_ID(),'themeum_club_facebook',true);
                  $twitter      = get_post_meta(get_the_ID(),'themeum_club_twitter',true);
                  $googleplus   = get_post_meta(get_the_ID(),'themeum_club_google_plus',true);
                  $instagram    = get_post_meta(get_the_ID(),'themeum_club_instagram',true);
                  $youtube      = get_post_meta(get_the_ID(),'themeum_club_youtube',true);
                  $vimeo        = get_post_meta(get_the_ID(),'themeum_club_vimeo',true);

                ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                      <div class="col-sm-3"> 
                          <div class="player-profile-leftside"> 
                            <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
                            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                            <?php } //.entry-thumbnail ?>
                             <h3><?php echo the_title(); ?></h3>
                              <?php if ($club_type){?><span><?php echo esc_html($club_type); ?></span><?php } ?>
                              
                              <?php 
                              if ( is_array($club_info) && !empty($club_info) ) {
                                foreach ($club_info as $value) {
                                  if ( $value['themeum_club_information_level'] ) { ?>
                                    <h4><?php echo esc_html($value['themeum_club_information_level']); ?></h4>
                                    <span><?php echo esc_html($value['themeum_club_information_data']); ?></span>
                                 <?php }
                                }
                              }
                              if ( $facebook || $twitter || $googleplus || $instagram || $youtube || $vimeo ) { ?>
                                <div class="player-share">
                                    <ul>
                                      <?php if ($facebook) { ?>
                                        <li><a class="facebook" href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
                                       <?php  } ?>
                                        <?php if ($twitter) { ?>
                                        <li><a class="twitter" href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($googleplus) { ?>
                                        <li><a class="google-plus" href="<?php echo esc_url($googleplus);?>"><i class="fa fa-google-plus"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($instagram) { ?>
                                        <li><a class="instagram" href="<?php echo esc_url($instagram);?>"><i class="fa fa-instagram"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($youtube) { ?>
                                        <li><a class="youtube" href="<?php echo esc_url($youtube);?>"><i class="fa fa-youtube"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($vimeo) { ?>
                                        <li><a class="vimeo" href="<?php echo esc_url($vimeo);?>"><i class="fa fa-vimeo-square"></i></a></li>
                                        <?php  } ?>
                                    </ul>
                                </div>
                              <?php } ?>
                          </div> <!--player-profile-leftside-->
                      </div> <!--col-sm-4-->

                      <div class="col-sm-9"> 
                         <div class="player-profile-rightside"> 
                              <h3><?php echo __('Club History', 'themeum-soccer'); ?></h3>
                              <?php the_content();?>
                              <div class="club-details-tab" role="tabpanel">
                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs club-details-tab-nav" role="tablist">
                                      <li role="presentation" class="active"><a href="#squed" aria-controls="squed" role="tab" data-toggle="tab"><?php _e('Squad','themeum-soccer');?></a></li>
                                      <li role="presentation"><a href="#honour" aria-controls="honour" role="tab" data-toggle="tab"><?php _e('Honours','themeum-soccer');?></a></li>
                                      <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab"><?php _e('Photos','themeum-soccer');?></a></li>
                                      <li role="presentation"><a href="#jersey" aria-controls="jersey" role="tab" data-toggle="tab"><?php _e('Jersey','themeum-soccer');?></a></li>
                                  </ul>
                                  
                                  <!-- Tab panes -->
                                  <div class="tab-content club-details-tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="squed">
                                      <div class="club-squed">
                   
                                        <?php
                                        if(is_array($squadlist)){
                                          if(!empty($squadlist)){
                                          $squadlist = themeum_player_info($squadlist);
                                          usort($squadlist, function($a, $b) { return $a['jersey'] - $b['jersey']; });
                                          foreach ($squadlist as $value){
                                        ?>
                                            <div class="row">
                                              <div class="col-sm-8 no-col">
                                                <div class="media">
                                                  <div class="pull-left">
                                                     <img width="40" src="<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>">
                                                  </div>
                                                  <div class="media-body">
                                                    <h3 class="club-team-title"><a href="<?php echo $value['url']; ?>"><?php echo $value['jersey']; ?>. <?php echo $value['name']; ?></a></h3>
                                                  </div>
                                                </div>
                                              </div> <!--col-sm-8-->  
                                              <div class="col-sm-4 text-right no-col">
                                                  <h4><?php echo $value['position']; ?></h4>
                                              </div> <!--col-sm-4-->  
                                            </div> <!--row-->     
                                            <?php
                                            }
                                          }
                                        }
                                        ?>
 
                                      </div><!--club-squed--> 
                                    </div> <!--squed--> 
                                    <div role="tabpanel" class="tab-pane fade" id="honour">
                                      <div class="club-honour">
                                           
                                        <?php  
                                        $honours_group    = get_post_meta(get_the_ID(),'honours_group',true);

                                         if ( is_array($honours_group) && !empty($honours_group) ) {
                                          if ( $honours_group[0]['themeum_title_number'] && $honours_group[0]['themeum_league'] ) {
                                            foreach ($honours_group as $value){
                                            ?>
                                              <div class="row">
                                                  <div class="col-sm-12 no-col">
                                                    <div class="media honours-intro">
                                                    <?php if ( $value['themeum_title_number'] != '' ) { ?>
                                                      <div class="pull-left">
                                                        <h3><?php echo $value['themeum_title_number']; ?></h3>
                                                        <span><?php _e('Champion','themeum-soccer'); ?></span>
                                                      </div>
                                                    <?php } ?>

                                                      <div class="media-body">
                                                        <h4 class="club-team-title"><?php  echo $value['themeum_league']; ?></h4>
                                                        <div class="win-list"><?php echo $value['themeum_year_list']; ?></div>
                                                      </div>
                                                    </div>
                                                  </div> <!--col-sm-8-->  
                                              </div> <!--row--> 
                                            <?php 
                                              }
                                            }
                                          }
                                        ?>
                                      </div>
                                    </div> <!--honour-->                                      
                                    <div role="tabpanel" class="tab-pane fade" id="photos">
                                      <div class="club-phots">
                                            <?php
                                            $images    = get_post_meta(get_the_ID(),'themeum_club_gallery_images');
                                            $count = count($images); 
                                            $i=0;
                                            foreach($images as $value) {
                                            if($i%3==0){
                                              echo '<div class="row">';
                                            }
                                            ?>
                                                <div class="col-sm-4">
                                                     <a data-rel="prettyPhoto[pp_gal]" href="<?php echo themeum_attachment_url_full($value,'full'); ?>"><img class="img-responsive" src="<?php echo themeum_attachment_url_full($value,'heighlights'); ?>" alt="<?php _e('Image','themeum-soccer'); ?>"></a>
                                                </div> <!--col-sm-4-->  
                                            <?php
                                            $i++;
                                            if( $i%3==0 || $count == $i ){
                                            echo '</div>'; 
                                            }
                                          }
                                            ?> 

                                      </div>
                                    </div> <!--photos--> 

                                    <div role="tabpanel" class="tab-pane fade" id="jersey">
                                      <div class="club-jersey">
                                           <?php
                                            $jersey_group    = get_post_meta(get_the_ID(),'jersey_group',true);
                                            if (is_array($jersey_group)) {
                                              if (isset($jersey_group[0]['themeum_club_jersey'])) {
                                                if ( $jersey_group[0]['themeum_club_jersey'] ) {
                                                  foreach ($jersey_group as $value){
                                                 ?>
                                                   <div class="row">
                                                      <div class="col-sm-12 no-col">
                                                        <div class="media">
                                                          <?php if ( $value['themeum_club_jersey'] != '' ) { ?>
                                                            <div class="pull-left">
                                                              <a href="<?php echo $value['themeum_club_jersey_link']; ?>" target="_blank">
                                                                <img src="<?php echo $value['themeum_club_jersey']; ?>" alt="<?php _e('Image','themeum-soccer'); ?>">
                                                               </a>
                                                            </div>
                                                          <?php } ?>
                                                          <div class="media-body club-jersey-text">
                                                              <p><?php echo $value['jersey_type']; ?></p>
                                                          </div>   
                                                        </div>
                                                      </div> <!--col-sm-12-->  
                                                    </div> <!--row-->   
                                                 <?php
                                                  }
                                                }
                                              }
                                            }
                                           ?>                                                           
                                      </div>
                                    </div> <!--jersey-->  

                                  </div>
                              </div><!--club-details-tab-->
                        </div> <!--player-profile-rightside-->
                      </div> <!--col-sm-8-->

                     </div><!--/#post-->
                  <?php endwhile; ?>

                </div> <!--row-->
            </div> <!--player-profile-inner-->
        </div> <!--container-->
    </div> <!--player-profile-->
</section>

<?php get_footer();

