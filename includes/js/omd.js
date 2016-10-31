var canChange = true;
// variable globale: tableau d'Objet'
var objets = new Array();
var objetActif = -1;

$(function () {
    initObjet("#workspace");
});


function Objet(ID, objectif, chiffre, brief, url, position) {

    this.ID = ID;
    this.objectif = objectif;
    this.chiffre = chiffre;
    this.brief = brief;
    this.url = url;
    this.position = position;

    this.append = function (workspace, index) {

        this.index = index;

        // le "togglers" contient l'ensemble des toggler(s)'
        if( $(".togglers", $(workspace) ).length == 0 )
             // on le créé dans le workspace s'il n'existe pas déjà
             $(workspace).html("<div class='togglers'></div>" + $(workspace).html() );

        // ce contener ne doit pas prendre de place
        $(".togglers", $(workspace) ).css({
            height:0,
            width:0
        });

        // on insère le toggler dans le togglers...
        $(".togglers", $(workspace) ).append("<div id='objet_"+ID+"' class='toggleObjet'><img class='objet' src='./media/img/toggle-" + this.ID + ".png' /></div>");

        // on place le toggler sur le worspace
        if(this.position_image != "") {
            var x=this.position.split("x")[0]+"px";
            var y=this.position.split("x")[1]+"px";

            $("#objet_"+ID).css({
                position:"absolute",
                left:x,
                top:y
            });
        }


    }
}
function initObjet(workspace) {
    
    $.ajax({
            url: "./xhr/getGooSpreadsheet.php",
            success: function(json) {
                // évalue la chaine reçu comme un objet JSON
                json = eval('('+ json +')');

                // pour chaque item du tableau, le convertie en objet
                for(var i in json.data)
                    objets.push( new Objet( json.data[i].ID,
                                              json.data[i].objectif,
                                              json.data[i].chiffre,
                                              json.data[i].brief,
                                              json.data[i].url,
                                              json.data[i].position ) );


                // on place et dessinne les objets sur le workspace
                for(var j in objets)
                    objets[j].append(workspace, j);

                    // on affice la pop up au mouseover
                    $(".toggleObjet").mouseover(function () {

                        canChange = false;
                        objetActif = $(this).index();
                        var that = this;
                        
                        setTimeout(function () {

                            if( objetActif == $(that).index() ) {

                                showObjet(that);

                            }

                        }, 300);

                    }).mouseout(function () {

                        canChange = true;
                        
                        setTimeout(function () {
                            if(canChange)
                                hideObjet();
                        }, 300);

                    });


                    $(".popup").mouseover(function () {
                        canChange = false;
                    }).mouseout(function () {

                        canChange = true;
                        setTimeout(function () {
                            if(canChange)
                                hideObjet();
                        }, 300);

                    });



                if(RR_UTILS.isApple() ) {

                    $("#workspace").mouseover(function () {
                        hideObjet();
                    });
                }
                

            }
    });
}


function showObjet(obj) {


    objetActif = $(obj).attr("id").replace("objet_", "") - 1;

    // rempli les champs
    $(".popup h2").html(objets[objetActif].objectif);
    $(".popup .chiffre").html(objets[objetActif].chiffre);
    $(".popup .brief p").html(objets[objetActif].brief);
    if(objets[objetActif].url != "") {
        $(".popup .url a").attr("href", objets[objetActif].url);
        $(".popup .url a").show();
    } else {
        $(".popup .url a").hide();
    }

    $('.popup:visible').css({opacity:1,
                             display:"block"})
        
    // affiche la popup
    $('.popup').center();
    if(! RR_UTILS.isApple() )
        $(".popup").stop().fadeIn(700);
    else
        $(".popup").show(0);
    
    $('.toggleObjet').hide();
    $(obj).stop().css({display:"block",opacity:1});
}

function hideObjet() {
    $(".popup").css({display:"none"});
    $('.toggleObjet').css({display:"block"});
}

