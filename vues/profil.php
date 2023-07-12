<!doctype html>
    <html lang="fr">
        
        <head>
            <meta charset="utf-8">
            <title>Titre de la page</title>
            <link rel="stylesheet" href="assets/style3.css">
            <script src="assets/script.js"></script>

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
                        <a href="index.php?uc=connexion&action=deconnexion" name="deco"><div class="deconnexion" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"><span class="text"> Déconnexion </span></div></a>
                </div>
            </nav>
            <section style="width: auto; height: 659px;">
                     <div class="principale">
                        <div class="partieHaut">
                            <div class="photo">
                                <button class="btnPhoto center">
                                    <img src="<?php echo "membres/avatars/".$userinfo['avatar']; ?>" alt="Modifier la photo de profil" class="imgPdp" />
                                </button>
                            </div>
                            <div class="TextPresentation">
                                <div class="premiereLigne">
                                    <span class="nomProfil"><?php echo $userinfo['nomUtilisateur']; ?> </span>
                                    <?php echo'<a class="modifProfil" href="index.php?uc=profil&action=modifier&id=' . $_SESSION['id'] . '">';?>Modifier profil</a>
                                    <i class="fa-solid fa-gear paramIcon"></i>
                                </div>
                                <div class="premiereLigne">
                                    <span class="texte"><strong>0</strong> publications</span>
                                    <span class="texte"><strong>34 </strong> abonnés</span>
                                    <span class="texte"><strong>94 </strong> abonnements</span>
                                </div>
                                <div class="DivBiographie">
                                    <span class="textBio"><?php echo $userinfo['nom']; ?></span><br>
                                    <span class="textBio" style="font-weight: 400;"><?php echo $userinfo['Biographie']; ?></span>
                                </div>
                            </div>
                        </div>
                     </div>
            </section>
        </body>
    </html>