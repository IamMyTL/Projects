$(document).ready(function(){

    var update = false;

    let ownerId = $("#ownerId").attr("data-value");
    function getDashboard(id){
        $.get("../owner/one?id="+id).done(function(result){
            console.log('success');
            $(".owner").html(result);
            $('.object').replaceWith(function () {  // On enlève les balise <a> car le propriétaire ne peut pas change de page
                return $('<span/>', {
                    html: $(this).html()
                });
            });
            $('.updateOwner').remove(); // Supprimer le bouton modifier propriétaire
            $('.delete-owner').remove(); // Supprimer le bouton delete-owner pour qu'il ne puisse pas se supprimer tout seul
        }).fail(function(err){
            console.warn('error', err);
        });
    }
    getDashboard(ownerId);

    $("body").on("click", "a.delete", function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        $.post(href).done(function(){
            console.log('success');
            getDashboard(ownerId);
        }).fail(function(err){
            console.warn('error', err);
        });
    })

    var toggle = false;
    $("body").on("click", "a.add", function(e){
        e.preventDefault();
        if (!toggle){
            let hrefCreate = $(this).attr('href');
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
                getDashboard(ownerId);
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
        // $(".owner-id").text()
        values["animal"] = idAnimalVisit // Récupérer l'id de l'animal
        // if (update == true){
        //     values["id"] = $("#animal-id").val();
        // }
        $.post("../visit/addNewVisit", values).done(function(result){
            console.log('success Post New Visit');
            console.log(result);
            if (result == "true"){
                // refresh la page
                getDashboard(ownerId);
            }else{
                $(".check-visit").html("<h2 class='check-false' style='color:red; display:none;'> Erreur, vérifiez bien les champs que vous avez entré.</h2>");
                $(".check-visit").html("");
            }
        }).fail(function(err){
            console.warn('error', err);
        });
    })
});