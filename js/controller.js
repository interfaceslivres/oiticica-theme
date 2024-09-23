document.addEventListener('DOMContentLoaded', function () {

    var windowHeight = window.innerHeight;

    var overlay = document.getElementById('menu-overlay');
    var corpo_doc= document.getElementById('documentos');

    var searchButton = document.getElementById('busca');
    var menuButton = document.getElementById('hamburger');
    var menuButonIcon = document.getElementById('hamburger-botao');
    var closeSearchButton = document.getElementById('busca-fecha');
    var searchBar = document.getElementById('busca-barra');
    var menuBar = document.getElementById('desktop-menu');
    var menuButtons = document.getElementById('menu-buttons');
    var searchForm = document.getElementById('s');


    searchButton.addEventListener('click', buscaClick);
    closeSearchButton.addEventListener('click', buscaClick);
    menuButton.addEventListener('click', toggleMenuOverlay);

    function buscaClick() {
        searchBar.classList.toggle('hidden');
        menuBar.classList.toggle('hidden');
        menuButtons.classList.toggle('hidden');
        menuButton.classList.toggle('hidden');   
        overlay.classList.add('hidden');
        document.body.classList.remove('stop-scrolling');
        menuButonIcon.classList.remove('fa-xmark');
        menuButonIcon.classList.add('fa-bars');
        searchForm.focus();
    }      

    window.addEventListener('resize', function (){
        windowHeight = window.innerHeight;
        
    })

    var menuNav = document.getElementById('menu-nav');    
    //var sideBar = document.getElementById('sidebar-menu');
    var cabecalho = document.getElementById('cabecalho-id');
    var corpo = document.getElementById('conteudo_pagina');
    var sidebar = document.getElementById('sidebar-menu');
    var offsetValue = cabecalho.offsetHeight;
    var menuHeight = menuNav.offsetHeight;
    var corpoHeight = corpo.offsetHeight;
    //var sidebarHeight = sidebar.offsetHeight;

    

    function toggleMenuOverlay() {  
        if (window.scrollY < offsetValue) {
            overlay.style.top = offsetValue + menuHeight - window.scrollY + 'px';
            var altura = windowHeight - offsetValue - menuHeight + window.scrollY + 'px';
            overlay.style.height = altura;
        } else {
            overlay.style.top = menuHeight + 'px';
            var altura = windowHeight - menuHeight + 'px';
            overlay.style.height = altura;
        }
        overlay.classList.toggle('hidden');
        menuButonIcon.classList.toggle('fa-xmark');
        menuButonIcon.classList.toggle('fa-bars');
        document.body.classList.toggle('stop-scrolling');
    }

    let scrollTimeout
    var prevScrollpos = window.scrollY;

    window.addEventListener('scroll', function () {
        var currentScrollPos = window.scrollY;
        if (prevScrollpos > currentScrollPos) {
            menuNav.style.top = "0";
        } else {
            menuNav.style.top = "-48px";
        }

        

        // Event buffering here
        clearTimeout(scrollTimeout)
        scrollTimeout = setTimeout(function () {
            prevScrollpos = currentScrollPos;
        }, 0) // This delay may need adjustment...

        //console.log(currentScrollPos);
    });

    /*console.log('cabecalho height:' + offsetValue);
    console.log('menu height:' + menuHeight);
    console.log('corpo height:' + corpoHeight);
    console.log('sidebar height:' + sidebarHeight);*/
    
    /*
    window.addEventListener('scroll', function () {
        // Use console.log to determine when you want the nav bar to stick.
        //console.log(window.pageYOffset);       

        if (window.pageYOffset >= offsetValue) {
            menuNav.classList.add('top-fixed');
            cabecalho.style.height = offsetValue + menuHeight + 'px';
            overlay.style.top = menuHeight + 'px';
        } else {
            menuNav.classList.remove('top-fixed');
            cabecalho.style.height = offsetValue + 'px';
            overlay.style.top = offsetValue + menuHeight - window.pageYOffset + 'px';
        }

        if (window.pageYOffset >= (offsetValue) && (window.pageYOffset < (offsetValue + corpoHeight - sidebarHeight))) {
            sideBar.classList.add('sidebar-fixed');
            sideBar.classList.remove('sidebar-wrapper');
            sideBar.classList.remove('sidebar-end');
            //console.log('fixed');
        } else if (window.pageYOffset >= (offsetValue + corpoHeight - sidebarHeight)){
            sideBar.classList.remove('sidebar-fixed');
            sideBar.classList.remove('sidebar-wrapper');
            sideBar.classList.add('sidebar-end');
            //console.log('end');
        } else {
            sideBar.classList.remove('sidebar-fixed');
            sideBar.classList.remove('sidebar-end');
            sideBar.classList.add('sidebar-wrapper');
            //console.log('nada');
        }
    });
    */
});

function altoContraste() {
    console.log("contraste")
    var body = document.getElementsByTagName("body")[0];
    if (body.classList.contains('contraste')) {
     body.classList.remove('contraste'); 
     localStorage.setItem('xContraste', 0);
    } else {
     body.classList.add('contraste'); 
     localStorage.setItem('xContraste', 1);
    }
}

function autismo() {
    console.log("contraste")
    var body = document.getElementsByTagName("body")[0];
    if (body.classList.contains('autismo')) {
     body.classList.remove('autismo'); 
     localStorage.setItem('xAutismo', 0);
    } else {
     body.classList.add('autismo'); 
     localStorage.setItem('xAutismo', 1);
    }
}

