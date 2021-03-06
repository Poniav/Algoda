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

    $args = array( 'post_type' => 'events', 'posts_per_page' => 10 );
    $loop = new WP_Query( $args );

?>
<section class="events-page responsive-table-line">

  <table class="table table-condensed table-striped table-responsive">
    <thead>
      <tr>
        <th data-title="Titre" class="titleth">Titre</th>
        <th data-title="Date" class="dateth">Date</th>
        <th data-title="Description">Description</th>
        <th data-title="Inscription">Inscription</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while ( $loop->have_posts() ) : $loop->the_post(); ?>

              <tr>
                <td data-title="Titre"><?php the_title();?></td>
                <?php $date_events = get_post_meta( get_the_ID(), '_event_value_key', true ); ?>
                <td data-title="Date"><?php echo $date_events; ?></td>
                <td data-title="Description"><?php the_content(); ?></td>
                <?php $register_events = get_post_meta( get_the_ID(), '_register_key', true ); ?>
                <?php if($register_events == 'Oui') : ?>
                  <td data-title="Inscription">
                    <a class="btn btn-open register link2" data-toggle="modal" data-target="#myModal" data-date="<?php echo $date_events; ?>" data-title="<?php the_title(); ?>" onClick="getData(this)" ;="">S'inscrire</a>
                  </td>
                <?php else : ?>
                  <td data-title="Inscription">
                    <a class="btn btn-close">Close</a>
                  </td>
                <?php endif; ?>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </div>

    </div>
  </div>
  <div class="modal fade" id="myModalConfirm" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <i class="fa fa-check-circle" aria-hidden="true"></i>
          <p>Nous vous <strong>confirmons votre inscription</strong>.</br> Vous allez prochainement recevoir un mail.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
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

      function addConfirm(){
        $('#myModal').modal('hide');$('#myModalConfirm').modal('show');
      }

  </script>

<?php endwhile; ?>

<?php get_footer(); ?>
