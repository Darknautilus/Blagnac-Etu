<?php
	include_once('twig/lib/Twig/Autoloader.php');
	
	// Coupe un texte à $longueur caractères, sur les espaces, et ajoute des points de suspension...
	function tronque($chaine, $longueur = 120)
	{

		if (empty ($chaine))
		{
			return "";
		}
		elseif (strlen ($chaine) < $longueur)
		{
			return $chaine;
		}
		elseif (preg_match ("/(.{1,".$longueur."})\s./ms", $chaine, $match))
		{
			return $match [1] . "...";
		}
		else
		{
			return substr ($chaine, 0, $longueur) . "...";
		}
	}
	
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/templates');
	$twig = new Twig_Environment($loader, array('cache' => false));
	$twig->addFilter("cut", new Twig_Filter_Function("tronque"));
	$twig->addFunction("estAdmin", new Twig_Function_Function("estAdmin"));
	$twig->addFunction("redirectURL", new Twig_Function_Function("redirectURL"));	