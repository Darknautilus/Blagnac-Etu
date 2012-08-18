<?php

/*
	Initialisation des sessions phpBB
*/
define("IN_PHPBB", true);
$phpbb_root_path = "./forum/";
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$GLOBALS["user"] = $user;
$GLOBALS["auth"] = $auth;
$GLOBALS["phpbb_root_path"] = $phpbb_root_path;
$GLOBALS["phpEx"] = $phpEx;

function estAdmin()
{
	if($GLOBALS["auth"]->acl_get("a_") == 1)
		return true;
	else
		return false;
}

/*
	Informations globales de l'utilisateur à intégrer dans chaque template
*/
$GLOBALS["infoMembres"] = array("user_id" => $GLOBALS["user"]->data["user_id"],
								"username" => $GLOBALS["user"]->data["username"],
								"is_registered" => $GLOBALS["user"]->data["is_registered"],
								"is_admin" => estAdmin()
								);

/*
	Récupération des fichiers de configuration
*/
include_once("./config.php");
include_once("./queries.php");

/*
	Initialisation du moteur de templates
*/
include_once("./loadTwig.php");
								
/*
	Désactivation des guillemets magiques
*/
if(get_magic_quotes_gpc())
{
        $_POST = array_map('stripslashes', $_POST);
        $_GET = array_map('stripslashes', $_GET);
        $_COOKIE = array_map('stripslashes', $_COOKIE);
}

/*
	Sécurisation des formulaires
*/
$_POST = array_map("htmlspecialchars", $_POST);
$_GET = array_map("htmlspecialchars", $_GET);
$_COOKIE = array_map("htmlspecialchars", $_COOKIE);

/*
	Démarrage de la temporisation de sortie
*/
ob_start();

if(!isset($_GET["module"]) || !is_module($_GET["module"]))
	$module = default_module();
else
	$module = $_GET["module"];

	
if(!isset($_GET["action"]) || !is_action($module, $_GET["action"]))
		$action = default_action($module);
else
		$action = $_GET["action"];

/*var_dump($module);
var_dump($action);*/

if(is_config($_GET["module"]))
{
	$chemin_include = PATH_MODULES."/".$module."/".configFile($_GET["module"]).".php";
	include($chemin_include);
}

$chemin_include = PATH_MODULES."/".$module."/".$action.".php";
include($chemin_include);

/*
	Récupération du contenu et fin de la temporisation
*/
$content = ob_get_contents();
ob_end_clean();

/*
	Affichage final
*/
echo $content;

?>