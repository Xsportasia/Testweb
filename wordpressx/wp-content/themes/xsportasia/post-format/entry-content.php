<?php global $themeum_options; ?>
<div class="row">
    <div class="entry-headder col-sm-9">
        <div class="entry-title-wrap">
            <h2 class="entry-title blog-entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
                <sup class="featured-post"><i class="fa fa-soccer-ball-o"></i><?php _e( 'Sticky', 'themeum' ) ?></sup>
                <?php } ?>
            </h2> <!-- //.entry-title --> 
        </div>
    </div>
    <div class="entry-blog-meta col-sm-3">
        <ul>

            <?php if (isset($themeum_options['blog-category']) && $themeum_options['blog-category'] ) { ?>
            <li class="category"><?php echo get_the_category_list(', '); ?></li>
            <?php }?>      

            <?php if (isset($themeum_options['blog-author']) && $themeum_options['blog-author'] ) { ?>
              <li class="author-by"> <?php  _e('By ', 'themeum'); ?> <span class="author"> <?php the_author_posts_link() ?></span> </li>
            <?php }?> 

            <?php if (isset($themeum_options['blog-date']) && $themeum_options['blog-date'] ) { ?>
                <li class="publish-date"><time class="entry-date" datetime="<?php the_time( 'c' ); ?>">
                <?php echo date_i18n( 'M j,  Y',  strtotime( get_the_time( "Y-m-d" ) ) ) ?>
                </li>  
            <?php }?>   
      
            <?php if (isset($themeum_options['blog-tag']) && $themeum_options['blog-tag'] ) { ?>
                <li class="tag"> <?php the_tags('', ', ', '<br />'); ?> </li>
            <?php }?>

            <?php if (isset($themeum_options['blog-comment']) && $themeum_options['blog-comment'] ){ ?> 
            <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <li class="comments-link">
                  <?php comments_popup_link( '<span class="leave-reply">' . __( 'No comment', 'themeum' ) . '</span>', __( 'One comment', 'themeum' ), __( '% comments', 'themeum' ) ); ?>
                </li>
            <?php endif; //.comment-link ?>
            <?php } ?>

            <?php if (isset($themeum_options['blog-edit-en']) && $themeum_options['blog-edit-en']) { ?>
                <li class="edit-link">
                    <?php edit_post_link( __( 'Edit', 'themeum' ), '<span class="edit-link">', '</span>' ); ?>
                </li>
            <?php } ?>
        </ul>
    </div> <!--/.entry-meta -->
</div>

<div class="clearfix"></div>

<div class="entry-summary clearfix">
    <?php if ( is_single() ) {
        the_content();
    } else {
        the_excerpt();
    } 
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'themeum' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );

     if (isset($themeum_options['blog-social']) && $themeum_options['blog-social'] ){
        if(is_single()) {
            get_template_part( 'post-format/social-buttons' );
        }
    }?>
</div> <!-- //.entry-summary -->



