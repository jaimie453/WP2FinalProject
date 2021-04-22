// animates dropdowns on homepage

$(document).ready(function () {
    // initialize flags, find lists
    var isTopImagesActive = false;
    var isNewImagesActive = false;
    var isRecentReviewsActive = false;
    var imagesContainer = $("#images-container");
    var topImagesList = $("#top-images-list");
    var newImagesList = $("#new-images-list");
    var recentReviewsList = $("#recent-reviews-list")

    $("#recent-reviews-button").click(function () {
        isRecentReviewsActive = !isRecentReviewsActive;
        isTopImagesActive = false;
        isNewImagesActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    // #top-images-button is clicked
    $("#top-images-button").click(function () {
        isTopImagesActive = !isTopImagesActive;
        isNewImagesActive = false;
        isRecentReviewsActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    // #new-images-button is clicked
    $("#new-images-button").click(function () {
        isNewImagesActive = !isNewImagesActive;
        isTopImagesActive = false;
        isRecentReviewsActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    

    // slides down if active, slides up otherwise
    function checkImagesContainer() {
        if (isTopImagesActive || isNewImagesActive || isRecentReviewsActive)
            imagesContainer.slideDown();
        else
            imagesContainer.slideUp();
    }

    // if open one is clicked, close
    $(".images-group-close").click(function () {
        isTopImagesActive = false;
        isNewImagesActive = false;
        isRecentReviewsActive = false;
        imagesContainer.slideUp();
    });

    // if one is active, show it and hide other
    function checkImagesListGroup() {
        if (isTopImagesActive) {
            newImagesList.hide();
            recentReviewsList.hide();
            topImagesList.show();
        } else if (isNewImagesActive) {
            topImagesList.hide();
            recentReviewsList.hide();
            newImagesList.show();
        } else if(isRecentReviewsActive) {
            topImagesList.hide();
            newImagesList.hide();
            recentReviewsList.show();
        }
    }
});
