<?php get_header(); ?>
<div class="row">
  <div class="container">
    <?php if (function_exists( 'bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
  </div>
</div>
<div class="container">
<h1>Новости Волгодонска</h1>
  <div class="row content">
    <div class="span8">
      <?php $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
        query_posts( array( 'post_type'=>'post', 'paged'=>$paged, 'showposts'=>0) );
        if (have_posts()) : while ( have_posts() ) : the_post();
      ?>

<?php count_post_number(); ?>



<?php
  if ($number_post == 2) {
?>
<a href="http://volgodonsk-media.ru/reklama/" class="firskill__label">Реклама</a>
<div class="reklama_banner">
  <a href="http://volgodonsk-media.ru/" target="_blank"><img class="reklama_banner__img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/montecarlo_banner.jpg" title="Радио Монте Карло 105,3 FM в Волгодонске"></img></a>
</div>
<? } ?>


<?php
  if ($number_post == 4) {
?>
<a href="http://volgodonsk-media.ru/reklama/" class="firskill__label">Реклама</a>
<div class="reklama_banner">
  <a href="http://telebegun.ru/volgodonsk" target="_blank"><img class="reklama_banner__img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/beg_stroka.png" title="Онлайн-подача объявлений бегущей строкой http://telebegun.ru/volgodonsk"></img></a>
</div>
<? } ?>


<?php
  if ($number_post == 7) {
?>
<a href="http://volgodonsk.europaplus.ru/" class="firskill__label">Реклама</a>
<div class="reklama_banner">
  <a href="http://volgodonsk.europaplus.ru/" target="_blank"><img class="reklama_banner__img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/epsite.jpg" title="volgodonsk.europaplus.ru"></img>
</div>
<? } ?>



<!--
<?php
  if ($number_post == 4) {
?>
<a href="https://dedal-service.ru/" class="firskill__label">Реклама</a>
<div class="reklama_banner">
  <a href="https://dedal-service.ru/" target="_blank"><img class="reklama_banner__img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dedal_8m.jpg" title="Кухни Дедал"></img>
</div>
<? } ?>

<?php
  if ($number_post == 9) {
?>
<a href="http://www.fitness-citrus.com/" class="firskill__label">Реклама</a>
<div class="reklama_banner">
  <a href="http://www.fitness-citrus.com/" target="_blank"><img class="reklama_banner__img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/citrus.png" title="www.fitness-citrus.com"></img>
</div>
<? } ?>

<?php
  if ($number_post == 13) {
?>
<a href="http://volgodonsk-media.ru/reklama/" class="firskill__label">Реклама</a>
<div class="reklama_banner">
  <a href="http://volgodonsk-media.ru/news/" target="_blank"><img class="reklama_banner__img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/promo_news.jpg" title="Новости в 18:30"></img></a>
</div>
<? } ?>
-->


      <div <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h2><?php the_title(); ?></h2></a>
        <p class="meta">
          <span class="date"><a href="<?php bloginfo('url') ?><?php the_time('/Y/m/d/'); ?>" title="Посмотреть все записи за <?php the_time('j F Y'); ?>"><?php the_time('j F Y'); ?></a></span>
          <?php echo ' / '; the_category( ', ', 'single'); ?>
          <span class="comments"><?php theme_comments_link(); ?></span>
          <?php theme_get_post_views(); ?>
        </p>

        <div class="row">
          <div class="span2">
            <?php ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php theme_post_image_thumbnail(); ?>
            </a>
          </div>
          <div class="span6">
            <?php the_excerpt(); ?>
            <p><a class="btn" href="<?php the_permalink(); ?>">Подробнее &raquo;</a></p>
          </div>
        </div>

        <hr/>
      </div>
      <?php endwhile; endif; ?>
      <?php page_navi(); ?>
    </div>
    <?php get_sidebar( ''); ?>
    <?php get_footer(); ?>
