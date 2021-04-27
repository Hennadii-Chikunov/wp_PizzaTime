<?php 
// делаем проверку, если у нас переменаня не определена, то мы выходим
if (!defined('ABSPATH')) {
	exit;
}


use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Настройки сайта' ) )
        ->add_tab( 'Общие настройки', [
            Field::make( 'image', 'site_logo', 'Логотип' ),
         ])

			->add_tab( 'Контакты', [
            Field::make( 'text', 'site_phone', 'Телефон' ),
				Field::make( 'text', 'site_phone_digits', 'Телефон без пробелов в формате +380639999999' ),
				Field::make( 'text', 'site_address', 'Адрес' ),
				Field::make( 'text', 'site_map_coordinates', 'Координаты карты' ),
            Field::make( 'text', 'site_in_url', 'LinkedIn' ),
				Field::make( 'text', 'site_twit_url', 'Twitter' ),
				Field::make( 'text', 'site_insta_url', 'Instagram' ),
         ]);