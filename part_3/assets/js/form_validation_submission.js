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
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
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
    //check if shopname is empty
    if (shopname.length == 0) {
        alert("Coffee shop name must be filled out.");
        document.getElementById('txt-shopname').focus();
        return false;
    }
    return true;
}

// fucntion for validating descripton
function validateDescription(description) {
    //check if description is empty
    if (description == "") {
        alert("Description must be filled out.");
        document.getElementById('txt-description').focus();
        return false;
    }
    return true;
}

// fucntion for validating latitude
function validateLatitude(latitude) {
    //latitude validation regex - a number
    var reNumber= /^(\-)?\d+\.?\d*$/;
    //check if latitude is empty
    if (latitude == "") {
        alert("Latitude must be filled out.");
        document.getElementById('txt-latitude').focus();
        return false;
    }
    if (!reNumber.test(latitude) || (parseFloat(latitude) < -90) || (parseFloat(latitude) > 90)) {
        alert("Latitude is invalid! \n The valid latitude should be a number between -90 and 90");
        document.getElementById('txt-latitude').focus();
        return false;
    }
    return true;
}

// fucntion for validating longitude
function validateLongitude(longitude) {
    //longitude validation regex - a number
    var reNumber= /^(\-)?\d*\.?\d*$/;
    if (longitude == "") {
        alert("Longitude must be filled out.");
        document.getElementById('txt-longitude').focus();
        return false;
    }
    //check if longitude is valid
    else if (!reNumber.test(longitude) || (parseFloat(longitude) < -180) || (parseFloat(longitude) > 180)) {
        alert("Longitude is invalid! \n The valid longitude should be a number between -180 and 180");
        document.getElementById('txt-latitude').focus();
        return false;
    }
    return true;
}

// fucntion for validating uploading image
function validateImageFormat(imageFilePath) {
    //file name validation regex - it accept .jpg, .jpeg, and .png, and ingnore case
    var reImage = /\.(jpg|jpeg|png)$/i;
    if (imageFilePath == "") {
        alert("You should upload a image.");
        return false;
    }
    //check if the image format is allowed
    else if (!reImage.test(imageFilePath)) {
        alert("Invalid file type, please upload jpg, jpeg, or png file");
        return false;
    }
    return true;
}


// fucntion for validating uploading video
function validateVideoFormat(videoFilePath) {
    //file name validation regex - it accept .mp4, .webm, and ingnore case
    var reVideo = /\.(mp4|webm)$/i;
    if (videoFilePath == "") {
        alert("You should upload a video.");
        return false;
    }
    //check if the video format is allowed
    else if (!reVideo.test(videoFilePath)) {
        alert("Invalid file type, please upload mp4 or wbem file");
        return false;
    }
    return true;
}

