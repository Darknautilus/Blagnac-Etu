<?php

$templateLogout = false;

if (isset($_GET['logout']))
{
   $GLOBALS["user"]->session_kill();
   $GLOBALS["user"]->session_begin();
   
   $templateLogout = true;
}
if (isset($_POST['login']))
{
   $username = request_var('username', '', true);
   $password    = request_var('password', '', true);
   $autologin   = (!empty($_POST['autologin'])) ? true : false;
   $viewonline = (!empty($_POST['viewonline'])) ? 0 : 1;
   $admin = 0;
   $result = $GLOBALS["auth"]->login($username, $password, $autologin, $viewonline, $admin);
   
   if ($result['error_msg'] !== false)
   {
      $err = $GLOBALS["user"]->lang[$result['error_msg']];
   }
   else
   {
      $GLOBALS["auth"]->acl($GLOBALS["user"]->data);
   }
}

$GLOBALS["infoMembres"] = majInfoMembres();

if($templateLogout)
{
	echo $twig->render("auth_logout.html");
}
else
{
	echo $twig->render("auth_login.html", array("phpbb_root_path" => $GLOBALS["phpbb_root_path"],
												"phpEx" => $GLOBALS["phpEx"],
												"infoMembres" => $GLOBALS["infoMembres"],
												"err" => $err
));

}