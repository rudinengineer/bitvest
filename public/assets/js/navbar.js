$(function() {
    if ( $(window).scrollTop() > 0 ) {
        $('.navbar').addClass('navbar-fixed')
    }
    $(window).on('scroll', function() {
        if ( $(window).scrollTop() > 0 ) {
            $('.navbar').addClass('navbar-fixed')
        } else {
            $('.navbar').removeClass('navbar-fixed')
        }
    })
})