<?php
/**
 * The template for displaying pages
 *
 * @package vega
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>

<div class="section page-content bg-white">
    <div class="container">
        <div class="row">

            <div class="col-md-8">

                <div id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

                    <div class="page-content">
                    <?php the_content(); ?>
                    </div>

                </div>
                <?php if ( comments_open() ) : ?>
                <?php comments_template(); ?>
                <?php endif; ?>
            </div>

            <?php if($vega_wp_page_sidebar == 'Y' && !is_page('contact') && !is_page('activites-du-mois')) { ?>
            <div class="col-md-push-1 col-md-3  sidebar">
              <div class="sidebar-default">
                <?php get_sidebar(); ?>
              </div>
            </div>
            <?php } ?>

            <?php if(is_page('contact')) { ?>
              <div class="col-md-push-1 col-md-3 sidebar contact-sidebar">
                <div class="contact-sidebar-bg">
                <?php dynamic_sidebar('contact-sidebar'); ?>
              </div>
              </div>
                <?php } ?>

              </div>

        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
