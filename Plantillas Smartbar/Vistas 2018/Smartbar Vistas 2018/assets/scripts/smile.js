/*!
 * Smile v0.1.0
 * Provisional vanilla code
 *
 */

// Mobile Menu Toggle
var navToggle = document.getElementById('nav-toggle');
var navToggleClose = document.getElementById('nav-toggle-close');
var navMain = document.getElementById('nav-main');

navToggle.onclick = function(event){
    navMain.classList.toggle("is-open");
    event.preventDefault();
};
navToggleClose.onclick = function(event){
    navMain.classList.toggle("is-open");
    event.preventDefault();
};
