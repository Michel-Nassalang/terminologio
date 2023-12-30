var cx = document.getElementById('cx');
var cy = document.getElementById('cy');
var btn = document.getElementById('btn');

var idillus = document.getElementById('idillus');
var id = idillus.getAttribute('data-id');

// Récupérer l'élément canvas et l'image
var canvas = document.getElementById('monCanvas');
var ctx = canvas.getContext('2d');



// function addComposant() {
//     var form = document.getElementById('cform');
//     var formData = new FormData(form);
    
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', '/illustration/'+ id +'/composant', true); 
//     xhr.onload = function() {
//         if (xhr.status >= 200 && xhr.status < 300) {
//             console.log('Réponse du serveur :', xhr.responseText);
//         } else {
//             console.error('Erreur de la requête. Statut :', xhr.status, xhr.statusText);
//         }
//     };
//     xhr.onerror = function() {
//         console.error('Erreur réseau lors de la requête.');
//     };
//     xhr.send(formData);
// }


// Ajouter un gestionnaire d'événement pour le clic de la souris
canvas.addEventListener('click', function(event) {
  // Récupérer les coordonnées du clic de la souris par rapport à l'élément canvas
  var rect = canvas.getBoundingClientRect();
  var x = event.clientX - rect.left;
  var y = event.clientY - rect.top;

  cx.value = x;
  cy.value = y;

});