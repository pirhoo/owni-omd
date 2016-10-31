<?php

    /** init.share.php
    * @author Pierre Romera - pierre.romera@gmail.com
    * @version 1.0
    * @desc Charge les boutons de partage de l'application.
    */

    // Nous plaçons cette condition au début de chaque includes
    // elle garanti l'inclusion depuis les fichiers autorisés
    // (fichiers qui définissent la constante avec la bonne valeur)
    if(SAFE_PLACE != "FD622N18U8h7y4Xs76cO80QX5AfOWkvg") die();
    
    define("DOC_URL"   , "http://www.rfi.fr/general/20100917-decouvrez-8-objectifs-millenaire-developpement");
    define("DOC_TITLE" , "[data] Les objectifs du millénaires sur RFI ");
    define("DOC_TWUSER", "RFI_Francais");
    
?>

<script type="text/javascript">
    
    // Affiche le code d'embed pour les apps
    function doEmbed() {
        if(RR_UTILS.isApple()) {

            $(".copier").hide();
            
            $("#mask").show();
            $(".inputEmbed").show();

            // cache l'embed au click sur le masque
            $("#mask").click(function () {
                $(".inputEmbed").hide();
            });

        } else {
            
            $("#mask").fadeIn(500);
            $(".inputEmbed").fadeIn(500);

            // cache l'embed au click sur le masque
            $("#mask").click(function () {
                $(".inputEmbed").fadeOut(500);
            });
        }
    }

    
 </script>


<!-- Logo du client -->
<a href="<?php echo DOC_URL; ?>" class="powered"><img src="<?php echo THEME_DIR."img/rfi-logo.png"; ?>" alt="Powered by RFI.fr" /></a>

<div class="like">
    <fb:like href="http://www.facebook.com/pages/rfi/67334499441" layout="button_count" show_faces="false" width="100" action="recommend" font="verdana"></fb:like>
</div>

<div class="sharing">

    <a class="share mini-share-mail bg-white"
       target="_blank"
       title="<?php __(4); ?>"
       href='http://www.addtoany.com/email?linkurl=<?php echo  rawurlencode(DOC_URL);  ?>&linkname=<?php echo   rawurlencode(DOC_TITLE);  ?>&t=<?php echo rawurldecode(DOC_TITLE); ?>'>
        <img alt="share mail" src="<?php echo THEME_DIR."img/mini-email.png"; ?>" /> email
    </a>

    <a class="share mini-embed bg-white "
       href="#"
       title="<?php __(5); ?>"
       onclick="doEmbed()">
        &lt;integrer&gt;
    </a>
    
    <span class="share twitter"
          title="<?php __(2); ?>">
        <a href="http://twitter.com/share" 
           class="twitter-share-button"
           data-url="<?php echo DOC_URL; ?>"
           data-text="<?php echo DOC_TITLE; ?>"
           data-count="horizontal" 
           data-via="<?php echo DOC_TWUSER; ?>">Tweet</a>
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    </span>
    
    <a class="share facebook" 
       title="<?php __(3); ?>"
       name="fb_share"
       type="button-count"
       share_url="<?php echo DOC_URL;  ?>"
       href="http://www.facebook.com/sharer.php">Partager</a>
    <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>


    <div class="center inputEmbed">
        <label>
            Copiez ce code pour intégrer l'application sur votre site:<br />
            <input value='<a href="<?php echo APP_URL; ?>" target="_blank"><img src="<?php echo APP_URL; ?>/includes/style/img/apercu_<?php echo LANG; ?>.jpg" alt="OMD" /></a>' class="codeEmbed text" id="codeEmbed" />
        </label>
        <input onclick="RR_UTILS.copier( document.getElementById('codeEmbed') )"
               type="button"
               value="Copier"
               class="addTitle copier"
               title="<?php __(6); ?>" />
    </div>

</div>