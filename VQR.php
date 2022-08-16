<?php
require "database.php";
require "head.php";
?>
<link rel="stylesheet" href="dist/css/genstyle.css">
<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        top: 0;
        display: flex;
        background-color: var(--background-color);
        font-family: 'poppins', sans-serif;
        align-content: space-around;
        justify-content: center;
        color: var(--dark-color);
    }

    .container {
        display: grid;
        justify-content: center;
    }

    .material-symbols-outlined {
        font-variation-settings: "FILL"1, "wght"500, "GRAD"0, "opsz"48;
        font-size: 10rem;
        display: inline-flex;
        vertical-align: text-bottom;
    }

    .icon {
        justify-self: center;
        padding: 5vh;
    }

    .icon-ok{
        color: var(--success-color);
    }

    .icon-cancel{
        color:var(--danger-color);
    }
</style>
</head>

<body>
    <?php
    if ($datosUsuario['permiso'] == "Encargado") {
        if (isset($_GET['id_inv']) && isset($_GET['num_folio'])) {
            $qry = "SELECT * FROM reportes WHERE num_folio = '" . $_GET['num_folio'] . "' ";
            $res = mysqli_query($con, $qry);
            $row = mysqli_fetch_assoc($res);

            $num_folio = $_GET['num_folio'];
            $id_inv = $_GET['id_inv'];

            if ($row['estado'] == 'Pendiente') {

                $query = "UPDATE reportes set estado = 'Validado' WHERE num_folio = $num_folio";
                mysqli_query($con, $query);

                $query = "UPDATE inv_equipo set condiciones = '0' WHERE id_inv= $id_inv";
                mysqli_query($con, $query);
    ?>
                <div class="container">
                    <div class="icon icon-ok">
                        <span class="material-symbols-outlined">
                            check_circle
                        </span>
                    </div><br>
                    <div class="content">
                        <p>El reporte se ha validado correctamente</p>
                    </div>
                </div>

            <?php
            } else if ($row['estado'] == "Validado") {
            ?>
                <div class="container">
                    <div class="icon icon-ok">
                        <span class="material-symbols-outlined">
                            check_circle
                        </span>
                    </div><br>
                    <div class="content">
                        <p>El reporte se ha validado con anterioridad, no se puede procesar la solicitud</p>
                    </div>
                </div>
            <?php
            } else if ($row['estado'] == "Rechazado") {
            ?>
                <div class="container">
                    <div class="icon icon-cancel">
                        <span class="material-symbols-outlined">
                            cancel
                        </span>
                    </div><br>
                    <div class="content">
                        <p>El reporte ya ha sido rechazado, no se puede procesar la solicitud</p>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
</body>

</html>