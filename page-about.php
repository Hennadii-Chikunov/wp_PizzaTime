<?php
/*
Template Name: О нас
*/
?>
<?php $page_id = get_the_ID(); ?>
<?php get_header(); ?>

<section class="section single-page">
  <div class="container single-page__container">
    <h2 class="section__title  section__title--accent"><?php the_title(); ?></h2>
    <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
      <div class="single-page__content">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>

    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>