// a function to set the review form to be visible
function showForm(){
    document.getElementById("review-form").hidden = false;
}

// a function to set the review form to be invisible
function hiddenForm(){            
    document.getElementById("review-form").hidden = true;
}


// Set class name and input value of ranking when user click the first star of the ranking
function setRanking1(){
    let className1 = document.getElementById("rating1").className;
    let className2 = document.getElementById("rating2").className;
    if(className1 === "fa fa-star-o"){
        document.getElementById("rating1").className = "fa fa-star";
        document.getElementById("value-of-ranking").value = "1";
    }else if(className1 === "fa fa-star" && className2 == "fa fa-star"){
        document.getElementById("rating2").className = "fa fa-star-o";
        document.getElementById("rating3").className = "fa fa-star-o";
        document.getElementById("rating4").className = "fa fa-star-o";
        document.getElementById("rating5").className = "fa fa-star-o";
        document.getElementById("value-of-ranking").value = "1";
    }
    else{
        document.getElementById("rating1").className = "fa fa-star-o";
        document.getElementById("value-of-ranking").value = "0";                
    }            
}

// Set class name and input value of ranking when user click the second star of the ranking
function setRanking2(){
    document.getElementById("value-of-ranking").value = "2";
    let className = document.getElementById("rating2").className;
    if(className === "fa fa-star-o"){
        document.getElementById("rating1").className = "fa fa-star";
        document.getElementById("rating2").className = "fa fa-star";                
    }else{                
        document.getElementById("rating3").className = "fa fa-star-o";
        document.getElementById("rating4").className = "fa fa-star-o";
        document.getElementById("rating5").className = "fa fa-star-o";
    }
}

// Set class name and input value of ranking when user click the third star of the ranking
function setRanking3(){
    document.getElementById("value-of-ranking").value = "3";
    let className = document.getElementById("rating3").className;
    if(className === "fa fa-star-o"){
        document.getElementById("rating1").className = "fa fa-star";
        document.getElementById("rating2").className = "fa fa-star";
        document.getElementById("rating3").className = "fa fa-star";                
    }else{
        document.getElementById("rating4").className = "fa fa-star-o";
        document.getElementById("rating5").className = "fa fa-star-o";
    }
}

// Set class name and input value of ranking when user click the fourth star of the ranking
function setRanking4(){
    document.getElementById("value-of-ranking").value = "4";
    let className = document.getElementById("rating4").className;
    if(className === "fa fa-star-o"){
        document.getElementById("rating1").className = "fa fa-star";
        document.getElementById("rating2").className = "fa fa-star";
        document.getElementById("rating3").className = "fa fa-star";
        document.getElementById("rating4").className = "fa fa-star";
    }else{
        document.getElementById("rating5").className = "fa fa-star-o";
    }
}

// Set class name and input value of ranking when user click the fifth star of the ranking
function setRanking5(){
    document.getElementById("value-of-ranking").value = "5";
    let className = document.getElementById("rating5").className;
    if(className === "fa fa-star-o"){
        document.getElementById("rating1").className = "fa fa-star";
        document.getElementById("rating2").className = "fa fa-star";
        document.getElementById("rating3").className = "fa fa-star";
        document.getElementById("rating4").className = "fa fa-star";
        document.getElementById("rating5").className = "fa fa-star";
    }else{
        document.getElementById("rating5").className = "fa fa-star-o";
    }
}

// Validate the review form
function validateReviewForm(){
    let comments = document.getElementById("comments").value;
    document.getElementById("comments-error").innerHTML ='';
    //check if comments is empty
    if (comments.length == 0) {
        document.getElementById("comments-error").innerHTML = '<p style="color:red";>Comments must be filled out!</p>';
        document.getElementById('comments').focus();
        return false;
    }
    return true;
}