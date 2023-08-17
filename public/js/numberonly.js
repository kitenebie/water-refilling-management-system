//? use code: validateNumberOnly(document.getElementById("number"));

var minNumInputs = document.querySelectorAll('#minstock');
var priceNumInputs = document.querySelectorAll('#priceNum');
var prdqtyInputs = document.querySelectorAll('#prdqty');
var numberGalllonInputs = document.querySelectorAll('#numberGalllon');
var pdpriceInputs = document.querySelectorAll('#pdprice');
var pqtystockInputs = document.querySelectorAll('#pqtystock');
var addqtyStocksInputs = document.querySelectorAll('#addqtyStocks');
var feeInputs = document.querySelectorAll('#fee');
var contactInputs = document.querySelectorAll('#contact');

function validateNumberOnly(inputField) {
    var regex = /^[0-9]+$/;
    if (!regex.test(inputField.value)) {
      inputField.value = inputField.value.slice(0,-1);
      alert("Please enter only numbers in this field.");
      inputField.focus();
    }
  }

  function validateNumberWithPoint(inputField) {
    var regex = /^[0-9]*\.?[0-9]*$/;
    if (!regex.test(inputField.value)) {
        inputField.value = inputField.value.slice(0,-1);
      alert("Please enter a valid number with a decimal point.");
      inputField.focus();
    }
  }

for (var i = 0; i < minNumInputs.length; i++) {
var minNumInput = minNumInputs[i];
    minNumInput.addEventListener("input", function(event) {
        var inputField = event.target;
        validateNumberOnly(inputField);
      });
}

for (var i = 0; i < feeInputs.length; i++) {
    var feeInput = feeInputs[i];
        feeInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberWithPoint(inputField);
          });
    }

for (var i = 0; i < priceNumInputs.length; i++) {
    var priceNumInput = priceNumInputs[i];
        priceNumInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberWithPoint(inputField);
        });
    }
for (var i = 0; i < pdpriceInputs.length; i++) {
    var pdpriceInput = pdpriceInputs[i];
        pdpriceInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberWithPoint(inputField);
          });
    }

for (var i = 0; i < prdqtyInputs.length; i++) {
    var prdqtyInput = prdqtyInputs[i];
        prdqtyInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberOnly(inputField);
          });
    }


for (var i = 0; i < numberGalllonInputs.length; i++) {
    var numberGalllonInput = numberGalllonInputs[i];
        numberGalllonInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberOnly(inputField);
          });
    }

for (var i = 0; i < pqtystockInputs.length; i++) {
    var pqtystockInput = pqtystockInputs[i];
        pqtystockInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberOnly(inputField);
          });
    }


for (var i = 0; i < addqtyStocksInputs.length; i++) {
    var addqtyStocksInput = addqtyStocksInputs[i];
        addqtyStocksInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberOnly(inputField);
          });
    }


for (var i = 0; i < contactInputs.length; i++) {
    var contactInput = contactInputs[i];
        contactInput.addEventListener("input", function(event) {
            var inputField = event.target;
            validateNumberOnly(inputField);
          });
    }
