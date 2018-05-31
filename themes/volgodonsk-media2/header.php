<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title>
      <?php global $page, $paged;
        wp_title( '/', true, 'right' );
        bloginfo( 'name' );
        $site_description=get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) echo " / $site_description";
        if ( $paged>= 2 || $page >= 2 ) {echo ' / Страница ' . $paged;} ?>
    </title>
    <?php theme_meta (); ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/ico/favicon.ico">
    <link rel="stylesheet" href="/wp-content/themes/volgodonsk-media2/css/liMarquee.css">
    <link rel="stylesheet" href="/wp-content/themes/volgodonsk-media2/css/jplayer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-countdown/2.0.1/jquery.countdown.min.css" ?>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'template_url' ); ?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'template_url' ); ?>/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'template_url' ); ?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'template_url' ); ?>/ico/apple-touch-icon-57-precomposed.png">
    <meta name="yandex-verification" content="4ecdd458e7066495" />
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2653693518447248",
    enable_page_level_ads: true
  });
</script>
  </head>
     <div class="banner_wrap">
      <div class="banner_image2"></div>
    </div>
  <body <?php body_class(); ?>data-spy="scroll" data-target=".bs-docs-sidebar" data-offset="10">
    <div class="navbar navbar-inverse navbar-relative-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php bloginfo( 'name' ); ?>
          </a>
          <?php wp_nav_menu( array( 'menu'=>'main-menu', 'container_class' => 'nav-collapse', 'menu_class' => 'nav', 'fallback_cb' => '', 'menu_id' => 'main-menu', 'walker' => new Bootstrapwp_Walker_Nav_Menu() ) ); ?>
          <img class="old" src="<?php bloginfo( 'template_url' ); ?>/img/16+.png" alt="16+"/>
          <div class="span100">
            <?php if (!is_search() or !is_404() or ! is_page()){get_search_form();} ?>
          </div>
        </div>
      </div>
    </div>
