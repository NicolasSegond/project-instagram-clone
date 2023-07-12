<?php

if (!isset($_GET['action'])) {
    $_GET['action'] = 'demandeInscription';
}

/**
 *  Récupération de l'action dans l'url et en fonction de l'action je lui attribue les actions a réaliser et 
 * les pages a afficher
 */
$action = $_GET['action'];
switch ($action) {
    case 'consulterProfil': {
            if (isset($_GET['id']) and $_GET['id'] > 0) {
                $getid = intval($_GET['id']);
                $requser = $pdo->prepare('SELECT * FROM `users` WHERE id = ?');
                $requser->execute(array($getid));
                $userinfo = $requser->fetch();
            }
            include('vues/profil.php');
            break;
        }
    case 'modifier': {
            if (isset($_GET['id']) and $_GET['id'] > 0) {
                $getid = intval($_GET['id']);
                $requser = $pdo->prepare('SELECT * FROM `users` WHERE id = ?');
                $requser->execute(array($getid));
                $userinfo = $requser->fetch();
            }
            include('vues/modifProfil.php');
            break;
        }
    case 'modifierMDP': {
            if (isset($_GET['id']) and $_GET['id'] > 0) {
                $getid = intval($_GET['id']);
                $requser = $pdo->prepare('SELECT * FROM `users` WHERE id = ?');
                $requser->execute(array($getid));
                $userinfo = $requser->fetch();
            }
            include('vues/modifMDP.php');
            break;
        }
    case 'changerPhoto': {
            /* AJOUT D'UNE PHOTO DE PROFIL */

            if (isset($_FILES['upfile']) and !empty($_FILES['upfile']['name'])) {
                $tailleMax = 2097152;
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if ($_FILES['upfile']['size'] <= $tailleMax) {
                    $extensionUpload = strtolower(substr(strrchr($_FILES['upfile']['name'], '.'), 1));
                    if (in_array($extensionUpload, $extensionsValides)) {
                        $chemin = "membres/avatars/" . $_SESSION['id'] . "." . $extensionUpload;
                        $resultat = move_uploaded_file($_FILES['upfile']['tmp_name'], $chemin);
                        if ($resultat) {
                            $updateavatar = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
                            $updateavatar->execute(array(
                                'avatar' => $_SESSION['id'] . "." . $extensionUpload,
                                'id' => $_SESSION['id']
                            ));
                            header('Location: index.php?uc=profil&action=consulterProfil&id=' . $_SESSION['id']);
                        } else {
                            $msg = "Erreur durant l'importation de votre photo de profil";
                        }
                    } else {
                        $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    }
                } else {
                    $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
                }
            }
        }
    case 'supprimerPhoto': {
            /* SUPPRESSION PHOTO DE PROFIL */

            if (isset($_POST['deletefile']) and !empty($_POST['deletefile'])) {
                $updateavatar = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => "",
                    'id' => $_SESSION['id']
                ));
                header('Location: index.php?uc=profil&action=consulterProfil&id=' . $_SESSION['id']);
            }
        }
    case 'modifierInfos': {
            /* TRAITEMENT INFOS DU PROFIL */

            if (isset($_POST['submit'])) {
                $nouveauNom = trim($_POST['modifNom']);
                $nouveauNomUtil = trim($_POST['modifUsername']);
                $nouveauSite = trim($_POST['modifWebSite']);
                $nouvelleBio = trim($_POST['modifBio']);
                $nouveauEmail = trim($_POST['modifEmail']);
                $nouveauNumero = trim($_POST['modifNum']);

                if (filter_var($nouveauEmail, FILTER_VALIDATE_EMAIL)) {
                    $sql = "UPDATE users SET email = :email, nom = :nom, nomUtilisateur = :nomUtilisateur, siteWeb = :siteWeb, Biographie = :Biographie, telephone = :telephone WHERE id = :id";
                    $query = $pdo->prepare($sql);
                    $query->execute(array(
                        'email' => $nouveauEmail,
                        'nom' => $nouveauNom,
                        'nomUtilisateur' => $nouveauNomUtil,
                        'siteWeb' => $nouveauSite,
                        'Biographie' => $nouvelleBio,
                        'telephone' => $nouveauNumero,
                        'id' => $_SESSION['id']
                    ));
                }
                header('Location: index.php?uc=profil&action=modifier&id=' . $_SESSION['id']);
                break;
            }
        }
    case 'modifierInfosMDP': {
            if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
                $getid = intval($_SESSION['id']);
                $requser = $pdo->prepare('SELECT * FROM `users` WHERE id = ?');
                $requser->execute(array($getid));
                $userinfo = $requser->fetch();
            }

            /*  MODIFICATION DU MOT DE PASSE */

            if (isset($_POST['submitModifMDP']) and !empty($_POST['submitModifMDP'])) {
                if (!empty($_POST['oldPassword']) and !empty($_POST['newPassword']) and !empty($_POST['confirmation'])) {
                    $MotDePasseDeLaBdd = $userinfo['motdepasse'];
                    $AncienMotDePasseEntree = trim(sha1($_POST['oldPassword']));
                    if ($MotDePasseDeLaBdd == $AncienMotDePasseEntree) {
                        $NouveauMotDePasse = trim(sha1($_POST['newPassword']));
                        $confirmationMotDePasse = trim(sha1($_POST['confirmation']));
                        if (preg_match('@[A-Z]@', $NouveauMotDePasse) == true) {
                            if (preg_match('@[a-z]@', $NouveauMotDePasse) == true) {
                                if (preg_match('@[0-9]@', $NouveauMotDePasse) == true) {
                                    if (strlen($NouveauMotDePasse) > 8) {
                                        if ($NouveauMotDePasse == $confirmationMotDePasse) {
                                            $sql = "UPDATE users SET motdepasse = :motdepasse WHERE id = :id";
                                            $query = $pdo->prepare($sql);
                                            $query->execute(array(
                                                'motdepasse' => $NouveauMotDePasse,
                                                'id' => $_SESSION['id']
                                            ));
                                        } else {
                                            $msg = "le mot de passe de confirmation n'est pas le même";
                                        }
                                    } else {
                                        $msg = "Format du mot de passe non valide ! Votre mot de passe doit comporter au moins 8 caractères";
                                    }
                                } else {
                                    $msg = "Format du mot de passe non valide ! Votre mot de passe doit contenir au moins 1 chiffre";
                                }
                            } else {
                                $msg = "Format du mot de passe non valide ! Votre mot de passe doit contenir au moins 1 minuscule";
                            }
                        } else {
                            $msg = "Format du mot de passe non valide ! Votre mot de passe doit contenir au moins 1 majuscule";
                        }
                    } else {
                        $msg = "l'ancien mot de passe ne correspond pas";
                    }
                } else {
                    $msg = "l'ancien mot de passe, le nouveau mot de passe ou le mot de passe de confirmation est manquant";
                }
            }
            header('Location: index.php?uc=profil&action=modifierMDP&id=' . $_SESSION['id']);
            break;
        }
}
