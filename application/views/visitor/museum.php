<script>
    var directionDisplay;
    var directionsService = new google.maps.DirectionsService();
    function initialize() {
        var latlng = new google.maps.LatLng(51.764696, 5.526042);
        directionsDisplay = new google.maps.DirectionsRenderer();
        var myOptions = {
            zoom: 14,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: "My location"
        });
    }
    function calcRoute() {
        var start = document.getElementById("routeStart").value;
        var end = "51.764696,5.526042";
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div id="map_canvas"></div>
<div class="routeplanner">
    <form action="" onsubmit="calcRoute();return false;" id="routeForm">
        <input type="text" id="routeStart" value="">
        <input type="submit" value="Route plannen">
    </form>
</div>
<div id="directionsPanel"></div>
