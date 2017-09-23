$(document).ready(function () {


    /* ---------------------------------------------- /*
     * Navbar
     /* ---------------------------------------------- */

    $('.header').sticky({
        topSpacing: 0
    });

    $('body').scrollspy({
        target: '.navbar-custom',
        offset: 70
    });

});