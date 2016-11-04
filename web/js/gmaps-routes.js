//Google Map object delared globally
var overviewMap;

//InfoWindow to show bus stop information
var stopWindow = new google.maps.InfoWindow();

//Bus stop markers
var oldMarker = [];

//Bus Stop Way Points to calculate complex route
var wayPoints = [];

//Destination for the current route
var routeDestination = new google.maps.Marker({
    draggable: true,
    animation: google.maps.Animation.DROP,
    //icon: 'https://chart.googleapis.com/chart?chst=d_map_pin_icon&chld=glyphish_redo|0000FF',
});

//Route path
var directionsDisplay = new google.maps.DirectionsRenderer();

function initialize() {

    var dps = [13.117346, 77.641570];
    var stoneHill = [13.170170, 77.595624];
    var cgi = [12.948347, 77.689351];

    //Center the map as per school coordinates
    var latlng = new google.maps.LatLng(cgi[0], cgi[1]);

    //Define the map styling with the map preperties here
    var mapOverviewProp = {
        center: latlng,
        zoom: 14,
        panControl: true,
        panControlOptions: {
            position:google.maps.ControlPosition.LEFT_BOTTOM,
        },
        zoomControl: true,
        zoomControlOptions: {
            style:google.maps.ZoomControlStyle.SMALL,
            position:google.maps.ControlPosition.LEFT_BOTTOM,
        },
        streetViewControl: false,
        mapTypeControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    //Create the map object here
    overviewMap = new google.maps.Map(document.getElementById("map"), mapOverviewProp);

    //create the school marker at the center location
    var marker = new google.maps.Marker({
        position: latlng,
        draggable: false,
        icon: schoolIcon,
        animation: google.maps.Animation.DROP,
    });

    //Show the marker on the map
    marker.setMap(overviewMap);

    //Show the infowindow when someone clicks on the school marker
    google.maps.event.addListener(marker, 'click', function() {
        stopWindow.setContent("School <b>Base Location</b>");
        stopWindow.open(overviewMap,marker);
    });

    //Update route stops in Update form
    updateRouteStops();

}

google.maps.event.addDomListener(window, "load", initialize);

//Pin the map with a specific marker as soon as a bus stop is included in the route
function pinMap(pinId){

    // Fire off the request to busstops/json-data [Controller/Action]
    request = $.ajax({
        url: jsonDataUrl,
        type: "get",
        data: {'id': pinId},
        dataType: "json"
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        latLng = new google.maps.LatLng(response.lat_coords, response.lon_coords);

        // Placing a marker on the map as per Json Data
        oldMarker[response.id] = new google.maps.Marker({
            position: latLng,
            draggable: false,
            map: overviewMap,
            icon: {
                path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                strokeColor: "green",
                scale: 5,
            },
            animation: google.maps.Animation.DROP,
            title: response.stop_name,
        });

        var tempMarker = oldMarker[response.id];

        //Add a listener using a closure to compose the marker specific data
        google.maps.event.addListener(oldMarker[response.id], 'click', (function(tempMarker, response) {
            return function() {
                var content = '<div class="stop-window-content"><b>'+response.stop_name+'</b><br><small>'+response.lat_coords+', '+response.lon_coords+'</small><p>'+response.notes+'</p></div>';
                stopWindow.setContent(content);
                stopWindow.open(overviewMap, tempMarker);
            }
        })(tempMarker, response));

        addWayPoint(latLng);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
        return null;
    });

}

//Show - Bounce the marker on clicking the a bus stop on bus stop index page
function onClickBusStop(stop_id, lat, lng){
    var location = new google.maps.LatLng(lat, lng);
    overviewMap.panTo(location);
    oldMarker[stop_id].setAnimation(google.maps.Animation.BOUNCE);
    setTimeout(function(){ oldMarker[stop_id].setAnimation(null); }, 1500);
}

//Unpin the marker as soon as it's deselcted from the bus stop list in a route
function unPinMap(pinId){
    oldMarker[pinId].setMap(null);
    var response = oldMarker[pinId].getPosition();
    removeWayPoint(response);
}

//render the directions as soon the bus stop list is changes in the route page
function renderDirections(){

    var rendererOptions = {
        map: overviewMap,
        markerOptions: {visible: false},
        draggable: true
    };

    directionsDisplay.setOptions(rendererOptions);

    var org = new google.maps.LatLng ( 12.948347, 77.689351);
    var dest = routeDestination.getPosition();

    var request = {
        origin: org,
        destination: dest,
        waypoints: wayPoints,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };

    directionsService = new google.maps.DirectionsService();
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
        else
            alert ('Failed to get directions. Auto plot is possible for 10 waypoints only. Please deselect the Auto Plot Route option if you choose more than 10 way points (Including Origin and Destination).');
    });
}

//Add waypoints as they add bus stops to the route
function addWayPoint(response){
    wayPoints.push({location: response});
    directionsDisplay.setMap(null);
    if($("input[name='Routes[autoplot]']:checked").val() == 1)
    renderDirections();
}

//Remove waypoints as they delete bus stops from the route
function removeWayPoint(response){
    var waypointIndex = functiontofindIndexByKeyValue(wayPoints, 'location', response);
    wayPoints.splice(waypointIndex, 1);
    directionsDisplay.setMap(null);
    if($("input[name='Routes[autoplot]']:checked").val() == 1)
    renderDirections();
}

//Helper function to search for Index as per the location coordinates
function functiontofindIndexByKeyValue(arraytosearch, keytosearchfor, valuetosearch) {
    for (var i = 0; i < arraytosearch.length; i++) {
        if (arraytosearch[i][keytosearchfor] == valuetosearch)
            return i;
    }
    return null;
}

//
function pinDestination(pinId){
    // Fire off the request to busstops/json-data [Controller/Action]
    request = $.ajax({
        url: jsonDataUrl,
        type: "get",
        data: {'id': pinId},
        dataType: "json"
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        latLng = new google.maps.LatLng(response.lat_coords, response.lon_coords);

        // Placing a marker on the map as per Json Data
        routeDestination.setPosition(latLng);
        routeDestination.setMap(overviewMap);

        //Add a listener using a closure to compose the marker specific data
        google.maps.event.addListener(routeDestination, 'click', (function(routeDestination, response) {
            return function() {
                var content = '<div class="stop-window-content"><b>'+response.stop_name+'</b><br><small>'+response.lat_coords+', '+response.lon_coords+'</small><p>'+response.notes+'</p></div>';
                stopWindow.setContent(content);
                stopWindow.open(overviewMap, routeDestination);
            }
        })(routeDestination, response));
        if($("input[name='Routes[autoplot]']:checked").val() == 1)
        renderDirections();
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
        return null;
    });

}

