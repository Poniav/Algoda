<?php
/**
* The template part for displaying the post entry in the recent posts on the front page (static)
*
* @package vega
*/
?>
<?php
$vega_wp_blog_feed_meta = vega_wp_get_option('vega_wp_blog_feed_meta');
if($vega_wp_blog_feed_meta == 'Y') {
    $vega_wp_blog_feed_meta_author = vega_wp_get_option('vega_wp_blog_feed_meta_author');
    $vega_wp_blog_feed_meta_category = vega_wp_get_option('vega_wp_blog_feed_meta_category');
    $vega_wp_blog_feed_meta_date = vega_wp_get_option('vega_wp_blog_feed_meta_date');
}
$vega_wp_blog_feed_buttons = vega_wp_get_option('vega_wp_blog_feed_buttons');
global $key;
?>
<div class="post-grid recent-entry" id="recent-post-<?php the_ID(); ?>">
    <div class="recent-entry-image image">
        <?php if(has_post_thumbnail()) { ?>
        <a class="post-thumbnail post-thumbnail-recent" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'vega-post-thumbnail-recent', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
        <?php } else { ?>
        <a class="post-thumbnail post-thumbnail-recent" href="<?php the_permalink(); ?>"><img src="<?php vega_wp_random_thumbnail('vega-post-thumbnail-recent'); ?>" class="img-responsive" /></a><?php } ?>
        <div class="caption">
            <div class="caption-inner">
                <a href="<?php the_permalink(); ?>" class="icon-link white"><i class="fa fa-link"></i></a>
            </div>
            <div class="helper"></div>
        </div>
    </div>
    <!-- Post Title -->
    <?php #if no title is defined for the post...
    if(get_the_title() == '') { $id = get_the_ID(); ?>
    <h4 class="recent-entry-title"><a href="<?php the_permalink(); ?>"><?php _e('ID: ', 'vega'); echo $id; ?></a></h4>
    <?php } else { ?>
    <h4 class="recent-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <?php } ?>
    <!-- /Post Title -->

    <div class="recent-entry-content">
        <?php ext_content(0, 85); ?>
    </div>

    <?php if($vega_wp_blog_feed_buttons == 'Y') { ?>
    <!-- Post Buttons -->
    <div class="recent-entry-buttons">
        <a href="<?php the_permalink(); ?>" class="btn-recent"><?php echo esc_html(vega_wp_get_option('vega_wp_blog_feed_readme_text')); ?></a>
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
