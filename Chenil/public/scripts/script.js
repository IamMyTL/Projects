$(document).ready(function(){

    var href;
    var update = false;
    let hrefCreate;
    $.get("../owner").done(function(result){
        console.log('success');
        $(".content").html(result);
    }).fail(function(err){
        console.warn('error', err);
    });

    function refreshOwner(){
        let hrefOwner = "../owner/one?id="+$(".owner-id").text();
        $.get(hrefOwner).done(function(result){
            console.log('success');
            $(".content").html(result);
        }).fail(function(err){
            console.warn('error', err);
        });
    }

    $("#lists-select").change(function(){
        $.get("../"+$(this).val()).done(function(result){
            console.log('success');
            $(".content").html(result);
        }).fail(function(err){
            console.warn('error', err);
        });
    })

    $("body").on("click", "a.object", function(e){
        e.preventDefault();
        if ($(this).attr('id') == "accueil"){
            // Si on revient à la page "accueil" des listes, affiche la liste déroulante
            $("#accueil").css("display", "none");
            $("#lists-select").css("display", "inline");
            $("#lists-select").val("owner");
        }
        else{
            $("#lists-select").css("display", "none");
            $("#accueil").css("display", "inline");
        }
        href = $(this).attr('href');
        $.get(href).done(function(result){
            console.log('success');
            $(".content").html(result);
        }).fail(function(err){
            console.warn('error', err);
        });
    })

    $("body").on("click", "a.delete", function(e){
        e.preventDefault();
        let hrefDel = $(this).attr('href');
        $.post(hrefDel).done(function(){
            console.log('successPost');
            $.get(href).done(function(result){
                console.log('success');
                $(".content").html(result);
            }).fail(function(err){
                console.warn('error', err);
            });
        }).fail(function(err){
            console.warn('error', err);
        });
    })

    var toggle = false;
    $("body").on("click", "a.add", function(e){
        e.preventDefault();
        if (!toggle){
            hrefCreate = $(this).attr('href');
            $.get(hrefCreate).done(function(result){
                console.log('success');
                $(".add").text("➖");
                $(".create-animal").html(result);
                toggle = true;
            }).fail(function(err){
                console.warn('error', err);
            });
        }
        else{
            $(".create-animal").html("");
            $(".add").text("➕Ajouter un animal")
            toggle = false;
        }
    }) 

    $("body").on("submit", "#create-animal-form", function(e){
        // Récupérer les values sans changer de page
        e.preventDefault();
        var $inputs = $('#create-animal-form :input');
        var values = {};
        $.each($('#create-animal-form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        values["owner"] = $(".owner-id").text();
        if (update == true){
            values["id"] = $("#animal-id").val();
        }
        $.post("../animal/addNewAnimal", values).done(function(result){
            console.log('successPost');
            if (result == "true"){
                // refresh la page
                refreshOwner();
            }else{
                $(".check-false").css("display", "inline");
                $(".check-true").css("display", "none");
            }
        }).fail(function(err){
            console.warn('error', err);
        });
    })

    $("body").on("click", "a.edit", function(e){
        e.preventDefault();
        update = true;
        $.get($(this).attr('href')).done(function(result){
            console.log('success');
            $(".create-animal").html(result);
        }).fail(function(err){
            console.warn('error', err);
        });
    })

    var animalId;
    $("body").on("click", "a.add-visit", function(e){
        e.preventDefault();
        if ($(this).hasClass("closed")){
            hrefCreate = $(this).attr('href');
            animalId = $(this).attr("class").split(" ")[1]; // Prendre la deuxième class qui est l'id de l'animal
            $.get(hrefCreate).done(function(result){
                console.log('successAddVisit');
                $(".create-visit"+animalId).html(result);
                $(".add-visit"+animalId).removeClass("closed");
                $(".create-visit"+animalId).children().addClass(animalId);
                $(".create-visit"+animalId).find(".check-visit").addClass(animalId);
            }).fail(function(err){
                console.warn('error', err);
            });}
        else{
            $(".add-visit"+animalId).addClass("closed");
            $(".create-visit"+animalId).html("");
        }
    }) 

    $("body").on("submit", "#create-visit-form", function(e){
        e.preventDefault();
        var idAnimalVisit = $(this).parent().attr("class").split(" ")[1];
        var $inputs = $('#create-visit-form :input');
        var values = {};
        $.each($('.'+idAnimalVisit).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        values["animal"] = idAnimalVisit // Récupérer l'id de l'animal
        $.post("../visit/addNewVisit", values).done(function(result){
            console.log('success Post New Visit');
            console.log(result);
            if (result == "true"){
                // refresh la page
                refreshOwner();
            }else{
                // $(".check-visit "+idAnimalVisit).html("<h2 class='check-false' style='color:red; display:none;'> Erreur, vérifiez bien les champs que vous avez entré.</h2>");
                $(".check-visit "+idAnimalVisit).find(".check-false").css("display", "inline");
                $(".check-visit "+idAnimalVisit).find(".check-true").css("display", "none"); // J'ai pas eu le temps d'implémenter les messages d'erreur en front pour les séjour
            }
        }).fail(function(err){
            console.warn('error', err);
        });
    })
});