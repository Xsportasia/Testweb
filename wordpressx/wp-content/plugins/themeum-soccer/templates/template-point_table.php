<?php
/**
 * Display Single Point_table
 *
 * @author    Themeum
 * @category  Template
 * @package   Soccer
 * @version     1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
  exit; // Exit if accessed directly

get_header();

function sort_by_goal_difference($a, $b){
    return $b['themeum_goals_difference'] - $a['themeum_goals_difference'];
}


?>

<?php if ( have_posts() ) : the_post(); ?>



<section id="main" class="clearfix">
    <?php 
      $banner_src_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
      if ( has_post_thumbnail() && ! post_password_required() ) { ?>
      <div class="sub-title" style="background-image:url(<?php echo esc_url($banner_src_image[0]);?>);background-size: cover;background-position: 50% 50%;padding:150px 0 90px">
          <div class="container">
            <div class="sub-title-inner">
              <h2 class="player-profile-title"><?php the_title(); ?></h2>
            </div>
          </div> <!--container-->   
      </div><!--player-profile-banner-->
      <?php } else { ?>
        <div class="sub-title" style="background-color:#444;padding:150px 0 90px">
          <div class="container">
            <div class="sub-title-inner">
              <h2 class="player-profile-title"><?php the_title(); ?></h2>
            </div>
          </div> <!--container-->   
      </div><!--player-profile-banner-->
      <?php } ?>


  <div class="point-table-single">
    <div class="container">
      <div class="point-table table-responsive">
      <table class="table table-striped">
      <?php

      foreach ($posts as $post){
        setup_postdata( $post );

        $point_table    = get_post_meta(get_the_ID(),'point_table_group',true);

     

        usort($point_table, 'sort_by_points');
       


        $frequent = array();
        foreach ( $point_table as $value ){
            if( !empty($frequent) ){
                if( array_key_exists( $value['themeum_points'],$frequent ) ){
                    $frequent[$value['themeum_points']] = $frequent[$value['themeum_points']] + 1;    
                }else{
                    $frequent[$value['themeum_points']] = 1;  
                }
            }else{
                $frequent[$value['themeum_points']] = 1;
            }
        }




        $serial_data = array();
        $value_count = 0;
        foreach ($frequent as $value) {
            $serial_data[] = array_slice($point_table, $value_count, $value);   
            $value_count = $value_count + $value; 
        }

        $marge_inline = array();
        foreach ($serial_data as $value) {
          usort($value, 'sort_by_goal_difference');
          $marge_inline[] = $value;
        }

        $all_point = array();
        foreach ($marge_inline as $value1) {
            foreach ($value1 as $value) {
                $all_point[] = $value;
            }
        }
        $i=1;
      ?>


        <thead class="point-table-head"><tr><th class="text-left"><?php _e('No','themeum-soccer'); ?></th><th class="text-left"><?php _e('TEAM','themeum-soccer'); ?></th><th>P</th><th>W</th><th>D</th><th>L</th><th>GS</th><th>GA</th><th>+/-</th><th>PTS</th></tr></thead>
        <tbody>
        <?php
        foreach ($all_point as  $value) {
          if ( $value['themeum_club_name'] ) { ?>
            <tr>
            <td class="text-left"><?php echo $i; ?></td>
            <td class="text-left"><a href="<?php echo get_the_permalink($value['themeum_club_name']); ?>"><img class="point-table-image" src="<?php echo esc_url( themeum_logo_url_by_id($value['themeum_club_name']) ); ?>" alt="<?php echo get_the_title($value['themeum_club_name']); ?>"><span><?php echo get_the_title($value['themeum_club_name']); ?></span></a></td>
            <td><?php echo $value['themeum_games_played']; ?></td>
            <td><?php echo $value['themeum_games_won']; ?></td>
            <td><?php echo $value['themeum_games_drown']; ?></td>
            <td><?php echo $value['themeum_games_lost']; ?></td>
            <td><?php echo $value['themeum_goals_scored']; ?></td>
            <td><?php echo $value['themeum_goals_against']; ?></td>
            <td><?php echo $value['themeum_goals_difference']; ?></td>
            <td><?php echo $value['themeum_points']; ?></td>
            </tr>
          <?php
          $i++; 
          }
        }
        ?>
        </tbody>
      <?php }
      wp_reset_postdata();
      ?>
      </table>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>

<?php get_footer();