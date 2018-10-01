//function to show conflict with existing usernames
function showConflict(str) {
    if (str.length == 0) { 
        document.getElementById("conflict").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("conflict").innerHTML = this.responseText;
								if (this.responseText == ""){
									//document.getElementById("submit").disabled = true;
									document.getElementById("password").hidden = false;
									document.getElementById("passConfirm").hidden = false;
									document.getElementById("matchAlertContain").hidden = false;
								} else {
									document.getElementById("password").hidden = true;
									document.getElementById("passConfirm").hidden = true;
									document.getElementById("matchAlertContain").hidden = true;
								}
            }
        };
        xmlhttp.open("GET", "getUsers.php?q=" + str, true);
        xmlhttp.send();
    }
}

//function to show conflict with existing usernames
function cardConflict(str) {
    if (str.length == 0) { 
        document.getElementById("ccConflict").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ccConflict").innerHTML = this.responseText;
								if (this.responseText != ""){
									document.getElementById("submit").disabled = true;
								} else {
									document.getElementById("submit").disabled = false;
								}
            }
        };
        xmlhttp.open("GET", "getCard.php?q=" + str, true);
        xmlhttp.send();
    }
}
//clear the comments form
function clearForm(){
	document.getElementById("name").value = '';
	document.getElementById("email").value = '';
	document.getElementById("comments").value = '';
	return;
}
function redirectHome() {
	location.href = "index.php";
	return 0;
}
function redirectAccount() {
	location.href = "account.php";
	return 0;
}
function validateForm() {
	
	var properPass = /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{2,}$/; //must contain at least one digit
	// /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/ //must contain at least one uppercase												
	var x = document.forms["myForm"]["password"].value;
  var y = document.forms["myForm"]["passConfirm"].value;
	
	if (x != y) {
        alert("Passwords must match.");
        return false;
    }
	if (!properPass.test(x)) {
		alert("Password must contain at least one digit and one uppercase letter.");
		return false;
	}
	return;
}

function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var passConfirm = document.getElementById("passConfirm").value;
		if (password.length == 0){
			document.getElementById("submit").disabled = true;
			document.getElementById("matchAlert").className = "glyphicon glyphicon-unchecked";
		} else if (password != passConfirm) {
			//document.getElementById("matchAlert").innerHTML = "<span class='glyphicons glyphicons-unchecked'></span>";//"Passwords do not match!";
			//disable submit
			document.getElementById("submit").disabled = true;
			document.getElementById("matchAlert").className = "glyphicon glyphicon-unchecked";
		}	else {
			document.getElementById("matchAlert").className = "glyphicon glyphicon-check";
			document.getElementById("submit").disabled = false;
		}
}

function loginHandler() {
	//get values from login fields -- verified working	
	str1 = document.getElementById("user").value;
	str2 = document.getElementById("pass").value;

	//alert("DEBUG");

  if (str1.length == 0) { 				//error and break when no username entered -- verified working 
    document.getElementById("login-error").innerHTML = "No Username Entered";
    return;
  } else if ((str2.length == 0)) {//error and break when no password entered -- verified working
		document.getElementById("login-error").innerHTML = "No Password Entered";
    return;
	} else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
				if (str2 === this.responseText) {//valid password
					//setSession(str1);
					//clear any login errors
					document.getElementById("login-error").innerHTML = "";
					//hide the login link
					document.getElementById("login-link").disabled = true;
					//reveal account and log out links
					document.getElementById("account-link").disabled = false;
					document.getElementById("logout-link").disabled = false;
				} else {
					document.getElementById("login-error").innerHTML = "Invalid Login Attempt";
				}
      }
		};
		xmlhttp.open("GET", "loginUsers.php?u=" + str1, true); //pass in username, returns password
		xhttp.send();
  }
}
//simple ajax function to set the php session variable $_SESSION["username"]
function setSession(str){
	if (str.length == 0){	//no username; should never be called this way but...
		return;
	} else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//return 200		
				//or do some other stuff
			}
		};
		xmlhttp.open("GET", "setSession.php?u=" + str, true);
		xhttp.send();
	}
}
