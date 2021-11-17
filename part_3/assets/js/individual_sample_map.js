//Create a Leaflet map instance with the give mapid, view parameter(latitude, longitutde) and zoom level
function InitMap(mapid, lati, longi, zoom) {
    //Create the map
    var mymap = L.map(mapid);
    //set its view according to the given latitude and longtitude
    mymap.setView([lati, longi], zoom);
    //add a tile layer to add to our map
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoieWVmMTAiLCJhIjoiY2t2aGlqdjh4MmhzdjJwbm8xeDdnMTJ3dyJ9.BOusRdioCyDRhIhxuHlWGg'
    }).addTo(mymap);
    return mymap;
}

// Load the map to individual sample page and add an marker
function loadMapToIndividualPage() {
    //Define a variable for the map in individual sample page
    var mapOfIndividualPage = InitMap("mapid", 43.25346, -79.87943, 12);

    // create a blank pop-up
    var popup = L.popup();
    //Display the popup when the user clicks on the map
    function onMapClick(e) {
        popup.setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mapOfIndividualPage);
    }
    mapOfIndividualPage.on('click', onMapClick);

    //add a marker with the location of the coffee shop
    var marker = new L.marker([43.25346, -79.87943])
        .addTo(mapOfIndividualPage)
        .bindPopup("<div><b> Durand Coffee</b> </div> <div>latitude:43.25346</div>  <div>Longitude:-79.87943</div>")
}
