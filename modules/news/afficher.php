<?php

include(PATH_MODELES."/bdd.php");

$streamNews = new BDD;
if(!$streamNews->query("SELECT * FROM news WHERE news_id = '".$_GET["id"]."'"))
	$error = $streamNews->error();
else
{
	$tabNews = $streamNews->result()->fetchAll();
	$error = null;
	if(empty($tabNews))
		$error = "Une erreur SQL est survenue";
}

echo $twig->render("news_afficher.html", array("error" => $error, "news" => $tabNews[0]));