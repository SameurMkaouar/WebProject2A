document.addEventListener("DOMContentLoaded", function () {
  var notification = document.getElementById("notification");

  // Hide the notification after 3 seconds (adjust as needed)
  setTimeout(function () {
    notification.style.display = "none";
  }, 5000);

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  function setBorderColor(element, isValid) {
    element.style.borderColor = isValid ? "green" : "red";
  }

  document.getElementById("form").addEventListener("submit", function (e) {
    var firstname = document.getElementById("login-name");
    var lastname = document.getElementById("login-lastname");
    var username = document.getElementById("login-username");
    var dateofbirth = document.getElementById("login-DateOfBirth");
    var email = document.getElementById("login-email");
    var password = document.getElementById("login-password");

    var firstnameMsg = document.getElementById("firstname-controle");
    var lastnameMsg = document.getElementById("lastname-controle");
    var usernameMsg = document.getElementById("username-controle");
    var DateMsg = document.getElementById("date-controle");
    var EmailMsg = document.getElementById("email-controle");
    var radioMsg = document.getElementById("radio-controle");

    const min = "1980-01-01";
    const max = "2005-12-31";

    // Function to set border color based on validity

    // Validate and set border color for firstname
    var isFirstnameValid = /^[a-zA-Z]+$/.test(firstname.value);
    setBorderColor(firstname, isFirstnameValid);
    firstnameMsg.innerHTML = isFirstnameValid
      ? ""
      : "please enter a name full of caracters";
    firstnameMsg.style.color = "darkred";

    // Validate and set border color for lastname
    var isLastnameValid = /^[a-zA-Z]+$/.test(lastname.value);
    setBorderColor(lastname, isLastnameValid);
    firstnameMsg.innerHTML = isLastnameValid
      ? ""
      : "please enter a name full of caracters";
    firstnameMsg.style.color = "darkred";

    // Validate and set border color for username
    var isUsernameValid = /^[a-zA-Z]+$/.test(username.value);
    setBorderColor(username, isUsernameValid);
    usernameMsg.innerHTML = isUsernameValid
      ? ""
      : "please enter a name full of caracters";
    usernameMsg.style.color = "darkred";

    // Validate and set border color for date of birth
    var isDateValid = dateofbirth.value >= min && dateofbirth.value <= max;
    setBorderColor(dateofbirth, isDateValid);
    DateMsg.innerHTML = isDateValid ? "" : "you must be 18 atleast";
    DateMsg.style.color = "darkred";

    // Validate and set border color for email

    var isEmailValid = emailRegex.test(email.value);
    setBorderColor(email, isEmailValid);
    EmailMsg.innerHTML = isEmailValid
      ? ""
      : "Please enter a valid email address.";

    // Validate and set border color for radio buttons
    var radioButtons = document.getElementsByName("sex");
    var isRadioChecked = false;

    for (var i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
        isRadioChecked = true;
        break;
      }
    }

    setBorderColor(radioButtons[0], isRadioChecked);
    radioMsg.innerHTML = isRadioChecked ? "" : "Please select an option";
    radioMsg.style.color = "darkred";

    // Note: Password validation is not included in this example, you can add it similarly

    // Prevent form submission if any validation fails
    if (
      !(
        isFirstnameValid &&
        isLastnameValid &&
        isUsernameValid &&
        isDateValid &&
        isEmailValid &&
        isRadioChecked
      )
    ) {
      e.preventDefault();
    }

    // Check if the doctor registration form is visible
    var isDoctorFormVisible = !document
      .querySelector(".doctor-registration")
      .classList.contains("hide");

    if (isDoctorFormVisible) {
      var region = document.getElementById("region");
      var city = document.getElementById("city");
      var street = document.getElementById("street");
      var postalCode = document.getElementById("postal_code");

      var RegionMsg = document.getElementById("region-controle");
      var CityMsg = document.getElementById("city-controle");
      var streetMsg = document.getElementById("street-controle");
      var codeMsg = document.getElementById("code-controle");

      var isRegionValid = /^[a-zA-Z]+$/.test(region.value);
      setBorderColor(region, isRegionValid);
      RegionMsg.innerHTML = isRegionValid ? "" : "please enter a valid region ";
      RegionMsg.style.color = "darkred";

      var isCityValid = /^[a-zA-Z]+$/.test(city.value);
      setBorderColor(region, isCityValid);
      CityMsg.innerHTML = isCityValid ? "" : "please enter a valid city ";
      CityMsg.style.color = "darkred";

      var isstreetValid = /^[a-zA-Z]+$/.test(street.value);
      setBorderColor(region, isstreetValid);
      streetMsg.innerHTML = isstreetValid
        ? ""
        : "please enter a valid street name ";
      streetMsg.style.color = "darkred";

      var isPostalCodeValid = /^\d{4}$/.test(postalCode.value);
      setBorderColor(postalCode, isPostalCodeValid);
      codeMsg.innerHTML = isPostalCodeValid
        ? ""
        : "Please enter a valid postal code.";
      codeMsg.style.color = "darkred";
      // Check if any of the doctor fields is empty
      if (
        !(isRegionValid && isCityValid && isstreetValid && isPostalCodeValid)
      ) {
        e.preventDefault();
      }
    }
  });
});
