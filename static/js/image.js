import * as localStorage from './localStorage.js';

$(document).ready(function() {
    var toast = new bootstrap.Toast($(".toast")[0]);
    var toastText = $("#toast-text")[0];

    var imageCard = $("#image-page-card");
    var reviewCard = $("#review-card");
    setReviewCardHeight();
    
    const id = parseInt(new URLSearchParams(window.location.search).get('id'));
    checkIsImageFavorited(id);

    $(".favorite-img").click(function () {
        localStorage.addToLocalStorage(id, 'favImages');
        $(".favorite-img").hide();
        $(".unfavorite-img").show();

        toastText.innerText = "Added image to favorites!";
        toast.show();
    });

    $(".unfavorite-img").click(function () {
        localStorage.removeFromLocalStorage(id, 'favImages');
        $(".favorite-img").show();
        $(".unfavorite-img").hide();

        toastText.innerText = "Removed image from favorites.";
        toast.show();
    });

    $( window ).resize(function() {
        setReviewCardHeight();
    });

     // equalize the height of the image page card and the reviews card
    function setReviewCardHeight() {
        reviewCard.css("max-height", imageCard.height()); 
    }

    function checkIsImageFavorited(id) {
        const isFavorited = localStorage.isInLocalStorage(id, 'favImages');

        if (isFavorited) {
            $(".favorite-img").hide();
            $(".unfavorite-img").show();
        } else {
            $(".favorite-img").show();
            $(".unfavorite-img").hide();
        }
    }
});