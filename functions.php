<?php

function load_stylesheets()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('style_cards', get_template_directory_uri() . '/style_cards.css', array(), false, 'all');
    wp_enqueue_style('style_cards');

    wp_register_style('style_slides', get_template_directory_uri() . '/style_slides.css', array(), false, 'all');
    wp_enqueue_style('style_slides');

    wp_register_style('style_top', get_template_directory_uri() . '/style_top.css', array(), false, 'all');
    wp_enqueue_style('style_top');

    wp_register_style('style_base', get_template_directory_uri() . '/style.css', array(), false, 'all');
    wp_enqueue_style('style_base');

}

add_action('wp_enqueue_scripts', 'load_stylesheets');

function load_javascripts()
{
    wp_register_script('customjs', get_template_directory_uri() . '/scripts.js', __FILE__, 1, false);
    wp_enqueue_script('customjs');
}

add_action('wp_enqueue_scripts', 'load_javascripts');

// function mytheme_dequeue_css_from_plugins()  {
// 	wp_dequeue_style( "plugin-css-file-handle" );
// }
// add_action('wp_print_styles', 'mytheme_dequeue_css_from_plugins', 100);

?>
