<?php
include '../database.php';
$fecha_realizacion = $_POST['fecha_realizacion'];
$fecha_concluido = $_POST['fecha_concluido'];
$num_folio = $_POST['num_folio'];
$compra_material = $_POST['compra_material'];
$turno = $_POST['turno'];
$area_solicitante = $_POST['area_solicitante'];
$num_linea = $_POST['num_linea'];
$supervisor_area = $_POST['supervisor_area'];
$nombre_asignado = $_POST['nombre_asignado'];
$cargo_asignado = $_POST['cargo_asignado'];
$contacto_asignado = $_POST['contacto_asignado'];
$codigo_equipo = $_POST['codigo_equipo'];
$descripcion_equipo = $_POST['descripcion_equipo'];
$problema_equipo = $_POST['problema_equipo'];
$observaciones_equipo = $_POST['observaciones_equipo'];
$estado = $_POST['estado'];
$tipo_mantenimiento = $_POST['tipo_mantenimiento'];


$qry = "INSERT INTO reportes (fecha_realizacion,fecha_concluido,num_folio,compra_material,turno,area_solicitante,num_linea,supervisor_area,nombre_asignado,cargo_asignado,contacto_asignado,codigo_equipo,descripcion_equipo,problema_equipo,observaciones_equipo,estado,tipo_mantenimiento) VALUES ('$fecha_realizacion','$fecha_concluido','$num_folio','$compra_material','$turno','$area_solicitante','$num_linea','$supervisor_area','$nombre_asignado','$cargo_asignado','$contacto_asignado','$codigo_equipo','$descripcion_equipo','$problema_equipo','$observaciones_equipo','$estado','$tipo_mantenimiento')";
$res = mysqli_query($con, $qry);

$query = "UPDATE inv_equipo SET condiciones='R' WHERE id_inv = '" . $_POST['id_inv'] . "'";
mysqli_query($con, $query);

?>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/jspdf"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
    <script>
        $(document).ready(function() {
            var qrcode = new QRCode("qr_code", {
                text: "http://localhost/MM/VQR.php?id_inv=<?php echo $_POST['id_inv']; ?>&num_folio=<?php echo $num_folio; ?>",
                width: 60,
                height: 60,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H,
            });
            $(document).ready(function() {
                generatePDF();
            });

            function generatePDF() {
                var pdf = new jsPDF({
                    orientation: "portrait",
                    unit: "mm",
                    format: [280, 220],
                });
                pdf.rect(10, 5, 200, 10);
                pdf.setFontSize(15);
                pdf.text("Reporte de Mantenimiento", 75, 12);

                pdf.setFontSize(10);
                pdf.text("Fecha de realización: <?php echo $fecha_realizacion; ?>", 20, 30);
                pdf.text("No. folio: <?php echo $num_folio; ?>", 150, 30);
                //
                pdf.text("Mantenimiento:<?php echo $tipo_mantenimiento; ?>", 20, 35);
                pdf.text("Compra de material: <?php echo $compra_material; ?>", 150, 35);
                pdf.text("Turno: <?php echo $turno; ?>", 150, 40);
                //
                pdf.text("Área solicitante: <?php echo $area_solicitante; ?>", 20, 60);
                pdf.text("Numero de linea: <?php echo $num_linea; ?>", 20, 65);
                //
                pdf.text("Supervisor del área: <?php echo $supervisor_area; ?>", 20, 75);
                pdf.text("Nombre del asignado: <?php echo $nombre_asignado; ?>", 20, 80);
                pdf.text("Cargo del asignado: <?php echo $cargo_asignado; ?>", 20, 85);
                pdf.text("Contacto del asignado: <?php echo $contacto_asignado; ?>", 20, 90);

                let base64Image = $("#qr_code img").attr("src");
                console.log("hola");
                pdf.addImage(base64Image, "png", 135, 155, 60, 60);
                pdf.text("Para validar de manera remota", 140, 220);
                pdf.autoTable({
                    margin: {
                        top: 105,
                        left: 15,
                        bottom: 10,
                    },
                    head: [
                        ["Codigo de equipo", "Descripcion", "Problema"]
                    ],
                    body: [
                        [
                            "<?php echo $codigo_equipo; ?>",
                            "<?php echo $descripcion_equipo; ?>",
                            "<?php echo $problema_equipo; ?>",
                        ],
                    ],
                    columnStyles: {
                        1: {
                            cellWidth: 74,
                        },
                    },
                });
                pdf.autoTable({
                    margin: {
                        top: 105,
                        left: 15,
                        bottom: 10,
                    },
                    head: [
                        ["Obsservaciones"]
                    ],
                    body: [
                        ["<?php echo $observaciones_equipo; ?>"]
                    ],
                    columnStyles: {
                        0: {
                            cellWidth: 100,
                        },
                    },
                });

                var blob = pdf.output("blob");

                var formData = new FormData();
                formData.append("pdf", blob);
                var num_folio = '<?php echo $num_folio; ?>';

                $.ajax("pdf_serv.php?num_folio="+num_folio, {
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        window.location = "../reportes.php"
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            }
            // window.location = '../reportes.php';
        });
    </script>
</head>
<style>
    #qr_code {
        display: none;
    }
</style>
<body>
    <div id="qr_code"></div>
</body>
</html>