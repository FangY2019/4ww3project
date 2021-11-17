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
                    .bindPopup("<a class=\"img-ref\" href=\"individual_sample.html\"><img src=\"img/gallery/default.jpg\" class=\"sample-img-popup\" alt=\"Coffee Shop Picture\"/> <h3 class=\"des-text\">Here is Durand Coffee</h3></a><br>", {maxWidth:200})
                    .addTo(mymap);
    //add another marker with the location of the coffee shop
    var marker2 = new L.marker([43.25326,-79.89943])
                    .bindPopup("<a class=\"img-ref\" href=\"individual_sample.html\"><img src=\"img/gallery/default.jpg\" class=\"sample-img-popup\" alt=\"Coffee Shop Picture\"/> <h3 class=\"des-text\">Here is Second Fake Coffee Shop</h3></a><br>", {maxWidth:200})
                    .addTo(mymap);
}


//https://developer.mozilla.org/en-US/docs/Web/API/Geolocation/getCurrentPosition
function success(pos) {
  var crd = pos.coords;

  //debugging purpose
  console.log('Your current position is:');
  console.log('Latitude : ' + crd.latitude);
  console.log('Longitude: ' + crd.longitude);
  console.log('More or less ' + crd.accuracy + ' meters.');

  //initialize the map with coordinates
  loadMap(crd.latitude, crd.longitude, 13);
}

//get position failed
function error(err) {
  //alert the user location service is blocked.
  alert("Why are you doing this to me?\nAccessing location failed, is it blocked?");
  //load map with default parameters.
  loadMap();
}

function getLoc() {
  return navigator.geolocation.getCurrentPosition(success, error);
}

function Initalize() {
  //retrieve parameters from get request
  var queryDict = {};
  location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
  //check request
  if(queryDict["local"] == "true") {
    getLoc();
    return;
  }
  loadMap();
}
