document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  console.log("ready");
  fetch("../../View/FrontOffice/fetchComments.php?id_user=1")
    .then((response) => response.json())
    .then((data) => {
      console.log("ready");
      for (let i = 0; i < data.length; i++) {
        const comment = data[i];
        const date = formatDate(comment.comment_time);
        const postHTML = `
                  <tr class="item-editable">
                    <td class="media-middle text-center">
                    <form><input type="hidden" name="idComment" value="${comment.id_comment}"></form>
                    <input type="checkbox" />
                    </td>
                    <td class="media-middle">
                    <h5>
                        <a href="#">
                        ${comment.comment_content}
                        </a>
                    </h5>
                    </td>
                    <td class="media-middle">
                    <time
                        class="entry-date"
                        >${date}</time
                    >
                    </td>
                    <td class="media-middle">Published</td>
                  </tr>
                  `;
        document
          .getElementById("comment-table")
          .insertAdjacentHTML("beforeend", postHTML);
      }
    });
});

function formatDate(date) {
  const options = {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  };

  return new Date(date).toLocaleString("en-GB", options).replace(",", " at");
}
