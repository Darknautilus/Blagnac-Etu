<?php

// Calcul du nombre de news à afficher
if(!isset($_GET["page"]) || $_GET["page"] <= 1)
	$page_news = 1;
else
	$page_news = $_GET["page"];

$interFin = NB_NEWS_PAGE * $page_news;
$interDeb = $interFin - NB_NEWS_PAGE;

$nbNews = nbElemTable("news");
$nbPages = (int)($nbNews/NB_NEWS_PAGE);
if($nbNews%NB_NEWS_PAGE != 0)
	$nbPages++;
	
$streamListeNews = new BDD;
$streamListeNews->query("SELECT * FROM news LIMIT ".$interDeb." , ".$interFin);
$listeNews = $streamListeNews->result()->fetchAll();

echo $twig->render("news_liste.html", array("infoMembres" => $GLOBALS["infoMembres"], "listeNews" => $listeNews, "numPage" => $page_news, "nbNews" => $nbNews, "nbPages" => $nbPages));


