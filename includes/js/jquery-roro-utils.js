// espace de nommage UTILS
var RR_UTILS = {};

// Recherche dans un tableau arr, la valeur val
RR_UTILS.inArray  = function(arr, val) {
    for(var i = 0; arr[i] != val && i < arr.length; i++) {}
    return (i < arr.length);
};

// le navigateur est-il est un ipad ?
RR_UTILS.isIpad  = function() {
    return navigator.userAgent.match(/iPad/i);
};

// le navigateur est-il est un iphone ?
RR_UTILS.isIphone  = function() {
    return navigator.userAgent.match(/iPhone/i);
};

// le navigateur est-il est un ipad ou un iphone ?
RR_UTILS.isApple  = function() {
    return RR_UTILS.isIpad() || RR_UTILS.isIphone();
};


RR_UTILS.isIE = function() {
    return navigator.appName.indexOf("Internet Explorer") > -1;
};


// déclenche un copier
RR_UTILS.copier = function (inElement) {
    
    if (inElement.createTextRange) {
        var range = inElement.createTextRange();
        if (range && BodyLoaded==1)
            range.execCommand('Copy');
    } else {
        var flashcopier = 'flashcopier';
        if(!document.getElementById(flashcopier)) {
            var divholder = document.createElement('div');
            divholder.id = flashcopier;
            document.body.appendChild(divholder);
        }
        
        document.getElementById(flashcopier).innerHTML = '';
        var divinfo = '<embed src="./includes/swf/_clipboard.swf" FlashVars="clipboard='+encodeURIComponent(inElement.value)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
        document.getElementById(flashcopier).innerHTML = divinfo;
    }
    
};

// Place un élément au centre de l'écran (positionement absolu)
// l'élément à center ne dois pas être contenu dans un block positioné en RELATIVE !
(function($){
    $.fn.extend({
        center: function() {

            var obj = $(this);

            // Pour fonctionner pleinnement, cette fonction doit être appellée au chargement et au redimmensionement de la page
            $(window).resize(function () { $(obj).center(); });

            // -----------
            // Centre l'élement (ou les éléments)
            // au milieu de la page
            // ----------------------------------
            $(obj).each(function () {

                var x = ( $(window).width()  > $(this).outerWidth()  )  ? $(window).width()  / 2 - $(this).outerWidth()  / 2 : 0;
                var y = ( $(window).height() > $(this).outerHeight() )  ? $(window).height() / 2 - $(this).outerHeight() / 2 : 0;

                
                // recherche dans les éléments parents positionnés en absolute
                var par = $(this).parent();
                
                while( par.attr("nodeName") != "BODY") {
                    
                    // l'élément est modifié
                    if( par.css("position") == "absolute" ) {
                        x -= par.css("left" ).replace("px", "").replace(",", ".") * 1;
                        y -= par.css("top").replace("px", "").replace(",", ".") * 1;
                    }
                    
                    par = par.parent();
                }
                
                $(this).css({
                    position:"absolute",
                    left:x+"px",
                    top: y+"px",
                    margin:0
                });

            });

            return this;
        }
    });
})(jQuery);