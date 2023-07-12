<?php
require_once('include/database.php');
require_once('include/config.php');

date_default_timezone_set('Europe/Paris');
session_start();

$uc = $_GET['uc'];

switch ($uc) {
    case 'connexion':{
        include("controller/c_connexion.php");
        break;
    }
    case 'inscription':{
        include("controller/c_inscription.php");
        break;
    }
    case 'accueil':{
        include("controller/c_accueil.php");
        break;
    }
    case 'profil':{
        include("controller/c_profil.php");
        break;
    }
    case 'upload':{
        include("controller/c_upload.php");
        break;
    }
}

?>