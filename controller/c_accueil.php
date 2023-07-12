<?php

if (!isset($_GET['action'])) {
    $_GET['action'] = 'demandeConnexion';
}

/**
 *  Récupération de l'action dans l'url et en fonction de l'action je lui attribue les actions a réaliser et 
 * les pages a afficher
 */
$action = $_GET['action'];
switch ($action) {
    case 'afficher': {
            include('vues/PageAccueil.php');
            break;
        }
}
