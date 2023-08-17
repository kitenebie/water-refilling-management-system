
var password = document.getElementById("password");
var confirmPassword = document.getElementById("confirmPassword");

function validatePassword(inputField) {
  // Check if the password contains at least one character, one symbol, and one number.
  var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=])[a-zA-Z0-9@#$%^&+=]{12,}$/;
  if (!regex.test(inputField.value)) {
    // Display an error message.
    document.getElementById("passwordError").innerHTML = "Password must be at least 12 characters long and contain at least one character, one symbol, and one number.";
  }else{
    document.getElementById("password").style.border = "1px solid green";
    document.getElementById("passwordError").innerHTML = "";
}
}

function confirmpwd(inputField){
    if (inputField.value != password.value) {
        // Set the border of the confirm password input field to red.
        inputField.style.border = "1px solid red";
        document.getElementById("ConfpasswordError").innerHTML = "Password Not Match";
    }else{
        inputField.style.border = "1px solid green";
        document.getElementById("ConfpasswordError").innerHTML = "";
    }
}

  password.addEventListener("input", function(event) {
    var inputField = event.target;
    validatePassword(inputField);
  });
  confirmPassword.addEventListener("input", function(event) {
    var inputField = event.target;
    confirmpwd(inputField);
  });
