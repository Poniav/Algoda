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

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->

  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active"> <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/slider1.jpg'; ?>" style="width:100%" alt="La ville de Laon - Actualités">
      <div class="container">
        <div class="carousel-caption">
          <h1>La Ville de Laon</h1>
          <p>Découvrez les actualités du mois</p>
          <p><a class="btn-slider" href="<?php echo get_site_url(); ?>/actualites/" role="button">En voir plus</a></p>
        </div>
      </div>
    </div>
    <div class="item"> <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/slider1.jpg'; ?>" style="width:100%" data-src="" alt="Second    slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>La Ville de Laon</h1>
          <p>Découvrez les actualités du mois</p>
          <p><a class="btn-slider" href="<?php echo get_site_url(); ?>/activites-du-mois/" role="button">En voir plus</a></p>
        </div>
      </div>
    </div>
    <div class="item"> <img src="<?php echo get_stylesheet_directory_uri().'/assets/img/slider1.jpg'; ?>" style="width:100%" data-src="" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>Slide 3</h1>
          <p>Donec sit amet mi imperdiet mauris viverra accumsan ut at libero.</p>
          <p><a class="btn-slider" href="<?php echo get_site_url(); ?>/infos/" role="button">Browse gallery</a></p>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>


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

<?php } ?>
