$(document).ready(function() {
    var imageCard = $("#image-page-card");
    var reviewCard = $("#review-card");
    setReviewCardHeight();

    $( window ).resize(function() {
        setReviewCardHeight();
    });

     // equalize the height of the image page card and the reviews card
    function setReviewCardHeight() {
        reviewCard.css("max-height", imageCard.height());
    }
});
