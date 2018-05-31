<?php
  define('FORCE_SSL_ADMIN', true);
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'feed_links', 2 );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
  remove_action( 'wp_head', 'wp_generator' );

  global $number_post;



  function my_the_tags($html){
    $postid = get_the_ID();
    $html = str_replace('rel="tag">','rel="tag"><span itemprop="keywords">',$html);
    $html = str_replace('</a>','</span></a>',$html);
    return $html;
  }

  add_filter('the_tags','my_the_tags');

  function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="" action="' . home_url( '/' ) . '" >
        <input class="input-block-level" placeholder="введите фразу для поиска" type="text" value="' . get_search_query() . '" name="s" id="search" />
      </form>';
    return $form;
  }

  add_filter( 'get_search_form', 'my_search_form' );

  function my_meta_noindex () {
    if (
      is_archive() OR
      is_author() OR
      is_date() OR
      is_day() OR
      is_month() OR
      is_year() OR
      is_tag() OR
      is_tax() OR
      is_attachment() OR
      is_paged()
    ) {echo "".'<meta name="robots" content="noindex,nofollow" />'."\n";}
  }

  add_action('wp_head', 'my_meta_noindex', 3);

  function page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
      $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if($start_page <= 0) {
      $start_page = 1;
    }
    echo $before.'<div class="pagination"><ul class="clearfix">'."";
    if ($paged > 1) {
      $first_page_text = "&laquo";
      echo '<li class="prev"><a href="'.get_pagenum_link().'" title="Первая">'.$first_page_text.'</a></li>';
    }
    $prevposts = get_previous_posts_link('&larr; Предыдущая');
    if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
    else { echo '<li class="disabled"><a href="#">&larr; Предыдущая</a></li>'; }
    for($i = $start_page; $i  <= $end_page; $i++) {
      if($i == $paged) {
        echo '<li class="active"><a href="#">'.$i.'</a></li>';
      } else {
        echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
      }
    }
    echo '<li class="">';
    next_posts_link('Следующая &rarr;');
    echo '</li>';
    if ($end_page < $max_page) {
      $last_page_text = "&raquo;";
      echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Последняя">'.$last_page_text.'</a></li>';
    }
    echo '</ul></div>'.$after."";
  }

  function change_email($email) {
    return 'no-reply@volgodonsk-media.ru';
  }

  function change_email_name($email_name){
    return 'Волгодонск-Медиа. Телекомпания ВТВ';
  }
  
  add_filter('wp_mail_from','change_email');
  add_filter( 'wp_mail_from_name', 'change_email_name');

  if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
  }

  function theme_post_image_thumbnail() {
    global $post;
    if ( has_post_thumbnail() ) {
      add_image_size ('post-preview', 170, 124, false);
      $attr = array(
        'class'  => "attachment-$size",
        'alt'  => get_the_title(),
        'title'  => get_the_title(),
      );
      echo '<a href="' . get_permalink() . '">'.get_the_post_thumbnail($page->ID, 'thumbnail', $attr).'</a>';
    }
  }

  function theme_post_image() {
    global $post;
    if ( has_post_thumbnail() ) {
      add_image_size ('post-preview', 390, 390, false);
      $attr = array(
        'class'  => "attachment-$size",
        'alt'  => get_the_title(),
        'title'  => get_the_title(),
      );
      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
      echo '<a href="' . $large_image_url[0] . '">'.get_the_post_thumbnail($page->ID, 'medium', $attr).'</a>';
    }
  }

  add_action('admin_init', 'youtube', 1);

  function youtube() {
    add_meta_box( 'extra_fields2', 'Видеоматериал', 'youtube_func', 'post', 'normal', 'high'  );
  }

  function youtube_func( $post ){
?>
    <p><label><input type="text" name="extra[youtube]" value="<?php echo get_post_meta($post->ID, 'youtube', 1); ?>" style="width:50%" /> ← код Youtube после слэша (title)</label></p>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
  }

  add_action('save_post', 'youtube_update', 0);

  function youtube_update( $post_id ){
    if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
    if ( !current_user_can('edit_post', $post_id) ) return false;
    if( !isset($_POST['extra']) ) return false;  
    $_POST['extra'] = array_map('trim', $_POST['extra']);
    foreach( $_POST['extra'] as $key=>$value ){
      if( empty($value) )
        {delete_post_meta($post_id, $key);} else {
      update_post_meta($post_id, $key, $value);}
    }
    return $post_id;
  }

  add_action('admin_init', 'author', 1);

  function author() {
    add_meta_box( 'extra_fields', 'Автор статьи', 'author_func', 'post', 'normal', 'high');
  }

  function author_func( $post ){
  ?>
    <p>
      <select name="extra[author]" />
        <?php $sel_v = get_post_meta($post->ID, 'author', 1); ?>
          <option value="no" <?php selected( $sel_v, 'no' )?> >Без Автора</option>
          <option value="newsvtv" <?php selected( $sel_v, 'newsvtv' )?> >Новости ВТВ</option>
          <option value="begotsky" <?php selected( $sel_v, 'begotsky' )?> >Артём Бегоцкий</option>
          <option value="akulova" <?php selected( $sel_v, 'akulova' )?> >Ольга Акулова</option>
          <option value="gorbacheva" <?php selected( $sel_v, 'gorbacheva' )?> >Дина Горбачева</option>
          <option value="maximova" <?php selected( $sel_v, 'maximova' )?> >Алёна Максимова</option>
          <!--<option value="dubas" <?php selected( $sel_v, 'dubas' )?> >Анастасия Дубас</option>
          <option value="nikulin" <?php selected( $sel_v, 'nikulin' )?> >Виталий Никулин</option>
          <option value="tregubova" <?php selected( $sel_v, 'tregubova' )?> >Ольга Трегубова</option>
          <option value="sheronova" <?php selected( $sel_v, 'sheronova' )?> >Анастасия Шеронова</option>-->
          
      </select> ← выбор автора
    </p>
      <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
  }

  add_action('save_post', 'author_update', 0);

  function author_update( $post_id ){
    if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
    if ( !current_user_can('edit_post', $post_id) ) return false;
    if( !isset($_POST['extra']) ) return false;  
      $_POST['extra'] = array_map('trim', $_POST['extra']);
      foreach( $_POST['extra'] as $key=>$value ){
        if( empty($value) )
          {delete_post_meta($post_id, $key);
          } else {
            update_post_meta($post_id, $key, $value);
          }
      }
    return $post_id;
  }

  function digatalart_tag_rel_post(){
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
      $tag_ids = array();
      foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
      $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>5,
        'caller_get_posts'=>1
      );
      $my_query = new wp_query($args);
      if($my_query->have_posts()){
        echo '<ul id="relPost">';
        while($my_query->have_posts()){
          $my_query->the_post();
          ?>
          <li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
          <?php
        }
          echo '</ul>';
      }
      else {
        echo '<p>Другие записи по теме отсутсвуют.</p>';
      }
      wp_reset_postdata();
    }
  }

  function theme_comments_link(){
    $comments_number = get_comments_number();
    if ($comments_number==0) { return; }
    $after = array('комментарий','комментария','комментариев');
    $cases = array (2, 0, 1, 1, 1, 2);
    $link_name = $comments_number.' '.$after[ ($comments_number%100>4 && $comments_number%100<20)? 2: $cases[min($comments_number%10, 5)] ];
    echo ' / '; ?><a href="<?php comments_link(); ?>" title="Посмотреть комментарии к новости «<?php the_title(); ?>»"><?php echo $link_name; ?></a><?php
  }

  function theme_comments(){
    $comments_number = get_comments_number();
    if ($comments_number==0){ return; }
    $after = array('комментарий','комментария','комментариев');
    $cases = array (2, 0, 1, 1, 1, 2);
    $link_name = $comments_number.' '.$after[ ($comments_number%100>4 && $comments_number%100<20)? 2: $cases[min($comments_number%10, 5)] ];
    echo $link_name;
  }

  function theme_get_post_views(){
    $after = array('просмотр','просмотра','просмотров');
    $postID = get_the_ID();
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='') {
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
      return;
    }
    $cases = array (2, 0, 1, 1, 1, 2);
    if ($count!=0) {
      echo ' / '.$count.' '.$after[ ($count%100>4 && $count%100<20)? 2: $cases[min($count%10, 5)] ];
    }
  }

  function theme_set_post_views() {
    $postID = get_the_ID();
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count=='') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
      $count++;
      update_post_meta($postID, $count_key, $count);
    }
  }

  function theme_meta () {
    $keywords =  'Волгодонск, новости, телекомпания, втв';
    $description = 'Главные новости города Волгодонска. Новости телекомпании ВТВ.';   
    if (is_single()) {
      $posttags = get_the_tags();
      if ($posttags){foreach($posttags as $tag) { $tags = $tags.', '.$tag->name; }
        $keywords =  $keywords.$tags;
      }
    }
    echo '<meta name="keywords" content="'.$keywords.'" />';
    echo '<meta name="description" content="'.$description.'" />';
  }

  function custom_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <?php ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div class="comment-meta">
      <?php
        if(get_comment_type() == "comment") {
      ?>
          <?php the_commenter_avatar() ?>
          <?php
        }
          ?>
      <span class="name"><?php the_commenter_link() ?></span>
      <?php
        if(get_comment_type() == "comment") {
      ?>
          <span class="date"><?php echo get_comment_date("j F Y"); ?> в <?php echo get_comment_time(); ?></span>
          <span class="edit"><?php edit_comment_link(Редактировать, '', ''); ?></span>
          <span class="perma"><a class="comment-permalink" href="<?php echo get_comment_link(); ?>" title="Прямая ссылка на комментарий">#</a></span>
      <?php
        }
      ?>
    </div>
    <div class="comment-entry"  id="comment-<?php comment_ID(); ?>">
      <?php comment_text() ?>
      <?php
        if ($comment->comment_approved == '0') {
      ?>
          <p class='unapproved'>Ваш комментарий появится на сайте после модерирования</p>
          <?php } ?>
      <div class="reply">
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
    </div>
    <div class="clear"></div>
    <?php
  }

  function the_commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( ']* class=[^>]+>', $commenter ) ) {
      $commenter = ereg_replace( '(]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    echo $commenter;
  }

  function the_commenter_avatar() {
    $email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email", "38" ) );
    echo $avatar;
  }

  function exclude_category($query) {
    if ( $query->is_home ) {
      $query->set(‘category_not_in’, array(106,105,6));
    } elseif ( $query->is_feed ) {
    if ( ! $query->is_single and ! $query->is_archive )
      $query->set(‘category_not_in’, array(106,105,6));
    }
    return $query;
  }
  add_filter('pre_get_posts', 'exclude_category');

function count_post_number() {
  global $number_post;
  $number_post += 1;
  return $number_post;
}

?>
