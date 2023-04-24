<!-- Initialisation -->
<?php

function montheme_supports(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');   
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/main.css',array(), '1.0'
    );
}
add_action('after_setup_theme', 'montheme_supports');

// function montheme_register_assets(){
//     wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', []);
//     wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
//     wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
//     wp_deregister_script('jquery');
//     wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
//     wp_enqueue_style('bootstrap');
//     wp_enqueue_script('bootstrap');

// }
// ?>

<!-- Menu -->
