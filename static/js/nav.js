$(document).ready(function () {
    $('.dropdown').bind('show.bs.dropdown', function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideDown(500, "swing");
    });

    $('.dropdown').bind('hide.bs.dropdown', function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideUp(250, "swing");
    });
})
