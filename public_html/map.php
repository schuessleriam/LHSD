//OBTAIN A GOOGLE MAPS API KEY FROM https://developers.google.com/maps/documentation/javascript/

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Geocoding Simple</title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script type="text/javascript">
  var geocoder;
  var map;
  var address = getUrlVars()["map_address"];
  //var address = <?php $_GET["map_address"] ?>;
  //var address = "valparasio"

function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(87.042, 41.463);
    var myOptions = {
      zoom: 5,
      center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

            var infowindow = new google.maps.InfoWindow(
                { content: '<b>'+address+'</b>',
                  size: new google.maps.Size(150,50)
                });

            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                title:address
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });

          } else {
           document.getElementById("map_canvas").innerHTML = "No map results for this City.";
// document.write("No Map results for this City.");
          }
        } else {
	document.getElementById("map_canvas").innerHTML = "No map results for this City.";
// document.write("No Map results for this City.");
        }
      });
    }
  }



function getUrlVars() {
var vars = {};
var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
vars[key] = value;
});
return vars;
}
</script>
</head>
<body style="margin:0px; padding:0px;" onload="initialize()">
 <div id="map_canvas" style="width:100%; height:100%">
</body>
</html>
