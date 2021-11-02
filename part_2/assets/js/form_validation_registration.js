
// registration form validation
function validateRegistrationForm() {
    let username = document.forms["form-registration"]["txt-username"].value;
    let email = document.forms["form-registration"]["txt-email"].value;
    let password = document.forms["form-registration"]["txt-password"].value;
    let confirmPassword = document.forms["form-registration"]["txt-confirm-password"].value;
    let userAgreement = document.forms["form-registration"].terms;
    // validate username
    if(!validateUserName(username)){
        return false;
    }
    //validate email address
    else if(!validateEmail(email)){
        return false;
    }
    //validate password
    else if(!validatePassword(password)){
        return false;
    }
    //validate the confirmed password
    else if(!validateConfirmPassword(password, confirmPassword)){
        return false;
    }
    //check if the uuser accept the terms
    else if(!userAgreement.checked){
        alert("Please indicate that you accept the terms");
        return false;
    }
    return true;  
}


//fucntion for validating username
function validateUserName(username) {
    //check if username is empty
    if (username.length == 0) {
        alert("Username must be filled out.");
        document.getElementById('txt-username').focus();
        return false;
    }else if(username.length < 6){
        alert("Username should contain at least 6 character");
        document.getElementById('txt-username').focus();
        return false;
    }
    //check if username is too short
    return true;
}

// fucntion for validating email address
function validateEmail(email) {
    //email validation regex 
    //Valid email - start with at least one character that is not @
    //            - then an @ character
    //            - then at least one character that is not @
    //            - then a period and at least two letters
    var reEmail = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
    //check if email is empty
    if (email == "") {
        alert("Email must be filled out.");
        document.getElementById('txt-email').focus();
        return false;
    }
    //check if email is valid
    else if(!reEmail.test(email)){
        alert("Email is invalid");
        document.getElementById('txt-email').focus();
        return false;
    }
    return true;
}


// fucntion for validating password
function validatePassword(password) {
    //password validation regex 
    //Valid password contains - minimum 6 characters   .{6,}
    //                        - at least one lowercase letter: (?=.*?[a-z]) 
    //                        - at least one uppercase letter: (?=.*?[A-Z])
    var rePassword= /^(?=.*?[a-z])(?=.*?[A-Z]).{6,}$/;
    //check if password is empty
    if (password == "") {
        alert("Password must be filled out.");
        document.getElementById('txt-password').focus();
        return false;
    }
    //check if password is valid
    else if(!rePassword.test(password)){
        alert("Password is invalid! \n The password should contains minimum 6 characters, at least one lowercase letter, one uppercase letter");
        document.getElementById('txt-password').focus();
        return false;
    }
    return true;
}

// fucntion for validating confirmed password
function validateConfirmPassword(password, confirmPassword) {
    if(confirmPassword == ""){
        alert("Confirm password must be filled out.");
        document.getElementById('txt-confirm-password').focus();
        return false;
    }
    else if(password != confirmPassword){
        alert("Passwords do not match.");
        document.getElementById('txt-confirm-password').focus();
        return false;
    }
    return true;
}
