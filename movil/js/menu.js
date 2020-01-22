var something = document.getElementById('downrow');

something.style.cursor = 'pointer';
something.onclick = function () {
    $('html, body').animate({
        scrollTop: $("#productos").offset().top
    }, 1000);

};


var something = document.getElementById('btnquehacemos');

something.style.cursor = 'pointer';
something.onclick = function () {
    $('html, body').animate({
        scrollTop: $("#contacto").offset().top
    }, 1000);

};

var something = document.getElementById('btnmateriaprima');

something.style.cursor = 'pointer';
something.onclick = function () {
    $('html, body').animate({
        scrollTop: $("#contacto").offset().top
    }, 1000);

};

var something = document.getElementById('btndiferencia');

something.style.cursor = 'pointer';
something.onclick = function () {
    $('html, body').animate({
        scrollTop: $("#contacto").offset().top
    }, 1000);

};