document.addEventListener('DOMContentLoaded', function () {
    var menuNav = document.getElementById('menu-nav');
    var sideBar = document.getElementById('sidebar-menu');
    var cabecalho = document.getElementById('cabecalho-id');
    var corpo = document.getElementById('conteudo');
    var sidebar = document.getElementById('sidebar-menu');
    var offsetValue = cabecalho.offsetHeight;
    var menuHeight = menuNav.offsetHeight;
    var corpoHeight = corpo.offsetHeight;
    var sidebarHeight = sidebar.offsetHeight;

    console.log('cabecalho height:' + offsetValue);
    console.log('corpo height:' + corpoHeight);
    console.log('sidebar height:' + sidebarHeight);
    
    window.addEventListener('scroll', function () {
        // Use console.log to determine when you want the nav bar to stick.
        console.log(window.pageYOffset);
        
        if (window.pageYOffset >= offsetValue) {
            menuNav.classList.add('top-fixed');
            cabecalho.style.height = offsetValue + menuHeight + 'px';
        } else {
            menuNav.classList.remove('top-fixed');
            cabecalho.style.height = offsetValue + 'px';
        }

        if (window.pageYOffset >= (offsetValue) && (window.pageYOffset < (offsetValue + corpoHeight - sidebarHeight))) {
            sideBar.classList.add('sidebar-fixed');
            sideBar.classList.remove('sidebar-wrapper');
            sideBar.classList.remove('sidebar-end');
            console.log('fixed');
        } else if (window.pageYOffset >= (offsetValue + corpoHeight - sidebarHeight)){
            sideBar.classList.remove('sidebar-fixed');
            sideBar.classList.remove('sidebar-wrapper');
            sideBar.classList.add('sidebar-end');
            console.log('end');
        } else {
            sideBar.classList.remove('sidebar-fixed');
            sideBar.classList.remove('sidebar-end');
            sideBar.classList.add('sidebar-wrapper');
            console.log('nada');
        }
    });
});