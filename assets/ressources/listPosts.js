// Fetch posts and render initial page
document.addEventListener("DOMContentLoaded", function () {
  fetch("../../controller/fetchPosts.php")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      //displayRecentPosts();
      renderPagination(data);
      displayPostsByPage(currentPage, data);
    });
});

function fetchPosts(sortType) {
  const activeTags = document.querySelectorAll("#sort-tags a.active");
  console.log(activeTags);
  const tagString = Array.from(activeTags)
    .map((tag) => tag.textContent.trim().toLowerCase())
    .join("-");

  const URL =
    "../../controller/FetchPosts.php?sort=" + sortType + "&tags=" + tagString;
  fetch(URL)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("post-container").innerHTML = "";
      renderPagination(data);
      displayPostsByPage(currentPage, data);
    });
}

function AfficherPosts(data) {
  document.getElementById("post-container").innerHTML = "";
  for (let i = 0; i < data.length; i++) {
    var post = data[i];
    postContent = post.post_content;
    var previewLimit = 250;

    if (postContent.length > previewLimit) {
      postContent = postContent.substring(0, previewLimit) + "...";
    }
    const postHTML = `
    <article class="vertical-item content-padding post format-standard with_shadow">
        <div class="item-media entry-thumbnail">
            <img src="data:image/jpeg;base64,${post.post_img}" alt="erreur" />
            <div class="media-links">
                <a class="abs-link" title="" href="blog-single-full.php?id=${post.id_post}"></a>
            </div>
            
        </div>
        <div class="item-content entry-content">
        <header class="entry-header">
            

            <h4 class="entry-title">
            <a href="blog-single-full.php?id=${post.id_post}" rel="bookmark">${post.post_title}</a><div id="tag-container"></div>
            </h4>
            <div id="tag-container"></div>
            <hr class="divider_30_1" />
        </header>
        <p>
            ${postContent} 
        </p>
        </div>
      
        <div class="rating">
          <div class="media">
            <div class="media-left">
            <div class="profile-icon">
            <img  src="data:image/jpeg;base64,${post.Picture}" alt="erreur" style="scale=150%" />

            
            </div>
            </div>
            <div class="media-body">
              <h5>
                <a href="admin_profile.html">Author: ${post.Lastname} ${post.Firstname}</a>
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
          <div class="rating-buttons">
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
        </div>
    </article>`;
    document
      .getElementById("post-container")
      .insertAdjacentHTML("beforeend", postHTML);
    //ACTIVATE OLD REACTS
    const insertedPost =
      document.getElementById("post-container").lastElementChild;
    fetch(
      `../../controller/checkReactStatus.php?id_post=${post.id_post}&react=dislike`
    )
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() == "True") {
          insertedPost.querySelector(".dislike").classList.add("active");
        }
      });
    fetch(
      `../../controller/checkReactStatus.php?id_post=${post.id_post}&react=like`
    )
      .then((response) => response.text())
      .then((data) => {
        if (data.trim() == "True") {
          insertedPost.querySelector(".like").classList.add("active");
        }
      });

    //ADD TAGS
    // const tagsArray = post.post_categorie.split("-");
    // const tags = document.querySelectorAll("#post-container #tag-container");
    // const tagContainer = tags[tags.length - 1];

    // const tagCloudDiv = document.createElement("div");
    // tagCloudDiv.classList.add("widget", "widget_tag_cloud");

    // const tagCloud = document.createElement("div");
    // tagCloud.classList.add("tagcloud");

    // tagsArray.forEach((tag) => {
    //   const tagLink = document.createElement("a");
    //   tagLink.title = tag;
    //   tagLink.classList.add("active");
    //   tagLink.textContent = tag;
    //   tagCloud.appendChild(tagLink);
    // });
    // tagCloudDiv.appendChild(tagCloud);
    // tagContainer.appendChild(tagCloudDiv);
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
  fetch(`../../controller/checkReactStatus.php?id_post=${id}&react=like`)
    .then((response) => response.text())
    .then((data) => {
      if (data.trim() == "False") {
        var likes = parseInt(element.querySelector("p").textContent) + 1;
        element.querySelector("p").textContent = likes;
        return fetch(
          `../../controller/reactToPost.php?id_post=${id}&type=like`
        );
      } else {
        var likes = parseInt(element.querySelector("p").textContent) - 1;
        element.querySelector("p").textContent = likes;
        return fetch(
          `../../controller/reactToPost.php?id_post=${id}&type=unlike`
        );
      }
    })
    .then((response) => response.text())
    .then((data) => {})
    .catch((error) => console.error("Error:", error));
}

function dislikePost(element) {
  var id =
    element.parentElement.querySelector("form").elements["id_post"].value;
  fetch(`../../controller/checkReactStatus.php?id_post=${id}&react=dislike`)
    .then((response) => response.text())
    .then((data) => {
      if (data.trim() == "False") {
        var dislikes = parseInt(element.querySelector("p").textContent) + 1;
        element.querySelector("p").textContent = dislikes;
        return fetch(
          `../../controller/reactToPost.php?id_post=${id}&type=dislike`
        );
      } else {
        var dislikes = parseInt(element.querySelector("p").textContent) - 1;
        element.querySelector("p").textContent = dislikes;
        return fetch(
          `../../controller/reactToPost.php?id_post=${id}&type=undislike`
        );
      }
    })
    .then((response) => response.text())
    .then((data) => {})
    .catch((error) => console.error("Error:", error));
}

const postsPerPage = 5;
let currentPage = 1;

function displayPostsByPage(pageNumber, data) {
  const startIndex = (pageNumber - 1) * postsPerPage;
  const endIndex = startIndex + postsPerPage;
  let postsArray = [];
  for (let postId in data) {
    if (data.hasOwnProperty(postId)) {
      postsArray.push(data[postId]);
    }
  }
  const postsToDisplay = postsArray.slice(startIndex, endIndex);
  AfficherPosts(postsToDisplay);
}

function renderPagination(data) {
  const totalPosts = data.length;
  const totalPages = Math.ceil(totalPosts / postsPerPage);

  let paginationHTML = `
    <ul class="pagination">
      <li>
        <a href="#">
          <span class="sr-only">Prev</span>
          <i class="fa fa-angle-left"></i>
        </a>
      </li>
  `;
  for (let i = 1; i <= totalPages; i++) {
    paginationHTML += `<li${
      i === currentPage ? ' class="active"' : ""
    }><a href="#" onclick="displayPostsByPage(${i}, ${JSON.stringify(
      data
    )})">${i}</a></li>`;
  }
  paginationHTML += `
      <li>
        <a href="#">
          <span class="sr-only">Next</span>
          <i class="fa fa-angle-right"></i>
        </a>
      </li>
    </ul>
  `;
  document.getElementById("pagination-container").innerHTML = paginationHTML;
  // Event listeners for pagination buttons
  const paginationLinks = document.querySelectorAll(".pagination li a");
  paginationLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const pageNumber = parseInt(this.textContent);
      currentPage = pageNumber;
      displayPostsByPage(pageNumber, data);
      // Scroll to the post-container element
      const postContainer = document.getElementById("post-container");
      postContainer.scrollIntoView({ behavior: "smooth", block: "start" });

      renderPagination(data);
    });
  });
}

function displayRecentPosts() {
  const recentPostsList = document.getElementById("recentPostsList");
  fetch("../../controller/FetchPosts.php?sort=recent")
    .then((response) => response.json())
    .then((data) => {
      let postsArray = [];
      //console.log(data);
      for (let postId in data) {
        if (data.hasOwnProperty(postId)) {
          postsArray.push(data[postId]);
        }
      }
      const recentPosts = postsArray.slice(0, 5);
      console.log(recentPosts);
      recentPostsList.innerHTML = "";
      recentPosts.forEach((post) => {
        const listItem = document.createElement("li");
        listItem.innerHTML = `
          <div class="entry-date small-text highlight">
            <a href="#aa" rel="bookmark">
              <time class="entry-date" datetime="${post.post_time}">
                ${post.post_time}
              </time>
            </a>
          </div>
          <h4>
            <a href="blog-single-full.php?id=${post.id_post}">${post.post_title}</a>
          </h4>
        `;
        recentPostsList.appendChild(listItem);
      });
    })
    .catch((error) => {
      console.error("Error fetching recent posts:", error);
    });
}

function checkNewsLetter(event) {
  event.preventDefault();

  const button = document.getElementById("news");

  if (
    button.innerHTML.trim() ===
    '<i class="fa fa-bell"></i> Subscribe to newsletter'
  ) {
    button.innerHTML =
      '<i class="fa fa-bell-slash"></i> Unsubscribe to newsletter ';
    fetch("../../controller/subscription.php?action=sub")
      .then((response) => {
        console.log(response.text);

        if (!response.ok) {
          throw new Error("Failed to subscribe");
        }
      })
      .catch((error) => {
        button.innerHTML = '<i class="fa fa-bell"></i> Subscribe to newsletter';
        console.error("Error:", error);
      });
  } else {
    button.innerHTML = '<i class="fa fa-bell"></i> Subscribe to newsletter';
    fetch("../../controller/subscription.php?action=unsub")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to unsubscribe");
        }
      })
      .catch((error) => {
        button.innerHTML =
          '<i class="fa fa-bell-slash"></i> Unsubscribe to newsletter';
        console.error("Error:", error);
      });
  }
}

const button = document.getElementById("news");
button.addEventListener("click", checkNewsLetter);

document.addEventListener("DOMContentLoaded", function () {
  fetch("../../controller/check_subscription.php")
    .then((response) => response.text())
    .then((data) => {
      const button = document.getElementById("news");
      if (data.trim() == "1") {
        button.innerHTML =
          '<i class="fa fa-bell-slash"></i> Unsubscribe to newsletter';
      } else {
        button.innerHTML = '<i class="fa fa-bell"></i> Subscribe to newsletter';
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
