<?php

/*
	Module affiché par défaut
*/
define("DEFAULT_MODULE", "index");

/*
	Action par défaut pour chaque module
*/
$DEFAULT_ACTION = array(
	"index" => "show",
	"membres" => "auth",
	"news" => "liste"
);
$GLOBALS["DEFAULT_ACTION"] = $DEFAULT_ACTION;

/*
	Liste des modules et des actions
*/
$MODULES = array(
	"index" => array(
		"show"
		),
	"membres" => array(
		"auth"
		),
	"news" => array(
		"liste",
		"afficher",
		"ecrire",
		"save",
		"delete"
		)
	);
$GLOBALS["MODULES"] = $MODULES;

/*
	Fichiers de configuration des modules
*/
$MODULES_CONFIG = array(
	"news" => "config"
);
$GLOBALS["MODULES_CONFIG"] = $MODULES_CONFIG;

/*
	Fonction de controles des modules et actions
*/
function is_module($pModule)
{
	foreach($GLOBALS["MODULES"] as $module => $action)
	{
		if($pModule == $module)
			return true;
	}
	
	return false;
}

function is_action($pModule, $pAction)
{
	foreach($GLOBALS["MODULES"] as $module => $tabAction)
	{
		if($pModule == $module)
		{
			foreach($tabAction as $action)
			{
				if($action == $pAction)
					return true;
			}
		}
	}
	
	return false;
}

function default_module()
{
	return DEFAULT_MODULE;
}

function default_action($pModule)
{
	return $GLOBALS["DEFAULT_ACTION"][$pModule];
}

function is_config($pModule)
{
	foreach($GLOBALS["MODULES_CONFIG"] as $module => $config)
	{
		if($module == $pModule && $config != null)
			return true;
	}
	
	return false;
}

function configFile($pModule)
{
	return $GLOBALS["MODULES_CONFIG"][$pModule];
}