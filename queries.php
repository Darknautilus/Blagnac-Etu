<?php

/*
	Module affiché par défaut
*/
define("DEFAULT_MODULE", "index");

/*
	Action par défaut pour chaque module
*/
$DEFAULT_ACTION = array(
	"index" => "show"
);
$GLOBALS["DEFAULT_ACTION"] = $DEFAULT_ACTION;

/*
	Liste des modules et des actions
*/
$MODULES = array(
	"index"
);
$GLOBALS["MODULES"] = $MODULES;

$ACTIONS = array(
	"index" => "show"
);
$GLOBALS["ACTIONS"] = $ACTIONS;

/*
	Fonction de controles des modules et actions
*/
function is_module($pModule)
{
	foreach($GLOBALS["MODULES"] as $module)
	{
		if($pModule == $module)
			return true;
	}
	
	return false;
}

function is_action($pModule, $pAction)
{
	foreach($GLOBALS["ACTIONS"] as $module => $action)
	{
		if($pModule == $module && $pAction == $action)
			return true;
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