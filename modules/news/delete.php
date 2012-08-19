<?php

/*
if(!estAdmin())
	header("Location:./index.php?module=news");
*/

$error = null;

if(!isset($_GET["id"]) || empty($_GET["id"]))
	$error = "Erreur de requête GET : id manquant";

else
{
	$streamNews = new BDD;
	if(!$streamNews->query("DELETE FROM news WHERE news_id=".$_GET["id"]))
		$error = $streamNews->error();
}

echo $twig->render("news_delete.html", array("infoMembres" => $GLOBALS["infoMembres"], "error" => $error));