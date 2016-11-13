<?php
/*
Template Name: Single Infos
*/
?>
<?php get_header(); ?>

<?php get_template_part('parts/banner'); ?>


<div class="section post-content bg-white infos-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php

    $args = array( 'post_type' => 'infos', 'posts_per_page' => 7 );
    $loop = new WP_Query( $args );
?>
    <?php
    while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <section class="infos-page">

            <section class="col-xs-12 col-md-3 col-lg-2">
              <a class="post-thumbnail post-thumbnail-small"><?php the_post_thumbnail(); ?></a>
              <div class="clearfix">

              </div>
            </section>
            <section class="col-xs-12 col-md-8">
              <h3 class="entry-title"><?php the_title(); ?></h3>
                <div class="entry-content">
                  <?php the_content(); ?>
                </div>
            </section>

          <div class="clearfix"></div>
      </section>
    <?php endwhile; ?>
          </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
