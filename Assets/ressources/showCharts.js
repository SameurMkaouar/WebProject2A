document.addEventListener("DOMContentLoaded", function () {
  fetch("../../View/FrontOffice/retrieveChartData.php")
    .then((response) => response.json())
    .then((data) => {
      const labels = data["posts"].map((data) => data.post_date);
      const postCounts = data["posts"].map((data) => data.post_count);

      const Clabels = data["comments"].map((data) => data.comment_date);
      const commetsCounts = data["comments"].map((data) => data.comment_count);

      const ctx = document.getElementById("chart-posts").getContext("2d");
      const ctx2 = document.getElementById("chart-comments").getContext("2d");

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
    });
});
