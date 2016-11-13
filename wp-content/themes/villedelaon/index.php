<?php
/**
 * The main template file.
 *
 * @package vega
 */
?>
<?php get_header(); ?>
<?php get_template_part('parts/banner'); ?>


    <div class="section blog-feed bg-white">
        <div class="container">
            <div class="row">

                <div class="col-md-8 blog-feed-column">

                    
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) : the_post();
                            get_template_part( 'parts/content', get_post_format() );
                        endwhile;
                    }
                    else { ?>
                    <div class="no-results"><p><?php _e('No posts found.', 'vega'); ?></p></div>
                    <?php } ?>

                    <div class="posts-pagination">
                        <div class="posts-pagination-block">
                            <?php if( get_next_posts_link() ) { next_posts_link('<span class="ic ic-angle-left"></span>'); }?>
                            <?php if( get_previous_posts_link() ) { previous_posts_link('<span class="ic ic-angle-right"></span>'); } ?>
                        </div>
                    </div>


                </div>


                <div class="col-md-push-1 col-md-3 sidebar contact-sidebar">
                  <div class="contact-sidebar-bg">
                    <?php get_sidebar(); ?>
                  </div>
                </div>


            </div>
        </div>
    </div>


<?php get_footer(); ?>
