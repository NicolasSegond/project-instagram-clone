<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
    <script src="https://kit.fontawesome.com/fda357da01.js" crossorigin="anonymous"></script>
</head>

<body>
<section class="section_principale2">
    <div class="form">
        <div class="formulaireContact2">
            <img src="logo.png" alt="logoInsta" class="Logo">
            <div class="ssTitre">Inscrivez-vous pour voir les photos et vidéos de vos amis.</div>
            <button class="btnFacebook"><span class="FacebookText center"> <i class="fa-brands fa-facebook-f" style="margin: auto 10px;"></i> Se connecter avec Facebook</span></button>
            <div class="display">
                <div class="ligne"></div>
                <h6 class="text">OU</h6>
                <div class="ligne"></div>
            </div>
            <form action="index.php?uc=inscription&action=valideInscription" method="post">
                <input class="input" type="text" name="hismail" placeholder="Numéro de mobile ou e-mail" required/>
                <input class="input" type="text" name="nom" placeholder="Nom Complet" required/>
                <input class="input" type="text" name="nomUtilisateur" placeholder="Nom d'utilisateur" required/>
                <input class="input" type="password" name="motdepasse" placeholder="Mot de passe" required/>
                <div style="color: rgba(237,73,86,1); text-align: center; margin: 10px 40px;"><?php if(isset($msg)) echo $msg ?></div>
                <button class="btnConnexion" name="submit"><span class="btnText">Suivant</span></button>
                <p class="paragraphe">En vous inscrivant, vous acceptez nos Conditions générales. Découvrez comment nous recueillons, utilisons et partageons vos données en lisant notre Politique d’utilisation des données et comment nous utilisons les cookies et autres technologies similaires en consultant notre Politique d’utilisation des cookies.</p>
            </form>
        </div>
        <div class="creationComptes">
            <div class="center">
                <span >Vous avez un compte ?</span>
                <a href="index.php?uc=connexion&action=demandeConnexion" class="lien" style="margin-left: 10px;">Connectez-vous</a>
            </div>
        </div>
        <div class="telechargement">
            <span class="center">Téléchargez l'application</span>
            <div class="center">
                <a><img class="img" src="assets/appstore.png" alt="appStore"></a>
                <a><img class="img" src="assets/googleplay.png" alt="googlePlay"></a>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="footer">
        <a>Meta</a>
        <a>A propos</a>
        <a>Blog</a>
        <a>Emplois</a>
        <a>Aide</a>
        <a>API</a>
        <a>Confidentialité</a>
        <a>Conditions</a>
        <a>Comptes principaux</a>
        <a>Hashtags</a>
        <a>Lieux</a>
        <a>Instagram Lite</a>
    </div>
    <div class="footer">
        <select aria-label="Changer la langue d’affichage" class="selectBox">
            <option value="af">Afrikaans</option>
            <option value="cs">Čeština</option>
            <option value="da">Dansk</option>
            <option value="de">Deutsch</option>
            <option value="el">Ελληνικά</option>
            <option value="en">English</option>
            <option value="en-gb">English (UK)</option>
            <option value="es">Español (España)</option>
            <option value="es-la">Español</option>
            <option value="fi">Suomi</option>
            <option value="fr">Français</option>
            <option value="id">Bahasa Indonesia</option>
            <option value="it">Italiano</option>
            <option value="ja">日本語</option>
            <option value="ko">한국어</option>
            <option value="ms">Bahasa Melayu</option>
            <option value="nb">Norsk</option>
            <option value="nl">Nederlands</option>
            <option value="pl">Polski</option>
            <option value="pt-br">Português (Brasil)</option>
            <option value="pt">Português (Portugal)</option>
            <option value="ru">Русский</option>
            <option value="sv">Svenska</option>
            <option value="th">ภาษาไทย</option>
            <option value="tl">Filipino</option>
            <option value="tr">Türkçe</option>
            <option value="zh-cn">中文(简体)</option>
            <option value="zh-tw">中文(台灣)</option>
            <option value="bn">বাংলা</option>
            <option value="gu">ગુજરાતી</option>
            <option value="hi">हिन्दी</option>
            <option value="hr">Hrvatski</option>
            <option value="hu">Magyar</option>
            <option value="kn">ಕನ್ನಡ</option>
            <option value="ml">മലയാളം</option>
            <option value="mr">मराठी</option>
            <option value="ne">नेपाली</option>
            <option value="pa">ਪੰਜਾਬੀ</option>
            <option value="si">සිංහල</option>
            <option value="sk">Slovenčina</option>
            <option value="ta">தமிழ்</option>
            <option value="te">తెలుగు</option>
            <option value="vi">Tiếng Việt</option>
            <option value="zh-hk">中文(香港)</option>
            <option value="bg">Български</option>
            <option value="fr-ca">Français (Canada)</option>
            <option value="ro">Română</option>
            <option value="sr">Српски</option>
            <option value="uk">Українська</option>
        </select>
        <a>© 2022 Instagram par Meta</a>
    </div>
</footer>
</body>
</html>



