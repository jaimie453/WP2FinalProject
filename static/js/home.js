$(document).ready(function() {
    var isTopImagesActive = false;
    var isNewImagesActive = false;
    var imagesContainer = $("#images-container");
    var topImagesList = $("#top-images-list");
    var newImagesList = $("#new-images-list")

    $("#top-images-button").click(function() {
        isTopImagesActive = !isTopImagesActive;
        isNewImagesActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    $("#new-images-button").click(function() {
        isNewImagesActive = !isNewImagesActive;
        isTopImagesActive = false;
        checkImagesListGroup();
        checkImagesContainer();
    });

    function checkImagesContainer() {
        if (isTopImagesActive || isNewImagesActive)
            imagesContainer.slideDown();
        else
            imagesContainer.slideUp();
    }

    $(".images-group-close").click(function() {
        isTopImagesActive = false;
        isNewImagesActive = false;
        imagesContainer.slideUp();
    });

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