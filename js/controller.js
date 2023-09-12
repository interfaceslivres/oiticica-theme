document.addEventListener('DOMContentLoaded', function () {
    var menuNav = document.getElementById('menu-nav');
    var sideBar = document.getElementById('sidebar-menu');
    var cabecalho = document.getElementById('cabecalho-id');
    var offsetValue = cabecalho.offsetHeight;
    var menuHeight = menuNav.offsetHeight;
    
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

        if (window.pageYOffset >= (offsetValue)) {
            sideBar.classList.add('sidebar-fixed');
        } else {
            sideBar.classList.remove('sidebar-fixed');
        }
    });
});