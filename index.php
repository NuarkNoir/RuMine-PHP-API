<?php
error_reporting(E_ALL);
require_once("./DiDom/Document.php");
use DiDom\Document;

$lastpage = file_get_contents("./last.page");
$url = "http://ru-minecraft.ru/forum/showtopic-15361/page-$lastpage";
$document = new Document(file_get_contents($url));

$messages = array();
$msgs = $document->find('li.msg');
foreach ($msgs as $msg){
	$author = $msg->first('.msgAutorInfo .autorInfo p a');
	$text = $msg->find('.msgText')[0];
	$text = $text->toDocument()->first('[id^=MsgTextBox-]');
	$likers = $text->toDocument()->first('[class^=likeBox-]')->remove();
	$dk = new Document($text->innerHtml());
	$dk->first('[class^=likeBox-]')->remove();
	$text = $dk;
	$info = $msg->first('.msgInfo');
	if ($likers == '') $likers = 'NOBODY';
	/*FOR DEBUG
    echo '<div>';
    echo $author;
    echo '<br><br><br>';
    echo $text->html();
    echo '<br><br><br>';
    echo $likers->text();
    echo '<br><br><br>';
    echo $info;
    echo '</div>';
    echo '<br><br><br><br><br><br>';
	FOR DEBUG*/
	$adding = array(
	'USER' => $author->text(),
	'TEXT' => base64_encode($text->html()),
	'LIKERS' => $likers->text(),
	'INFO' => $info->text()
	);
	array_push($messages, $adding);
}
$json = array(
'LASTPAGE' => $lastpage,
'MEMUSAGE' => round(memory_get_peak_usage()/1024/1024,2) . " MB",
'MESSAGES' => $messages
);
echo json_encode($json, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
