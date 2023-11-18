// function enableEditingContent() {
//   var contentArea = document.getElementById("contentArea");
//   var textarea = document.createElement("textarea");
//   textarea.style.width = "100%";
//   textarea.style.height = "100%";
//   textarea.selectionStart = 0;
//   textarea.selectionEnd = 0;
//   textarea.value = contentArea.innerHTML;
//   contentArea.parentNode.replaceChild(textarea, contentArea);
//   textarea.focus();
//   textarea.addEventListener("blur", function () {
//     var newContentArea = document.createElement("p");
//     newContentArea.id = "contentArea";
//     newContentArea.setAttribute("onclick", "enableEditingContent()");
//     //VERIFIE SI LA CHAINE MODIFIER EST VIDE OU NON SI VIDE METTRE VALEUR PAR DEFAUT ET AFFICHE ERREUR
//     textarea.value = textarea.value.trim();
//     if (textarea.value == "") {
//       textarea.value = "Post content here ...";
//       var alerte = `<div
//           class="alert alert-danger"
//           style="margin: 25px"
//           role="alert"
//         >
//           <button type="button" class="close" data-dismiss="alert">
//             <span aria-hidden="true">×</span>
//             <span class="sr-only">Close</span>
//           </button>
//           <strong>Oops !</strong> Ne laisse pas le contenu du post vide !
//         </div>`;
//       document
//         .getElementById("alert-container")
//         .insertAdjacentHTML("beforeend", alerte);
//     }
//     newContentArea.textContent = textarea.value;
//     textarea.parentNode.replaceChild(newContentArea, textarea);
//     POSTinputs();
//   });
// }

// function enableEditingTitle() {
//   var contentArea = document.getElementById("titleArea");
//   var textarea = document.createElement("textarea");
//   textarea.style.width = "100%";
//   textarea.style.height = "100%";
//   textarea.selectionStart = 0;
//   textarea.selectionEnd = 0;
//   textarea.value = contentArea.innerHTML;
//   contentArea.parentNode.replaceChild(textarea, contentArea);
//   textarea.focus();
//   textarea.addEventListener("blur", function () {
//     //VERIFIE SI LA CHAINE MODIFIER EST VIDE OU NON SI VIDE METTRE VALEUR PAR DEFAUT ET AFFICHE ERREUR
//     textarea.value = textarea.value.trim();
//     var newContentArea = document.createElement("div");
//     if (textarea.value == "") {
//       textarea.value = "Post title here ...";
//       var alerte = `<div
//           class="alert alert-danger"
//           style="margin: 25px"
//           role="alert"
//         >
//           <button type="button" class="close" data-dismiss="alert">
//             <span aria-hidden="true">×</span>
//             <span class="sr-only">Close</span>
//           </button>
//           <strong>Oops !</strong> Veuillez mettre un titre approprié !
//         </div>`;
//       document
//         .getElementById("alert-container")
//         .insertAdjacentHTML("beforeend", alerte);
//     }
//     var newTitle = `<a
//     rel="bookmark"
//     id="titleArea"
//     onclick="enableEditingTitle()"
//     >${textarea.value}</a>`;
//     newContentArea.innerHTML = newTitle;
//     textarea.parentNode.replaceChild(newContentArea, textarea);
//     POSTinputs();
//   });
// }

function updateCurrentTime() {
  var now = new Date();
  var formattedTime = now.toLocaleTimeString("en-US", {
    month: "long",
    day: "numeric",
    year: "numeric",
  });
  var entryDateElement = document.querySelector(".entry-date");
  entryDateElement.textContent = formattedTime;
}

function POSTinputs() {
  var form = document.getElementById("publish-form");
  var titleValue = document.getElementById("titleArea").innerText;
  var contentValue = document.getElementById("contentArea").innerText;

  var ptitle = document.createElement("input");
  ptitle.type = "hidden";
  ptitle.name = "ptitle";
  ptitle.value = titleValue;

  var pcontent = document.createElement("input");
  pcontent.type = "hidden";
  pcontent.name = "pcontent";
  pcontent.value = contentValue;

  form.appendChild(pcontent);
  form.appendChild(ptitle);
}

updateCurrentTime();
POSTinputs();

// document
//   .getElementById("publish_button")
//   .addEventListener("click", function (event) {
//     const titre = document.getElementById("titleArea").innerHTML.trim();
//     const content = document.getElementById("contentArea").innerHTML.trim();
//     console.log(titre, content);
//     var postData = {
//       ptitle: titre,
//       pcontent: content,
//     };

//     fetch("../../Controller/createPost.php", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify(postData),
//     })
//       .then((response) => response.json())
//       .then((data) => console.log(data))
//       .catch((error) => console.error("Error:", error));
//   });
