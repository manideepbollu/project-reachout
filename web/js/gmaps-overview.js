//Google Map object delared globally
var overviewMap;

//InfoWindow to show bus stop information
var stopWindow = new google.maps.InfoWindow();

//Bus stop markers
var oldMarker = [];

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

    //Populating the map with Bus stop information
    populateMap();
}

google.maps.event.addDomListener(window, "load", initialize);

//Populating map with the available Json Data
function populateMap(){

    // Fire off the request to busstops/json-data [Controller/Action]
    request = $.ajax({
        url: jsonDataUrl,
        type: "get",
        dataType: "json",
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        jsonData = response;
        for (var i = 0; i < jsonData.length; i++) {
            var data = jsonData[i],
                latLng = new google.maps.LatLng(data.lat_coords, data.lon_coords);

            // Placing a marker on the map as per Json Data
            oldMarker[data.id] = new google.maps.Marker({
                position: latLng,
                draggable: false,
                map: overviewMap,
                icon: {
                    path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                    strokeColor: "green",
                    scale: 5,
                },
                animation: google.maps.Animation.DROP,
                title: data.stop_name,
            });

            var tempMarker = oldMarker[data.id];

            //Add a listener using a closure to compose the marker specific data
            google.maps.event.addListener(oldMarker[data.id], 'click', (function(tempMarker, data) {
                return function() {
                    var content = '<div class="stop-window-content"><b>'+data.stop_name+'</b><br><small>'+data.lat_coords+', '+data.lon_coords+'</small><p>'+data.notes+'</p>'+subscribeButton+'</div>';
                    stopWindow.setContent(content);
                    stopWindow.open(overviewMap, tempMarker);
                }
            })(tempMarker, data));
        }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

}

function onClickBusStop(stop_id, lat, lng){
    var location = new google.maps.LatLng(lat, lng);
    overviewMap.panTo(location);
    oldMarker[stop_id].setAnimation(google.maps.Animation.BOUNCE);
    setTimeout(function(){ oldMarker[stop_id].setAnimation(null); }, 1500);
}