//Inialize and load the Leaflet map
function loadMap(){
    //Initalize the map and set its view to mcmaster and a zoom level
    var mymap = L.map('mapid').setView([43.25966, -79.91823], 13);
    //add a tile layer to add to our map
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoieWVmMTAiLCJhIjoiY2t2aGlqdjh4MmhzdjJwbm8xeDdnMTJ3dyJ9.BOusRdioCyDRhIhxuHlWGg'
    }).addTo(mymap);
    //add a marker with the location of the coffee shop
    var marker = new L.marker([43.25346,-79.87943])
                    .bindPopup('Here is Durand Coffee')
                    .addTo(mymap);
}