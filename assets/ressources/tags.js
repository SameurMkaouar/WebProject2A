const tags = document.querySelectorAll(".widget_tag_cloud a");

tags.forEach((tag) => {
  tag.addEventListener("click", function (event) {
    event.preventDefault();
    if (this.classList.contains("active")) {
      this.classList.remove("active");
    } else {
      this.classList.add("active");
    }
  });
});
