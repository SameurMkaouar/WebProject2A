document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  fetch(`../../controller/fetchPost.php?id=${idPost}`)
    .then((response) => response.json())
    .then((data) => {
      console.log("ready");
      const post = data;
      const postHTML = `
      <div class="with_border">
              <img
                  src="data:image/jpeg;base64,${post.post_img}"
                  alt="Erreur-image"
                  style="display: block;
                  margin: 0 auto;"
                />
        </div>
      <input hidden name="id_post" value="${post.id_post}"/>
      <div class="row form-group">
      <label class="col-lg-3 control-label">Publish date:</label>
      <div class="col-lg-9">
        <input type="date" class="form-control" value="${post.publish_date}" disabled/>
      </div>
    </div>

    <div class="row form-group">
      <label class="col-lg-3 control-label">Publish time:</label>
      <div class="col-lg-9">
        <input type="time" class="form-control" value="${post.publish_time}" disabled/>
      </div>
    </div>

    <div class="row form-group">
      <label class="col-lg-3 control-label">Post title: </label>
      <div class="col-lg-9">
        <input
          type="text"
          class="form-control"
          name="post_title"
          value="${post.post_title}"
          id="post_title"
          disabled
        />
      </div>
    </div>

    <div class="row form-group">
      <label class="col-lg-3 control-label"
        >Post Content:
      </label>
      <div class="col-lg-9">
        <textarea rows="5" class="form-control" id="post_content" name="post_content" style="width: 100%; max-width: 100%;" disabled>
        ${post.post_content} </textarea
        >
      </div>
    </div>
    <div class="row form-group">
                      <label class="col-lg-3 control-label">Post Category:</label>
                      <div class="col-lg-9">
                        <select
                          class="form-control with-selected"
                          name="post_categorie"
                          id="with-selected"
                          value="${post.post_categorie}" 
                          selected
                          disabled
                        >
                          <option value="cat1">Categorie 1</option>
                          <option value="cat2">Categorie 2</option>
                          <option value="cat3">Categorie 3</option>
                        </select>
                      </div>
    </div>
    </div>`;
      document
        .getElementById("post-detail")
        .insertAdjacentHTML("afterbegin", postHTML);
      showComments();
      //IDPOST
      var hiddenInput = document.createElement("input");
      hiddenInput.type = "hidden";
      hiddenInput.name = "id_post";
      hiddenInput.value = post.id_post;
      var form = document.getElementById("approve-post");
      console.log(form);
      form.appendChild(hiddenInput);
    });
});

function showComments() {
  //REQUETE AJAX POUR RECUPERER UN TABLEAU DES POSTS VIA JSON FILE
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  console.log("ready2");
  fetch(`../../controller/fetchComments.php?id=${idPost}`)
    .then((response) => response.json())
    .then((data) => {
      for (let i = 0; i < data.length; i++) {
        const comment = data[i];
        const date = formatDate(comment.comment_time);
        const postHTML = `
                  <tr class="item-editable">
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
}

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
