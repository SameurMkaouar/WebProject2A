document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  fetch(`../../Controller/fetchPost.php?id=${idPost}`)
    .then((response) => response.json())
    .then((data) => {
      console.log("ready");
      const post = data;
      const postHTML = `
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
        />
      </div>
    </div>

    <div class="row form-group">
      <label class="col-lg-3 control-label"
        >Post Content:
      </label>
      <div class="col-lg-9">
        <textarea rows="5" class="form-control" id="post_content" name="post_content" style="width: 100%; max-width: 100%;">
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
                        >
                          <option value="cat1">Categorie 1</option>
                          <option value="cat2">Categorie 2</option>
                          <option value="cat3">Categorie 3</option>
                        </select>
                      </div>
    </div>
    <div class="row form-group">
                      <label class="col-lg-3 control-label">Change Post Image: </label>
                      <div class="col-lg-9">
                        <input type="file" id="img" name="image" />
                      </div>
    </div>
    <input hidden name="id_post" value="${post.id_post}"/>`;
      document
        .getElementById("post-detail")
        .insertAdjacentHTML("afterbegin", postHTML);
    });
});
