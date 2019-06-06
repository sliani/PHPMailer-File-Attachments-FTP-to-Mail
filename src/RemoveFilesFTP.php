<?php

// Change the values for deploye new project
require '../src/Models.php';

// Déclaration des valeurs de connexion pour le FTP - dans Models.php ->
$ftp_server    = $ftp_s;
$ftp_user_name = $ftp_login;
$ftp_user_pass = $ftp_pass;

// Mise en place d'une connexion basique
$conn_id = ftp_connect($ftp_server);

// Identification avec un nom d'utilisateur et un mot de passe
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// Récupération du contenu d'un dossier
$contents = ftp_nlist($conn_id, "./public");

// Delete all files in the folder ftp after sync with source/public/
foreach ($contents as $file)
{
	ftp_delete($conn_id, $file);
}

echo "<br> Email success send : <br>";

// Affiche le buffer
var_dump($contents);

// Fermeture de la connexion
ftp_close($conn_id);
