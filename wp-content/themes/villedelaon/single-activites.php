<?php
/*
Template Name: Single Activites
*/
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>


<div class="section post-content bg-white infos-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php

    $args = array( 'post_type' => 'events', 'posts_per_page' => 7 );
    $loop = new WP_Query( $args );

?>
<section class="events-page">

  <table class="table table-condensed table-striped table-responsive">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Description</th>
        <th>Inscription</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while ( $loop->have_posts() ) : $loop->the_post(); ?>

              <tr>
                <td><?php the_title();?></td>
                <?php $date_events = get_post_meta( get_the_ID(), '_event_value_key', true ); ?>
                <td><?php echo $date_events; ?></td>
                <td><?php the_content(); ?></td>
                <td><a class="btn btn-primary register link2" data-toggle="modal" data-target="#myModal" data-date="<?php echo $date_events; ?>" data-title="<?php the_title(); ?>" onClick="getData(this)" ;="">Inscription</a></td>
              </tr>

    <?php endwhile; ?>

          </tbody>
       </table>

          <div class="clearfix"></div>
      </section>
          </div>
        </div>
    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inscription</h4>
        </div>
        <div class="modal-body">
          <p>Evenement : <span class="event-name"></span></p>
          <p>Date : <span class="event-date"></span></p>
        </div>
        <?php echo do_shortcode( '[contact-form-7 id="130" title="Form Inscription"]' ); ?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <script type="text/javascript">

      function getData(obj){
        var title = obj.getAttribute('data-title');
        var date = obj.getAttribute('data-date');

        var eventName = document.querySelector(".event-name");
        var eventDate = document.querySelector(".event-date");
        eventName.textContent = title;
        eventDate.textContent = date;

        var eventSelect = document.getElementById("eventvalue");
        var dateSelect = document.getElementById("datevalue");
        eventSelect.value = title;
        dateSelect.value = date;
      }

      function closeWindows(){
          $('#myModal').click(function(){
            // Set a timeout to hide the element again
              setTimeout(function(){
                  $("p").hide();
              }, 3000);
          });
      }

  </script>

<?php endwhile; ?>

<?php get_footer(); ?>
