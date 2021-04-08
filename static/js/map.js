// https://developers.google.com/maps/documentation/javascript/overview#maps_map_simple-javascript
function initMap() {
    let map = document.getElementById("map");
    let longitude = parseFloat(map.getAttribute("data-map-longitude"));
    let latitude = parseFloat(map.getAttribute("data-map-latitude"));

    map = new google.maps.Map(map, {
        center: {
            lat: latitude,
            lng: longitude
        },
        zoom: 8,
    });
}