<!DOCTYPE html>
<html>
  <head>
    <title>Place ID Finder</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
    html,
body,
#map_canvas {
height: 100%;
width: 100%;
margin: 0px;
padding: 0px
}
    </style>
  </head>
  <body>
    <input id="id_address" type="text" value="" />
<div id="postal_code"></div>
<div id="map_canvas"></div>

    <script>
    var geocoder;
var map;

function initialize() {
var map = new google.maps.Map(
  document.getElementById("map_canvas"), {
    center: new google.maps.LatLng(37.4419, -122.1419),
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
var input = document.getElementById('id_address');
var options = {
  types: ['address'],
  componentRestrictions: {
    country: 'uk'
  }
};
autocomplete = new google.maps.places.Autocomplete(input, options);
google.maps.event.addListener(autocomplete, 'place_changed', function() {
  var place = autocomplete.getPlace();
  for (var i = 0; i < place.address_components.length; i++) {
    for (var j = 0; j < place.address_components[i].types.length; j++) {
      if (place.address_components[i].types[j] == "postal_code") {
        document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;

      }
    }
  }
})
}
google.maps.event.addDomListener(window, "load", initialize);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgVTxbNiWLoE9N8qQuogD-VIBvcRVWm2s&libraries=places&callback=initMap"
        async defer></script>
  </body>
</html>
