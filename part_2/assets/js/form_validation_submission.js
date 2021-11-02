
// registration form validation
function validateObjectSubmissionForm() {
    let shopname = document.forms["form-object-submission"]["txt-shopname"].value;    
    let description = document.forms["form-object-submission"]["txt-description"].value;
    let latitude = document.forms["form-object-submission"]["txt-latitude"].value;
    let longitude = document.forms["form-object-submission"]["txt-longitude"].value;
    let imageFilePath = document.getElementById("upload-image").value;
    // validate shopname
    if(!validateShopName(shopname)){
        return false;
    }
    // //validate description
    else if(!validateDescription(description)){
        return false;
    }
    // //validate latitude
    else if(!validateLatitude(latitude)){
        return false;
    }
    //validate longtitude
    else if(!validateLongitude(longitude)){
        return false;
    }
    //validate image format
    // else if(!validateImageFormat(imageFilePath)){
    //     return false;
    // }
    return true;  
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
    //latitude validation regex 
    //Assuming valid latitude for North America 
    //                                  - range:25 - 70, not include 70
    //                                           - before the decimal point, it might be 25 - 29 and 30 -69  
    //                                 - with at most five digit in the demical place
    var reLatitude= /^(2[5-9]|[3-6][0-9])($|\.[0-9]{1,5}$)/;
    //check if latitude is empty
    if (latitude == "") {
        alert("Latitude must be filled out.");
        document.getElementById('txt-latitude').focus();
        return false;
    }
    //check if latitude is valid
    else if(!reLatitude.test(latitude)){
        alert("Latitude is invalid! \n The valid latitude should be a number between 25 and 70, not include 70");
        document.getElementById('txt-latitude').focus();
        return false;
    }
    return true;
}

// fucntion for validating longitude
function validateLongitude(longitude) {
    //longitude validation regex 
    //Assuming valid longitude for North America 
    //                       - range: -170 - -50, not include -170 
    //                              - before the decimal point, it might be 100-169 or 50 - 99    
    //                       - with at most five digit in the demical place
    //                              - the number is end with the whole number or with a period following 1 to 5 digits
    var reLongitude= /^-(1[0-6][0-9]|[5-9][0-9])($|\.[0-9]{1,5}$)/;
    if(longitude == ""){
        alert("Longitude must be filled out.");
        document.getElementById('txt-longitude').focus();
        return false;
    }
    //check if longitude is valid
    else if(!reLongitude.test(longitude)){
        alert("Longitude is invalid! \n The valid longitude should be a number between -170 and -50, not include -170");
        document.getElementById('txt-latitude').focus();
        return false;
    }
    return password == confirmPassword;
}

// fucntion for validating uploading image
function validateImageFormat(filePath) {
    alert(filePath);
    //file name validation regex - it accept .jpg, .bmp, and .png
    var reFile= /\.(jpg|bmp|png)$/;
    if(filePath == ""){
        alert("You should upload a image.");
         return false;
    }
    //check if longitude is valid
    else if(!reFile.test(filePath)){
        alert("It only allows jpg, bmp, and png image");
        return false;
    }
    return true;
}

