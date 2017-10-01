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

    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

});