<?php
-/**
- * Template Name: full width
- * Description: Page template with a content container and right sidebar
- */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="row">
  <div class="container">
    <?php if ( function_exists( 'bootstrapwp_breadcrumbs' ) ) bootstrapwp_breadcrumbs(); ?>
  </div>
</div>
<div class="container">
  <h1><?php the_title(); ?></h1>
  <div class="row content span">
    <?php the_content(); ?>
    <?php comments_template( '',true ); ?>
    <?php endwhile; ?>
  </div>
  <?php get_footer(); ?>
