<?php
/**
* The template for displaying the footer
*
* @package vega
*/
?>

<?php get_sidebar('footer'); ?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
              <p class="text-left">Tous droits réservés @2016 Mairie de Laon</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <p class="text-right">
                <a href="<?php echo esc_url( home_url( '/wp-admin/' ) ); ?>" class="admin">Accès Administration</a>
              </p>
            </div>
        </div>
    </div>
</footer>

<?php get_template_part('parts/footer', 'back-to-top'); ?>
<?php wp_footer(); ?>

<script>jQuery(document).ready(function(){
    /*search box*/
    jQuery('#q').focus(function(){
        jQuery('form.search').addClass('selected');
    });
    jQuery('#q').blur(function(){
        jQuery('form.search').removeClass('selected');
    });
    jQuery('html').click(function(e){
        if(jQuery(e.target).is('#q')){}else if(jQuery('.srch form').hasClass('selected')){jQuery('.srch form').removeClass('selected');}
    });
    jQuery('.srch form button[type="submit"]').click(function(e){
        if(jQuery('.srch form').hasClass('selected') && (jQuery('#q').val().length != 0)){}else{
            e.preventDefault();
            e.stopPropagation();
            jQuery('.srch form').addClass('selected');
            if(jQuery('#q').val().length != 0){}else{jQuery('#q').focus();}
        }
    });
});</script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</body>
</html>
