var cx = document.getElementById('cx');
var cy = document.getElementById('cy');
var btn = document.getElementById('btn');

var idillus = document.getElementById('idillus');
var id = idillus.getAttribute('data-id');

// Récupérer l'élément canvas et l'image
var canvas = document.getElementById('monCanvas');
var ctx = canvas.getContext('2d');



// Ajouter un gestionnaire d'événement pour le clic de la souris
canvas.addEventListener('click', function(event) {
  // Récupérer les coordonnées du clic de la souris par rapport à l'élément canvas
  var rect = canvas.getBoundingClientRect();
  var x = event.clientX - rect.left;
  var y = event.clientY - rect.top;

  cx.value = x;
  cy.value = y;

});
