<?php
/**
 * The Header for the theme.
 *
 * Displays all of the <head> section and logo and navigation
 *
 * @package vega
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type='image/x-icon' href="<?php echo get_site_url(); ?>/wp-content/themes/villedelaon/assets/img/favicon.ico" />
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                <?php get_template_part('parts/header', 'logo'); ?>
            </div>
            <div class="srch clearfix">
                <form method="GET" action="<?php echo get_site_url(); ?>">
                    <div class="cbd"><input max-length="120" autocomplete="off" placeholder="Rechercher..." value="<?php the_search_query(); ?>" name="s" id="q"><button type="submit" title="Rechercher sur le site"><i class="fa fa-search"></i></button></div>
                </form>
            </div>
            <?php if ( has_nav_menu( 'header' ) ) :  ?>

            <?php wp_nav_menu( array(
                    'theme_location'    => 'header',
                    'depth'             => 3,
                    'container'         => 'div',
                    'container_class'   => 'navbar-collapse collapse',
                    'menu_class'        => 'nav navbar-nav navbar-right menu-header',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker()
                    )
                );
            ?>

            <?php else: ?>

            <?php
            vega_wp_example_nav_header();
            ?>

            <?php endif; ?>


        </div>
        <div class="clearfix"></div>
    </div>
    <section class="intro">
      <section class="container">
        <div class="row">
          <h2>Vous êtes les bienvenus sur le site de la<span> Ville de Laon</span></h2>
        </div>
      </section>
    </section>
