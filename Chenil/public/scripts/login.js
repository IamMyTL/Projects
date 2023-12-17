$(document).ready(function(){
    $.get("../owner/register").done(function(result){
        console.log('success');
        $(".register").html(result);
    }).fail(function(err){
        console.warn('error', err);
    });
});