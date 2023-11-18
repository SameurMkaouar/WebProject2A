document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  fetch(`../../View/FrontOffice/fetchComments.php?id=${idPost}`)
    .then((response) => response.json())
    .then((data) => {
      for (let i = 0; i < data.length; i++) {
        const comment = data[i];
        const date = formatDate(comment.comment_time);
        const postHTML = `
            <article class="comment-body media">
            <div class="media-left">
                <img
                class="media-object"
                alt=""
                src="../../Assets/images/profile.png"
                />
            </div>
            <div class="media-body">
                <span class="reply greylinks">
                <a href="#respond">
                    <i class="fa fa-reply"></i>
                </a>
                </span>
                <div class="comment-meta darklinks">
                <a
                    class="author_url"
                    rel="external nofollow"
                    href="#"
                    >JaaferJaafour3000</a
                >
                <span class="comment-date small-text highlight">
                    <time
                    class="entry-date"
                    >${date}</time
                    >
                </span>
                </div>
                <p>
                ${comment.comment_content}
                </p>
            </div>
            </article>`;
        document
          .getElementById("comment_container")
          .insertAdjacentHTML("afterbegin", postHTML);
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
