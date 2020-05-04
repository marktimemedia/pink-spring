  //Add event listeners to buttons
    var menuBtn = document.getElementById('openMainMenu');
    var closeBtn = document.getElementById('closeSidebar');

    var sidebarBtn = document.getElementById('openSidebar');

    var mediaQuerySmall = '48.9em';
    var mediaQueryLarge = '62em';

    if (menuBtn.attachEvent) {
        menuBtn.attachEvent('onclick', openCloseMenu);

        if(sidebarBtn !== null) {
            sidebarBtn.attachEvent('onclick', openSidebar);
        }
    } else {

        menuBtn.addEventListener('click', openCloseMenu);

        if(sidebarBtn !== null) {
            sidebarBtn.addEventListener('click', openSidebar);
        }
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

    function openSidebar() {

        var htmlEl = document.querySelectorAll('html')[0];
        var htmlElClasses = htmlEl.className;

        // Add or remove the open-menu class
        if (htmlElClasses.indexOf('open-the-sidebar') === -1) {
            htmlEl.className = htmlElClasses + ' open-the-sidebar';
        } else {
            htmlEl.className = htmlElClasses.replace(' open-the-sidebar', '');
        }
    }

    function navHeight() {
        var heights = window.innerHeight;
        var mq = window.matchMedia( '(max-width: ' + mediaQuerySmall + ')' );

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

document.addEventListener('DOMContentLoaded', function() {
    navHeight();
}, false);

var timer;

window.onresize = onResizeFunction;

function onResizeFunction() {
    clearTimeout(timer);
    timer = setTimeout(function() {
        sizeTest(true);
        navHeight();
    }, 100);
}

var matching = false;

dataAttributeAdd();

var newHtml = '<div class="sidebar--leftcol"></div><div class="sidebar--rightcol"></div>';
document.querySelectorAll('.content--sidebar')[0].insertAdjacentHTML('beforeend', newHtml);

sizeTest(false);

function sizeTest(resize) {
    if(Modernizr.mq('(min-width: ' + mediaQuerySmall + ') and (max-width: ' + mediaQueryLarge + ')')) {
        reorderWidgets();
        // console.log('order widgets');
    } else if (resize) {
        unorderWidgets();
    }
}

function reorderWidgets() {
    if (matching === false) {
        matching = true;

        var widgets = document.querySelectorAll('aside .widget'),
            widgetsLength = widgets.length,
            col1 = document.querySelectorAll('.sidebar--leftcol')[0],
            col2 = document.querySelectorAll('.sidebar--rightcol')[0],
            height1 = col1.offsetHeight,
            height2 = col2.offsetHeight,
            node;

        for(var i = 0; i < widgetsLength; i++) {
            node = widgets[i];
            if(height1 <= height2) {
                col1.appendChild(node);
            } else {
                col2.appendChild(node);
            }

            height1 = col1.offsetHeight;
            height2 = col2.offsetHeight;
        }
    }
}

function unorderWidgets() {
    if (matching === true) {
        matching = false;
        var widgets = document.querySelectorAll('aside .widget'),
            widgetsLength = widgets.length,
            sidebar = document.querySelectorAll('.content--sidebar')[0];

        console.log(widgets);

        for(var i = 0; i < widgetsLength; i++) {
            for(var j = 0; j < widgetsLength; j++) {
                var orderNbr = widgets[j].getAttribute('data-order');
                if(orderNbr == i) {
                    sidebar.appendChild(widgets[j]);
                }
            }
        }
    }
}

function dataAttributeAdd() {

    var widgets = document.querySelectorAll('aside .widget'),
        widgetsLength = widgets.length;

    for(var i = 0; i < widgetsLength; i++) {
        widgets[i].setAttribute('data-order', i);
    }
}
