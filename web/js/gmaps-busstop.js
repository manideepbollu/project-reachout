/**
 * Created by manideep.bollu on 1/28/2015.
 */
//Map variable is here
var map;

//school Marker is here
var schoolMarker;

//Temporary Variables
var dps = [13.117346, 77.641570];
var stoneHill = [13.170170, 77.595624];
var cgi = [12.948347, 77.689351];

//JSON data from the Bus Stop DB table
var jsonData;

//create Bus Stop Marker
var createBusStop = new google.maps.Marker({
    draggable: true,
    animation: google.maps.Animation.DROP,
    //icon: 'https://chart.googleapis.com/chart?chst=d_map_pin_icon&chld=glyphish_redo|0000FF',
});

//School Location
var schoolLocation = new google.maps.LatLng(cgi[0], cgi[1]);

//AutoComplete field - Bus Stop name field
var autoComplete = new google.maps.places.Autocomplete(document.getElementById('busstops-stop_name'));

//Assigning the latLng fields to variables
var stopLat = document.getElementById("busstops-lat_coords");
var stopLng = document.getElementById("busstops-lon_coords");

//Geocode variable
var geoCoder = new google.maps.Geocoder();

//Ajax Request to BusStop Controller
var request;

//InfoWindow to show bus stop information
var stopWindow = new google.maps.InfoWindow();

google.maps.event.addDomListener(window, "load", initialize);


//Helper functions are declared here
//Initialize the map for the very first time
function initialize() {

    //Define the map styling with the map properties here
    var mapProp = {
        center: schoolLocation,
        zoom: 15,
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
    map = new google.maps.Map(document.getElementById("map"), mapProp);

    //create the school marker at the center location
    schoolMarker = new google.maps.Marker({
        position: schoolLocation,
        draggable: false,
        icon: schoolIcon,
        animation: google.maps.Animation.DROP,
        map: map
    });

    //If latlng coordinates are already in the database (In case of Update)
    if(stopLat.value && stopLng.value)
        setPlaceMarker(new google.maps.LatLng(stopLat.value, stopLng.value));

    //Show the infowindow when someone clicks on the school marker
    google.maps.event.addListener(schoolMarker, 'click', function() {
        stopWindow.setContent("School <b>Base Location</b>");
        stopWindow.open(map,schoolMarker);
    });

    //Drops the red marker (New Bus stop) for the first time on click
    google.maps.event.addListener(map, 'click', function(event){
        setPlaceMarker(event.latLng);
        updateCoords();
        updateDistance();
        reverseGeoCode();
    });

    //Updates the coordinates as you drag the marker
    google.maps.event.addListener(createBusStop, 'dragend', function(){
        updateCoords();
        updateDistance();
        reverseGeoCode();
    });

    //Place a marker based on the Auto-completed input
    google.maps.event.addListener(autoComplete, 'place_changed', onPlaceChanged);

    populateMap();

}

//This function drop a marker for the autocompleted place
function onPlaceChanged(){
    var place = autoComplete.getPlace();
    if (place.geometry) {
        setPlaceMarker(place.geometry.location);
        updateCoords();
        updateDistance();
    }
}

//Drops the marker on the choosen place
function setPlaceMarker(location){
    map.panTo(location);
    map.setZoom(16);
    createBusStop.setPosition(location);
    createBusStop.setMap(map);
}

//Reverse GeoCoding
function reverseGeoCode(){
    var tempLocation = new google.maps.LatLng(stopLat.value, stopLng.value);
    geoCoder.geocode({'latLng': tempLocation}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            document.getElementById('busstops-stop_name').value = results[1].formatted_address;
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}

function updateCoords(){
    stopLat.value = createBusStop.getPosition().lat();
    stopLng.value = createBusStop.getPosition().lng();
}

function updateDistance(){
    document.getElementById("busstops-distance").value = (google.maps.geometry.spherical.computeDistanceBetween(createBusStop.getPosition(), schoolLocation)/1000).toFixed(2);
}

//Populating map with the available Json Data
function populateMap(){

    // Fire off the request to busstops/json-data [Controller/Action]
    request = $.ajax({
        url: jsonDataUrl,
        type: "get",
        data: typeof stopId != 'undefined' ? "id="+stopId : "",
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
            var oldMarker = new google.maps.Marker({
                position: latLng,
                draggable: false,
                map: map,
                icon: {
                    path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                    strokeColor: "green",
                    scale: 5,
                },
                animation: google.maps.Animation.DROP,
                title: data.stop_name,
            });

            //Add a listener using a closure to compose the marker specific data
            google.maps.event.addListener(oldMarker, 'click', (function(oldMarker, data) {
                return function() {
                    var content = '<div class="stop-window-content"><b>'+data.stop_name+'</b><br><small>'+data.lat_coords+', '+data.lon_coords+'</small><p>'+data.notes+'</p></div>';
                    stopWindow.setContent(content);
                    stopWindow.open(map, oldMarker);
                }
            })(oldMarker, data));
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
