//Update route + stops in update form
function updateRouteStops(){
    //Initialize the route on update
    pinDestination($('#destination-select').val());
    var availableStops = $('#stops-multiselect').val();
    for(var i = 0; i < availableStops.length; i++){
        pinMap(availableStops[i]);
    }
}

//Choosen triggers
$('#stops-multiselect').on('change', function(evt, params) {

    //Populating the map with Bus stop information
    if(params.selected)
        pinMap(params.selected);

    if(params.deselected)
        unPinMap(params.deselected);
});

$('#destination-select').on('change', function(evt, params) {
    //Populating the map with Bus stop information
    pinDestination(params.selected);
});

$("input[name='Routes[autoplot]']").change(function(){
    if($("input[name='Routes[autoplot]']:checked").val() == 0)
        directionsDisplay.setMap(null);
    if($("input[name='Routes[autoplot]']:checked").val() == 1)
        renderDirections();
});
