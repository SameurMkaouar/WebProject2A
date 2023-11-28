document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const idPost = urlParams.get("id");
  fetch(`../../View/FrontOffice/fetchPost.php?id=${idPost}`)
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
                      <label class="col-lg-3 control-label">Post Tags: </label>
                      <div class="col-lg-9">
                        <div class="checkbox">
                          <input
                            type="checkbox"
                            id="option1"
                            name="post_categorie[]"
                            value="discussion"
                          />
                          <label for="option1">Discussion</label><br />
                          <input
                            type="checkbox"
                            id="option2"
                            name="post_categorie[]"
                            value="question"
                          />
                          <label for="option2">Question</label><br />

                          <input
                            type="checkbox"
                            id="option3"
                            name="post_categorie[]"
                            value="info"
                          />
                          <label for="option3">Info</label><br />
                        </div>
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
