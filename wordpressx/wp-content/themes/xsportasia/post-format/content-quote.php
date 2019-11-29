<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( get_post_meta( get_the_ID(), 'thm_qoute',true) ) { ?>
    <div class="featured-wrap">
        <div class="entry-qoute">
            <blockquote>
                <p><?php echo esc_html(get_post_meta( get_the_ID(), 'thm_qoute',true )); ?></p>
                <small><?php echo esc_html(get_post_meta( get_the_ID(), 'thm_qoute_author',true )); ?></small>
            </blockquote>
        </div>
        <div class="share-btn"><i class="fa fa-share"></i></div>
        <div class="share-btn-pop" style="display:none"><?php get_template_part( 'post-format/social-buttons' ); ?></div>          
    </div>
    <?php } ?>

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

</article> <!--/#post -->