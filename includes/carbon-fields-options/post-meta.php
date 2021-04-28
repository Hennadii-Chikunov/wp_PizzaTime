<?php 
// делаем проверку, если у нас переменаня не определена, то мы выходим
if (!defined('ABSPATH')) {
	exit;
}


use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __( 'Дополнительные поля' ) )
        ->show_on_page(16)

        ->add_tab( 'Первый экран', [
            Field::make( 'text', 'top_info', 'Надзаголовок' ),
				Field::make( 'text', 'top_title', 'Заголовок' ),
				Field::make( 'text', 'top_btn_text', 'Текст кнопки' )
				  	->set_width(50),		
				Field::make( 'text', 'top_btn_scrool_to', 'Класс секции для перехода по кнопке' )
               ->set_width(50),				
				Field::make( 'image', 'top_img', 'Изображение' ),
         ])

			->add_tab( 'Каталог', [
            Field::make( 'text', 'catalog_title', 'Заголовок' ),
         ])

			->add_tab( 'О нас', [
            Field::make( 'text', 'about_title', 'Заголовок' ),
				Field::make( 'rich_text', 'about_text', 'Текст' ),
				Field::make( 'image', 'about_img', 'Изображение' ),
         ])

			->add_tab( 'Контакты', [
            Field::make( 'text', 'contacts_title', 'Заголовок' ),
				Field::make( 'checkbox', 'contacts_is_img', __( 'Показать изображение помидоров' ) ),
         ]);

