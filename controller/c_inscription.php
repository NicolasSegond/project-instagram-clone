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
    case 'demandeInscription': {
            include('vues/register.php');
            break;
        }
    case 'valideInscription': {
            if (isset($_POST['submit'])) {
                if (!empty($_POST['hismail']) and !(empty($_POST['nom'])) and !(empty($_POST['nomUtilisateur'])) and !(empty($_POST['motdepasse']))) {
                    $hismail = trim($_POST['hismail']);
                    $nom = trim($_POST['nom']);
                    $nomUtil = trim($_POST['nomUtilisateur']);
                    $mdp = trim($_POST['motdepasse']);
                    $hashMdp = sha1($mdp);

                    if (preg_match('@[A-Z]@', $mdp) == true) {
                        if (preg_match('@[a-z]@', $mdp) == true) {
                            if (preg_match('@[0-9]@', $mdp) == true) {
                                if (strlen($mdp) > 8) {
                                    if (filter_var($hismail, FILTER_VALIDATE_EMAIL)) {
                                        $sql = "SELECT email FROM `users` WHERE email = :email";
                                        $query = $pdo->prepare($sql);
                                        $query->execute(array(
                                            "email" => $hismail,
                                        ));

                                        $nbemail = $query->rowCount();

                                        if ($nbemail == 0) {
                                            $sql = "INSERT INTO `users` (email,nom,nomUtilisateur,motdepasse) VALUES (:email,:nom,:nomUtilisateur,:mdp)";
                                            $query = $pdo->prepare($sql);
                                            $query->execute(array(
                                                ":mdp" => $hashMdp,
                                                ":email" => $hismail,
                                                ":nom" => $nom,
                                                ":nomUtilisateur" => $nomUtil
                                            ));
                                            header("Location:index.php?uc=connexion&action=demandeConnexion");
                                        } else {
                                            $msg = "Erreur le compte existe déjà ! Le mail est déjà utiliser";
                                            include('vues/register.php');
                                        }
                                    } else {
                                        $msg = "Veuillez entrez une adresse mail valide !";
                                        include('vues/register.php');
                                    }
                                } else {
                                    $msg = "Format du mot de passe non valide ! Votre mot de passe doit comporter au moins 8 caractères";
                                    include('vues/register.php');
                                }
                            } else {
                                $msg = "Format du mot de passe non valide ! Votre mot de passe doit contenir au moins 1 chiffre";
                                include('vues/register.php');
                            }
                        } else {
                            $msg = "Format du mot de passe non valide ! Votre mot de passe doit contenir au moins 1 minuscule";
                            include('vues/register.php');
                        }
                    } else {
                        $msg = "Format du mot de passe non valide ! Votre mot de passe doit contenir au moins 1 majuscule";
                        include('vues/register.php');
                    }
                }
            }
            break;
        }
}
