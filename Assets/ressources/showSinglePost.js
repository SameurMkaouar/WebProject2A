document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  fetch(`../../Controller/fetchPost.php?id=${idPost}`)
    .then((response) => response.json())
    .then((data) => {
      const post = data;
      const postHTML = `
        <header class="entry-header">
          <div id="img-container">
            <img src="data:image/jpeg;base64,${post.post_img}" alt="erreur" />
          </div>
          <h1 class="entry-title">
            <a href="#" rel="bookmark">
            ${post.post_title}
            </a>
          </h1>
          <div class="entry-date small-text highlight">
            <a href="#" rel="bookmark">
              <timeclass="entry-date">
                ${post.post_time}</i>
              </time>
            </a>
          </div>
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
    });
});
