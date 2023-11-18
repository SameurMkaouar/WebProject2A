document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  console.log("ready");
  fetch("../../View/FrontOffice/fetchPosts.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("ready");
      for (let i = 0; i < data.length; i++) {
        const post = data[i];

        const postHTML = `
                <tr class="item-editable">
                  <td class="media-middle text-center">
                  <form><input type="hidden" name="idPost" value="${post.id_post}"></form>
                  <input type="checkbox" />
                  </td>
                  <td class="media-middle">
                  <h5>
                      <a href="admin_post.html?id=${post.id_post}">
                      ${post.post_title}
                      </a>
                  </h5>
                  </td>
                  <td class="media-middle">
                  <time
                      class="entry-date"
                      >${post.post_time}</time
                  >
                  </td>
                  <td>
                  <div class="media">
                      <div class="media-left">
                      <img src="../../Assets/images/team/01.jpg" alt="..." />
                      </div>
                      <div class="media-body">
                      <h5>
                          <a href="admin_profile.html">Jaafer Guesmi</a>
                      </h5>
                      &lt;jaafer123@jmail.com&gt;
                      </div>
                  </div>
                  </td>
                  <td class="media-middle">Published</td>
                </tr>
                `;
        document
          .getElementById("post-table")
          .insertAdjacentHTML("beforeend", postHTML);
      }
    });
});
