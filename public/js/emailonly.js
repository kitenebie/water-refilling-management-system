
//? use code: validateEmail(document.getElementById("email"));
function validateEmail(inputField) {
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!regex.test(inputField.value)) {
      alert("Please enter a valid email address.");
      inputField.focus();
      return false;
    }
    return true;
  }
