import * as localStorage from './localStorage.js';

$(document).ready(function() {
    var toast = new bootstrap.Toast($(".toast")[0]);
    var toastText = $("#toast-text")[0];

    const id = parseInt(new URLSearchParams(window.location.search).get('id'));
    checkIsPostFavorited(id);

    $(".favorite-post").click(function () {
        localStorage.addToLocalStorage(id, 'favPosts');
        $(".favorite-post").hide();
        $(".unfavorite-post").show();

        toastText.innerText = "Added post to favorites!";
        toast.show();
    });

    $(".unfavorite-post").click(function () {
        localStorage.removeFromLocalStorage(id, 'favPosts');
        $(".favorite-post").show();
        $(".unfavorite-post").hide();

        toastText.innerText = "Removed post from favorites.";
        toast.show();
    });

    function checkIsPostFavorited(id) {
        const isFavorited = localStorage.isInLocalStorage(id, 'favPosts');

        if (isFavorited) {
            $(".favorite-post").hide();
            $(".unfavorite-post").show();
        } else {
            $(".favorite-post").show();
            $(".unfavorite-post").hide();
        }
    }
});