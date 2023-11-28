document.getElementById("delete-button").addEventListener("click", function () {
  var checkboxes = document.querySelectorAll("input:checked");
  checkboxes.forEach(function (checkbox) {
    //RECUPERER ID DU Commentaire
    var id = checkbox.previousElementSibling.elements["idComment"].value;
    fetch(`../../View/FrontOffice/deleteComment.php?id=${id}`)
      .then((response) => {
        location.reload();
      })
      .then((data) => console.log(data))
      .catch((error) => console.error("Error:", error));
  });
});
