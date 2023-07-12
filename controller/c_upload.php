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
    case 'upload': {
            if (isset($_POST["partagerPublication"]) and !empty($_FILES['imagePublication']['name']) and !empty($_POST['descriptionPublication'])) {
                $description = htmlspecialchars($_POST['descriptionPublication']);
                $lieu = htmlspecialchars($_POST['lieuPublication']);
                $tailleMax = 2097152;
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                $nombreAleatoire = rand(0, 9999999999999);

                if ($_FILES['imagePublication']['size'] <= $tailleMax) {
                    $extensionUpload = strtolower(substr(strrchr($_FILES['imagePublication']['name'], '.'), 1));
                    if (in_array($extensionUpload, $extensionsValides)) {
                        $chemin = "posts/images/" . $nombreAleatoire . "." . $extensionUpload;
                        $resultat = move_uploaded_file($_FILES['imagePublication']['tmp_name'], $chemin);
                        if ($resultat) {
                            $sql = "INSERT INTO `posts` (idUSER,description,lieu,date,image) VALUES (:idUSER,:description, :lieu,NOW(),:image)";
                            $query = $pdo->prepare($sql);
                            $query->execute(array(
                                "idUSER" => $_SESSION['id'],
                                "description" => $description,
                                "lieu" => $lieu,
                                "image" => $nombreAleatoire . "." . $extensionUpload
                            ));
                            header('Location: index.php?uc=accueil&action=afficher&id=' . $_SESSION['id']);
                        } else {
                        }
                    } else {
                    }
                } else {
                }
            }
            include('vues/PageAccueil.php');
            break;
        }
}
