<?php
require_once(".\DiDom\Document.php");
use DiDom\Document;
#set_time_limit(30);
$url = 'http://ru-minecraft.ru/forum/showtopic-15361/page-';
$document = new Document($url . 9999, true);
$lastpage = $document->find('li.txt_info_pages');
$lastpage = explode(' ', $lastpage[0])[4];

$author = $document->find('.msg .msgAutorInfo .autorInfo p a');
$text = $document->find('.msg .msgText');
$info = $document->find('.msg .msgInfo');

###testarea
echo $author[0];
echo '<br><br><br>';
echo $text[0];
echo '<br><br><br>';
echo $info[0];
echo '<br><br><br><br><br><br>';
###testarea

echo "<br><b>Мы отработали!</b> Памяти использовано: ".round(memory_get_peak_usage()/1024/1024,2)." MB<br>\n";
echo "Последняя страница: $lastpage<br>\n";
