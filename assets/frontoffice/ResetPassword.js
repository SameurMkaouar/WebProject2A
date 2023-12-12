document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("form").addEventListener("submit", function (e) {
    var password = document.getElementById("password").value;
    var password_confirmation = document.getElementById(
      "password-confirmation"
    ).value;
    if (password !== password_confirmation) {
      e.preventDefault();
      alert("Passwords do not match. Please try again.");
      // Prevent the form submission
    }
  });
});
