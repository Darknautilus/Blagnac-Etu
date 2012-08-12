<?php

include(PATH_MODELES."/bdd.php");

// Calcul du nombre de news à afficher
if(!isset($_GET["page"]) || $_GET["page"] <= 1)
	$page_news = 1;
else
	$page_news = $_GET["page"];

$interFin = 10 * $page_news;
$interDeb = $interFin - 10;

$streamListeNews = new BDD;
$streamListeNews->query("SELECT * FROM news LIMIT ".$interDeb." , ".$interFin);
$listeNews = $streamListeNews->result()->fetchAll();

echo $twig->render("news_liste.html", array("listeNews" => $listeNews));


