<?php
    session_start();
    include 'database.php';

    if(isset($_GET['id']) AND $_GET['id'] > 0) {
        $getid = intval($_GET['id']);
        $requser = $pdo->prepare('SELECT * FROM `users` WHERE id = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();
    }

    if(isset($_POST["partagerPublication"]) AND !empty($_FILES['imagePublication']['name']) AND !empty($_POST['descriptionPublication'])){
        $description = htmlspecialchars($_POST['descriptionPublication']);
        $lieu = htmlspecialchars($_POST['lieuPublication']);
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        $nombreAleatoire = rand(0,9999999999999);

        if($_FILES['imagePublication']['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($_FILES['imagePublication']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides)) {
                $chemin = "posts/images/".$nombreAleatoire.".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['imagePublication']['tmp_name'], $chemin);
                if($resultat) {
                    $sql = "INSERT INTO `posts` (idUSER,description,lieu,date,image) VALUES (:idUSER,:description, :lieu,NOW(),:image)";
                    $query = $pdo->prepare($sql);
                    $query->execute(array(
                        "idUSER" => $_SESSION['id'],
                        "description" => $description,
                        "lieu" => $lieu,
                        "image" => $nombreAleatoire.".".$extensionUpload
                    ));
                    header('Location: profil.php?id='.$_SESSION['id']);
                } else{

                }
            } else{

            }
        } else{

        }
    }

    $articles = $pdo->query('SELECT * FROM posts ORDER BY date DESC');
    $utilisateur = $pdo->query('SELECT * FROM users');
    $utilisateur2 = $pdo->query('SELECT * FROM users');

?>

<!doctype html>
    <html lang="fr">

        <head>
            <meta charset="utf-8">
            <title>Titre de la page</title>
            <link rel="stylesheet" href="style3.css">

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
                        <?php echo'<a href="PageAccueil.php?id=' . $_SESSION['id'] . '">';?><i class="fa-solid fa-house icon"></i></a>
                        <a href="#"><i class="fa-solid fa-paper-plane icon"></i></a>
                        <button id="modal-btn" style="border: none; background: none;"><a><i class="fa-solid fa-plus icon"></i></a></button>
                        <div id="my-modal" class="modal">
                            <div class="modal-content-Publication">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="EnTeteModalPublication">
                                        <div class="TitreModalPublication">
                                            <h1 style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; position: absolute;">Créer une publication</h1>
                                        </div>
                                        <div class="arrow"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 24px; width: 24px;"><path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"/></svg></div>
                                        <div class="btnPartager">
                                            <input class="btnPartager2" type="submit" name="partagerPublication" value="Partager" style="border:0; background: none; color: rgb(0,149,246); font-size: 14px; font-weight: 600; z-index: 1">
                                        </div>
                                    </div>
                                    <div class="division2PartiesUpload">
                                        <div class="importImagePublication">
                                            <input type="file" name="imagePublication">
                                        </div>
                                        <div class="detailsPublication">
                                            <div id="nomProfilPublication">
                                                <img src="<?php echo "membres/avatars/".$userinfo['avatar']; ?>" style="margin-right: 12px; height: 28px; width: 28px; border-radius: 50%;" alt="Photo de profil">
                                                <span><?php echo $userinfo['nomUtilisateur']; ?> </span>
                                            </div>
                                            <div class="descriptionPublication">
                                                <textarea name="descriptionPublication" aria-label="Ajoutez une légende…" placeholder="Ajoutez une légende…" id="textAreaPublication" autocomplete="off" autocorrect="off" style="height: 24px !important;"></textarea>
                                            </div>
                                            <div class="divLieuPublication">
                                                <input type="text" name="lieuPublication" class="lieuPublication" placeholder="Ajouter un lieu" aria-label="Ajouter un lieu" autocomplete="off" autocorrect="off">
                                            </div>
                                            <?php echo $msg ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="#"><i class="fa-solid fa-compass icon"></i></a>
                        <a href="#"><i class="fa-solid fa-heart icon"></i></a>
                        <div style="height: 28px; width: 28px;" onclick="clique()">
                            <div class="boxPdp" style="height: 28px; width: 28px; border: 1px solid rgb(38,38,38,1); border-radius: 50%;"></div>
                            <img src="<?php echo "membres/avatars/".$userinfo['avatar']; ?>" style="position: absolute; top: 15px; height: 28px; width: 28px; border: 1px solid rgb(,38,38,1); border-radius: 50%;">
                        </div>
                    </div>
                </div>
                <div class="menuDeroulantPdp" id="menuDeroulantPdp">
                    <form action="PageAccueil.php" method="post">
                        <?php echo'<a href="profil.php?id=' . $_SESSION['id'] . '">';?><div class="profil" style="border-top-left-radius: 20px; border-top-right-radius: 20px;"><span class="text"><i class="fa-solid fa-user" style="margin-right: 10px;"></i> Profil</span></div></a>
                    </form>
                    <a href="#"><div class="profil"><span class="text"><i class="fa-solid fa-bookmark" style="margin-right: 10px;"></i> Enregistré</span></div></a>
                    <a href="#"><div class="profil"><span class="text"><i class="fa-solid fa-gear" style="margin-right: 10px;"></i></i> Paramètres</span></div></a>
                    <a href="#"><div class="profil"><span class="text"><i class="fa-solid fa-arrows-rotate" style="margin-right: 10px;"></i> Changer de compte</span></div></a>
                    <hr>
                    <a href="deconnexion.php"><div class="deconnexion" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"><span class="text"> Déconnexion </span></div></a>
                </div>
            </nav>
            <section class="partie_principale center">
                <div class="publication">
                    <div class="storie">
                            <?php while($user = $utilisateur->fetch()) { ?>
                            <div class="storie-item">
                                <img src="<?php echo "membres/avatars/".$user['avatar']; ?>" alt="image utilisateur">
                            </div>
                            <?php } ?>
                    </div>
                    <?php while($a = $articles->fetch()) {
                        $req = $pdo->prepare('SELECT * FROM `users` WHERE id = ?');
                        $req->execute(array($a["idUSER"]));
                        $infouser = $req->fetch();?>
                        <div class="publi">
                                <div class="headerPublication">
                                    <div class="infoUser">
                                        <img src="<?php echo "membres/avatars/".$infouser['avatar']; ?>" style="margin-right: 12px; height: 28px; width: 28px; border-radius: 50%;" alt="Photo de profil">
                                        <span style="display:flex; flex-direction: column;"><a style="font-size: 14px; font-weight: 600;" href="#"><?php echo $infouser['nomUtilisateur']; ?></a><a style="font-size: 12px; font-weight: normal;" href="#"><?php echo $a['lieu']; ?></a></span>
                                    </div>
                                    <button class="parametrePublication">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" viewBox="0 0 448 512"><path d="M120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200C94.93 200 120 225.1 120 256zM280 256C280 286.9 254.9 312 224 312C193.1 312 168 286.9 168 256C168 225.1 193.1 200 224 200C254.9 200 280 225.1 280 256zM328 256C328 225.1 353.1 200 384 200C414.9 200 440 225.1 440 256C440 286.9 414.9 312 384 312C353.1 312 328 286.9 328 256z"/></svg>
                                    </button>
                                </div>
                                <div class="imgPublication">
                                    <img src="<?php echo "posts/images/".$a['image']; ?>" alt="image de la publication">
                                </div>
                                <div class="divDetailsPublication">
                                    <div class="iconPublication">
                                        <span><button style="background: transparent; border: none; cursor: pointer; display:flex; justify-content: center; padding: 8px 8px 8px 0px;"><svg aria-label="J’aime" class="_ab6-" color="rgb(38,38,38)" fill="rgb(38,38,38)" height="24" role="img" viewBox="0 0 24 24" width="24"><path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z"></path></svg></button></span>
                                        <span><button style="background: transparent; border: none; cursor: pointer; display:flex; justify-content: center; padding: 8px;"><svg aria-label="Commenter" class="_ab6-" color="rgb(38,38,38)" fill="rgb(38,38,38)" height="24" role="img" viewBox="0 0 24 24" width="24"><path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path></svg></button></span>
                                        <span><button style="background: transparent; border: none; cursor: pointer; display:flex; justify-content: center; padding: 8px;"><svg aria-label="Partager la publication" class="_ab6-" color="rgb(38,38,38)" fill="rgb(38,38,38)" height="24" role="img" viewBox="0 0 24 24" width="24"><line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2" x1="22" x2="9.218" y1="3" y2="10.083"></line><polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon></svg></button></span>
                                        <span style="margin-left: auto; margin-right: -10px;"><button style="background: transparent; border: none; cursor: pointer; display:flex; justify-content: center; padding: 8px;"><svg aria-label="Enregistrer" class="_ab6-" color="rgb(38,38,38)" fill="rgb(38,38,38)" height="24" role="img" viewBox="0 0 24 24" width="24"><polygon fill="none" points="20 21 12 13.44 4 21 4 3 20 3 20 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon></svg></button></span>
                                    </div>
                                    <div class="divDescPublication"><span style="font-size: 14px; font-weight: 600;"><?php echo $infouser['nomUtilisateur']; ?></span><span>&nbsp;</span><span style="font-size: 14px; font-weight: normal;"><?php echo $a['description']; ?></span></div>
                                </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="test">
                    <div class="navbar">
                        <div class="basculerComptes">
                            <img src="<?php echo "membres/avatars/".$userinfo['avatar']; ?>" style="margin-right: 12px; height: 56px; width: 56px; border-radius: 50%;" alt="Photo de profil">
                            <div style="display:flex; flex-direction: column; justify-content: center; margin-left: 12px; width: 100%; height: 100%;">
                                <a style="font-size: 14px; font-weight: 600;"><?php echo $userinfo['nomUtilisateur']; ?></a>
                                <span style="font-size: 12px; font-weight: normal;"><?php echo $userinfo['nom']; ?></span>
                            </div>
                            <div style="display:flex; flex-direction: column; justify-content: center; font-weight: 700; font-size: 12px; color: rgb(0,149,246);">Basculer</div>
                        </div>
                        <div class="Suggestions">
                            <div class="BtnVoirTout">
                                <span style="color: rgb(142,142,142); font-weight: 700; font-size: 14px; flex: 1 1 auto;">Suggestions pour vous </span>
                                <span style="color: rgb(38,38,38); font-size: 12px; font-weight: 700; width: auto;"> Voir tout </span>
                            </div>
                            <div class="utilisateursSuggere">
                                <?php while($user2 = $utilisateur2->fetch()) { ?>
                                    <div class="autresUtilisateurs">
                                        <img src="<?php echo "membres/avatars/".$user2['avatar']; ?>" style="height: 42px; width: 42px; margin-right: 12px; border: 1px solid grey; border-radius: 50%;" alt="image utilisateur">
                                        <div style="width: 100%; height: 100%;">
                                            <a href="" style="color: rgb(38,38,38); font-size: 14px; font-weight: 700;"><?php echo $user2['nomUtilisateur']; ?></a>
                                        </div>
                                        <div style="display:flex; flex-direction: column; justify-content: center; font-weight: 700; font-size: 12px; color: rgb(0,149,246);">S'abonner</div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mentionsLegales">
                                <div class="listeMentions">
                                    <ul class="ulMentions">
                                        <li class="_ab8f" style="width: max-content"><a  href="https://about.instagram.com/" rel="nofollow noopener noreferrer" target="_blank"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">À propos</span></a></li>
                                        <li class="_ab8f" style="width: max-content"><a  href="https://help.instagram.com/"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">Aide</span></a></li>
                                        <li class="_ab8f" style="width: max-content"><a  href="https://about.instagram.com/blog/"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">Presse</span></a></li>
                                        <li class="_ab8f" style="width: max-content"><a  href="https://developers.facebook.com/docs/instagram" rel="nofollow noopener noreferrer" target="_blank"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">API</span></a></li>
                                        <li class="_ab8f" style="width: max-content"><a  href="/about/jobs/"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">Emplois</span></a></li><li class="_ab8f"><a class="_ab8g" href="/legal/privacy/"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">Confidentialité</span></a></li><li class="_ab8f"><a class="_ab8g _ab8h" href="/legal/terms/"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">Conditions</span></a></li>
                                        <li class="_ab8f" style="width: max-content"><a  href="/explore/locations/"><span class="_aacl _aacn _aacu _aad1 _aad7 _aade">Lieux</span></a></li>
                                        <li class="_ab8f" style="width: max-content"><select aria-label="Changer la langue d’affichage" class="_aajm"><option value="af">Afrikaans</option><option value="cs">Čeština</option><option value="da">Dansk</option><option value="de">Deutsch</option><option value="el">Ελληνικά</option><option value="en">English</option><option value="en-gb">English (UK)</option><option value="es">Español (España)</option><option value="es-la">Español</option><option value="fi">Suomi</option><option value="fr">Français</option><option value="id">Bahasa Indonesia</option><option value="it">Italiano</option><option value="ja">日本語</option><option value="ko">한국어</option><option value="ms">Bahasa Melayu</option><option value="nb">Norsk</option><option value="nl">Nederlands</option><option value="pl">Polski</option><option value="pt-br">Português (Brasil)</option><option value="pt">Português (Portugal)</option><option value="ru">Русский</option><option value="sv">Svenska</option><option value="th">ภาษาไทย</option><option value="tl">Filipino</option><option value="tr">Türkçe</option><option value="zh-cn">中文(简体)</option><option value="zh-tw">中文(台灣)</option><option value="bn">বাংলা</option><option value="gu">ગુજરાતી</option><option value="hi">हिन्दी</option><option value="hr">Hrvatski</option><option value="hu">Magyar</option><option value="kn">ಕನ್ನಡ</option><option value="ml">മലയാളം</option><option value="mr">मराठी</option><option value="ne">नेपाली</option><option value="pa">ਪੰਜਾਬੀ</option><option value="si">සිංහල</option><option value="sk">Slovenčina</option><option value="ta">தமிழ்</option><option value="te">తెలుగు</option><option value="vi">Tiếng Việt</option><option value="zh-hk">中文(香港)</option><option value="bg">Български</option><option value="fr-ca">Français (Canada)</option><option value="ro">Română</option><option value="sr">Српски</option><option value="uk">Українська</option></select></li></ul>
                                </div>
                                <div style="color: rgb(199,199,199); font-weight: 400; font-size: 12px; text-transform: none;">© 2022 INSTAGRAM PAR META</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script src="script.js"></script>
            <script src="https://kit.fontawesome.com/fda357da01.js" crossorigin="anonymous"></script>
        </body>
    </html>
