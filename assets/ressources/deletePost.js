document.getElementById("delete-button").addEventListener("click", function () {
  var checkboxes = document.querySelectorAll("input:checked");
  checkboxes.forEach(function (checkbox) {
    console.log(checkbox);
    //RECUPERER ID DU POST
    var id = checkbox.previousElementSibling.elements["idPost"].value;
    fetch(`../../controller/deletePost.php?id=${id}`)
      .then((response) => {
        location.reload();
      })
      .then((data) => console.log(data))
      .catch((error) => console.error("Error:", error));
  });
});