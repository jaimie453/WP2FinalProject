var captions = document.getElementsByClassName("carousel-caption");
for (var i = 0; i < captions.length; i++) {
  var bottomAd = document.createElement("IMG");
  bottomAd.setAttribute("class", "carousel-bottom-ad");
  bottomAd.setAttribute("src", "./static/ads/explore the world cropped.jpg");
  bottomAd.setAttribute("alt", "ad here");
  captions[i].appendChild(bottomAd);
}
