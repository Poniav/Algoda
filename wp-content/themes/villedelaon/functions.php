<?php

// Importation du style css du theme

function wpm_enqueue_styles(){
  wp_enqueue_style( 'vega', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );


// Ajout d'un champs de recherche au Menu

function add_search_box($items, $args) {

        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();

        $items .= '<li class="form-search">' . $searchform . '</li>';
        return $items;
}
add_filter('wp_nav_menu_items','add_search_box', 10, 2);


// Supprimer la barre du haut WP

function wpc_show_admin_bar() {
	return false;
}
add_filter('show_admin_bar' , 'wpc_show_admin_bar');

/**
* Sécurité
**/

// Supprimer l'éditeur de fichier depuis wordpress

define('DISALLOW_FILE_EDIT',true);

// Supprimer les erreurs

add_filter('login_errors',create_function('$a', "return null;"));

// Supprimer version WP

function wpbeginner_remove_version() {
        return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');


/**
* Widget Contact Sidebar
**/


function register_my_widget_theme()  {

	register_sidebar(array(

		'id' => 'contact-sidebar', // identifiant
		'name' => 'Sidebar Contact', // Nom a afficher dans le tableau de bord
		'description' => 'Sidebar pour la page contact.', // description facultatif
		'before_widget' => '<section id="%1$s" class="widget %2$s">', // class attribuer pour le contenu (css)
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widgettitle">', // class attribuer  pour le titre (css)
		'after_title' => '</h2>',
	));
}

add_action( 'init', 'register_my_widget_theme' );


/**
*  Système Slider Custom Post
**/

function slider_custom_post_type (){

	$labels = array(
		'name' => 'Slider',
		'singular_name' => 'Slider',
		'add_new' => 'Ajouter Slide',
		'all_items' => 'Les Sliders',
		'add_new_item' => 'Ajouter un Slide',
		'edit_item' => 'Modifier Slide',
		'new_item' => 'Nouveau Slider',
		'view_item' => 'Voir Slide',
		'search_item' => 'Recherche Slide',
		'not_found' => 'Aucun Slide',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
    'menu_icon' => 'dashicons-slides',
    'media_buttons' => false,
    'public' => false,
    'publicly_queriable' => true,
    'show_ui' => true,
    'exclude_from_search' => true,
    'show_in_nav_menus' => false,
    'has_archive' => false,
    'rewrite' => false,
		'supports' => array(
      'thumbnail',
			'revisions',
		),
		'menu_position' => 9,
		'exclude_from_search' => false
	);
	register_post_type('slider',$args);
}
add_action('init','slider_custom_post_type');

// Meta Box Slider Admin

add_action('add_meta_boxes','slider_metabox');
function slider_metabox(){
  add_meta_box('configuration-slider', 'Configuration', 'slider_data', 'slider', 'normal');
}

function slider_data($post){
  $url = get_post_meta($post->ID,'_slider_link',true);
  $texarea = get_post_meta($post->ID,'_slider_text',true);
  $text_sub = get_post_meta($post->ID,'_slider_text_sub',true);
  echo '<h4>1) Titre du Slider</h4>';
  echo '<input id="textareaslider" style="width:45%;" type="text" maxlength="80" placeholder="Ajouter un titre" name="slider_text" value="'.$texarea.'" />';
  echo '<h4>2) Texte du Slider</h4>';
  echo '<input id="textslider" style="width:45%;" type="text" maxlength="80" placeholder="Ajouter du texte" name="slider_text_sub" value="'.$text_sub.'" />';
  echo '<h4>3) Lien du button</h4>';
  echo '<input id="linkslider" style="width:25%;" type="url" placeholder="Ajouter un lien" name="slider_link" value="'.$url.'" /></br>';
  echo '<div style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 15px;margin-top:10px;margin-bottom: 10px;border: 1px solid transparent;border-radius: 4px;">';
  echo 'Laisser vide si vous ne souhaitez pas ajouter de lien. Autrement, veuillez ajouter un lien valide. <strong>Exemple : </strong>'.get_site_url().'/actualites/';
  echo '</div>';
}

add_action('save_post','slider_save_metabox');
function slider_save_metabox($post_id){
  if(isset($_POST['slider_link']) && isset($_POST['slider_text']) && isset($_POST['slider_text_sub'])) {
      update_post_meta($post_id, '_slider_link', esc_url($_POST['slider_link']));
      update_post_meta($post_id, '_slider_text', $_POST['slider_text']);
      update_post_meta($post_id, '_slider_text_sub', $_POST['slider_text_sub']);
  }
}
// Image Size Slider

add_image_size('slider', 1600, 460, true);


// Personnalisation Admin Events

function slider_columns( $columns ){
	$newColumns = array();
	$newColumns['titre'] = 'Titre';
  $newColumns['desc'] = 'Description';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function slider_custom_column( $column, $post_id ){

	switch( $column ){

		case 'titre' :
      $titre = get_post_meta( $post_id, '_slider_text', true );
			echo $titre;
			break;

		case 'desc' :
			$text_sub = get_post_meta( $post_id, '_slider_text_sub', true );
			echo $text_sub;
			break;
	}

}

add_filter( 'manage_slider_posts_columns', 'slider_columns' );
add_action( 'manage_slider_posts_custom_column', 'slider_custom_column', 10, 2 );


// Ajouter Custom Post Infos

function awesome_custom_post_type (){

	$labels = array(
		'name' => 'Infos',
		'singular_name' => 'Infos',
		'add_new' => 'Ajout Infos',
		'all_items' => 'Les Infos',
		'add_new_item' => 'Ajouter une Infos',
		'edit_item' => 'Modifier Infos',
		'new_item' => 'Nouvelle Infos',
		'view_item' => 'Voir Infos',
		'search_item' => 'Recherche Infos',
		'not_found' => 'Aucune Infos',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
    'menu_icon' => 'dashicons-flag',
    'media_buttons' => false,
    'public' => false,
    'publicly_queriable' => true,
    'show_ui' => true,
    'exclude_from_search' => true,
    'show_in_nav_menus' => false,
    'has_archive' => false,
    'rewrite' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
		),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('infos',$args);
}
add_action('init','awesome_custom_post_type');


// Ajouter Custom events

function events_custom_post_type (){

	$labels = array(
		'name' => 'Evenements',
		'singular_name' => 'Evenements',
		'add_new' => 'Ajout Evenements',
		'all_items' => 'Les Evenements',
		'add_new_item' => 'Ajouter un Events',
		'edit_item' => 'Modifier Events',
		'new_item' => 'Nouvelle Events',
		'view_item' => 'Voir Events',
		'search_item' => 'Recherche Events',
		'not_found' => 'Aucun Events',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
    'menu_icon' => 'dashicons-calendar-alt',
    'media_buttons' => false,
    'public' => false,
    'publicly_queriable' => true,
    'show_ui' => true,
    'exclude_from_search' => true,
    'show_in_nav_menus' => false,
    'has_archive' => false,
    'rewrite' => false,
		'supports' => array(
			'title',
			'editor',
			'revisions',
		),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('events',$args);
}
add_action('init','events_custom_post_type');


// Personnalisation Admin Infos

function infos_columns( $columns ){
	$newColumns = array();
  $newColumns['thumbnail_infos'] = 'Média';
	$newColumns['title'] = 'Titre';
  $newColumns['desc'] = 'Description';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function infos_custom_column( $column, $post_id ){

	switch( $column ){

    case 'thumbnail_infos' :
			the_post_thumbnail(array(100,100));
			break;

		case 'desc' :
			echo substr(get_the_content(), 0, 120);
			break;

	}

}

add_filter( 'manage_infos_posts_columns', 'infos_columns' );
add_action( 'manage_infos_posts_custom_column', 'infos_custom_column', 10, 2 );


// Personnalisation Admin Events


function events_columns( $columns ){
	$newColumns = array();
	$newColumns['title'] = 'Titre';
  $newColumns['desc'] = 'Description';
	$newColumns['date_events'] = 'Date Evenements';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function events_custom_column( $column, $post_id ){

	switch( $column ){

		case 'desc' :
			echo substr(get_the_content(), 0, 120);
			break;

		case 'date_events' :
			$date_events = get_post_meta( $post_id, '_event_value_key', true );
			echo $date_events;
			break;
	}

}

add_filter( 'manage_events_posts_columns', 'events_columns' );
add_action( 'manage_events_posts_custom_column', 'events_custom_column', 10, 2 );


// Custom Meta Box - Inscription On / Off


add_action('add_meta_boxes','register_metabox');
function register_metabox(){
  add_meta_box('events_register', 'Configuration', 'register_save_date', 'events', 'side');
}

function register_save_date($post){
  $open = get_post_meta($post->ID,'_register_key',true);
  echo '<label for="dispo_meta">Ouverture des inscriptions :</label></br></br>';
  echo '<select name="register_save_date">';
  echo '<option ' . selected( 'dispo', $open, false ) . ' value="Oui">Oui</option>';
  echo '<option ' . selected( 'encours', $open, false ) . ' value="Non">Non</option>';
  echo '</select>';
  echo '<div style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 15px;margin-top:10px;margin-bottom: 10px;border: 1px solid transparent;border-radius: 4px;">';
  echo '<strong>Attention ! </strong> Si vous cochez oui, les inscriptions seront ouvertes au public.</a>';
  echo '</div>';
}

add_action('save_post','save_metabox_register');
function save_metabox_register($post_id){
if(isset($_POST['register_save_date']))
  update_post_meta($post_id, '_register_key', $_POST['register_save_date']);
}


// Custom Meta Box - Event Date

function custom_events_meta_box() {
	add_meta_box( 'events-infos', 'Evenement', 'events_callback', 'events', 'normal', 'high' );
}
function events_callback( $post ) {
	wp_nonce_field( 'events_save_data', 'events_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_event_value_key', true );

	echo '<label for="events_date_field">Date de l\'événement :  </lable>';
	echo '<input type="text" id="events_date_field" name="events_date_field" value="' . esc_attr( $value ) . '" size="25" />';
  echo '<div style="color: #31708f;background-color: #d9edf7;border-color: #bce8f1;padding: 15px;margin-top:10px;margin-bottom: 10px;border: 1px solid transparent;border-radius: 4px;">';
  echo 'Veuillez respecter le format JJ/MM/AAAA pour rentrer votre adresse</div>';

}
function events_save_data( $post_id ) {

	if( ! isset( $_POST['events_meta_box_nonce'] ) ){
		return;
	}

	if( ! wp_verify_nonce( $_POST['events_meta_box_nonce'], 'events_save_data') ) {
		return;
	}

	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}

	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if( ! isset( $_POST['events_date_field'] ) ) {
		return;
	}

	$my_data = sanitize_text_field( $_POST['events_date_field'] );

	update_post_meta( $post_id, '_event_value_key', $my_data );

}

add_action( 'add_meta_boxes', 'custom_events_meta_box' );
add_action( 'save_post', 'events_save_data' );



// Supprimer Media Button Custom Post Type - Infos & Events

function remove_media_button() {

    global $current_screen;
    if( 'infos' == $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');
    if( 'events' == $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');

}
add_action('admin_head','remove_media_button');


// Extrait home Text Last Post

function ext_content ($a, $b){
      $content = get_the_content();
      $content = strip_tags($content);
      if (strlen($content) > $b) {
          $content = wordwrap($content, $b);
          $i = strpos($content, "\n");
          if($i) {
            $content = substr($content, $a, $i);
            echo $content.'...';
          }
      }
}
