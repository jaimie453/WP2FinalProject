$(document).ready(function () {
    var isBrowseActive = false;
    var isContinentsActive = false;
    var isCountriesActive = false;
    var isCitiesActive = false;

    var browseButton = $("#navbarDropdown1");
    var continentsButton = $("#navbarDropdown2");
    var countriesButton = $("#navbarDropdown3");
    var citiesButton = $("#navbarDropdown4");


    $("#navbarDropdown1").click(function () {
        isBrowseActive = !isBrowseActive;

        isContinentsActive = false;
        isCountriesActive = false;
        isCitiesActive = false;

        checkImagesListGroup();
        checkImagesContainer();
    });

    $("navbarDropdown2").click(function () {
        isContinentsActive = !isContinentsActive;

        isBrowseActive = false;
        isCountriesActive = false;
        isCitiesActive = false;

        checkImagesListGroup();
        checkImagesContainer();
    });

    $("#navbarDropdown3").click(function () {
        isCountriesActive = !isCountriesActive;

        isBrowseActive = false;
        isContinentsActive = false;
        isCitiesActive = false;

        checkImagesListGroup();
        checkImagesContainer();
    });

    $("navbarDropdown4").click(function () {
        isCitiesActive = !isCitiesActive;

        isBrowseActive = false;
        isContinentsActive = false;
        isCountriesActive = false;

        checkImagesListGroup();
        checkImagesContainer();
    });


    function checkImagesContainer() {
        if (isTopImagesActive || isNewImagesActive)
            imagesContainer.slideDown();
        else
            imagesContainer.slideUp();
    }

    function checkImagesListGroup() {
        if (isBrowseActive) {
            browseButton.show();
            continentsButton.hide();
            countriesButton.hide();
            citiesButton.hide();
        } else if (isContinentsActive) {
            browseButton.hide();
            continentsButton.show();
            countriesButton.hide();
            citiesButton.hide();
        } else if (isCountriesActive) {
            browseButton.hide();
            continentsButton.hide();
            countriesButton.show();
            citiesButton.hide();
        } else if (isCitiesActive) {
            browseButton.hide();
            continentsButton.hide();
            countriesButton.hide();
            citiesButton.show();
        }
    }
});
