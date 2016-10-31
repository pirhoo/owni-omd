<?php
    /** HP APP
    * @author Pierre Romera - pierre.romera@gmail.com
    * @version 1.0
    * @desc La page d'accueil de l'application
    */

    // Cette constante est une sécurité pour les includes
    define("SAFE_PLACE", "FD622N18U8h7y4Xs76cO80QX5AfOWkvg");
    
    // Cette constante est essentielle au bon fonctionement de l'app,
    // elle indique le dossier rassemblant toutes les librairies php, js et le thème css
    // (tout ce qui est inclue d'une façon ou d'une autre)
    define("INC_DIR", "./includes/");

    // le coeur de l'application, c-a-d toute ce qu'il faut charger
    // ou définir avant de commencer à travailler...
    require_once(INC_DIR."init.core.php");

?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="fr" lang="fr">
    <head>
            <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=990" />


            <title><?php __(0); ?> - <?php __(1); ?></title>

            <!-- LE THÈME DE BASE -->
            <link type="text/css" rel="stylesheet" href="<?php echo THEME_DIR; ?>style.css" media="screen" />

            <!-- Pour utiliser JQUERY et JQUERY UI-->
            <script type="text/javascript" src="<?php echo JS_DIR; ?>jquery-1.4.2.min.js"></script>
            <script type="text/javascript" src="<?php echo JS_DIR; ?>jquery-ui-1.8.4.custom.min.js"></script>
            
            <!-- Pour générer des infobulles personnalisées -->
            <script type="text/javascript" src="<?php echo JS_DIR; ?>jquery-roro-hidden-title.js"></script>
            <!-- Des fonctions utiles homemade -->
            <script type="text/javascript" src="<?php echo JS_DIR; ?>jquery-roro-utils.js"></script>

            <!-- Le script global relatif à cette app -->
            <script type="text/javascript" src="<?php echo JS_DIR; ?>omd.js"></script>


            <script type="text/javascript">
                $(document).ready(function () {
                    // centre les éléments avec la classe .center millieu de l'écran (ici l'app)
                    $(".center").center();

                    // déclenche les infobulles personnalisées sur les éléments .share et leur ajoute la classe "shareTitle"
                    if(! RR_UTILS.isApple() ) {
                        $(".share").addTitle("shareTitle");
                        $(".copier").addTitle("copierTitle");
                    }
                    
                    // cache le mask si on lui clique dessus
                    // sauf si il contient la classe "hold"
                    $("#mask").click(function () {
                        if( ! $(this).hasClass("hold") ) {
                            if(RR_UTILS.isApple()) 
                                $(this).hide();
                            else
                                $(this).stop().fadeOut(300);
                        }
                    });
                    
                });
            </script>
    </head>
    <body onload="window.scrollTo(0, 1)">

        <?php
            // Hoot essentiel au bon fonctionement de l'API Facebook
            // (ici, plusieurs outils sont réuni dans une classe FBconnect)
            $FB->doFBhoot();
        ?>

        <!-- L'APP en elle même, de 990x667 -->
        <h1 style="display:none"><?php __(0); ?> - <?php __(1); ?></h1>
        <div id="app" class="center">

            <!-- Une surcouche sur la div APP avec un overflow hidden de 990x667 -->
            <div id="overflow">

                <!-- Là où l'application se déroule -->
                <div id="workspace"></div>

                <!-- Un masque sombre qui recouvre l'application (pour des popups) -->
                <div id="mask"></div>

                <!-- La popup a afficher lors d'un click sur un objet -->
                <div class="popup">
                    <h2></h2>
                    <div class="chiffre"></div>
                    <div class="brief"><p></p></div>
                    <div class="url"><a href="" target="_blank">&rsaquo;&nbsp;en savoir plus</a></div>
                </div>

                <!-- Ligne qui contient un déclencheur pour afficher la barre de partage -->
                <div class="showFooter"><img src="<?php echo THEME_DIR."img/heart-footer.png"; ?>" alt="" class="trigger" /></div>

                <!-- Barre de partage (cachée) -->
                <div id="footer">

                    <!-- Les outils pour partager l'APP (Facebook, Twitter, etc) -->
                    <?php include(INC_DIR."inc.share.php"); ?>

                </div>
                
            </div>
        </div>
    </body>
</html>