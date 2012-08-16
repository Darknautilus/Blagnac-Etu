<?php

// Calcul du nombre de news à afficher
if(!isset($_GET["page"]) || $_GET["page"] <= 1)
	$page_news = 1;
else
	$page_news = $_GET["page"];

$interFin = 10 * $page_news;
$interDeb = $interFin - 10;

$nbNews = nbElemTable("news");
$nbPages = (int)($nbNews/10);
if($nbNews%10 != 0)
	$nbPages++;
	
$streamListeNews = new BDD;
$streamListeNews->query("SELECT * FROM news LIMIT ".$interDeb." , ".$interFin);
$listeNews = $streamListeNews->result()->fetchAll();

echo $twig->render("news_liste.html", array("listeNews" => $listeNews, "numPage" => $page_news, "nbNews" => $nbNews, "nbPages" => $nbPages));


