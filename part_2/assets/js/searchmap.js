//Inialize and load the Leaflet map
function loadMap(x = 43.25966, y = -79.91823, z = 13){
    //Initalize the map and set its view to mcmaster and a zoom level
    var mymap = L.map('search-map-id').setView([x, y], z);
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
    var marker2 = new L.marker([43.25326,-79.89943])
                    .bindPopup('Here is Second Fake Coffee Shop')
                    .addTo(mymap);
}


function success(pos) {
  var crd = pos.coords;

  console.log('Your current position is:');
  console.log('Latitude : ' + crd.latitude);
  console.log('Longitude: ' + crd.longitude);
  console.log('More or less ' + crd.accuracy + ' meters.');

  loadMap(crd.latitude, crd.longitude, 13);
}

function error(err) {
  alert("Accessing current location failed.");
  loadMap();
}

function getLoc() {
  return navigator.geolocation.getCurrentPosition(success, error);
}

function Initalize() {
  var queryDict = {};
  location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
  if(queryDict["local"] == "true") {
    getLoc();
    return;
  }
  loadMap();
}
