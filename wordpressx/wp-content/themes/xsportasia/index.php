<?php get_header(); ?>

<section id="main">
    <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-md-8" role="main">
                <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            get_template_part( 'post-format/content', get_post_format() );
                        endwhile;
                    else:
                        get_template_part( 'post-format/content', 'none' );
                    endif;
                ?>
               <?php themeum_pagination(); ?>
            </div> <!-- #content -->
            <div id="sidebar" class="col-md-4" role="complementary">
                <div class="sidebar-inner">
                    <aside class="widget-area">
                        <?php dynamic_sidebar( 'sidebar' ); ?>
                    </aside>
                </div>
            </div> <!-- #sidebar -->
        </div> <!-- .row -->
    </div>
</section> <!-- .container -->

<?php get_footer();