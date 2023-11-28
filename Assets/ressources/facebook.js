function shareOnFacebook(event) {
  event.preventDefault();
  var ngrokUrl = "https://logical-hagfish-honest.ngrok-free.app";
  var currentPath = window.location.pathname;
  var currentArgs = window.location.search;
  var shareUrl =
    "https://www.facebook.com/sharer/sharer.php?u=" +
    encodeURIComponent(ngrokUrl + currentPath + currentArgs);
  window.open(shareUrl, "_blank");
}
