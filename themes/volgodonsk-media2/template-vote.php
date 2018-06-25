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
<div class="container container--2">
    <h1><?php the_title(); ?></h1>
    <div class="row content content--2">

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
                        color: #000;
                        line-height: 1.2em;
                        margin: 40px 0 40px;
                        width: 300px;
                        min-width: 300px;
                        background: #fff;
                    }

                    .member-name {
                        color: #2a5885;
                        text-decoration: none;
                        font-weight: 500;
                        padding: 13px 20px 10px 15px;
                        background-color: #fafbfc;
                        white-space: nowrap;
                        border-bottom: 1px solid #e7e8ec;
                    }

                    .member-votes {
                        color: #000;
                        text-decoration: none;
                        font-weight: 500;
                        padding: 13px 20px 10px 15px;
                        white-space: nowrap;
                        border-bottom: 1px solid #e7e8ec;
                    }

                    .member-desc {
                        color: #000;
                        text-decoration: none;
                        font-weight: 500;
                        padding: 13px 20px 10px 15px;
                    }

                    .mfp-img {
                        max-width: 600px !important;
                        object-fit: cover;
                    }

                    .mfp-close {
                        position: relative;
                    }

                    .mfp-figure {
                        display: flex;
                        justify-content: center;
                    }


                    .mfp-figure:after {
                        background: transparent;
                        box-shadow: none;
                    }

                    .vote-answer-item__image-block img {
                        width: 188px;
                        height: 140px;
                    }

                    @media (max-width: 1200px) {
                        body > .container--2 {
                            display: flex;
                            justify-content: center;
                            flex-direction: column;
                        }
                        .span4 {
                            display: none;
                        }

                        .content--2 {
                            margin-left: 0;
                        }
                    }

                    @media (max-width: 970px) {
                        .mfp-figure {
                            flex-direction: column;
                        }

                        .gallery-right-sidebar {
                            width: 90%;
                            max-width: 700px;
                            margin-top: 0;
                            margin-left: auto;
                            margin-right: auto;
                        }

                        .mfp-img {
                            padding-bottom: 0 !important;
                            width: 90% !important;
                            max-width: 700px !important;
                        }

                        .mfp-close {
                            position: absolute;
                            top: 0;
                        }

                        .vote-content-fx ol.contest-voting-answers .vote-answer-item {
                            width: 100%;
                            float: none;
                            margin-right: 0;
                            padding-right: 0;
                            box-sizing: border-box;
                            margin-bottom: 30px;
                        }

                        .contest-voting-answers__row {
                            flex-wrap: wrap;
                            align-items: center;
                        }

                        .vote-answer-item__image-block {
                            align-items: center;
                        }

                        .vote-answer-item__image-block img {
                            width: 100%;
                            height: auto;
                        }
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
                                            <img style=""
                                                 src="<?= $item['mini_img']; ?>">
                                            <div class="mgnfc-popup-parent-container mgnfc-popup-parent-container-<?= $i ?>"
                                                 style="">
                                                <?php if ($item['gallery']) {
                                                    foreach ($item['gallery'] as $gallery_item) { ?>
                                                        <a href="<?= $gallery_item['url']; ?>"></a>
                                                    <?php }
                                                } ?>
                                            </div>
                                            <script>
                                                $('.mgnfc-popup-parent-container-<?= $i ?>').magnificPopup({
                                                    delegate: 'a', // child items selector, by clicking on it popup will open
                                                    type: 'image',
                                                    gallery: {enabled: true},
                                                    image: {
                                                        markup: '<div class="mfp-figure">' +

                                                        '<div class="mfp-img"></div>' +
                                                        '<figure>' + '<figcaption>' +
                                                        '<div class="mfp-bottom-bar">' +
                                                        '<div style="background: #fff; text-align: center"  class="mfp-title "></div>' +

                                                        '</div>' +
                                                        '</figcaption>' +
                                                        '</figure>' +
                                                        '<div class="gallery-right-sidebar">' +
                                                        '<div class="member-name"><?= $item["name"]; ?></div>' +
                                                        '<div class="member-votes member-votes-<?= $i ?>">Голосов: <?= $item["vote"]; ?></div>' +
                                                        '<div class="member-desc"><?= $item["desc"]; ?></div>' +
                                                        '</div>' +
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
                                            <span class="numvotes numvotes-<?= $i ?>">Голосов: <?= $item["vote"]; ?></span>
                                        </div>
                                        <div class="bar">
                                            <button class="vote-button-<?= $i ?>">Голосовать</button>
                                            <!--                                        <div class="votedone" style="width: 10.00%"></div>-->
                                        </div>
                                        <script>
                                            $(".vote-button-<?= $i ?>").click(function (e) {

                                                var url = "<?php echo admin_url("admin-ajax.php") ?>"; // the script where you handle the form input.

                                                var form_data = {
                                                    action: 'update_vote',
                                                    member : <?= $i; ?>,
                                                    post_id : <?= get_the_ID(); ?>
                                                };

                                                $.ajax({
                                                    type: "POST",
                                                    url: url,
                                                    data: form_data, // serializes the form's elements.
                                                    success: function (data) {
                                                        data = data.substring(0, data.length - 1);
                                                        console.log(JSON.parse(data));
                                                        var response = JSON.parse(data);
                                                        $(".numvotes-<?= $i ?>").html("Голосов: " + response.vote);
                                                        $(".member-votes-<?= $i ?>").html("Голосов: " + response.vote);
                                                        if(response.ip_disable) {
                                                            alert('Вы уже проголосовали')
                                                        }
                                                    },

                                                    error: function () {
                                                        console.log('error');
                                                    }
                                                });
                                                e.preventDefault(); // avoid to execute the actual submit of the form.
                                            });
                                        </script>
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
