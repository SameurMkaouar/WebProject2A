document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  fetch("../../Controller/fetchPosts.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("selem");
      //   console.log(data[0]);
      //   console.log(data.length);
      for (let i = 0; i < data.length; i++) {
        const post = data[i];
        // console.log(post);
        postContent = post.post_content;
        const previewLimit = 250;
        if (postContent.length > previewLimit) {
          postContent = postContent.substring(0, previewLimit) + "...";
        }
        const postHTML = `
                <div class="col-sm-10 col-sm-push-1">
                    <article class="vertical-item content-padding post format-standard with_shadow">
                        <div class="item-media entry-thumbnail">
                            <img src="data:image/jpeg;base64,${post.post_img}" alt="erreur" />
                            <div class="media-links">
                                <a class="abs-link" title="" href="blog-single-full.html?id=${post.id_post}"></a>
                            </div>
                        </div>
                        <div class="item-content entry-content">
                        <header class="entry-header">
                            <div class="entry-date small-text highlight">
                            <a href="blog-right.html" rel="bookmark">
                                <time class="entry-date" >
                                ${post.post_time} 
                                </time>
                            </a>
                            </div>

                            <h4 class="entry-title">
                            <a href="blog-single-full.html?id=${post.id_post}" rel="bookmark">${post.post_title}</a>
                            </h4>

                            <hr class="divider_30_1" />
                        </header>
                        <p>
                            ${postContent} 
                        </p>
                        </div>
                        <!-- .item-content.entry-content -->
                    </article>
                </div>
            `;
        document
          .getElementById("post-container")
          .insertAdjacentHTML("beforeend", postHTML);
      }
    });
});
