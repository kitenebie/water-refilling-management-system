//? Use code: validateTextOnly(document.getElementById("name"));

var UserInputs = document.querySelectorAll('#userPname');
var firstname = document.querySelectorAll('#firstname');
var lastname = document.querySelectorAll('#lastname');
function validateTextOnly(inputField) {
    var regex = /^[a-zA-Z ]+$/;
    if (!regex.test(inputField.value)) {
      inputField.value = inputField.value.slice(0,-1);
      alert("Please enter only letters in this field.");
      inputField.focus();
      return false;
    }
    return true;
}

for (var i = 0; i < UserInputs.length; i++) {
  var UserInputsInput = UserInputs[i];
      UserInputsInput.addEventListener("input", function(event) {
          var inputField = event.target;
          validateTextOnly(inputField);
        });
  }

for (var i = 0; i < firstname.length; i++) {
  var Userfirstname = firstname[i];
      Userfirstname.addEventListener("input", function(event) {
          var inputField = event.target;
          validateTextOnly(inputField);
        });
  }

for (var i = 0; i < lastname.length; i++) {
  var Userlastname = lastname[i];
      Userlastname.addEventListener("input", function(event) {
          var inputField = event.target;
          validateTextOnly(inputField);
        });
  }
