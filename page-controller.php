<?php
require_once("./DiDom/Document.php");
use DiDom\Document;
$url = 'http://ru-minecraft.ru/forum/showtopic-15361/page-1';
$document = new Document(file_get_contents($url));
$lastpage = $document->find('li.txt_info_pages');
$lastpage = explode(' ', $lastpage[0]->text())[3];
echo "Спасибо за апдейт\nLP: $lastpage";
file_put_contents("last.page", $lastpage);
