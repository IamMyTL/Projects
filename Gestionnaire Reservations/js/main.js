//Ce script permet d'afficher le tableau que l'on sélectionne dans la page admin.

var value = 1;
document.getElementById(value).style.cssText = 'display:inline;';
function update(){
    document.getElementById(value).style.cssText = 'display:none;';
    var select = document.getElementById('activites');
    value = select.options[select.selectedIndex].value;
    
    document.getElementById(value).style.cssText = 'display:inline;';
}
