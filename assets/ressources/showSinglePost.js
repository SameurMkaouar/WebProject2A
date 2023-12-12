document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  fetch(`../../controller/fetchPost.php?id=${idPost}`)
    .then((response) => response.json())
    .then((data) => {
      const post = data;
      const postHTML = `
        <header class="entry-header">
        
          <div id="img-container" >
            <img src="data:image/jpeg;base64,${post.post_img}" alt="erreur" />
          </div>
          <div class="media">
          <div class="media-left">
          <div class="profile-icon">
             <img  src="data:image/jpeg;base64,${post.Picture}" alt="erreur" style="scale=150%" />
          </div>
          </div>
          <div class="media-body">
            <h5>
              <a href="../../view/frontoffice/test.php?id=${post.id_user}">Author: ${post.Lastname} ${post.Firstname}</a>
            </h5>
            <div class="entry-date small-text highlight">
          <a href="blog-right.html" rel="bookmark">
              <time class="entry-date" >
              on ${post.post_time} 
              </time>
          </a>
          </div>
          </div>
        </div>
          <h1 class="entry-title">
            <a href="#" rel="bookmark">
            ${post.post_title}
            </a>
          </h1>
          <hr class="divider_30_1" />
        </header>
        <div class="entry-content">
          <p>${post.post_content}</p>
        </div>`;
      document
        .getElementById("post")
        .insertAdjacentHTML("afterbegin", postHTML);

      //AJOUTER IDPOST AU COMMENTAIRE
      const hiddenIdPost = `<input hidden name="id_post" value="${post.id_post}"/>`;
      document
        .getElementById("comment_form")
        .insertAdjacentHTML("afterbegin", hiddenIdPost);
      //AFFICHER BOUTONS DELETE UPDATE
      showEditButtons(post.id_user, post.id_post);
    });
});

function showEditButtons(idUser, idPost) {
  fetch(`../../controller/checkUser.php?id_user=${idUser}`)
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      if (data == "1") {
        const html = `<button
                style="margin: 25px"
                class="theme_button"
                onclick="window.location.href = 'blog-form-update.html?id=${idPost}';"
              ><i class="rt-icon2-files"></i>
                Update Post
              </button>

              <button
                style="margin: 25px"
                class="theme_button"
                onclick="window.location.href = '../../controller/deletePost.php?id=${idPost}';"
              ><i class="rt-icon2-trashcan"></i>
                Delete Post 
              </button>`;
        document
          .getElementById("button-user")
          .insertAdjacentHTML("afterbegin", html);
      }
    });
}
