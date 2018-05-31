<?php get_header(); ?>
<!--<div class="row">
  <div class="container">
    <!--<div id="scrolling_text" class="str_wrap">-->
<!--Приглашаем молодых, креативных и творческих личностей на должности <b>менеджер по рекламе</b>, <b>ведущий программ</b>. КА Приоритет 212622&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    <!--</div>-->
<!--</div>
<!--</div>-->
<?php while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="container">
      <?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
    </div>
  </div>
  <div class="container" itemscope itemtype="http://schema.org/NewsArticle">
    <h1><span itemprop="headline"><?php the_title(); ?></span></h1>
    <div class="row content">
      <div class="span8">
        <p class="meta">
          <span class="date">
            <a href="<?php bloginfo('url').the_time('/Y/m/d/'); ?>" title="Посмотреть все записи за <?php the_time('j F Y'); ?>">
              <time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('j F Y'); ?></time>
            </a>
          </span>
          <?php echo ' / '; ?><?php the_category(', ', 'single'); ?>
          <span class="comments"><?php theme_comments_link(); ?></span>
          <?php theme_get_post_views(); ?>
        </p>
        <?php theme_post_image(); ?>
        <p><span itemprop="articleBody"><?php the_content(); ?></span></p> 
        <?php if (get_post_meta($post->ID, 'author', true) AND get_post_meta($post->ID, 'author', true) !='no'):
          $author_select = array(
            'newsvtv' => 'Новости ВТВ',
            'begotsky' => 'Артём Бегоцкий',
            'dubas' => 'Анастасия Дубас',
            'nikulin' => 'Виталий Никулин',
            'tregubova' => 'Ольга Трегубова',
            'karmazina' => 'Виолетта Кармазина',
            'androsov' => 'Артём Андросов',
            'ovcharenko' => 'Сергей Овчаренко',
            'vedeneva' => 'Наталья Веденева',
            'lvova' => 'Екатерина Львова',
            'shimko' => 'Лидия Шимко',
            'gordeeva' => 'Мария Гордеева',
            'shtrafina' => 'Елена Штрафина',
            'doroshenko' => 'Наталья Дорошенко',
            'gorbacheva' => 'Дина Горбачева',
            'akulova' => 'Ольга Акулова',
            'sheronova' => 'Анастасия Шеронова',
            'maximova' => 'Алёна Максимова'
          );
          $author = $author_select[get_post_meta($post->ID, 'author', true)];
        ?>
        <p class="meta">Автор: <?php echo $author; ?></p>
        <?php endif; ?>
        <p class="meta"><?php the_tags( '<i class="icon-tags"></i> Тема: ', ', ', ''); ?></p>
        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,moikrug,gplus"></div>

	

        <hr/>
        <?php if (get_post_meta($post->ID, 'youtube', true)):
        echo '<div class="widget"><h3>Видеоматериал </h3><div class="video"><object width="600" height="450"><param name="movie" value="http://www.youtube.com/v/'.get_post_meta($post->ID, 'youtube', true).'?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1" /><param name="allowFullScreen" value="true" /><param name="allowscriptaccess" value="always" /><embed type="application/x-shockwave-flash" width="600" height="450" src="http://www.youtube.com/v/'.get_post_meta($post->ID, 'youtube', true).'?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1" allowscriptaccess="always" allowfullscreen="true"></embed></object>';
        ?>
        </div></div>
        <?php endif;?>
        <?php endwhile;?>
        
        <?php if( has_term('', 'post_tag') ) :?>
        <hr/><h3 class="similar_news">Похожие новости</h3>
        <?php digatalart_tag_rel_post(); ?>
        <?php endif; ?>
        <hr/>
        <?php comments_template(); ?>
        </div>
        <?php theme_set_post_views(); ?>
        <?php get_sidebar('single'); ?>
        <?php get_footer(); ?>
