<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<meta name="description" content="PizzaTime — Лучшая пицца в Днепре от итальянского повара">
	<meta name="keywords" content="пицца">
	<meta property="og:title" content="PizzaTime — Лучшая пицца в Днепре от итальянского повара" />
	<meta property="og:description" content="PizzaTime — Лучшая пицца в Днепре от итальянского повара" />
	<meta property="og:image" content="img/section-top/bg-header.jpg" />
    <!-- favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-16x16.png">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#000000">
	<!-- /.favicon -->
	<title>PizzaTime — Лучшая пицца в Днепре от итальянского повара</title>

	<?php wp_head(); ?>
</head>
<body>
    

	 <!-- header PAGE -->
	 <header class="header-page">
		 <div class="container header-page__container">
           <div class="header-page__start">
				  <div class="logo">
					  <!-- ИНЛАЙН СТИЛИ ПРОПИСАНЫ ДЛЯ ЛОГО С ЦЕЛЬЮ защитить размеры при "слете внешних стилей" -->
					  <img  data-src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" alt="PizzaTime" class="logo__img lazy"  width="127" height="21">
				  </div>
			  </div>
			  <div class="header-page__end">
				  <nav class="header-page__nav">
					  <ul class="header-page__list">
						  <li class="header-page__item">
							  <a href="#" class="header-page__link" data-scroll-to="section-catalog">
								  <span class="header-page__link-name">пицца</span>
							  </a>
						  </li>
						<li class="header-page__item">
							<a href="#" class="header-page__link" data-scroll-to="section-about">
								<span class="header-page__link-name">о нас</span>
							</a>
						</li>
						<li class="header-page__item">
							<a href="#" class="header-page__link" data-scroll-to="section-contacts">
								<span class="header-page__link-name">контакты</span>
							</a>
						</li>
					  </ul>
				  </nav>
				  <div class="phone">
					  <a href="tel:+380639999999" class="phone__item">+380 (63) 999-99-99</a>
				  </div>
				  <!-- меню бургер -->
				  <div class="header-page__hamburger">
					  <button class="btn-menu" type="button" data-popup="popup-menu">
						  <span class="btn-menu__box">
							  <span class="btn-menu__inner"></span>
						  </span>
					  </button>
				  </div>
					<!-- / меню бургер -->
			  </div>
		 </div>
	 </header>
	 <!-- / .header PAGE -->