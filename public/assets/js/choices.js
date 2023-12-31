
var clang = document.getElementById('clang');
var hlang = document.getElementsByClassName('hlang');
var lang = document.getElementById('lang');
var blang = document.getElementById('blang');

var langue = lang.value;
for (let index = 0; index < hlang.length; index++) {
    hlang[index].style.display = "none";
}
blang.style.display = "none";

lang.addEventListener('change', function() {
    langue = lang.value;
  });

clang.addEventListener('click', function() {
    for (let index = 0; index < hlang.length; index++) {
        hlang[index].style.display = "block";
    }
    blang.style.display = "block";
  });