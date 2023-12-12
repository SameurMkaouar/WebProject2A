document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM Content Loaded");

  // Function to show the alert
  function showAlert() {
    var alert = document.querySelector(".alert-top");

    // Add show class to trigger the animation
    alert.classList.add("show");

    // Set a timeout to remove the show class after the animation duration
    setTimeout(function () {
      alert.classList.remove("show");
      alert.classList.add("hide");
    }, 5000); // Adjust the time based on your animation duration
  }

  // Close the alert when the close button is clicked
  document.getElementById("close").addEventListener("click", function () {
    var alert = document.querySelector(".alert-top");
    alert.classList.remove("show");
    alert.classList.add("hide");
  });

  // Example usage
  showAlert();
});
