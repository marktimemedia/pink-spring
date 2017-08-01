//Add event listeners to buttons
var menuBtn = document.getElementById('openMainMenu');
var closeBtn = document.getElementById('closeSidebar');

if (menuBtn.attachEvent) {
    menuBtn.attachEvent('onclick', openCloseMenu);

} else {

    menuBtn.addEventListener('click', openCloseMenu);

}

if (closeBtn.attachEvent) {
    closeBtn.attachEvent('onclick', openCloseMenu);

} else {

    closeBtn.addEventListener('click', openCloseMenu);
}


function openCloseMenu() {
    var htmlEl = document.querySelectorAll('html')[0];
    var htmlElClasses = htmlEl.className;

    // Add or remove the open-menu class
    if (htmlElClasses.indexOf('open-the-menu') === -1) {
        htmlEl.className = htmlElClasses + ' open-the-menu';
    } else {
        htmlEl.className = htmlElClasses.replace(' open-the-menu', '');
    }
}

function navHeight() {
    var heights = window.innerHeight;
    var mq = window.matchMedia( "(max-width: 48.5em)" );

    document.addEventListener('DOMContentLoaded', function() {
        if (mq.matches) {
          document.querySelectorAll('.nav-main')[0].style.height = heights -50 + "px";
        } 
    }, false); 
    
    mq.addListener(function(changed) {
        if(changed.matches) {
            document.querySelectorAll('.nav-main')[0].style.height = heights -50 + "px";
        } else {
            document.querySelectorAll('.nav-main')[0].style.height = null;
        }
    });
}

navHeight();

var timer;

function onResizeFunction() {
    clearTimeout(timer);
    timer = setTimeout(function() {
        navHeight();
    }, 100);
}

window.onresize = onResizeFunction;
