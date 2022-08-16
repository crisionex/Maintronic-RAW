<?php
include "head.php";
if ($datosUsuario['permiso'] == 'Encargado') {
?>
    <link rel="stylesheet" href="dist/css/styleinv.css">
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
                        <a href="index.php" id="index.php" class="target">
                            <span class="material-symbols-outlined"> event_note </span>
                            <h3>Bitacora</h3>
                        </a>
                        <a href="inventarios.php" id="inventarios.php" class="selected-a">
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
                        <h1>Inventario de equipo</h1>
                        <button onclick="openModal2()" class="btn btn-option">Añadir Equipo</button>
                        <div class="theme-mode">
                            <span class="material-symbols-outlined"> dark_mode </span>
                            <span class="material-symbols-outlined"> wb_sunny </span>
                        </div>
                    </div>

                    <div class="main-content-grid tabla-datos">
                        <table class="table-1">
                            <thead>
                                <tr>
                                    <th>Numero de Inventario</th>
                                    <th>Descripcion</th>
                                    <th>Condiciones</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'database.php';

                                $equipolistqry = "SELECT * FROM inv_equipo";
                                $equipolistres = mysqli_query($con, $equipolistqry);

                                while ($equipodata = mysqli_fetch_assoc($equipolistres)) {
                                ?>
                                    <tr>
                                        <td><?php echo $equipodata['numero_inv']; ?></td>
                                        <td><?php echo $equipodata['nom_eq']; ?></td>
                                        <td>
                                            <?php
                                            if ($equipodata['condiciones'] == '0') {
                                                echo "<span style=\"color:var(--success-color);\">Operativo</span>";
                                            } elseif ($equipodata['condiciones'] == 'R') {
                                                echo "<span style=\"color:var(--warning-color);\">Mantenimiento</span>";
                                            } elseif ($equipodata['condiciones'] == 'M') {
                                                echo "<span style=\"color:var(--danger-color);\">No operativo</span>";
                                            } ?>
                                        </td>
                                        <td>
                                            <button onclick="openModal(this.value)" type="button" class="btn btn-option" value=<?php echo $equipodata['id_inv']; ?>>
                                                <span class="material-symbols-outlined">
                                                    edit
                                                </span>
                                            </button>
                                            <button onclick="deleteEquipment(this.value)" type="button" class="btn btn-cancel" value=<?php echo $equipodata['id_inv']; ?>>
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>
                            </tbody>
                        </table>
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
                        <label for="nigger">El equipo actualmente se encuentra en estado:</label><br>
                        <select class="dropdown" name="nigger" id="nigger">
                            <option value="0">Operativo</option>
                            <option value="R">Regular</option>
                            <option value="M">No operativo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button onclick="sendInfo(this.value)" type="button" class="btn btn-option" id="btn-modal-ok" value="">
                            Editar estado
                        </button>
                        <button onclick="closeModal()" type="button" class="btn btn-cancel">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>

            <div id="my-modal-2" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close close2">&times;</span>
                        <h2>Añadir Equipo</h2>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nigger1">Numero de inventario</label><br>
                            <input id="nigger1" autocomplete="off" autofill="off" autofill="off" type="text" name="num_inv" placeholder="Numero de inventario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nigger2">Descripcion del equipo</label><br>
                            <input id="nigger2" autocomplete="off" autofill="off" autofill="off" type="text" name="nom_eq" placeholder="Descripcion del equipo" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="addEquipment()" type="button" class="btn btn-option">
                            Añadir equipo
                        </button>
                        <button onclick="closeModal2()" type="button" class="btn btn-cancel">
                            Cerrar
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