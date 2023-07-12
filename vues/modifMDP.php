<!doctype html>
    <html lang="fr">
        
        <head>
            <meta charset="utf-8">
            <title>Titre de la page</title>
            <script src="assets/script.js"></script>
            <link href="assets/style3.css" rel="stylesheet">

            <script src="https://kit.fontawesome.com/fda357da01.js" crossorigin="anonymous"></script>
        </head>

        <body>
            <nav class="header">
                <div class="center">
                    <a href="#"><div class="Logo">
                        <img src="logo.png" alt="LogoInsta" class="imgLogo">
                    </div></a>
                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass icon-search"></i>
                        <input type="text" maxlength="12" placeholder="Rechercher" class="searchbar" />
                    </div>
                    <div class="navigation">
                    <?php echo'<a href="index.php?uc=accueil&action=afficher&id=' . $_SESSION['id'] . '">';?><i class="fa-solid fa-house icon"></i></a>
                        <a href="#"><i class="fa-solid fa-paper-plane icon"></i></a>
                        <a href="#"><i class="fa-solid fa-plus icon"></i></a>
                        <a href="#"><i class="fa-solid fa-compass icon"></i></a>
                        <a href="#"><i class="fa-solid fa-heart icon"></i></a>
                        <div style="height: 28px; width: 28px;" onclick="clique()">
                            <div class="boxPdp" style="height: 28px; width: 28px; border: 1px solid rgba(var(--i1d,38,38,38),1); border-radius: 50%;"></div>
                            <img src="<?php echo "membres/avatars/".$userinfo['avatar']; ?>" style="position: absolute; top: 15px; height: 28px; width: 28px; border: 1px solid rgba(var(--i1d,38,38,38),1); border-radius: 50%;">
                        </div>
                    </div>
                </div>
                <div class="menuDeroulantPdp" id="menuDeroulantPdp">
                    <?php echo'<a href="index.php?uc=profil&action=consulterProfil&id=' . $_SESSION['id'] . '">';?><div class="profil" style="border-top-left-radius: 20px; border-top-right-radius: 20px;"><span class="text"><i class="fa-solid fa-user" style="margin-right: 10px;"></i> Profil</span></div></a>
                    <a href="#"><div class="profil"><span class="text"><i class="fa-solid fa-bookmark" style="margin-right: 10px;"></i> Enregistré</span></div></a>
                    <a href="#"><div class="profil"><span class="text"><i class="fa-solid fa-gear" style="margin-right: 10px;"></i></i> Paramètres</span></div></a>
                    <a href="#"><div class="profil"><span class="text"><i class="fa-solid fa-arrows-rotate" style="margin-right: 10px;"></i> Changer de compte</span></div></a>
                    <hr>
                        <a href="index.php?uc=connexion&action=deconnexion"><div class="deconnexion" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"><span class="text"> Déconnexion </span></div></a>
                </div>
            </nav>
            <div class="colonnePrincipale">
                <div class="CategorieModif">
                    <div class="Liste">
                        <ul>
                            <li><?php echo'<a href="index.php?uc=profil&action=modifier&id=' . $_SESSION['id'] . '" class="textCategorie">';?>Modifier profil</a></li>
                            <li><a href="#" class="textCategorie ">Changer de mot de passe</a></li>
                            <li><a href="#" class="textCategorie ">Apps et sites web</a></li>
                            <li><a href="#" class="textCategorie ">Notifications par e-mail</a></li>
                            <li><a href="#" class="textCategorie ">Notifications push</a></li>
                            <li><a href="#" class="textCategorie ">Gérer les contacts</a></li>
                            <li><a href="#" class="textCategorie ">Sécurité et confidentialité</a></li>
                            <li><a href="#" class="textCategorie ">Activité de connexion</a></li>
                            <li><a href="#" class="textCategorie ">E-mails d'Instagram</a></li>
                            <li><a href="#" class="textCategorie ">Aide</a></li>
                        </ul>
                    </div>
                </div>
                <div class="colonneProfil">
                    <div id="premiereLignesMDP">
                        <div class="pdpModifMDP">
                            <img src="<?php echo "membres/avatars/".$userinfo['avatar']; ?>" alt="" class="imgModifMDP">
                        </div>
                        <h1 style="font-size: 24px; font-weight: 400; line-height: 38px;"><?php echo $userinfo['nomUtilisateur']; ?></h1>
                    </div>
                    <form action="index.php?uc=profil&action=modifierInfosMDP" method="POST">
                        <div class="inputContainerModifMdp">
                            <aside class="aside">
                                <label for="oldPassword"> Ancien mot de passe </label>
                            </aside>
                            <div style="padding-right: 60px; width: 100%;">
                                <input type="password" name="oldPassword" class="inputPassword">
                            </div>
                        </div>
                        <div class="inputContainerModifMdp">
                            <aside class="aside">
                                <label for="newPassword"> Nouveau mot de passe </label>
                            </aside>
                            <div style="padding-right: 60px; width: 100%;">
                                <input type="password" name="newPassword" class="inputPassword">
                            </div>
                        </div>
                        <div class="inputContainerModifMdp">
                            <aside class="aside">
                                <label for="confirmation"> Confirmer le nouveau mot de passe </label>
                            </aside>
                            <div style="padding-right: 60px; width: 100%;">
                                <input type="password" name="confirmation" class="inputPassword">
                            </div>
                        </div>
                        <div class="inputContainerModifMdp">
                            <aside class="aside">
                            </aside>
                            <div style="padding-right: 60px; width: 100%; display: flex; flex-direction: row;">
                                <input type="submit" name="submitModifMDP" class="btnModifMDP" value="Modifier le mot de passe">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    </html>