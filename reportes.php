<?php
include "head.php";
?>
<script src="https://www.jsdelivr.com/package/npm/pdfjs-dist"></script>
<link rel="stylesheet" href="dist/css/genstyle.css">
<link rel="stylesheet" href="dist/css/stylemodal.css">
<link rel="stylesheet" href="dist/css/stylereport.css">
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
                    <?php if ($datosUsuario['permiso'] != 'Tecnico') { ?>
                        <a href="index.php" id="index.php" class="target">
                            <span class="material-symbols-outlined"> event_note </span>
                            <h3>Bitacora</h3>
                        </a>
                        <a href="inventarios.php" id="inventarios.php" class="target">
                            <span class="material-symbols-outlined"> inventory_2 </span>
                            <h3>Inventario</h3>
                        </a>
                        <a href="validaciones.php" id="validaciones.php" class="target">
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
                    <?php } ?>
                    <a href="reportes.php" id="reportes.php" class="selected-a">
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
                    <?php if ($datosUsuario['permiso'] != 'Tecnico') { ?>
                        <a href="registrar.php" id="registrar.php" class="target">
                            <span class="material-symbols-outlined">
                                admin_panel_settings
                            </span>
                            <h3>Gestion</h3>
                        </a>
                    <?php } ?>
                    <a href="salir.php" id="salir.php" class="target">
                        <span class="material-symbols-outlined"> logout </span>
                        <h3>Cerrar sesion</h3>
                    </a>
                </div>
            </div>
            <!-- main-content-grid -->
            <div class="content-grid main-content">
                <div class="main-content-grid Main-title">
                    <h1>Reportes</h1>
                    <div class="theme-mode">
                        <span class="material-symbols-outlined"> dark_mode </span>
                        <span class="material-symbols-outlined"> wb_sunny </span>
                    </div>
                </div>
                <div class="main-content-grid title-1">
                    <h3>Reportes pendientes</h3>
                </div>
                <?php
                $qry = "SELECT * FROM inv_equipo WHERE condiciones = 'M'";
                $res = mysqli_query($con, $qry);
                if (!empty($res) && mysqli_num_rows($res) > 0) {
                ?>
                    <div class="main-content-grid tabla-datos">
                        <table class="table-1">
                            <thead>
                                <tr>
                                    <th>Numero de Inventario</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'database.php';
                                $equipolistqry = "SELECT * FROM inv_equipo WHERE condiciones = 'M'";
                                $equipolistres = mysqli_query($con, $equipolistqry);
                                while ($equipodata = mysqli_fetch_assoc($equipolistres)) {
                                ?>
                                    <tr>
                                        <td><?php echo $equipodata['numero_inv']; ?></td>
                                        <td>
                                            <button onclick="genreport(this.value)" type="button" class="btn btn-option" value=<?php echo $equipodata['id_inv']; ?>>
                                                Generar reporte
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
                        <h3>No hay reportes pendientes</h3>
                    </div>
                <?php } ?>
                <div class="main-content-grid title-2">
                    <h3>Historial de reportes</h3>
                </div>
                <?php
                $qry = "SELECT * FROM reportes";
                $res = mysqli_query($con, $qry);
                if (!empty($res) && mysqli_num_rows($res) > 0) {
                ?>
                    <div class="main-content-grid tabla-datos">
                        <table class="table-2">
                            <thead>
                                <tr>
                                    <th>Equipo</th>
                                    <th>Fecha de captura</th>
                                    <th>Estatus</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'database.php';
                                $equipolistqry = "SELECT * FROM reportes ORDER BY id_reporte DESC";
                                $equipolistres = mysqli_query($con, $equipolistqry);
                                while ($equipodata = mysqli_fetch_assoc($equipolistres)) {
                                ?>
                                    <tr>
                                        <td><?php echo $equipodata['codigo_equipo']; ?></td>
                                        <td><?php echo $equipodata['fecha_concluido']; ?></td>
                                        <td>
                                            <?php
                                            if ($equipodata['estado'] == 'Validado') {
                                                echo "<span style=\"color:var(--success-color);\">Validado</span>";
                                            } elseif ($equipodata['estado'] == 'Pendiente') {
                                                echo "<span style=\"color:var(--warning-color);\">Pendiente</span>";
                                            } elseif ($equipodata['estado'] == 'Rechazado') {
                                                echo "<span style=\"color:var(--danger-color);\">Rechazado</span>";
                                            } ?>
                                        <td>
                                            <button onclick="openPDFModal(this.value)" type="button" class="btn btn-option" value=<?php echo $equipodata['num_folio']; ?>>
                                                Visualizar
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
                        <h3>No hay historial de reportes</h3>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="my-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Visualizacion de reporte</h2>
                </div>
                <div class="modal-body">
                    <iframe id="DocPDF" src="" width="100%" style="border: none; height: 66vh;"></iframe>
                </div>
                <div class="modal-footer">
                    <button onclick="closeModal()" type="button" class="btn btn-cancel" id="btn-modal-ok" value="">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
        <script src="dist/js/modal.js"></script>
    </div>
</body>
<script src="dist/js/script.js"></script>

</html>