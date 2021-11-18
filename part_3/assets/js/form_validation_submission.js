// registration form validation
function validateObjectSubmissionForm() {
    let shopname = document.forms["form-object-submission"]["txt-shopname"].value;
    let description = document.forms["form-object-submission"]["txt-description"].value;
    let latitude = document.forms["form-object-submission"]["txt-latitude"].value;
    let longitude = document.forms["form-object-submission"]["txt-longitude"].value;
    let imageFilePath = document.getElementById("image-upload").value;
    let videoFilePath = document.getElementById("video-upload").value;
    //validate shopname
    if (!validateShopName(shopname)) {
        return false;
    }
    //validate description
    else if (!validateDescription(description)) {
        return false;
    }
    //validate latitude
    else if (!validateLatitude(latitude)) {
        return false;
    }
    //validate longtitude
    else if (!validateLongitude(longitude)) {
        return false;
    }
    //validate image file
    else if (!validateImageFormat(imageFilePath)) {
        return false;
    }
    //validate video file
    else if (!validateVideoFormat(videoFilePath)) {
        return false;
    }
    return true;
}

//get the user's coorniates and call the show postion function 
function getCoordinates() {
    document.getElementById("geolocation-error").innerHTML ='';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        // alert("Geolocation is not supported by this browser.");
        document.getElementById("geolocation-error").innerHTML = '<p style="color:red";>Geolocation is not supported by this browser!</p>';
    }
}

//show the latitude and longitude of the user's position in the input
function showPosition(position) {
    var x = document.getElementById("txt-latitude");
    var y = document.getElementById("txt-longitude");
    x.value = position.coords.latitude;
    y.value = position.coords.longitude;
}


//fucntion for validating shopname
function validateShopName(shopname) {
    document.getElementById("shopname-error").innerHTML ='';
    //check if shopname is empty
    if (shopname.length == 0) {
        // alert("Coffee shop name must be filled out.");
        document.getElementById("shopname-error").innerHTML = '<p style="color:red";>Coffee shop name must be filled out!</p>';
        document.getElementById('txt-shopname').focus();
        return false;
    }
    return true;
}

// fucntion for validating descripton
function validateDescription(description) {
    document.getElementById("description-error").innerHTML ='';
    //check if description is empty
    if (description == "") {
        // alert("Description must be filled out.");
        document.getElementById("description-error").innerHTML = '<p style="color:red";>Description must be filled out!</p>';
        document.getElementById('txt-description').focus();
        return false;
    }
    return true;
}

// fucntion for validating latitude
function validateLatitude(latitude) {
    document.getElementById("geolocation-error").innerHTML ='';
    //latitude validation regex - a number
    var reNumber= /^(\-)?\d+\.?\d*$/;
    //check if latitude is empty
    if (latitude == "") {
        // alert("Latitude must be filled out.");
        document.getElementById("geolocation-error").innerHTML = '<p style="color:red";>Latitude must be filled out!</p>';
        document.getElementById('txt-latitude').focus();
        return false;
    }
    if (!reNumber.test(latitude) || (parseFloat(latitude) < -90) || (parseFloat(latitude) > 90)) {
        // alert("Latitude is invalid! \n The valid latitude should be a number between -90 and 90");
        document.getElementById("geolocation-error").innerHTML = '<p style="color:red";>Latitude is invalid! The valid latitude should be a number between -90 and 90!</p>';
        document.getElementById('txt-latitude').focus();
        return false;
    }
    return true;
}

// fucntion for validating longitude
function validateLongitude(longitude) {
    document.getElementById("geolocation-error").innerHTML ='';
    //longitude validation regex - a number
    var reNumber= /^(\-)?\d*\.?\d*$/;
    if (longitude == "") {
        // alert("Longitude must be filled out.");
        document.getElementById("geolocation-error").innerHTML = '<p style="color:red";>Longitude must be filled out!</p>';
        document.getElementById('txt-longitude').focus();
        return false;
    }
    //check if longitude is valid
    else if (!reNumber.test(longitude) || (parseFloat(longitude) < -180) || (parseFloat(longitude) > 180)) {
        // alert("Longitude is invalid! \n The valid longitude should be a number between -180 and 180");
        document.getElementById("geolocation-error").innerHTML = '<p style="color:red";>Longitude is invalid! The valid longitude should be a number between -180 and 180!</p>';
        document.getElementById('txt-latitude').focus();
        return false;
    }
    return true;
}

// fucntion for validating uploading image
function validateImageFormat(imageFilePath) {
    document.getElementById("image-error").innerHTML ='';
    //file name validation regex - it accept .jpg, .jpeg, and .png, and ingnore case
    var reImage = /\.(jpg|jpeg|png)$/i;
    if (imageFilePath == "") {
        // alert("You should upload a image.");
        document.getElementById("image-error").innerHTML = '<p style="color:red";>You should upload a image!</p>';
        return false;
    }
    //check if the image format is allowed
    else if (!reImage.test(imageFilePath)) {
        // alert("Invalid file type, please upload jpg, jpeg, or png file");
        document.getElementById("image-error").innerHTML = '<p style="color:red";>Invalid file type, please upload jpg, jpeg, or png file!</p>';
        return false;
    }
    return true;
}


// fucntion for validating uploading video
function validateVideoFormat(videoFilePath) {
    document.getElementById("video-error").innerHTML ='';
    //file name validation regex - it accept .mp4, .webm, and ingnore case
    var reVideo = /\.(mp4|webm)$/i;
    if (videoFilePath == "") {
        // alert("You should upload a video.");
        document.getElementById("video-error").innerHTML = '<p style="color:red";>You should upload a video!</p>';
        return false;
    }
    //check if the video format is allowed
    else if (!reVideo.test(videoFilePath)) {
        // alert("Invalid file type, please upload mp4 or wbem file");
        document.getElementById("video-error").innerHTML = '<p style="color:red";>Invalid file type, please upload mp4 or wbem file!</p>';
        return false;
    }
    return true;
}

