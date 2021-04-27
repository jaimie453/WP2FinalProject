// distributes bottom ad to all carousel slides

// get all slides
var captions = document.getElementsByClassName("carousel-caption");

// add ad image to each slide
for (var i = 0; i < captions.length; i++) {
  // create element
  var bottomAd = document.createElement("IMG");
  bottomAd.setAttribute("class", "carousel-bottom-ad");
  bottomAd.setAttribute("src", "./static/ads/explore the world cropped.jpg");
  bottomAd.setAttribute("alt", "ad here");

  // append to slide
  captions[i].appendChild(bottomAd);
}
