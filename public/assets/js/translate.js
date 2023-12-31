var langtrans = document.getElementById('langtranslate');
var btntrad = document.getElementById('btntrad');
var idillus = document.getElementById('idillus');
var id = idillus.getAttribute('data-id');
var lang = langtrans.value;
console.log(lang);
langtrans.addEventListener('change', function() {
    lang = langtrans.value;
});

var notif = document.getElementById('notiftrans');

var canvas = document.getElementById('monCanvas');
var ctx = canvas.getContext('2d');

btntrad.addEventListener('click', function(){
    var xhr = new XMLHttpRequest();
xhr.open('GET', '/illustration/'+id+'/'+lang, true);
xhr.responseType = 'json';
xhr.onload = function() {
    if (xhr.status === 200) {
        var reponse = xhr.response;
        if (reponse.length > 0 && reponse !== null) {
            // Affichage des composants traduits de l'illustration
            notif.innerHTML = "Les composants traduits de l'illustration ont été mis à jour";
            affiche(reponse);
            afficheTransComposants(reponse);
        }else{
            notif.innerHTML = "Il n'y a pas de composants traduits en cette langue";
        }
        
    }else{
        console.log('error: ' + xhr.status + ','+ xhr.statusText);
    }
};
xhr.send();
});

function affiche(res) {
    for (let index = 0; index < res.length; index++) {
        var idc = res[index].composant.id;
        var label = document.getElementById(idc);
        label.innerHTML = res[index].labeltrad;
        var desc = document.getElementById("desc"+idc);
        desc.innerHTML = res[index].descriptiontrad;
    }
}

function afficheTransComposants(res) {

    var image = new Image();
    image.src = "/uploads/"+ res[0].illustration.imgsrc;
    // Charger l'image
    image.onload = function() {
        // Effacer le canvas
      ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Dessiner l'image pour qu'elle occupe tout le canvas
      ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
    // Ajouter du texte
    ctx.font = 'bold 12px Arial';
    ctx.fillStyle = 'blue';
    ctx.strokeStyle="red"; 
    var xtext;
    var ytext;
    for (let index = 0; index < res.length; index++) {
      if(res[index].composant.adressex-50 > 10){
        if (res[index].composant.adressey-50 > 10) {
          xtext = res[index].composant.adressex-50;
          ytext = res[index].composant.adressey-50;
        } else {
          xtext = res[index].composant.adressex-50;
          ytext = res[index].composant.adressey+50;
        }
      }else{
        if (res[index].composant.adressey-50 > 10) {
          xtext = res[index].composant.adressex+50;
          ytext = res[index].composant.adressey-50;
        } else {
          xtext = res[index].composant.adressex+50;
          ytext = res[index].composant.adressey+50;
        }
      }
      ctx.fillText(res[index].labeltrad, xtext, ytext);
      Vecteur(xtext,ytext,res[index].composant.adressex,res[index].composant.adressey);
    };
    // ctx.fill();
  };
}