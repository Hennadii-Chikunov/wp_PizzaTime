<?php
/*
Template Name: Главная
*/
?>
<?php $page_id = get_the_ID(); ?>
<?php get_header(); ?>

<!-- section-TOP -->
<?php 
	$top_img_id = carbon_get_post_meta( $page_id, 'top_img' );
   $top_img_src = wp_get_attachment_image_url( $top_img_id, 'full');
	$top_img_src_webp = convertToWebpSrc($top_img_src);
	?>
	<section class="section-top lazy" data-bg="<?php echo $top_img_src_webp; ?>" data-bg-replace-webp="<?php echo $top_img_src; ?>">
		<div class="container section-top__container">
			<p class="section-top__info"><?php echo carbon_get_post_meta( $page_id, 'top_info' ); ?></p>
			<h1 class="section-top__title"><?php echo carbon_get_post_meta( $page_id, 'top_title' );?></h1>
			<div class="section-top__btn">
				<button class="btn" type="button" data-scroll-to="<?php echo carbon_get_post_meta( $page_id, 'top_btn_scrool_to' );?>"><?php echo carbon_get_post_meta( $page_id, 'top_btn_text' );?></button>
			</div>
		</div>
	</section>
	<!-- / section-TOP -->

	<!-- section CATALOG -->
	<section class="section section-catalog">
		<div class="container">
         <header class="section__header">
				<h2 class="section__title section__title--accent"><?php echo carbon_get_post_meta( $page_id, 'catalog_title' );?></h2>
				<nav class="catalog-nav">
					<ul class="catalog-nav__wrapper">
						<li class="catalog-nav__item">
							<button class="catalog-nav__btn is-active" type="button" data-filter="all">все</button>
						</li>
						<li class="catalog-nav__item">
							<button class="catalog-nav__btn" type="button" data-filter="mushrooms">грибные</button>
						</li>
						<li class="catalog-nav__item">
							<button class="catalog-nav__btn" type="button" data-filter="meat">мясные</button>
						</li>
						<li class="catalog-nav__item">
							<button class="catalog-nav__btn" type="button" data-filter="cheese">сырные</button>
						</li>
					</ul>
				</nav>
			</header>
			<?php
      $catalog_products = carbon_get_post_meta( $page_id, 'catalog_products' );
      $catalog_products_ids = wp_list_pluck($catalog_products, 'id');

      $catalog_products_args = [
        'post_type' => 'product',
        'post__in' => $catalog_products_ids
      ];
      $catalog_products_query = new WP_Query( $catalog_products_args );
    ?>


     <?php if ( $catalog_products_query->have_posts() ) : ?>
    <div class="catalog">
 
          <?php while ( $catalog_products_query->have_posts() ) : $catalog_products_query->the_post(); ?>
           <div class="catalog__item" data-category="mushrooms">
           <?php echo get_template_part('product-content'); ?>
          </div>
          <?php endwhile; ?>

         <?php endif; ?>

          </div><!-- /.catalog -->
				
		
		</div>
	</section>
	<!-- / section CATALOG -->
	<!-- section ABOUT -->
	<section class="section section-about">
		<picture>
			<source type="image/webp" data-srcset="<?php echo get_template_directory_uri(); ?>/assets/img/section-about/bg.webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" />
			<img class="section-about__img lazy" data-src="<?php echo get_template_directory_uri(); ?>/assets/img/section-catalog/9.png" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" alt="about-bg" />
		</picture>
		<div class="container section-about__container">
           <div class="section-about__content">
				  <h2 class="section__title section-about__title"><?php echo carbon_get_post_meta( $page_id, 'about_title' );?></h2>
				  <div class="section-about__text">
					<?php echo carbon_get_post_meta( $page_id, 'about_text' );?>
				  </div>
			  </div>
		</div>
	</section>
	<!-- / section ABOUT -->
	<!-- section CONTACTS -->
	<section class="section section-contacts">
        <div class="container section-contacts__container">
		     <?php if (carbon_get_post_meta( $page_id, 'contacts_is_img' )) : ?>
               <div class="section-contacts__img lazy" data-bg="<?php echo get_template_directory_uri(); ?>/assets/img/section-contacts/tomatoes.webp" data-bg-replace-webp="img/section-contacts/tomatoes.png"></div>
           <?php endif; ?>
			  <header class="section__header">
				  <h2 class="section__title section-contacts__title"><?php echo carbon_get_post_meta( $page_id, 'contacts_title' );?></h2>
			  </header>
			  <div class="contacts">
				  <div class="contacts__start">
					  <div class="contacts__map" id="ymap" data-coordinates="<?php echo $GLOBALS['pizza_time']['map_coordinates']; ?>" data-address="<?php echo $GLOBALS['pizza_time']['address']; ?>">
					  </div>
				  </div>
				<div class="contacts__end">
					<address>
						<?php if ($GLOBALS['pizza_time']['address']) : ?>
                     <div class="contacts__item">
							<span class="contacts__title">Адрес</span>
							<p class="contacts__text"><?php echo $GLOBALS['pizza_time']['address']; ?></p>
						</div>
                  <?php endif; ?>
						<div class="contacts__item">
							<span class="contacts__title">Телефон</span>
							<a href="tel:<?php echo $GLOBALS['pizza_time']['phone_digits']; ?>" class="contacts__phone"><?php echo $GLOBALS['pizza_time']['phone']; ?></a>
						</div>
						<div class="contacts__item">
							<span class="contacts__title">Социальные сети</span>
							<ul class="socials">
							 <?php if ($GLOBALS['pizza_time']['in_url']) : ?>
								<li class="socials__item">
									<a href="<?php echo $GLOBALS['pizza_time']['in_url']; ?>" class="socials__link" target="_blank">
										<svg class="socials__icon socials__icon--in" viewBox="0 0 512 512" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
											<path
												d="m256 0c-141.363281 0-256 114.636719-256 256s114.636719 256 256 256 256-114.636719 256-256-114.636719-256-256-256zm-74.390625 387h-62.347656v-187.574219h62.347656zm-31.171875-213.1875h-.40625c-20.921875 0-34.453125-14.402344-34.453125-32.402344 0-18.40625 13.945313-32.410156 35.273437-32.410156 21.328126 0 34.453126 14.003906 34.859376 32.410156 0 18-13.53125 32.402344-35.273438 32.402344zm255.984375 213.1875h-62.339844v-100.347656c0-25.21875-9.027343-42.417969-31.585937-42.417969-17.222656 0-27.480469 11.601563-31.988282 22.800781-1.648437 4.007813-2.050781 9.609375-2.050781 15.214844v104.75h-62.34375s.816407-169.976562 0-187.574219h62.34375v26.558594c8.285157-12.78125 23.109375-30.960937 56.1875-30.960937 41.019531 0 71.777344 26.808593 71.777344 84.421874zm0 0" />
										</svg>
									</a>
								</li>
								<?php endif; ?>
								<?php if ($GLOBALS['pizza_time']['twit_url']) : ?>
								<li class="socials__item">
									<a href="<?php echo $GLOBALS['pizza_time']['twit_url']; ?>" class="socials__link" target="_blank">
										<svg class="socials__icon socials__icon--twit" width="40" height="40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
											<g>
												<path d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
													c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
													c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
													c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
													c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
													c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
													C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
													C480.224,136.96,497.728,118.496,512,97.248z" />
											</g>
										</svg>
									</a>
								</li>
								<?php endif; ?>
								<?php if ($GLOBALS['pizza_time']['insta_url']) : ?>
								<li class="socials__item">
									<a href="<?php echo $GLOBALS['pizza_time']['insta_url']; ?>" class="socials__link" target="_blank">
										<svg class="socials__icon socials__icon--insta" width="40" height="40" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512">
											<g>
												<path d="M359.312,0H152.689C68.849,0,0.64,68.208,0.64,152.049v207.903C0.64,443.792,68.849,512,152.689,512h206.623
														c83.839,0,152.048-68.208,152.048-152.048V152.049C511.359,68.208,443.151,0,359.312,0z M490.961,359.951
														c0,72.593-59.057,131.65-131.649,131.65H152.689c-72.593,0-131.65-59.057-131.65-131.649V152.049
														c0-72.593,59.057-131.65,131.65-131.65h206.623c72.592,0,131.649,59.057,131.649,131.65V359.951z" />
												<path d="M359.312,58.294H152.689c-51.698,0-93.756,42.057-93.756,93.755v207.904c0,51.697,42.058,93.755,93.756,93.755h206.623
														c51.697,0,93.755-42.058,93.755-93.755V152.049C453.067,100.352,411.009,58.294,359.312,58.294z M432.669,359.951
														c0,40.449-32.908,73.357-73.357,73.357H152.689c-40.45,0-73.358-32.908-73.358-73.357V152.048
														c0-40.449,32.908-73.357,73.358-73.357v0.001h206.623c40.449,0,73.357,32.908,73.357,73.357V359.951z" />
											</g>
											<g>
												<path d="M256,124.178c-72.686,0-131.821,59.135-131.821,131.822S183.313,387.821,256,387.821S387.821,328.687,387.821,256
														S328.686,124.178,256,124.178z M256,367.422c-61.438,0-111.422-49.984-111.422-111.422c0-61.439,49.984-111.423,111.422-111.423
														c61.439,0,111.422,49.984,111.422,111.423C367.422,317.438,317.438,367.422,256,367.422z" />
												<path d="M256,181.041c-41.332,0-74.959,33.627-74.959,74.959s33.627,74.959,74.959,74.959c41.333,0,74.959-33.627,74.959-74.959
														S297.332,181.041,256,181.041z M256,310.561c-30.085,0-54.561-24.476-54.561-54.561s24.476-54.561,54.561-54.561
														s54.561,24.475,54.561,54.561C310.561,286.085,286.085,310.561,256,310.561z" />
											</g>
											<g>
												<path d="M380.485,99.843c-17.464,0-31.673,14.208-31.673,31.673s14.208,31.672,31.673,31.672
													c17.463,0,31.672-14.207,31.672-31.672S397.948,99.843,380.485,99.843z M380.485,142.789c-6.216,0-11.274-5.057-11.274-11.273
													c0-6.217,5.058-11.274,11.274-11.274s11.273,5.058,11.273,11.274C391.759,137.732,386.702,142.789,380.485,142.789z" />
											</g>
											<g>
												<path d="M239.681,463.044h-95.872c-5.633,0-10.199,4.566-10.199,10.199s4.566,10.199,10.199,10.199h95.872
													c5.633,0,10.199-4.566,10.199-10.199S245.314,463.044,239.681,463.044z" />
											</g>
											<g>
												<path d="M278.438,463.044h-6.12c-5.632,0-10.199,4.566-10.199,10.199s4.567,10.199,10.199,10.199h6.12
													c5.633,0,10.199-4.566,10.199-10.199S284.07,463.044,278.438,463.044z" />
											</g>
										</svg>
									</a>
								</li>
								<?php endif; ?>
							</ul>
						</div>
					</address>
				</div>
			  </div>
		  </div>
	</section>
	<!-- / section CONTACTS -->

	<?php get_footer(); ?>