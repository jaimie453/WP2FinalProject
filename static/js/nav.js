// animates dropdowns on nav

$(document).ready(function () {
    // if dropdown is shown, slide dropdown-menu down
    $('.dropdown').bind('show.bs.dropdown', function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideDown(500, "swing");
    });

    // if dropdown is hidden, slide dropdown-menu up
    $('.dropdown').bind('hide.bs.dropdown', function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideUp(250, "swing");
    });
})
