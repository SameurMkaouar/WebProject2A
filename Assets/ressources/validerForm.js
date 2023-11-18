function validerForm(event) {
  var titre = document.getElementById("post_title").value.trim();
  var content = document.getElementById("post_content").value.trim();
  var categorie = document.getElementById("with-selected").value;
  var img = document.getElementById("img");

  clearAlerts();

  var erreur = false;
  if (titre == "") {
    event.preventDefault();
    messageErreur("Le titre du post est vide !");
    erreur = true;
  }

  if (titre.length > 200) {
    event.preventDefault();
    messageErreur(
      "La longeur du titre a dépassée la limite de 200 caracteres !"
    );
    erreur = true;
  }

  if (content == "") {
    event.preventDefault();
    messageErreur("Le contenu du post est vide !");
    erreur = true;
  }

  if (categorie == "") {
    event.preventDefault();
    messageErreur("Choisissez une categorie pour votre post !");
    erreur = true;
  }

  if (img.files.length != 0) {
    if (!img.files[0].type.startsWith("image/")) {
      event.preventDefault();
      messageErreur("Choisissez un fichier de type image!");
      erreur = true;
    }
  }

  redirigerVersAlerte();
  return true ? erreur == false : false;
}

function messageErreur(message) {
  var alerte = `<div
        class="alert alert-danger"
        style="margin: 25px"
        role="alert"
        >
        <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
        <span class="sr-only">Close</span>
        </button>
        <strong>Oops !</strong> ${message}
        </div>`;
  document
    .getElementById("alert-container")
    .insertAdjacentHTML("beforeend", alerte);
}

function clearAlerts() {
  document.getElementById("alert-container").innerHTML = "";
}

function redirigerVersAlerte() {
  document
    .getElementById("alert-container")
    .scrollIntoView({ behavior: "smooth", block: "start" });
}
