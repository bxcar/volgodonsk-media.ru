<?php get_header(); if (have_posts() ) ; ?>
<div class="row">
  <div class="container">
    <?php if (function_exists( 'bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
  </div>
</div>
<div class="container">
  <?php if ( is_day() ) { echo '<h1>Архив записей за '. get_the_date() . '</h1>'; } elseif ( is_month() ) { echo '<h1>Архив записей за месяц: '. get_the_date( 'F Y') . '</h1>'; } elseif ( is_year() ) { echo '<h1>Архив записей за год: '. get_the_date('Y') . '</h1>'; } elseif ( is_tag() ) { echo '<h1>Архив записей на тему: '. single_tag_title( '', false ) . '</h1>';
  $tag_description=tag_description();
  if ( $tag_description ) echo '<p>' . $tag_description . '</p>'; } elseif ( is_category() ) { echo '<h1>' . single_cat_title( '', false ) . '</h1>'; $category_description=category_description();
  if ( $category_description ) echo '<p>'.$category_description . '</p>'; } else { echo '<h1>Архивы</h1>'; } ?>
  <div class="row content">
    <div class="span8">
      <?php while ( have_posts() ) : the_post(); ?>
      <div <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <h2><?php the_title(); ?></h2>
        </a>
        <p class="meta">
          <span class="date">
            <a href="<?php bloginfo('url') ?><?php the_time('/Y/m/d/'); ?>" title="Посмотреть все записи за <?php the_time('j F Y'); ?>">
              <?php the_time('j F Y'); ?>
            </a>
          </span>
          <?php echo ' / '; the_category( ', ', 'single'); ?>
            <span class="comments">
              <?php theme_comments_link(); ?>
            </span>
            <?php theme_get_post_views(); ?>
        </p>
        <div class="row">
          <div class="span2">
            <?php if ( has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php theme_post_image_thumbnail(); ?>
              </a>
            <?php else: ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <img src="http://img.youtube.com/vi/<?php echo get_post_meta($post->ID, 'youtube', true); ?>/0.jpg" width="170" height="124" alt=""></a>
            <?php endif; ?>
          </div>
          <div class="span6">
            <?php the_excerpt(); ?>
            <p><a class="btn" href="<?php the_permalink(); ?>">Подробнее &raquo;</a></p>
          </div>
        </div>
        <hr/>
      </div>
      <?php endwhile; ?>
      <?php page_navi(); ?>
    </div>
    <?php get_sidebar( ''); ?>
    <?php get_footer(); ?>
