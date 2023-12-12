document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  console.log("ready");
  console.log("hello");
  fetch("../../controller/fetchPosts.php?admin=ok")
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
                      <a href="admin_post.php?id=${post.id_post}">
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
                      <div class="profile-icon">
                      <img  src="data:image/jpeg;base64,${post.Picture}" alt="erreur" style="scale=150%" />
                      </div>
                      </div>
                      <div class="media-body">
                      <h5>
                          <a href="admin_profile.html">${post.Firstname} ${post.Lastname}</a>
                      </h5>
                      &lt;${post.Email};
                      </div>
                  </div>
                  </td>
                  <td class="media-middle">${post.post_status}</td>
                </tr>
                `;
        document
          .getElementById("post-table")
          .insertAdjacentHTML("beforeend", postHTML);
      }
    });
});

document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  console.log("ready");
  console.log("hello");
  fetch("../../controller/fetchPending.php")
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
                      <a href="admin_post.php?id=${post.id_post}">
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
                      <div class="profile-icon">
                      <img  src="data:image/jpeg;base64,${post.Picture}" alt="erreur" style="scale=150%" />
                      </div>
                      </div>
                      <div class="media-body">
                      <h5>
                          <a href="admin_profile.html">${post.Firstname} ${post.Lastname}</a>
                      </h5>
                      &lt;${post.Email};
                      </div>
                  </div>
                  </td>
                  <td class="media-middle">
                  <a href="admin_post.php?id=${post.id_post}"><i class="rt-icon2-magnifier"></i></a>
                  <a href="../../controller/approvePost.php?id_post=${post.id_post}"><i class="rt-icon2-checkmark"></i></a>
                  <a href="../../controller/deletePost.php?id=${post.id_post}"><i class="rt-icon2-cancel"></i></a>

                  </td>
                </tr>
                `;
        document
          .getElementById("post-table-pending")
          .insertAdjacentHTML("beforeend", postHTML);
      }
    });
});
document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  console.log("ready");
  console.log("hello");
  fetch("../../controller/fetchPublishedPosts.php")
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
                      
                      ${post.post_title}
                     
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
                      <div class="profile-icon">
                      <img  src="data:image/jpeg;base64,${post.Picture}" alt="erreur" style="scale=150%" />
                      </div>
                      </div>
                      <div class="media-body">
                      <h5>
                          <a href="admin_profile.html">${post.Firstname} ${post.Lastname}</a>
                      </h5>
                      &lt;${post.Email};
                      </div>
                  </div>
                  </td>
                  <td class="media-middle">
                  <a href="admin_post.php?id=${post.id_post}"><i class="rt-icon2-magnifier"></i></a>
                  <a href="../../controller/deletePost.php?id=${post.id_post}"><i class="rt-icon2-cancel"></i></a>
                  </td>
                </tr>
                `;
        document
          .getElementById("post-table-published")
          .insertAdjacentHTML("beforeend", postHTML);
      }
    });
});
