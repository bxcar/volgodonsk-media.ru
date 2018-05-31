<?php
-/**
- * Template Name: test
- * Description: Page template with a content container and right sidebar
- */ get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="row">
  <div class="container">
    <?php if ( function_exists( 'bootstrapwp_breadcrumbs' ) ) bootstrapwp_breadcrumbs(); ?>
  </div>
</div>
<div class="container">
  <h1><?php the_title(); ?></h1> 
  <?php theme_set_post_views(); ?>
  <div class="row content">
    <div class="span8">
      <?php the_content(); ?>
      <h5><?php theme_get_post_views(); ?> </h5>
      <?php comments_template( '',true ); ?>
      <?php endwhile; ?>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
