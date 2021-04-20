// animates dropdowns on homepage

$(document).ready(function () {
    // initialize flags, find lists
    var isTopImagesActive = false;
    var isNewImagesActive = false;
    var imagesContainer = $("#images-container");
    var topImagesList = $("#top-images-list");
    var newImagesList = $("#new-images-list");

    // #top-images-button is clicked
    $("#top-images-button").click(function () {
        isTopImagesActive = !isTopImagesActive;
        isNewImagesActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    // #new-images-button is clicked
    $("#new-images-button").click(function () {
        isNewImagesActive = !isNewImagesActive;
        isTopImagesActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    // slides down if active, slides up otherwise
    function checkImagesContainer() {
        if (isTopImagesActive || isNewImagesActive)
            imagesContainer.slideDown();
        else
            imagesContainer.slideUp();
    }

    // if open one is clicked, close
    $(".images-group-close").click(function () {
        isTopImagesActive = false;
        isNewImagesActive = false;
        imagesContainer.slideUp();
    });

    // if one is active, show it and hide other
    function checkImagesListGroup() {
        if (isTopImagesActive) {
            newImagesList.hide();
            topImagesList.show();
        } else if (isNewImagesActive) {
            topImagesList.hide();
            newImagesList.show();
        }
    }
});
