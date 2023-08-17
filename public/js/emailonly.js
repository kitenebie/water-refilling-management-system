
//? use code: validateEmail(document.getElementById("email"));
var user = document.querySelectorAll('#username');

function validateEmail(inputField) {
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!regex.test(inputField.value)) {
      alert("Please enter a valid email address.");
      inputField.value = "";
      inputField.focus();
      return false;
    }
    return true;
  }

  for (var i = 0; i < user.length; i++) {
    var uname = user[i];
        uname.addEventListener("change", function(event) {
            var inputField = event.target;
            validateEmail(inputField);
          });
    }
