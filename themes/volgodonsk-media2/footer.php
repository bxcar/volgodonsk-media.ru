<?php ?>
<hr/>
<footer>
    <div class="well socials">
        <a href="https://ok.ru/telekompaniyavtv" target="_blank">
            <i class="fa fa-odnoklassniki"></i>
        </a>
        <a href="http://vk.com/vtvnews" target="_blank">
            <i class="fa fa-vk"></i>
        </a>
        <a href="https://twitter.com/newsmediavtv" target="_blank">
            <i class="fa fa-twitter"></i>
        </a>
        <a href="https://www.instagram.com/TV_VTV" target="_blank">
            <i class="fa fa-instagram"></i>
        </a>
        <a href="https://www.facebook.com/groups/907090672692581" target="_blank">
            <i class="fa fa-facebook"></i>
        </a>
        <!--<a href="https://t.me/televtv" target="_blank">
          <i class="fa fa-telegram"></i>
        </a>-->
    </div>


    <div class="container">
        <p class="pull-right"><a href="#">Наверх</a></p>
        <p>Авторские права &copy; 2011-<?php echo date('Y'); ?> «Волгодонск-Медиа». ООО «Телекомпания ВТВ».</p>
        <p>Полное или частичное копирование материалов запрещено. При согласованном использовании материалов сайта
            необходима ссылка на ресурс.</p>
        <?php if (function_exists('dynamic_sidebar')) dynamic_sidebar("footer-content"); ?>
    </div>
    <div class="container">
        <!-- Yandex.Metrika informer -->
        <a href="https://metrika.yandex.ru/stat/?id=6485302&amp;from=informer"
           target="_blank" rel="nofollow"><img
                    src="https://informer.yandex.ru/informer/6485302/3_0_FFFFFFFF_FFFFFFFF_0_pageviews"
                    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                    title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                    onclick="try{Ya.Metrika.informer({i:this,id:6485302,lang:'ru'});return false}catch(e){}"/></a>
        <!-- /Yandex.Metrika informer -->


        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter6485302 = new Ya.Metrika({
                            id: 6485302,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            webvisor: true,
                            trackHash: true
                        });
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/6485302" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->
        <div style="display: block; padding: 50px;"></div>
    </div>
</footer>
<?php wp_footer(); ?>


<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11673660-5']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-countdown/2.0.1/jquery.plugin.min.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-countdown/2.0.1/jquery.countdown.min.js"
        type="text/javascript"></script>
<script src="/wp-content/themes/volgodonsk-media2/js/jquery.liMarquee.js" type="text/javascript"></script>
<script src="/wp-content/themes/volgodonsk-media2/flowplayer.min.js" type="text/javascript"></script>
<script src="/wp-content/themes/volgodonsk-media2/js/jquery.jplayer.min.js" type="text/javascript"></script>
<script src="/wp-content/themes/volgodonsk-media2/js/script.js?v=030" type="text/javascript"></script>

<script src="<?= get_template_directory_uri(); ?>/js/jquery.magnific-popup.min.js"></script>
<script>
    $('.mgnfc-popup-parent-container').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {enabled: true}
//        midClick: true
        // other options
    });
</script>
</body>
</html>
