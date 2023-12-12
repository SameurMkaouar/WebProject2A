$(document).ready(function () {
  var signUp = $(".signup-but");
  var logIn = $(".login-but");
  var doctorRegistrationBtn = $("#doctorRegistrationBtn");
  var doctorRegistrationForm = $(".doctor-registration");

  signUp.on("click", function () {
    $(".form-container").animate({ left: "10px" }, "slow");
    $(".login").fadeOut("slow").css("display", "none");
    $(".sign-up").fadeIn("slow");

    resetDoctorForm();
  });

  logIn.on("click", function () {
    $(".form-container").animate({ left: "400px" }, "slow");
    $(".sign-up").fadeOut("slow").css("display", "none");
    $(".login").fadeIn("slow");

    resetDoctorForm();
  });

  doctorRegistrationBtn.on("click", function (e) {
    // Only toggle the visibility of the doctor registration form
    doctorRegistrationForm.toggleClass("hide");

    // Toggle the text of the button between "Register as Doctor" and "Return"
    if (doctorRegistrationForm.hasClass("hide")) {
      resetDoctorForm();
      doctorRegistrationBtn.html('<i class="rt-icon2-user-md" ></i>');
    } else {
      doctorRegistrationBtn.html('<i class=" fa fa-user"></i>');
      $(".form-container").animate({ width: "770px" }, "slow");
      // Prevent the default form submission
    }
    e.preventDefault();
  });

  // Function to reset the doctor registration form
  function resetDoctorForm() {
    doctorRegistrationForm.addClass("hide");
    $(".form-container").animate({ width: "375px" }, "slow");
    // Reset any specific form styling or content here
    // For example, hide specific fields or reset input values
    // ...
  }
});
