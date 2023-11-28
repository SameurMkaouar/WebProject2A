document.addEventListener("DOMContentLoaded", function () {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  fetch("../../View/FrontOffice/fetchPosts.php")
    .then((response) => response.json())
    .then((data) => {
      AfficherPosts(data);
    });
});

function fetchPosts(sortType) {
  const activeTags = document.querySelectorAll(".tagcloud a.active");
  const tagString = Array.from(activeTags)
    .map((tag) => tag.textContent.trim().toLowerCase())
    .join("-");

  const URL =
    "../../View/FrontOffice/FetchPosts.php?sort=" +
    sortType +
    "&tags=" +
    tagString;
  console.log(URL);
  fetch(URL)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("post-container").innerHTML = "";
      AfficherPosts(data);
    });
}

function AfficherPosts(data) {
  for (let i = 0; i < data.length; i++) {
    const post = data[i];
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
                            <a href="blog-single-full.html?id=${post.id_post}" rel="bookmark">${post.post_title}</a><div id="tag-container"></div>
                            </h4>
                            <div id="tag-container"></div>

                            <hr class="divider_30_1" />
                        </header>
                        <p>
                            ${postContent} 
                        </p>
                        </div>
                        <!-- .item-content.entry-content -->
                        <div class="rating">
                          <!-- Thumbs up -->
                          <form><input type="hidden" name="id_post" value="${post.id_post}"></form>
                          <div class="like grow">
                            <i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>
                            <p>${post.post_likes}</p>
                          </div>
                          <!-- Thumbs down -->
                          <div class="dislike grow">
                            <i class="fa fa-thumbs-down fa-3x" aria-hidden="true"></i>
                            <p>${post.post_dislikes}</p>
                          </div>
                          <div class="comments">
                            <i class="fa fa-comments-o fa-3x" aria-hidden="true"></i>
                            <p>${post.post_comments}</p>
                          </div>
                        </div>
                    </article>
                </div>
            `;
    document
      .getElementById("post-container")
      .insertAdjacentHTML("beforeend", postHTML);

    //ACTIVATE OLD REACTS
    const insertedPost =
      document.getElementById("post-container").lastElementChild;
    fetch(`checkReactStatus.php?id_post=${post.id_post}&react=dislike`)
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() == "True") {
          insertedPost.querySelector(".dislike").classList.add("active");
        }
      });
    fetch(`checkReactStatus.php?id_post=${post.id_post}&react=like`)
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() == "True") {
          insertedPost.querySelector(".like").classList.add("active");
        }
      });
    //ADD TAGS
    const tagsArray = post.post_categorie.split("-");
    const tags = document.querySelectorAll("#post-container #tag-container");
    const tagContainer = tags[tags.length - 1];

    const tagCloudDiv = document.createElement("div");
    tagCloudDiv.classList.add("widget", "widget_tag_cloud");

    const tagCloud = document.createElement("div");
    tagCloud.classList.add("tagcloud");

    tagsArray.forEach((tag) => {
      const tagLink = document.createElement("a");
      tagLink.title = tag;
      tagLink.classList.add("active");
      tagLink.textContent = tag;
      tagCloud.appendChild(tagLink);
    });
    tagCloudDiv.appendChild(tagCloud);
    tagContainer.appendChild(tagCloudDiv);
  }
  //LIKE DISLIKE EVENTS
  document.querySelectorAll(".like, .dislike").forEach(function (elem) {
    elem.addEventListener("click", function () {
      var isActive = this.classList.contains("active");
      var isLike = this.classList.contains("like");

      elem
        .querySelectorAll("." + (isLike ? "like" : "dislike") + ".active")
        .forEach(function (activeElem) {
          activeElem.classList.remove("active");
        });

      if (!isActive) {
        this.classList.add("active");
        if (isLike) {
          likePost(this);
          var correspondingDislike =
            this.parentElement.querySelector(".dislike");
          console.log(correspondingDislike);
          if (correspondingDislike.classList.contains("active")) {
            correspondingDislike.classList.remove("active");
            dislikePost(correspondingDislike);
          }
        } else {
          dislikePost(this);
          var correspondingLike = this.parentElement.querySelector(".like");
          console.log(correspondingLike);
          if (correspondingLike.classList.contains("active")) {
            correspondingLike.classList.remove("active");
            likePost(correspondingLike);
          }
        }
      } else {
        this.classList.remove("active");
        if (isLike) {
          likePost(this);
        } else {
          dislikePost(this);
        }
      }
    });
  });
}

function likePost(element) {
  var id =
    element.parentElement.querySelector("form").elements["id_post"].value;
  fetch(`checkReactStatus.php?id_post=${id}&react=like`)
    .then((response) => response.text())
    .then((data) => {
      if (data.trim() == "False") {
        var likes = parseInt(element.querySelector("p").textContent) + 1;
        element.querySelector("p").textContent = likes;
        return fetch(`reactToPost.php?id_post=${id}&type=like`);
      } else {
        var likes = parseInt(element.querySelector("p").textContent) - 1;
        element.querySelector("p").textContent = likes;
        return fetch(`reactToPost.php?id_post=${id}&type=unlike`);
      }
    })
    .then((response) => response.text())
    .then((data) => {})
    .catch((error) => console.error("Error:", error));
}

function dislikePost(element) {
  var id =
    element.parentElement.querySelector("form").elements["id_post"].value;
  fetch(`checkReactStatus.php?id_post=${id}&react=dislike`)
    .then((response) => response.text())
    .then((data) => {
      if (data.trim() == "False") {
        var dislikes = parseInt(element.querySelector("p").textContent) + 1;
        element.querySelector("p").textContent = dislikes;
        return fetch(`reactToPost.php?id_post=${id}&type=dislike`);
      } else {
        var dislikes = parseInt(element.querySelector("p").textContent) - 1;
        element.querySelector("p").textContent = dislikes;
        return fetch(`reactToPost.php?id_post=${id}&type=undislike`);
      }
    })
    .then((response) => response.text())
    .then((data) => {})
    .catch((error) => console.error("Error:", error));
}
