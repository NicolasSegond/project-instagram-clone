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
    case 'demandeConnexion': {
            include('vues/login.php');
            break;
        }
    case 'valideConnexion': {
            if (isset($_POST['submit'])) {
                if (!empty($_POST['email']) and !empty($_POST['mdp'])) {
                    $email = trim($_POST['email']);
                    $mdp = sha1($_POST['mdp']);


                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $sql = "SELECT * FROM `users` WHERE email= :email AND motdepasse = :motdepasse";
                        $query = $pdo->prepare($sql);
                        $query->execute(array(
                            "email" => $email,
                            "motdepasse" => $mdp
                        ));

                        $line = $query->rowCount();

                        if ($line == 1) {
                            $userinfo = $query->fetch();
                            $_SESSION['id'] = $userinfo['id'];
                            $_SESSION['pseudo'] = $userinfo['nomUtilisateur'];
                            $_SESSION['email'] = $userinfo['email'];
                            header("Location: index.php?uc=accueil&action=afficher&id=" . $_SESSION['id']);
                        } else {
                            $msg = "Mot de passe ou email invalide veuillez réassayer";
                        }
                    } else {
                        $msg = "Mail incorrect !";
                    }
                } else {
                    $msg = "Les formulaires ne doivent pas être vides !";
                }
            }
            break;
        }
    case 'deconnexion': {
            session_start();
            $_SESSION = array();
            session_destroy();
            header("Location:index.php?uc=connexion&action=demandeConnexion");
        }
}
