<?php

$estAdmin = estAdmin();

echo $twig->render("index_show.html", array("nom" => $user->data["username"], "idGroupe" => $user->data["group_id"], "estAdmin" => $estAdmin ));