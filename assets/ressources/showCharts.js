document.addEventListener("DOMContentLoaded", function () {
  fetch("../../controller/retrieveChartData.php")
    .then((response) => response.json())
    .then((data) => {
      const labels = data["posts"].map((data) => data.post_date);
      const postCounts = data["posts"].map((data) => data.post_count);

      const Clabels = data["comments"].map((data) => data.comment_date);
      const commetsCounts = data["comments"].map((data) => data.comment_count);

      const ctx = document.getElementById("chart-posts").getContext("2d");
      const ctx2 = document.getElementById("chart-comments").getContext("2d");
      const ctx3 = document.getElementById("chart-reacts").getContext("2d");
      const ctx4 = document.getElementById("chart-tags").getContext("2d");

      const myChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Posts per Day",
              data: postCounts,
              backgroundColor: "rgba(54, 162, 235, 0.5)",
              borderColor: "rgba(54, 162, 235, 1)",
              borderWidth: 3,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              stepSize: 1,
            },
          },
        },
      });

      const myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
          labels: Clabels,
          datasets: [
            {
              label: "Comments per Day",
              data: commetsCounts,
              backgroundColor: "rgba(54, 162, 235, 0.5)",
              borderColor: "rgba(54, 162, 235, 1)",
              borderWidth: 3,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              stepSize: 1,
            },
          },
        },
      });

      const postTitles = data.reacts.map((post) => post.post_title);
      const likesCounts = data.reacts.map((post) => post.post_likes);
      const dislikesCounts = data.reacts.map((post) => post.post_dislikes);

      const myChart3 = new Chart(ctx3, {
        type: "bar",
        data: {
          labels: data.reacts.map((post) => `POST ID: ${post.id_post}`),
          datasets: [
            {
              label: "Likes", // Or any label you want
              data: data.reacts.map((post) => post.post_likes),
              backgroundColor: "rgba(75, 192, 192, 0.5)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
            },
            {
              label: "Dislikes", // Or any label you want
              data: data.reacts.map((post) => post.post_dislikes),
              backgroundColor: "rgba(255, 99, 132, 0.5)",
              borderColor: "rgba(255, 99, 132, 1)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              stepSize: 1,
            },
          },
          plugins: {
            tooltip: {
              callbacks: {
                label: function (context) {
                  let label = context.dataset.label || "";
                  if (label) {
                    label += ": ";
                  }
                  if (context.parsed.y !== null) {
                    label += context.parsed.y;
                  }
                  return label;
                },
              },
            },
          },
        },
      });

      const allTags = data.reacts.reduce((acc, post) => {
        const tags = post.post_categorie
          .split("-")
          .map((tag) => tag.charAt(0).toUpperCase() + tag.slice(1));
        acc.push(...tags);
        return acc;
      }, []);

      const tagCounts = {};
      allTags.forEach((tag) => {
        tagCounts[tag] = (tagCounts[tag] || 0) + 1;
      });

      const tagLabels = Object.keys(tagCounts);
      const tagPostCounts = Object.values(tagCounts);

      const myChart4 = new Chart(ctx4, {
        type: "pie",
        data: {
          labels: tagLabels,
          datasets: [
            {
              label: "Number of Posts per Tag",
              data: tagPostCounts,
              backgroundColor: [
                "rgba(255, 99, 132, 0.5)",
                "rgba(54, 162, 235, 0.5)",
                "rgba(255, 206, 86, 0.5)",
                "rgba(75, 192, 192, 0.5)",
                // Add more colors as needed for additional segments
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              stepSize: 1,
            },
          },
        },
      });
    });
});
