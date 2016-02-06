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
