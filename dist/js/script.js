const navSlide = () => {
  const open = document.querySelector(".open-sidebar");
  const close = document.querySelector(".close-sidebar");
  const nav = document.querySelector(".sidebar");

  open.addEventListener("click", () => {
    nav.classList.toggle("nav-active");
  });
  close.addEventListener("click", () => {
    nav.classList.toggle("nav-active");
  });
};
navSlide();

const themeMode = document.querySelector(".theme-mode");

themeMode.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme");
});

var date = new Date();
var Y = date.getFullYear();

$.ajax({
  url: "query/estadisticas.php",
  method: "POST",
  dataType: "JSON",
  data: {
    Y,
  },
  success: function (data) {
    console.log(data);
  },
});

const labels = ["Enero", "febrero", "Marzo", "Abril", "Mayo"];

const data = {
  labels: labels,
  datasets: [
    {
      label: "Realizados por mes",
      backgroundColor: "#84a8f5",
      borderColor: "#84a8f5",
      data: [0, 10, 5, 2, 20],
      tension: 0.3,
      // fill: {
      //   target: "origin",
      //   above: "rgba(45, 100, 240,0.3)",
      // },
    },
    {
      label: "Fallos por mes",
      backgroundColor: "#f2687b",
      borderColor: "#f2687b",
      data: [0, 14, 2, 8, 17],
      tension: 0.3,
      // fill: {
      //   target: "origin",
      //   above: "rgba(225, 100, 100, 0.3)",
      // },
    },
    {
      label: "Concluidos",
      backgroundColor: "#6dc79d",
      borderColor: "#6dc79d",
      data: [2, 15, 12, 8, 7],
      tension: 0.3,
      // fill: {
      //   target: "origin",
      //   above: "rgba(14, 125, 125, 0.3)",
      // },
    },
  ],
};

const config = {
  type: "line",
  data: data,
  options: {
    plugins: {
      legend: {
        labels: {
          font: {
            family: "'Fredoka', sans-serif",
            size: 14,
          },
        },
      },
      title: {
        labels: {
          font: {
            family: "'Fredoka', sans-serif",
            size: 14,
          },
        },
      },
      scales: {
        x: {
          ticks: {
            font: {
              family: "'Fredoka', sans-serif",
              size: 14,
            },
          },
        },
        y: {
          ticks: {
            font: {
              family: "'Fredoka', sans-serif",
              size: 14,
            },
          },
        },
      },
    },
  },
};
const myChart = new Chart(document.getElementById("myChart"), config);

function genreport(id_inv) {
  console.log("wut");
  const d = new Date();
  window.location =
    "reportegenerado.php?id_inv=" +
    id_inv +
    "&YI=" +
    d.getFullYear() +
    "&MI=" +
    (d.getMonth() + 1) +
    "&DI=" +
    d.getDate();
}
