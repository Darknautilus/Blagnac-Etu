<?php

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

if(isset($templateLogout))
{
	echo $twig->render("auth_logout.html");
}
else
{
	echo $twig->render("auth_login.html", array(
	"ANONYMOUS" => ANONYMOUS,
	"phpbb_root_path" => $GLOBALS["phpbb_root_path"],
	"phpEx" => $GLOBALS["phpEx"],
	"user_id" => $GLOBALS["user"]->data["user_id"],
	"username" => $GLOBALS["user"]->data["username"],
	"err" => $err
));

}