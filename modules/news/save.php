<?php
/*
if(!estAdmin())
	header("Location:./index.php?module=news");
*/

$error = null;

if($_GET["mode"] == MODE_EDITION && (!isset($_GET["id"]) || empty($_GET["id"])))
	$error = "Erreur de requête GET : id manquant";

else if($_GET["mode"] == MODE_EDITION)
{
	$streamNews = new BDD;
	if(!$streamNews->query("UPDATE news SET news_title='".$_POST["newsTitle"]."',news_author='".$_POST["newsAuthor"]."',news_content='".$_POST["newsContent"]."' WHERE news_id=".$_GET["id"]))
		$error = "Erreur de mise à jour de la table 'news' ; ".$streamNews->error();
}

else if($_GET["mode"] == MODE_NOUVEAU)
{
	$streamNews = new BDD;
	$date = date("d/m/Y à H:i");
	if(!$streamNews->query("INSERT INTO news (news_title,news_author,news_date,news_content) VALUES ('".$_POST["newsTitle"]."','".$_POST["newsAuthor"]."','".$date."','".$_POST["newsContent"]."')"))
		$error = "Erreur d'insertion dans la table 'news' ; ".$streamNews->error();
		
}

else
	$error = "Erreur de requête GET : mode manquant";

echo $twig->render("news_save.html", array("infoMembres" => $GLOBALS["infoMembres"], "error" => $error, "mode" => $_GET["mode"], "MODE_EDITION" => MODE_EDITION));