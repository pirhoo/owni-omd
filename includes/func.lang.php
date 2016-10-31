<?php

        /** func.lang.php
        * @author Pierre Romera - pierre.romera@gmail.com
        * @version 1.0
        * @desc Outils pour le multi-languisme de l'application
        */

        // Nous plaçons cette condition au début de chaque includes
        // elle garanti l'inclusion depuis les fichiers autorisés
        // (fichiers qui définissent la constante avec la bonne valeur)
        if(SAFE_PLACE != "FD622N18U8h7y4Xs76cO80QX5AfOWkvg") die();



	/** Function __
	* @desc Consulte le fichier langue (s'il n'est pas déjà chargé et retourne la ligne demandée
	* @param: $index : Numéro de la ligne du fichier à afficher (commence à 0)
        * @param: $display : Boolean indique si la valeur de la ligne doit-être affiché
	* @return ligne du fichier à afficher
	*/
        function __($index, $display = true) {

            // variable static pour ne pas charger le fichier 2 fois
            static $file;

            // on a pas encore chargé le fichier
            if( empty($file) ) {

                $file = Array();
                // ouvertue du fichier
                $lines = file(LANG_DIR.LANG.'.lang');

                // lecture du fichier ligne par ligne
                foreach ($lines as $lineNumber => $lineContent)
                        $file[] = $lineContent;
            }

            if($display) echo $file[$index];

            return $file[$index];

        }


	/** Function defineLang
	* @desc Définie la langue à utiliser par l'application (et donc le fichier à utiliser)
	* @param: $lang : (facultatif) La langue de l'application
	* @return null
	*/
        function defineLang($lang = null) {

            // langue disponible
            $lang_dispo = Array("FR_fr");


            if($lang == null) {

                if(isset($_SESSION['lang']) && @in_array($lang_dispo, $_SESSION['lang']))
                    define("LANG", $_SESSION['lang']);
                else
                    define("LANG", "FR_fr");

            } else {

                if( ! @in_array($lang_dispo, $lang) )
                    $lang = "FR_fr";

                define("LANG", $lang);
                $_SESSION['lang'] = $lang;

            }
        
    
        
    }
?>
