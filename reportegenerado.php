<?php
include "head.php";
if (isset($_GET['id_inv'])) {

    $YI = $_GET['YI'];
    $MI = $_GET['MI'];
    $DI = $_GET['DI'];

    $qry = "SELECT * FROM inv_equipo WHERE id_inv = '" . $_GET['id_inv'] . "'";
    $res = mysqli_query($con, $qry);
    $datosEquipo = mysqli_fetch_assoc($res);

?>
    <link rel="stylesheet" href="dist/css/genstyle.css">
    <link rel="stylesheet" href="dist/css/genreportstyle.css">
    <link rel="stylesheet" href="dist/css/stylemodal.css">
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
                        <h1>Reporte: Mantenimiento Correctivo</h1>
                        <div class="theme-mode">
                            <span class="material-symbols-outlined"> dark_mode </span>
                            <span class="material-symbols-outlined"> wb_sunny </span>
                        </div>
                    </div>
                    <div class="main-content-grid title-1">
                        <h3>Llene los siguientes campos</h3>
                    </div>
                    <div class="main-content-grid form-report">
                        <form class="form-grid" method="POST" action="query/reporte_db.php">
                            <div class="form-group a">
                                <label for="tipo_mantenimiento">Mantenimiento</label>
                                <br>
                                <select id="tipo_mantenimiento" class="form-control" name="tipo_mantenimiento">
                                    <option value="Interno">Interno</option>
                                    <option value="Externo">Externo</option>
                                </select>
                            </div>
                            <div class="form-group b">
                                <label for="num_folio">No. de folio de solicitud</label>
                                <br>
                                <input id="num_folio" autocomplete="off" autofill="off" autofill="off" type="text" name="num_folio" placeholder="Numero de folio" class="form-control" required>
                            </div>
                            <div class="form-group c">
                                <label for="compra_material">Compra de material</label>
                                <br>
                                <select id="compra_material" class="form-control" name="compra_material">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group d">
                                <label for="turno">Turno</label>
                                <br>
                                <select id="turno" class="form-control" name="turno">
                                    <option value="Diurno">Diurno</option>
                                    <option value="Nocturno">Nocturno</option>
                                </select>
                            </div>
                            <div class="form-group e">
                                <label for="area_solicitante">Area solicitante</label>
                                <br>
                                <input id="area_solicitante" autocomplete="off" autofill="off" autofill="off" type="text" name="area_solicitante" placeholder="Area solicitante" class="form-control" required>
                            </div>
                            <div class="form-group f">
                                <label for="num_linea">No. linea</label>
                                <br>
                                <input id="num_linea" autocomplete="off" autofill="off" autofill="off" type="text" name="num_linea" placeholder="No. linea" class="form-control" required>
                            </div>
                            <div class="form-group g">
                                <label for="supervisor_area">Supervisor del area</label>
                                <br>
                                <select id="supervisor_area" class="form-control" name="supervisor_area">
                                    <?php
                                    $qry = "SELECT * FROM usuarios WHERE permiso = 'Encargado'";
                                    $res = mysqli_query($con, $qry);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <option value=<?php echo $row['usid'] ?>><?php echo $row['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="nombre_asignado" value=<?php echo $datosUsuario['nombre']; ?>>
                            <input type="hidden" name="cargo_asignado" value=<?php echo $datosUsuario['permiso']; ?>>
                            <input type="hidden" name="contacto_asignado" value=<?php echo $datosUsuario['correo']; ?>>
                            <input type="hidden" name="fecha_realizacion" value=<?php echo $YI . "-" . $MI . "-" . $DI; ?>>
                            <input type="hidden" name="fecha_concluido" value=<?php echo "" . date('Y') . "-" . date('M') . "-" . ((int)date('j') - 1) . ""; ?>>
                            <input type="hidden" name="codigo_equipo" value=<?php echo $datosEquipo['numero_inv']; ?>>
                            <input type="hidden" name="id_inv" value=<?php echo $_GET['id_inv']; ?>>
                            <input type="hidden" name="estado" value="Pendiente">
                            <div class="form-group h">
                                <label for="descripcion_equipo">Descripcion</label>
                                <br>
                                <input id="descripcion_equipo" autocomplete="off" autofill="off" autofill="off" type="text" name="descripcion_equipo" placeholder="Descripcion" class="form-control" required>
                            </div>
                            <div class="form-group i">
                                <label for="problema_equipo">Problema de equipo</label>
                                <br>
                                <select id="problema_equipo" class="form-control" name="problema_equipo">
                                    <option value="Fallo">Fallo</option>
                                    <option value="Averia">Averia</option>
                                </select>
                            </div>
                            <div class="form-group j">
                                <label for="observaciones_equipo">Observaciones</label>
                                <br>
                                <textarea id="observaciones_equipo" name="observaciones_equipo" rows="4" cols="100"></textarea>
                                <button type="submit" class="btn btn-option">
                                    Enviar reporte
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Estado del Equipo</h2>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
            <script src="dist/js/modal.js"></script>
        </div>
    </body>
    <script src="dist/js/script.js"></script>

    </html>
<?php
} else {
    echo "console.location ='index.php'";
} ?>