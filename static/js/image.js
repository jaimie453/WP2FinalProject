$(document).ready(function () {
    var imageCard = $("#image-page-card");
    var reviewCard = $("#review-card");
    var deleteReviewModal = new bootstrap.Modal($('#deleteModal')[0]);

    setReviewCardHeight();

    $(window).resize(function () {
        setReviewCardHeight();
    });

    // For review modal
    // change the amount of stars shown whenever the user changes the rating
    $("#ratingRange").change(function () {
        const rating = $("#ratingRange").val();

        $.get("utils/ratingsToStars.php", { rating: rating }, function (response) {
            $("#review-rating-stars").html(response);
        });
    });

    // each review listing contains a hidden input after the delete button
    // place the value of this input into the userId input within the delete review modal
    // before opening
    $(".delete-review-btn").click(function () {
        const userId = $(this).next().val();
        $("#deleteReviewUserId").val(userId);
        deleteReviewModal.show();
    });

    // equalize the height of the image page card and the reviews card
    function setReviewCardHeight() {
        reviewCard.css("max-height", imageCard.height());
    }
});
