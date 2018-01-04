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

// Video iframe
var videoIframe = document.getElementById('video-iframe');
var videoPlay = document.getElementById('video-play');

videoPlay.onclick = function(event){
    videoIframe.src += "&autoplay=1";
    videoPlay.classList.add("opacity-zero");
    event.preventDefault();
};

videoIframe.addEventListener("onStateChange", function(state){
    if(state === 0){
        videoPlay.classList.remove("opacity-zero");
    }
});