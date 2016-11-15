<?php
/**
 * The template part for displaying the recent posts on the front page (static)
 *
 * @package vega
 */
?>
<?php
global $vega_wp_curr_bg, $vega_wp_prev_bg;

$vega_wp_frontpage_latest_posts = vega_wp_get_option('vega_wp_frontpage_latest_posts');

if($vega_wp_frontpage_latest_posts == 'Y') {
if($vega_wp_prev_bg == 'bg-white') $vega_wp_curr_bg = 'bg-grey-light-2'; else $vega_wp_curr_bg = 'bg-white';
$vega_wp_prev_bg = $vega_wp_curr_bg;

$vega_wp_frontpage_latest_posts_n = vega_wp_get_option('vega_wp_frontpage_latest_posts_n');
$vega_wp_frontpage_latest_posts_heading = vega_wp_get_option('vega_wp_frontpage_latest_posts_heading');
$vega_wp_frontpage_latest_posts_section_id = vega_wp_get_option('vega_wp_frontpage_latest_posts_section_id');
?>
<?php
$args = array( 'post_type' => 'slider', 'posts_per_page' => 3 );
$loop = new WP_Query( $args );
if ($loop->have_posts()) :
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <?php  $count_posts = wp_count_posts('slider')->publish; ?>
  <?php  if ( $count_posts > "1" ) :  ?>
    <ol class="carousel-indicators">
      <?php for ($i = 0; $i < $count_posts; $i++) : ?>
          <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"></li>
      <?php endfor; ?>
    </ol>
  <?php endif; ?>
  <div class="carousel-inner">
  <?php  while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php
    $slider_titre = get_post_meta( get_the_ID(), '_slider_text', true );
    $slider_text = get_post_meta( get_the_ID(), '_slider_text_sub', true );
    $slider_link = get_post_meta( get_the_ID(), '_slider_link', true );
  ?>
    <div class="item"> <img src="<?php echo the_post_thumbnail_url('slider'); ?>" class="img-responsive" style="width:100%" alt="La ville de Laon - Actualités">
      <div class="container">
        <div class="carousel-caption">
          <h1><?= $slider_titre ?></h1>
          <p><?= $slider_text ?></p>
          <?php if($slider_link != '') : ?>
            <p><a class="btn-slider" href="<?= $slider_link ?>" role="button">En voir plus</a></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endwhile; ?>


</div>
  <?php if($count_posts > "1") : ?>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
  <?php endif; ?>
</div>
<?php endif; ?>

<div class="section frontpage-recent-posts <?php echo esc_attr($vega_wp_curr_bg) ?>" id="<?php echo esc_attr($vega_wp_frontpage_latest_posts_section_id) ?>">

    <div class="container">

        <div class="row">


            <?php
            global $post;
            $args = array( 'numberposts' => $vega_wp_frontpage_latest_posts_n );
            $recent_posts = get_posts( $args );
            foreach( $recent_posts as $post ){
            setup_postdata( $post );
            ?>
            <?php
            if($vega_wp_frontpage_latest_posts_n == 1)   $class = "col-md-4";
            if($vega_wp_frontpage_latest_posts_n == 2)   $class = "col-md-6 col-sm-6";
            if($vega_wp_frontpage_latest_posts_n == 3)   $class = "col-md-4 col-sm-4";
            ?>
            <div class="<?php echo $class ?> wow zoomIn">
                <?php get_template_part('parts/content','recent'); ?>
            </div>
            <?php } ?>
            <?php wp_reset_postdata();?>
              <section class="col-md-push-1 col-md-7">
                <section class="intro-home">
                  <section class="col-md-6 left">
                    <ul>
                      <li><a href="<?php echo get_site_url(); ?>/actualites/">Actualités</a></li>
                      <li><a href="<?php echo get_site_url(); ?>/infos/">Plus d'infos</a></li>
                      <li><a href="<?php echo get_site_url(); ?>/activites-du-mois/">Activités du mois</a></li>
                      <li><a href="<?php echo get_site_url(); ?>/contact/">Contact</a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </section>
                  <section class="col-md-6 right">
                    <h1>La mairie de Laon</h1>
                    <p>Vous êtes les bienvenus sur le site de la Mairie de Laon dans l’Aisne en Picardie. Ce site internet regroupe l’ensemble des actualités, événements culturels comme le sport, la natation et bien d’autres sports. Vous pourrez aussi voir les activités à venir dans la section des “activités du mois” pour lesquels vous pourrez vous inscrire et participer. <br><br>Nous restons à votre disposition si vous souhaitez nous contacter pour obtenir plus d’informations sur nos événements via notre formulaire sur la page contact.</p>
                  </section>
                  <div class="clearfix"></div>
              </section>
            </section>
        </div>

    </div>
</div>

<script>
jQuery(document).ready(function($){
  $("#myCarousel .carousel-indicators li:first").addClass("active");
  $("#myCarousel .carousel-inner .item:first").addClass("active");
   $("#myCarousel").carousel({
  interval: 4000
  })
});
</script>

<?php } ?>
