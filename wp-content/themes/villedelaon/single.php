<?php
/**
 * The Template for displaying single posts
 *
 * @package vega
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>

<!-- ========== Page Content ========== -->
<div class="section post-content bg-white">
    <div class="container">
        <div class="row">

            <?php
            $vega_wp_post_sidebar = vega_wp_get_option('vega_wp_post_sidebar');
            if($vega_wp_post_sidebar == 'Y') { $col1_class = 'col-md-9'; $col2_class='col-md-3'; }
            else { $col1_class = 'col-md-12'; $col2_class=''; }
            ?>

            <div class="col-md-8">
              <div class="infos-page">

                <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

                    <!-- Post Title -->
                    <?php $title = get_the_title(); ?>
                    <?php if($title == '') { ?>
                    <h3 class="entry-title"><?php echo _e('Post ID: ', 'vega'); echo get_the_ID(); ?></h3>
                    <?php } else { ?>
                    <h3 class="entry-title"><?php the_title(); ?></h3>
                    <?php } ?>
                    <!-- /Post Title -->

                    <?php
                    $vega_wp_post_meta = vega_wp_get_option('vega_wp_post_meta');
                    if($vega_wp_post_meta == 'Y') {
                        $vega_wp_post_meta_author = vega_wp_get_option('vega_wp_post_meta_author');
                        $vega_wp_post_meta_category = vega_wp_get_option('vega_wp_post_meta_category');
                        $vega_wp_post_meta_date = vega_wp_get_option('vega_wp_post_meta_date');
                    }
                    ?>
                    <?php if($vega_wp_post_meta == 'Y') { ?>
                    <!-- Post Meta -->
                    <div class="entry-meta">
                      <span class="author">La Mairie de Laon</span>
                      <span class="dateentry"><?php echo get_the_date(); ?></span>
                    </div>
                    <!-- /Post Meta -->
                    <?php } ?>

                    <?php
                    $vega_wp_post_tags = vega_wp_get_option('vega_wp_post_tags');
                    if($vega_wp_post_tags == 'Y') {
                    ?>
                    <!-- Post Tags -->
                    <div class="entry-tags">
                        <p><?php the_tags('',''); ?></p>
                    </div>
                    <!-- /Post Tags -->
                    <?php } ?>

                    <?php
                    $vega_wp_post_featured_image = vega_wp_get_option('vega_wp_post_featured_image');
                    if($vega_wp_post_featured_image == 'Y') {
                    ?>

                    <?php if(has_post_thumbnail()) { ?>
                    <!-- Post Image -->
                    <div class="entry-image"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?></div>
                    <!-- /Post Image -->
                    <?php } ?>

                    <?php } ?>


                    <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                    </div>


                </div>

                <?php if ( comments_open() ) : ?>
                <?php comments_template(); ?>
                <?php endif; ?>
              </div>
            </div>

            <?php if($vega_wp_post_sidebar == 'Y') { ?>
            <!-- Sidebar -->
            <div class="col-md-push-1 col-md-3 sidebar contact-sidebar">
              <div class="contact-sidebar-bg">
                <?php get_sidebar(); ?>
              </div>
            </div>
            <!-- /Sidebar -->
            <?php } ?>

        </div>
    </div>
</div>
<!-- ========== /Page Content ========== -->

<?php endwhile; ?>

<?php get_footer(); ?>
