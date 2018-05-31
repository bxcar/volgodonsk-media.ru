<?
$blog_url=get_bloginfo('url');
if(substr($blog_url, strlen($blog_url)-1,1)!='/')
{
	$blog_url.='/';
}

$blog_url.='?feed=news.yandex.ru';
?>
<style>
.news-yandex-ru-description{padding:6px;
color:#232323;
background:#FFFFE1;
}

.news-yandex-ru-atention{color:#ff0000;
font-size:12px !important;
}

.news-yandex-ru-description-atention{padding:6px;
background:#FFFFE1;
color:#DD5730;
border:1px solid #DD5730;
}

.news-yandex-ru-description-atention span{color:#232323;
}

input.news-yandex-ru-field{width:80%;
}

.news-yandex-ru-category{margin:22px 0px;
}

.news-yandex-ru-category li ul{
padding:0px 0px 0px 15px;
}

.news-yandex-ru-category li{
margin:4px 0px !important;
}
</style>
<div class="wrap">
<h2>news.yandex.ru WordPress RSS2.0 (v.<?=NEWS_YANDEX_RU_VERSION?>) <a class="news-yandex-ru-atention"  target="_blank" href="<?=$blog_url?>">Ссылка на rss для news.yandex.ru</a></h2>

<p class="news-yandex-ru-description">Плагин выводит посты за последние семь дней из выбранных категорий в виде  rss в формате пригодном для  сервиса news.yandex.ru. Все заголовки постов  обрезаются до 200 символов, при этом соблюдается целостность слов. Заголовки постов в rss  пишутся в нижнем регистре, заглавняа буква в верхнем. Все  изображения опубликованные в постах  добавляются в rss согласно рекомендациям news.yandex.ru.</p>

<p class="news-yandex-ru-description-atention">Если этот плагин помог вам и у вас есть возможность, то можете отблагодарить  автора переведя немного Webmoney на <span>Z413625351881</span> или  <span>R152804846543</span></p>

<form name="" action="" method="post">
<input name="news_yandex_ru_update" type="hidden" value="1">
<strong>Cсылка на графический файл с изображением логотипа издания:</strong>
<p>
<input class="news-yandex-ru-field" name="news_yandex_ru[url]" type="text" value="<?=$this->cfg['url']?>" autocomplete="off">
</p>
<p class="news-yandex-ru-description">(должен быть в формате .gif, без анимации. Размер – 100px по максимальной стороне)</p>


<strong>Название издания:</strong>
<p>
<input class="news-yandex-ru-field" name="news_yandex_ru[alt]" type="text" value="<?=$this->cfg['alt']?>" autocomplete="off">
</p>
<p class="news-yandex-ru-description">будет написано в html-атрибуте alt</p>

<strong>Урл издания:</strong>
<p>
<input class="news-yandex-ru-field" name="news_yandex_ru[link]" type="text" value="<?=$this->cfg['link']?>" autocomplete="off">
</p>
<p class="news-yandex-ru-description">если отличается от текущего адреса сайта. Пример:http://site.com</p>

<strong>Количество новостей в фиде:</strong>
<p>
Если количество публикуемых новостей за неделю очень большое то Яндекс бот может не успевать открывать его за  отведенное время в 15 секунд. И соответственно вы будете получать сообщение что  ваш rss недоступен. Но можно выбрать какое количество новостей фиксированно выводить в фид.
</p>

<?
$select_count=array(
'0'=>'',
'100'=>'',
'90'=>'',
'80'=>'',
'70'=>'',
'60'=>'',
'50'=>'',
'40'=>'',
'30'=>'',
'20'=>'',
'10'=>'',
);

$select_count[$this->cfg['count']]=' selected';
?>

<p>
<select size="1" name="news_yandex_ru[count]">
  <option value="0"<?=$select_count[0]?>>Все за последние 7 дней</option>
  <option value="100"<?=$select_count[100]?>>100</option>
  <option value="90"<?=$select_count[90]?>>90</option>
  <option value="80"<?=$select_count[80]?>>80</option>
  <option value="70"<?=$select_count[70]?>>70</option>
  <option value="60"<?=$select_count[60]?>>60</option>
  <option value="50"<?=$select_count[50]?>>50</option>
  <option value="40"<?=$select_count[40]?>>40</option>
  <option value="30"<?=$select_count[30]?>>30</option>
  <option value="20"<?=$select_count[20]?>>20</option>
  <option value="10"<?=$select_count[10]?>>10</option>
</select>
</p>

<strong>Рубрики</strong>
<p class="news-yandex-ru-description">выберите  рубрики посты из которых  выводить в  rss для яндекса. У выбранной рубрики в фид также будут включены  все  записи дочерних ей рубрик.
<p>
<?=$this->category()?>
</p>

<p><input class="button-primary" type="submit" value="Сохранить изменения"></p>
</form>

</div>