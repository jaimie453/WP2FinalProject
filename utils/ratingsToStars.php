<?php

// needed for star ratings in review modal
if(isset($_GET['rating'])) {
    echo convertRatingToStars(round($_GET['rating'] * 2));
}

// returns 5 svg star icons based on avg rating
// avg rating is an integer 1-10
function convertRatingToStars($rating) {
    $numFilledStars = intval($rating / 2);
    $hasHalfStar = ($rating % 2 == 1);
    $numUnfilledStars = intval((10 - $rating) / 2);

    $result = "";
    for($i = 0; $i < $numFilledStars; $i++)
        $result .= getFilledStar();

    if($hasHalfStar)
        $result .= getHalfFilledStar($numFilledStars == 4);

    for($i = 0; $i < $numUnfilledStars; $i++)
        $result .= getUnfilledStar();

    return $result;
}
 
// print filled star
function getFilledStar() {
    return '
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star filled-star" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffd700" fill="#ffd700" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
    </svg>';
}

// print half filled star
function getHalfFilledStar($isLastStar) {
    $class = 'reversed-star';
    if($isLastStar)
        $class .= ' last';

    return '
    <div class="position-relative d-inline">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star-half" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffd700" fill="#ffd700" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star-half ' . $class . '" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#B6B6B6" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253z" />
        </svg>
    </div>
    ';
}

// print empty star
function getUnfilledStar() {
    return '
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star unfilled-star" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#B6B6B6" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
    </svg>';
}
