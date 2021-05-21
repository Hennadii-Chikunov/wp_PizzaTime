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
  // добавляет изображение к записи когда добавляешь товар
  add_theme_support('post-thumbnails');
  add_image_size('product', 768, 768, true);
   // добавляет изображение к записи когда добавляешь товар
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
	 require_once('includes/carbon-fields-options/post-meta.php' );
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

function convertToWebpSrc($src) {
  $src_webp = $src . '.webp';
  return str_replace('uploads', 'uploads-webpc', $src_webp);
}

add_action( 'init', 'register_post_types' );
function register_post_types() {
  register_post_type('product', [
    'labels' => [
      'name'               => 'Товары', // основное название для типа записи
      'singular_name'      => 'Товар', // название для одной записи этого типа
      'add_new'            => 'Добавить товар', // для добавления новой записи
      'add_new_item'       => 'Добавление товара', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item'          => 'Редактирование товара', // для редактирования типа записи
      'new_item'           => 'Новый товар', // текст новой записи
      'view_item'          => 'Смотреть товар', // для просмотра записи этого типа.
      'search_items'       => 'Искать товар', // для поиска по этим типам записи
      'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'menu_name'          => 'Товары', // название меню
    ],
    'menu_icon'          => 'dashicons-cart',
    'public'             => true,
    'menu_position'      => 5,
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
    'has_archive'        => true,
    'rewrite'            => ['slug' => 'products']
   ] );

   register_taxonomy('product-categories', 'product', [
    'labels'        => [
      'name'                        => 'Категории товаров',
      'singular_name'               => 'Категория товаров',
      'search_items'                =>  'Искать категории',
      'popular_items'               => 'Популярные категории',
      'all_items'                   => 'Все категории',
      'edit_item'                   => 'Изменить категорию',
      'update_item'                 => 'Обновить категорию',
      'add_new_item'                => 'Добавить новую категорию',
      'new_item_name'               => 'Новое название категории',
      'separate_items_with_commas'  => 'Отделить категории запятыми',
      'add_or_remove_items'         => 'Добавить или удалить категорию',
      'choose_from_most_used'       => 'Выбрать самую популярную категорию',
      'menu_name'                   => 'Категории',
    ],
    'hierarchical'  => true,
  ]);
}

function sanitize_pagination($content) {
  // Remove h2 tag
  $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
  return $content;
}

add_action('navigation_markup_template', 'sanitize_pagination');