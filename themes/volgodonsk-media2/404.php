<?php get_header(); ?>
  <div class="container">
    <h1>Это как-то неприятно, не так ли?</h1>
    <p class="lead">Похоже, мы не можем найти то, что Вы ищете. Возможно, поиск или выбор одной из ссылок расположенных ниже сможет Вам помочь.</p>
    <div class="row content span">
      <?php get_search_form(); ?>
      <hr/>
      <div class="row">
        <h2>Все страницы</h2>
        <?php
          wp_page_menu();
          wp_list_categories();
        ?>
      </div>
      <hr/>
      <?php wp_tag_cloud(); ?>
    </div>
    <?php get_footer(); ?>
