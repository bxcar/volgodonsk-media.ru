<?php
   function mayak_single($mayak_template) {
	global $wp_query, $post;
	if(file_exists(TEMPLATEPATH . '/single-' . $post->ID . '.php')) {
	return TEMPLATEPATH . '/single-' . $post->ID . '.php';
	}
	if(file_exists(TEMPLATEPATH . '/single.php')) {
	return TEMPLATEPATH . '/single.php';
	}
	return $mayak_template;
	}
   add_filter('single_template', 'mayak_single');

  require_once ('my_functions.php');
  if (!defined('BOOTSTRAPWP_VERSION'))
    define('BOOTSTRAPWP_VERSION', '.90');
  if ( ! isset( $content_width ) )
    $content_width = 770;
    load_theme_textdomain('bootstrapwp');
    add_action( 'after_setup_theme', 'bootstrapwp_theme_setup' );
  if ( ! function_exists( 'bootstrapwp_theme_setup' ) ):
    function bootstrapwp_theme_setup() {
      add_theme_support( 'automatic-feed-links' );
      register_nav_menus( array(
      'main-menu' => __( 'Main Menu', 'bootstrapwp' ),
      ) );
      add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio', 'chat' ) );
    }
  endif;

  function bootstrapwp_css_loader() {
    wp_enqueue_style('bootstrapwp', get_template_directory_uri().'/css/bootstrapwp.css', false ,'6.55', 'all' );
    wp_enqueue_style('prettify', get_template_directory_uri().'/js/google-code-prettify/prettify.css', false ,'1.0', 'all' );
  }
  add_action('wp_enqueue_scripts', 'bootstrapwp_css_loader');

  function bootstrapwp_js_loader() {
    wp_enqueue_script('bootstrapjs', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'),'0.90', true );
    wp_enqueue_script('prettifyjs', get_template_directory_uri().'/js/google-code-prettify/prettify.js', array('jquery'),'1.0', true );
    wp_enqueue_script('demojs', get_template_directory_uri().'/js/bootstrapwp.demo.js', array('jquery'),'0.90', true );
  }
  add_action('wp_enqueue_scripts', 'bootstrapwp_js_loader');

  function bootstrapwp_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
  }
  add_filter( 'wp_page_menu_args', 'bootstrapwp_page_menu_args' );

  include 'includes/class-bootstrapwp_walker_nav_menu.php';

  function bootstrapwp_widgets_init() {
    register_sidebar( array(
      'name' => 'Сайдбар 1',
      'id' => 'sidebar1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => "</div>",
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
    ) );

    register_sidebar( array(
      'name' => 'Сайдбар 2',
      'id' => 'sidebar2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => "</div>",
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
    ) );

    register_sidebar( array(
      'name' => 'Сайдбар 3',
      'id' => 'sidebar3',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => "</div>",
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
    ) );
  
    register_sidebar( array(
      'name' => 'Сайдбар 4',
      'id' => 'sidebar4',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => "</div>",
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
    ) );
  
    register_sidebar( array(
      'name' => 'Сайдбар 5',
      'id' => 'sidebar5',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => "</div>",
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
    ) );
  }
  
  add_action( 'init', 'bootstrapwp_widgets_init' );

  function custom_excerpt_length( $length ) {return 30;}
  add_filter( 'excerpt_length', 'custom_excerpt_length' );
  function bootstrapwp_excerpt($more) {
    global $post;
    return '<a href="'. get_permalink($post->ID) . '">...</a>';
  }
  add_filter('excerpt_more', 'bootstrapwp_excerpt');

  if ( ! function_exists( 'bootstrapwp_content_nav' ) ):
    function bootstrapwp_content_nav( $nav_id ) {
    global $wp_query;
?>

<?php if ( is_single() ) : ?>
  <ul class="pager">
    <?php previous_post_link( '<li class="previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bootstrapwp' ) . '</span> %title' ); ?>
    <?php next_post_link( '<li class="next">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bootstrapwp' ) . '</span>' ); ?>
  </ul>
  <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
  <ul class="pager">
    <?php if ( get_next_posts_link() ) : ?>
    <li class="next"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bootstrapwp' ) ); ?></li>
    <?php endif; ?>
    <?php if ( get_previous_posts_link() ) : ?>
    <li class="previous"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bootstrapwp' ) ); ?></li>
    <?php endif; ?>
  </ul>
  <?php endif; ?>
  <?php
    }
      endif;

  if ( ! function_exists( 'bootstrapwp_comment' ) ) :
  function bootstrapwp_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'bootstrap' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'bootstrap' ), ' ' ); ?></p>
    <?php
      break;
      default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <footer>
          <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 40 ); ?>
            <?php printf( __( '%s <span class="says">says:</span>', 'bootstrap' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
          </div>
          <?php if ( $comment->comment_approved == '0' ) : ?>
          <em><?php _e( 'Your comment is awaiting moderation.', 'bootstrap' ); ?></em>
          <br/>
          <?php endif; ?>
          <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
              <time pubdate datetime="<?php comment_time( 'c' ); ?>">
                <?php
                  printf( __( '%1$s at %2$s', 'bootstrap' ), get_comment_date(), get_comment_time() );
                ?>
              </time>
            </a>
            <?php edit_comment_link( __( '(Edit)', 'bootstrap' ), ' ' ); ?>
          </div>
        </footer>

        <div class="comment-content"><?php comment_text(); ?></div>
        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
      </article>
      <?php
        break;
        endswitch;
  }
    endif;
    if ( ! function_exists( 'bootstrapwp_posted_on' ) ) :
    function bootstrapwp_posted_on() {
      printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'bootstrap' ),
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'bootstrap' ), get_the_author() ) ),
      esc_html( get_the_author() )
      );
    }
    endif;

    function bootstrapwp_body_classes( $classes ) {
      if ( ! is_multi_author() ) {
        $classes[] = 'single-author';
      }
      return $classes;
    }
    add_filter( 'body_class', 'bootstrapwp_body_classes' );

    function bootstrapwp_categorized_blog() {
      if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
        $all_the_cool_cats = get_categories( array(
        'hide_empty' => 1,
        ) );
      $all_the_cool_cats = count( $all_the_cool_cats );
        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
      }

      if ( '1' != $all_the_cool_cats ) {
        return true;
      } else {
        return false;
      }
    }

    function bootstrapwp_category_transient_flusher() {
      delete_transient( 'all_the_cool_cats' );
    }
    add_action( 'edit_category', 'bootstrapwp_category_transient_flusher' );
    add_action( 'save_post', 'bootstrapwp_category_transient_flusher' );

    function bootstrapwp_enhanced_image_navigation( $url ) {
      global $post;
      if ( wp_attachment_is_image( $post->ID ) )
        $url = $url . '#main';
        return $url;
    }
    add_filter( 'attachment_link', 'bootstrapwp_enhanced_image_navigation' );

    function bootstrapwp_breadcrumbs() {
      $delimiter = '<span class="divider">/</span>';
      $home = 'Главная';
      $before = '<li class="active">';
      $after = '</li>';
    if ( !is_home() && !is_front_page() || is_paged() ) {
      echo '<ul class="breadcrumb">';
      global $post;
      $homeLink = home_url();
      echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . single_cat_title('', false) . $after;
    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
          $cat = get_the_category(); $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo $before . get_the_title() . $after;
      }
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif ( is_attachment() ) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif ( is_page() && !$post->post_parent ) {
        echo $before . get_the_title() . $after;
    } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
          $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } elseif ( is_search() ) {
          echo $before . 'Результаты поиска "' . get_search_query() . '"' . $after;
      } elseif ( is_tag() ) {
          echo $before . 'Архив запесей на тему: «' . single_tag_title('', false) . '»' . $after;
      } elseif ( is_author() ) {
          global $author;
          $userdata = get_userdata($author);
          echo $before . 'Articles posted by ' . $userdata->display_name . $after;
      } elseif ( is_404() ) {
          echo $before . 'Ошибка 404' . $after;
      }
      if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo 'Страница '. get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
      }
    echo '</ul>';
  }
}
