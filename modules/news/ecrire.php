<?php
/*
if(!estAdmin())
	header("Location:./index.php?module=news");
*/
	
$mode = MODE_NOUVEAU;
	
if(!empty($_GET["id"]) && is_numeric($_GET["id"]))
{
	$streamNews = new BDD;
	if($streamNews->query("SELECT * FROM news WHERE news_id='".$_GET["id"]."'"))
	{
		$tabNews = $streamNews->result()->fetchAll();
		if(!empty($tabNews))
			$mode = MODE_EDITION;
	}
}


if($mode == MODE_EDITION)
	$tabNews = $tabNews[0];
else
	$tabNews = array("news_title" => "", "news_author" => $GLOBALS["infoMembres"]["username"], "news_date" => "", "news_content" => "");

echo $twig->render("news_ecrire.html", array("tabNews" => $tabNews, "mode" => $mode, "MODE_NOUVEAU" => MODE_NOUVEAU, "MODE_EDITION" => MODE_EDITION));