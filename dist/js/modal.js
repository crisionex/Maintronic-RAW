const modal = document.querySelector("#my-modal");
const modal2 = document.querySelector("#my-modal-2");
const closeBtn = document.querySelector(".close");
const closeBtn2 = document.querySelector(".close2");
var condicion = 0;

closeBtn.addEventListener("click", closeModal);
closeBtn2.addEventListener("click", closeModal);
window.addEventListener("click", outsideClick);

function openModal(value) {
  modal.style.display = "block";
  document.getElementById("btn-modal-ok").value = value;
}

function openModal2() {
  modal2.style.display = "block";
}

function openPDFModal(value) {
  modal.style.display = "block";
  document.getElementById("DocPDF").src = "reportesgenerados/" + value + ".pdf";
}

function openPDFModalValidator(value) {
  modal.style.display = "block";
  document.getElementById("DocPDF").src = "reportesgenerados/" + value + ".pdf";
  document.getElementById("validar-reporte").value = value;
  document.getElementById("rechazar-reporte").value = value;
}

function validarReporte(value) {
  accion = "validar";
  $.ajax({
    url: "query/gestReporte.php",
    method: "POST",
    data: {
      value,
      accion,
    },
    success: function (data) {
      window.location = "validaciones.php";
    },
  });
}

function rechazarReporte(value) {
  accion = "rechazar";
  $.ajax({
    url: "query/gestReporte.php",
    method: "POST",
    data: {
      value,
      accion,
    },
    success: function (data) {
      window.location = "validaciones.php";
    },
  });
}

$(document).ready(function () {
  $(".dropdown").change(function () {
    condicion = $(this).val();
  });
});

function sendInfo(id) {
  console.log("hola");
  $.ajax({
    url: "query/invstate.php",
    method: "POST",
    data: {
      id: id,
      condicion: condicion,
    },
    success: function (data) {
      window.location = "inventarios.php";
      console.log(data);
    },
  });
}

function addEquipment() {
  $(document).ready(function () {
    var num_inv = document.getElementById("xzy1").value;
    console.log(num_inv);
    var nom_eq = document.getElementById("xzy2").value;
    $.ajax({
      url: "query/addeq.php",
      method: "POST",
      data: {
        num_inv,
        nom_eq,
      },
      success: function (data) {
        window.location = "inventarios.php";
      },
    });
  });
}

function deleteEquipment(value) {
  $.ajax({
    url: "query/borrareq.php",
    method: "POST",
    data: {
      value: value,
    },
    success: function (data) {
      window.location = "inventarios.php";
    },
  });
}

function closeModal() {
  modal.style.display = "none";
  modal2.style.display = "none";
}

function outsideClick(e) {
  if (e.target == modal) {
    modal.style.display = "none";
  } else if (e.target == modal2) {
    modal2.style.display = "none";
  }
}
