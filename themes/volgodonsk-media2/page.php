<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="row">
  <div class="container">
    <?php if ( function_exists( 'bootstrapwp_breadcrumbs' ) ) bootstrapwp_breadcrumbs(); ?>
  </div>
</div>
<div class="container">
  <h1><?php the_title(); ?></h1>
  <div class="row content">
    <div class="span8">
      <?php the_content(); ?>
      <?php endwhile; ?>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
