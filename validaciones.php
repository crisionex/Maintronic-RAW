<?php
include "head.php";
if ($datosUsuario['permiso'] == 'Encargado') {
?>
    <link rel="stylesheet" href="dist/css/styleinv.css">
    <link rel="stylesheet" href="dist/css/stylemodal.css">
    <style>
        /* PDF Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 3;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            margin: 2% auto !important;
            width: 60% !important;
            height: 80% !important;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px,
                rgba(0, 0, 0, 0.22) 0px 10px 10px;
            animation-name: modalopen;
            animation-duration: var(--modal-duration);
        }

        @media screen and (max-width: 768px) {
            .modal-content {
                margin: 2% auto !important;
                width: 100% !important;
                height: 100% !important;
                box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px,
                    rgba(0, 0, 0, 0.22) 0px 10px 10px;
                animation-name: modalopen;
                animation-duration: var(--modal-duration);
            }
        }
    </style>
    </head>

    <body>
        <!-- P-content -->
        <div class="container">
            <!-- main-grid -->
            <div class="main-grid">
                <!-- head-grid -->
                <div class="content-grid head">
                    <div class="open-sidebar"><i class="material-icons">menu</i></div>
                </div>
                <!-- sidebar-grid -->
                <div class="content-grid sidebar">
                    <div class="logo">
                        <div class="lg">
                            <span class="material-symbols-outlined" style="color: var(--main-color)">
                                api
                            </span>
                            <span>Meca</span><span style="color: var(--main-color)">Matic</span> <br /><br />
                        </div>
                        <div class="close-sidebar">
                            <i class="material-icons">close</i>
                        </div>
                    </div>
                    <div class="sidebar-content">
                        <a href="index.php" id="index.php" class="target">
                            <span class="material-symbols-outlined"> event_note </span>
                            <h3>Bitacora</h3>
                        </a>
                        <a href="inventarios.php" id="inventarios.php" class="target">
                            <span class="material-symbols-outlined"> inventory_2 </span>
                            <h3>Inventario</h3>
                        </a>
                        <a href="validaciones.php" id="validaciones.php" class="selected-a">
                            <span class="material-symbols-outlined"> inventory </span>
                            <h3>Validaciones
                                <?php
                                $qry = "SELECT * FROM reportes WHERE estado = 'Pendiente'";
                                $res = mysqli_query($con, $qry);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $i++;
                                }
                                if (!empty($res) && mysqli_num_rows($res) > 0) {
                                ?>
                                    <span style="background-color: var(--danger-color); color: white; font-family: 'radio canada',sans-serif; padding: 5px; border-radius: 6px; font-size: 0.8rem; font-weight: 600;">
                                        <?php
                                        echo $i;
                                        ?>
                                    </span>
                                <?php } ?>
                            </h3>
                        </a>
                        <a href="reportes.php" id="reportes.php" class="target">
                            <span class="material-symbols-outlined"> post_add </span>
                            <h3>Reportes
                                <?php
                                $qry = "SELECT * FROM inv_equipo WHERE condiciones = 'M'";
                                $res = mysqli_query($con, $qry);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $i++;
                                }
                                if (!empty($res) && mysqli_num_rows($res) > 0) {
                                ?>
                                    <span style="background-color: var(--danger-color); color: white; font-family: 'radio canada',sans-serif; padding: 5px; border-radius: 6px; font-size: 0.8rem; font-weight: 600;">
                                        <?php
                                        echo $i;
                                        ?>
                                    </span>
                                <?php } ?>
                            </h3>
                        </a>
                        <a href="registrar.php" id="registrar.php" class="target">
                            <span class="material-symbols-outlined">
                                admin_panel_settings
                            </span>
                            <h3>Gestion</h3>
                        </a>
                        <a href="salir.php" id="salir.php" class="target">
                            <span class="material-symbols-outlined"> logout </span>
                            <h3>Cerrar sesion</h3>
                        </a>
                    </div>
                </div>
                <!-- main-content-grid -->
                <div class="content-grid main-content">
                    <div class="main-content-grid Main-title">
                        <h1>Validacion de usuarios</h1>
                        <div class="theme-mode">
                            <span class="material-symbols-outlined"> dark_mode </span>
                            <span class="material-symbols-outlined"> wb_sunny </span>
                        </div>
                    </div>
                    <?php
                    $qry = "SELECT * FROM reportes WHERE estado = 'Pendiente'";
                    $res = mysqli_query($con, $qry);
                    if (!empty($res) && mysqli_num_rows($res) > 0) {
                    ?>
                        <div class="main-content-grid tabla-datos">
                            <table class="table-1">
                                <thead>
                                    <tr>
                                        <th>Numero de Inventario</th>
                                        <th>Fecha de realizacion</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'database.php';

                                    $equipolistqry = "SELECT * FROM reportes where estado = 'Pendiente'";
                                    $equipolistres = mysqli_query($con, $equipolistqry);

                                    while ($equipodata = mysqli_fetch_assoc($equipolistres)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $equipodata['codigo_equipo']; ?></td>
                                            <td><?php echo $equipodata['fecha_concluido']; ?></td>
                                            <td>
                                                <?php
                                                if ($equipodata['estado'] == 'Pendiente') {
                                                    echo "<span style=\"color:var(--warning-color);\">Pendiente</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <button onclick="openPDFModalValidator(this.value)" type="button" class="btn btn-option" value=<?php echo $equipodata['num_folio']; ?>>
                                                    Detalles
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="main-content-grid tabla-datos" style="justify-self:center; box-shadow:none; font-family:'poppins', sans-serif; color: var(--grey-color); font-size: 2em;">
                            <h3>No hay validaciones pendientes</h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Validacion de reporte</h2>
                    </div>
                    <div class="modal-body">
                        <iframe id="DocPDF" src="" width="100%" style="border: none; height: 66vh;"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button id="validar-reporte" onclick="validarReporte(this.value)" type="button" class="btn btn-ok" value="">
                            Validar
                        </button>
                        <button id="rechazar-reporte" onclick="rechazarReporte(this.value)" type="button" class="btn btn-cancel" value="">
                            Rechazar
                        </button>
                    </div>
                </div>
            </div>
            <script src="dist/js/modal.js"></script>
        </div>
    <?php
} else {
    include 'sinacceso.php';
}
    ?>
    </body>
    <script src="dist/js/script.js"></script>

    </html>