<?php get_header(); ?>
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <h1><?php echo 'Показаны результаты поиска для: «' . get_search_query() . '»'; ?></h1>
      <div class="row content">
        <div class="span8">
          <hr/>
          <?php while ( have_posts() ) : the_post(); ?>
          <?php
            $title = get_the_title();
            $keys = explode(" ",$s);
            $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title);
          ?>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h2> <?php echo $title; ?></h2></a>
          <p class="meta">
            <span class="date">
              <a href="<?php bloginfo('url') ?><?php the_time('/Y/m/d/'); ?>" title="Посмотреть все записи за <?php the_time('j F Y'); ?>"><?php the_time('j F Y'); ?></a>
            </span>
            <?php echo ' / '; the_category(', ', 'single'); ?>
            <span class="comments"><?php theme_comments_link(); ?></span>
            <?php theme_get_post_views(); ?>
          </p>
          <p><?php the_excerpt(); ?></p>
          <hr/>
          <?php endwhile; ?>
          <?php else : ?>
          <h1>Ничего не найдено</h1>
          <p class="lead">Кажется, мы не можем найти то, что вы ищете. Может быть, вы должны попробовать еще раз с другим запросом поиска.</p>
          <div class="row content">
            <div class="span8">
              <?php endif ; ?>
              <?php page_navi(); ?>
            </div>
            <?php get_footer(); ?>
