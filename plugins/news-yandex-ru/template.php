<?ob_start();
setlocale(LC_ALL, "ru_RU.UTF-8") ;
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/rss+xml; charset=UTF-8");

function news_yandex_ru_formatchar($text)
{
	$re=array(
		'&' => '&amp;',
		'<' => '&lt;',
		'>' => '&gt;',
		"'" => '&apos;',
		'"' => '&quot;',
	);
	$text = strtr($text,$re);

	$re=array(
		'&amp;quot;'=>'&quot;',
		'&amp;#' => '&#'
	);

	return strtr($text,$re);
}


function cleat_title($title)
{$search = array ("'<script[^>]*?>.*?</script>'si",  // Âûðåçàåòñÿ javascript
                 "'<[\/\!]*?[^<>]*?>'si",           // Âûðåçàþòñÿ html-òýãè
                 "'([\r\n])[\s]+'",                 // Âûðåçàåòñÿ ïóñòîå ïðîñòðàíñòâî
                 "'&(quot|#34);'i",                 // Çàìåùàþòñÿ html-ýëåìåíòû
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i"
);

$replace = array ("",
                  "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169)
);

return preg_replace($search, $replace, $title);
}

/*ðåæåì ñòðîêó äî íóæíîãî êîëè÷åñòâà ñèìâîëîâ*/
function news_yandex_ru_strip_wrap($text, $limit=200)
{
	$text=mb_substr($text,0,$limit);
	/*åñëè íå ïóñòàÿ îáðåçàåì äî  ïîñëåäíåãî  ïðîáåëà*/
	if(mb_substr($text,mb_strlen($text)-1,1) && mb_strlen($text)==$limit)
	{
		$textret=mb_substr($text,0,mb_strlen($text)-mb_strlen(strrchr($text,' ')));
		if(!empty($textret))
		{
			return $textret;
		}
	}
	return $text;
}

$cfg=get_option('news_yandex_ru');

$category=array();

foreach($cfg['category'] as $k=>$v)
{ 	$category[]=$v;
}

echo '<?xml version="1.0" encoding="utf-8"?>
';?>
<rss version="2.0" xmlns="http://backend.userland.com/rss2" xmlns:yandex="http://news.yandex.ru">
<channel>
	<title><?=news_yandex_ru_formatchar(cleat_title(get_bloginfo_rss('name')))?></title>
	<link><?=news_yandex_ru_formatchar(htmlspecialchars(get_bloginfo_rss('url'),ENT_QUOTES))?></link>
	<description><?=htmlspecialchars(get_bloginfo_rss('description'),ENT_QUOTES)?></description>
	<image>
		<title><?=news_yandex_ru_formatchar(cleat_title($cfg['alt']))?></title>
		<link><?=news_yandex_ru_formatchar(htmlspecialchars($cfg['link']))?></link>
		<url><?=news_yandex_ru_formatchar(htmlspecialchars($cfg['url']))?></url>
	</image>
   <?

   $posts_per_page=-1;

   if(!empty($cfg['count']))
   {   		$posts_per_page=$cfg['count'];
   }

    $args=array(
		'cat'=>implode(',',$category),
		'posts_per_page'=>-1,
		'post_status'=>'publish'
	);
    query_posts($args);
	$options['description']=true;
	if (have_posts())
	{
		global $more;
		$more =1;
		while (have_posts())
		{
		the_post();
		$hide =  get_post_meta($post->ID, 'news_yandex_ru_hide', true);

			if($hide==0)
			{
				$titleitem=cleat_title(get_the_title());
				?>
			<item>
				<title><?=news_yandex_ru_formatchar(news_yandex_ru_strip_wrap($titleitem))?></title>
				<link><?=news_yandex_ru_formatchar(htmlspecialchars(get_permalink(),ENT_QUOTES))?></link>
				<description><?=news_yandex_ru_formatchar(apply_filters('the_excerpt_rss',get_the_excerpt(true)))?></description>
				<?php
				$categories = get_the_category($post->ID);
				 echo "<category>".news_yandex_ru_formatchar(htmlspecialchars(strip_tags(get_the_category_by_ID($categories[0]->term_id), ENT_QUOTES)))."</category>\n"; ?>
				<?php rss_enclosure(); ?>

				<?
				preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content, $post_images);
				if(!empty($post_images[1]) && count($post_images[1])>0)
				{
					foreach($post_images[1] as $pi_k=>$pi_v)
					{

		            	$image_info=getimagesize($pi_v);
		            	$image_name=basename($pi_v);
		            	$image_path=str_replace($image_name,'',$pi_v);
		            	?><enclosure url="<?=$image_path.urlencode($image_name)?>" type="<?=$image_info['mime']?>"/><?
					}
				}

				?>


				<pubDate><?php
					$gmt_offset = get_option('gmt_offset');
					$gmt_offset = ($gmt_offset>9)?$gmt_offset.'00':('0'.$gmt_offset.'00');
					echo mysql2date('D, d M Y H:i:s +'.$gmt_offset, get_date_from_gmt(get_post_time('Y-m-d H:i:s', true)), false); ?></pubDate><?

					$content = apply_filters('the_content_rss', $post->post_content);
					/*óáèðàåì øîðòêîäû*/
					$content=preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content );
					/*óáèðàåì ñêðèïòû*/
					$content=preg_replace( '/<script\b[^>]*>(.*?)<\/script>/i', '', $content );
					?>
					<yandex:full-text><?=news_yandex_ru_formatchar(htmlspecialchars(strip_tags($content,ENT_QUOTES)))?></yandex:full-text>
			</item>
			<?
			}
		}
	}
	else
	{
	}
	?>

</channel>
</rss>
<!-- wordpress news.yandex.ru rss 2.0 plugin author http://saintist.ru. -->
<?
$yandex_rss=ob_get_contents();
ob_clean();
echo trim($yandex_rss);
?>