// Récupérer l'élément canvas et l'image
var canvas = document.getElementById('monCanvas');
var ctx = canvas.getContext('2d');
var image = new Image();


var idillus = document.getElementById('idillus');
var id = idillus.getAttribute('data-id');


var xhr = new XMLHttpRequest();
xhr.open('GET', '/illustration/data/'+id, true);
xhr.responseType = 'json';
xhr.onload = function() {
    if (xhr.status === 200) {
        var response = xhr.response;
    // Spécifier la source de l'image, le chemin
    image.src = "/uploads/" + response.imgsrc;
    var composants = response.composants;
    // Affichage des composants de l'illustration
    afficheComposants(composants);
    }else{
        console.log('error: ' + xhr.status + ','+ xhr.statusText);
    }
};
xhr.send();

// fonction d'affichage des composants de l'illustration
function afficheComposants(composants) {

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
    composants.forEach(function(composant) {
      if(composant.adressex-50 > 10){
        if (composant.adressey-50 > 10) {
          xtext = composant.adressex-50;
          ytext = composant.adressey-50;
        } else {
          xtext = composant.adressex-50;
          ytext = composant.adressey+50;
        }
      }else{
        if (composant.adressey-50 > 10) {
          xtext = composant.adressex+50;
          ytext = composant.adressey-50;
        } else {
          xtext = composant.adressex+50;
          ytext = composant.adressey+50;
        }
      }
      ctx.fillText(composant.label, xtext, ytext);
      Vecteur(xtext,ytext,composant.adressex,composant.adressey);
    });
    // ctx.fill();
  };
}

  // Dessiner une flèche
  function Norm(xA,yA,xB,yB) {
    return Math.sqrt(Math.pow(xB-xA,2)+Math.pow(yB-yA,2));
  } 
  function Vecteur (xA,yA,xB,yB,ArrowLength,ArrowWidth) { 
    if (ArrowLength === undefined) {ArrowLength=10;} 
    if (ArrowWidth === undefined) {ArrowWidth=8;} 
    ctx.lineCap="round"; 
    // Calculs des coordonnées des points C, D et E 
    AB=Norm(xA,yA,xB,yB); 
    xC=xB+ArrowLength*(xA-xB)/AB;yC=yB+ArrowLength*(yA-yB)/AB; 
    xD=xC+ArrowWidth*(-(yB-yA))/AB;yD=yC+ArrowWidth*((xB-xA))/AB; 
    xE=xC-ArrowWidth*(-(yB-yA))/AB;yE=yC-ArrowWidth*((xB-xA))/AB; 
    // et on trace le segment [AB], et sa flèche: 
    ctx.beginPath(); 
    ctx.moveTo(xA,yA);ctx.lineTo(xB,yB); 
    ctx.moveTo(xD,yD);ctx.lineTo(xB,yB);ctx.lineTo(xE,yE); 
    ctx.stroke(); 
  } 

  