<?php
/**
 * The template part for displaying the post entry in the blog feed
 *
 * @package vega
 */
?>
<?php
$vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo');
$vega_wp_blog_feed_animations = vega_wp_get_option('vega_wp_blog_feed_animations');
$vega_wp_animations = vega_wp_get_option('vega_wp_animations');

#show meta?
$vega_wp_blog_feed_meta = vega_wp_get_option('vega_wp_blog_feed_meta');
if($vega_wp_blog_feed_meta == 'Y') {
    $vega_wp_blog_feed_meta_author = vega_wp_get_option('vega_wp_blog_feed_meta_author');
    $vega_wp_blog_feed_meta_category = vega_wp_get_option('vega_wp_blog_feed_meta_category');
    $vega_wp_blog_feed_meta_date = vega_wp_get_option('vega_wp_blog_feed_meta_date');
}
#display type
$vega_wp_blog_feed_display = vega_wp_get_option('vega_wp_blog_feed_display');
#show buttons?
$vega_wp_blog_feed_buttons = vega_wp_get_option('vega_wp_blog_feed_buttons');
?>

<?php
if($vega_wp_blog_feed_animations == 'Y' && $vega_wp_animations == 'Y')  $post_class = 'wow zoomIn';
else $post_class = '';
?>

<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix ' . $post_class); ?>>


    <?php #if no title is defined for the post...
    if(get_the_title() == '') { ?>

    <?php $id = get_the_ID(); ?>
    <?php if($vega_wp_blog_feed_display != 'Small Image Left, Excerpt Right') { ?>
    <!-- Post Title -->
    <h3 class="entry-title block-title block-title-left"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('Post ID: ', 'vega'); echo $id; ?></a></h3>
    <?php } else { ?>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('Post ID: ', 'vega'); echo $id; ?></a></h3>
    <?php } ?>
    <!-- /Post Title -->

    <?php } else { ?>

    <?php if($vega_wp_blog_feed_display != 'Small Image Left, Excerpt Right') { ?>
    <!-- Post Title -->
    <h3 class="entry-title block-title block-title-left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php } else { ?>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <!-- /Post Title -->
    <?php } ?>

    <?php } ?>

    <?php if($vega_wp_blog_feed_display == 'Small Image Left, Excerpt Right') { ?>

    <!-- Small Image Left, Excerpt Right -->
    <div class="entry-image entry-image-left">
        <?php if(has_post_thumbnail()) { ?>
        <a class="post-thumbnail post-thumbnail-small" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
        <?php } else { ?>
        <a class="post-thumbnail post-thumbnail-small" href="<?php the_permalink(); ?>"><img src="<?php vega_wp_random_thumbnail(); ?>" class="img-responsive" /></a><?php } ?>
    </div>

    <div class="entry-content-right">
        <?php the_excerpt(); ?>
        <?php wp_link_pages(); ?>
    </div>
    <!-- /Small Image Left, Excerpt Right -->

    <?php } else if($vega_wp_blog_feed_display == 'Large Image Top, Full Content Below') { ?>

    <!-- Large Image Top, Full Content Below -->
    <?php if(has_post_thumbnail()) { ?>
    <div class="entry-image entry-image-top">
        <a class="post-thumbnail post-thumbnail-large" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?></a>
    </div>
    <?php } else if($vega_wp_enable_demo == 'Y') { ?>
        <a class="post-thumbnail post-thumbnail-large" href="<?php the_permalink(); ?>"><img src="<?php vega_wp_random_thumbnail('full'); ?>" class="img-responsive" /></a><?php } ?>
    <div class="entry-content">
        <?php the_content(__('View full post...', 'vega')); ?>
        <?php wp_link_pages(); ?>
    </div>
    <!-- /Large Image Top, Full Content Below -->

    <?php } else if($vega_wp_blog_feed_display == 'No Image, Excerpt') { ?>

    <!-- No Image, Excerpt -->
    <div class="entry-content">
        <?php the_content('...'); ?>
        <?php wp_link_pages(); ?>
    </div>
    <!-- No Image, Excerpt -->

    <?php } ?>
    <div class="clearfix"></div>
    <div class="post-actus">

    <div class="col-md-12">

    <?php if($vega_wp_blog_feed_meta == 'Y') { ?>

    <!-- Post Meta -->
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 entry-meta <?php if($vega_wp_blog_feed_display == 'Small Image Left, Excerpt Right') { ?><?php } ?>">
      <span class="author">La Mairie de Laon</span>
      <span class="dateentry"><?php echo get_the_date(); ?></span>
    </div>

    <?php } ?>

    <?php if($vega_wp_blog_feed_buttons == 'Y') { ?>

    <!-- Post Buttons -->
    <div class="col-xs-12 col-sm-4 col-md-push-1 col-md-3 entry-buttons <?php if($vega_wp_blog_feed_display == 'Small Image Left, Excerpt Right') { ?><?php } ?>">
        <a href="<?php the_permalink(); ?>" class="btn-feed"><?php echo esc_html(vega_wp_get_option('vega_wp_blog_feed_readme_text')); ?></a>
        <?php if ( ! post_password_required() && comments_open() || '0' != get_comments_number() )  { ?>
        <?php
        $nocomments = esc_html(vega_wp_get_option('vega_wp_blog_feed_nocomments_text'));
        $comment = esc_html(vega_wp_get_option('vega_wp_blog_feed_comment_text'));
        $comments = esc_html(vega_wp_get_option('vega_wp_blog_feed_comments_text'));
        ?>
        <?php comments_popup_link( $nocomments, '1 ' . $comment, '% ' . $comments, 'btn btn-inverse' ); ?>
        <?php } ?>
    </div>
    <!-- /Post Buttons -->
    <?php } ?>

    </div>
    </div>
</div>
