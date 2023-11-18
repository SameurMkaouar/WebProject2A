document.getElementById("delete-button").addEventListener("click", function () {
  var checkboxes = document.querySelectorAll("input:checked");
  checkboxes.forEach(function (checkbox) {
    //RECUPERER ID DU POST
    var id = checkbox.previousElementSibling.elements["idPost"].value;
    fetch(`../../Controller/deletePost.php?id=${id}`)
      .then((response) => {
        location.reload();
      })
      .then((data) => console.log(data))
      .catch((error) => console.error("Error:", error));
  });
});
