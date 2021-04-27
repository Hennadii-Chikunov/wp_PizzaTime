<?php

add_filter('show_admin_bar', '__return_false');

// убираем лишние теги wordpress для очистки проекта
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles' );

remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator'); // remove meta name generator
remove_action('wp_head', 'rsd_link'); // remove EditURI
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_oembed_add_discovery_links');


add_action('wp_enqueue_scripts', 'site_scripts');

function site_scripts() {
	// переменная версии всех стилей меняем в одном месте, здесь
	$version = '0.0.0.0';
   // данная функция удаляет лишний тег из head   
	// wp_dequeue_style отключает стили
	wp_dequeue_style('wp-block-library');
	wp_deregister_script( 'wp-embed' ); // отключает ненужный скрипт

	// подключает стили
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Roboto:wght@300&display=swap', [], $version);
	wp_enqueue_style('main-style', get_stylesheet_uri(), [], $version);
// подключил библиотеку focus VISIBLE для людей с ограниченными возможностями
	wp_enqueue_script('focus-visible', 'https://unpkg.com/focus-visible@5.2.0/dist/focus-visible.js', [], $version, true);
	wp_enqueue_script('lazy-load', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.1/dist/lazyload.min.js', [], $version, true);
	wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', ['focus-visible', 'lazy-load'], $version, true);

	// внешние скрипты js  подключаются через, ниже пример и в нем указывается зависимость
	wp_localize_script('main-js', 'WPJS', [
       'siteUrl' => get_template_directory_uri(),
	]);
}

add_action( 'after_setup_theme', 'theme_support' );
function theme_support() {
  register_nav_menu( 'menu_main_header', 'Меню в шапке' );
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once('includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

// подключаем theme-options.php
add_action('carbon_fields_register_fields', 'register_carbon_fields');
function register_carbon_fields() {
	 require_once('includes/carbon-fields-options/theme-options.php' );
}

// глобальные переменные для уменьшения количества запросов в базу данных
add_action('init', 'create_global_variable');
function create_global_variable() {
	global $pizza_time;
	$pizza_time = [
     'phone' => carbon_get_theme_option('site_phone'),
	  'phone_digits' => carbon_get_theme_option('site_phone_digits'),
	  'address' => carbon_get_theme_option('site_address'),
	  'map_coordinates' => carbon_get_theme_option( 'site_map_coordinates' ),
	  'in_url' => carbon_get_theme_option( 'site_in_url' ),
    'twit_url' => carbon_get_theme_option( 'site_twit_url' ),
    'insta_url' => carbon_get_theme_option( 'site_insta_url' ),
	];
}
