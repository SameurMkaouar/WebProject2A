document.addEventListener("DOMContentLoaded", function () {
  var validEmailDomains = ["esprit.tn", "gmail.com", "yahoo.fr"];

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
    function setBorderColor(element, isValid) {
      element.style.borderColor = isValid ? "green" : "red";
    }

    // Validate and set border color for firstname
    var isFirstnameValid = /^[a-zA-Z]+$/.test(firstname.value);
    setBorderColor(firstname, isFirstnameValid);

    // Validate and set border color for lastname
    var isLastnameValid = /^[a-zA-Z]+$/.test(lastname.value);
    setBorderColor(lastname, isLastnameValid);

    // Validate and set border color for username
    var isUsernameValid = /^[a-zA-Z]+$/.test(username.value);
    setBorderColor(username, isUsernameValid);

    // Validate and set border color for date of birth
    var isDateValid = dateofbirth.value >= min && dateofbirth.value <= max;
    setBorderColor(dateofbirth, isDateValid);

    // Validate and set border color for email
    var domain = email.value.split("@")[1];
    var isEmailValid = domain && validEmailDomains.indexOf(domain) !== -1;
    setBorderColor(email, isEmailValid);

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
  });

  document.getElementById("login-email").addEventListener("keyup", function () {
    var email = document.getElementById("login-email").value;
    var EmailMsg = document.getElementById("email-controle");

    // Extract the domain from the email
    var domain = email.split("@")[1];

    if (!domain || validEmailDomains.indexOf(domain) === -1) {
      EmailMsg.innerHTML = "Invalid email domain";
      EmailMsg.style.color = "darkred";
    } else {
      EmailMsg.innerHTML = "Correct";
      EmailMsg.style.color = "darkgreen";
    }
  });
});
