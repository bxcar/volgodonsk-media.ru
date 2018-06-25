<?php
/**
 * Template Name: vote-page
 * */
?>
<?php get_header(); ?>
<?php while (have_posts()) :
the_post(); ?>
<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/vote.css">
<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/magnific-popup.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="<?= get_template_directory_uri(); ?>/js/jquery.magnific-popup.min.js"></script>
<div class="row">
    <div class="container">
        <?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
    </div>
</div>
<div class="container">
    <h1><?php the_title(); ?></h1>
    <div class="row content">

        <div class="vote-content-fx">
            <div class="voting-form-box">
                <style>
                    .contest-voting-answers__row {
                        align-items: flex-end;
                        display: inline-flex;
                    }

                    .vote-answer-item {
                        display: inline-table;
                    }

                    ol.contest-voting-answers .vote-answer-item .vhead {
                        align-items: flex-end;
                        display: flex;
                        white-space: normal;
                    }

                    .vote-answer-item__image-block {
                        display: flex;
                        position: relative;
                    }

                    .vote-answer-item__real-number {
                        background-color: #0a5a9c;
                        bottom: 0px;
                        color: #FFFFFF;
                        display: block;
                        font: bold 18px/18px DINPro, Arial, sans-serif;
                        left: 0px;
                        padding: 10px;
                        position: absolute;
                    }

                    .vote-answer-item .result {
                        margin-top: 5px;
                        margin-bottom: 5px;
                    }

                    .vote-content-fx {
                        width: 940px;
                    }

                    .row.content {
                        display: flex;
                    }

                    .vote-content-fx ol.contest-voting-answers .vote-answer-item button:hover {
                        border-color: #ee5c4a;
                        outline: none;
                    }

                    /*for gallery*/
                    .vote-answer-item__image-block {
                        position: relative;
                    }

                    .mgnfc-popup-parent-container {
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        top: 0;
                        left: 0;
                    }

                    .mgnfc-popup-parent-container a {
                        width: 100%;
                        display: block;
                        height: 100%;
                        position: absolute;
                        left: 0;
                        top: 0;
                        opacity: 0;
                    }

                    .mgnfc-popup-parent-container a:first-child {
                        z-index: 1;
                    }

                    .mfp-figure {
                        display: flex;
                    }

                    .gallery-right-sidebar {
                        color: red;
                        line-height: 1.2em;
                        margin: 40px 0 40px;
                        width: 300px;
                        min-width: 300px;
                        background: #fff;
                    }

                    .mfp-img {
                        max-width: 600px !important;
                        object-fit: cover;
                    }

                    .mfp-close  {
                        position: relative;
                    }

                    .mfp-figure:after {
                        background: transparent;
                        box-shadow: none;
                    }
                </style>
                <ol class="contest-voting">
                    <li class="contest-voting-item contest-voting-first vote-item-vote-last ">
                        <div class="contest-voting-question">&nbsp;</div>
                        <ol class="contest-voting-answers">
                            <?php if (get_field('members')) {
                                $i = 0;
                                foreach (get_field('members') as $item) {
                                    if ($i % 4 == 0) { ?>
                                        <div class="contest-voting-answers__row">
                                    <?php } ?>
                                    <li class="vote-answer-item ">
                                        <a class="vhead"><?= $item['name']; ?></a>
                                        <div class="vote-answer-item__image-block"
                                           href="#">
                                            <img style="width: 188px; height: 140px;"
                                                 src="<?= $item['mini_img']; ?>">
                                            <div class="mgnfc-popup-parent-container mgnfc-popup-parent-container-<?= $i ?>" style="">
                                                <?php if($item['gallery']) {
                                                    foreach ($item['gallery'] as $gallery_item) { ?>
                                                        <a href="<?= $gallery_item['url']; ?>"></a>
                                                    <?php }
                                                }?>
                                            </div>
                                            <script>
                                                $('.mgnfc-popup-parent-container-<?= $i ?>').magnificPopup({
                                                    delegate: 'a', // child items selector, by clicking on it popup will open
                                                    type: 'image',
                                                    gallery: {enabled: true},
                                                    image: {
                                                        markup: '<div class="mfp-figure">' +

                                                        '<div class="mfp-img"></div>' +
                                                        '<figure>'+'<figcaption>'+
                                                        '<div class="mfp-bottom-bar">' +
                                                        '<div style="background: #fff; text-align: center"  class="mfp-title "></div>' +

                                                        '</div>'+
                                                        '</figcaption>'+
                                                        '</figure>' +
                                                        '<div class="gallery-right-sidebar">right sidebar</div>' +
                                                        '<div class="mfp-close"></div>' +
                                                        '</div>'
                                                    }
//        midClick: true
                                                    // other options
                                                });
                                            </script>
                                            <!--                                        <p class="vote-answer-item__real-number">90</p>-->
                                        </div>
                                        <div class="result">
                                            <!--                                        <span class="percent">10.00%</span>-->
                                            <span class="numvotes">Голосов: 857</span>
                                        </div>
                                        <div class="bar">
                                            <button>Голосовать</button>
                                            <!--                                        <div class="votedone" style="width: 10.00%"></div>-->
                                        </div>
                                    </li>
                                    <?php $i++;
                                    if ($i % 4 == 0) { ?>
                                        </div>
                                    <?php } ?>
                                <?php }
                            } ?>
                        </ol>
                        <div class="clear"></div>
                    </li>
                </ol>
                <div class="clear"></div>

            </div>
        </div>

        <?php endwhile; ?>

        <?php get_sidebar(''); ?>
        <style>
            @media (min-width: 1200px) {
                .span4 {
                    float: right;
                    min-height: 1px;
                    margin-left: 30px;
                }

                .row {
                    margin-left: 0;
                }
            }
        </style>
        <?php get_footer(); ?>
