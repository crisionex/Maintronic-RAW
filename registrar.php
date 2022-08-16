<?php
session_start();
require 'database.php';
require 'sesion/alta_usuario.php';
?>
<!DOCTYPE html>
<html lang="es">

<?php include('head.php');

if ($datosUsuario['permiso'] == 'Encargado') {
?>
    <link rel="stylesheet" href="dist/css/genstyle.css">
    <link rel="stylesheet" href="dist/css/stylemodal.css">
    <link rel="stylesheet" href="dist/css/registrostyle.css">
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
                        <a href="registrar.php" id="registrar.php" class="selected-a">
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
                        <h1>Gestion de usuarios</h1>
                        <div class="theme-mode">
                            <span class="material-symbols-outlined"> dark_mode </span>
                            <span class="material-symbols-outlined"> wb_sunny </span>
                        </div>
                    </div>
                    <div class="main-content-grid tabla-datos">
                        <table class="table-1">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qry = "SELECT * FROM usuarios";
                                $res = mysqli_query($con, $qry);
                                while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?> </td>
                                        <td><?php echo $row['correo'] ?> </td>
                                        <td><?php echo $row['permiso'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="main-content-grid form-report">
                        <form class="form-grid" action="" method="POST">
                            <h2> Creacion de cuenta </H2>
                            <br>
                            <div class="form-group">
                                <label for="username" class="form-label"><b>Usuario</b></label>
                                <input autocomplete="off" autofill="off" type="text" class="form-control" placeholder="Ingrese nombre de usuario" id="username" name="form_usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label"><b>Email</b></label>
                                <input autocomplete="off" autofill="off" type="email" class="form-control" placeholder="Ingrese email" id="email" name="form_email" required>
                            </div>
                            <div class="form-group">
                                <label for="password"><b>Constraseña</b></label>
                                <input type="password" class="form-control" placeholder="Ingrese contraseña" id="password" name="form_password" required>
                            </div>
                            <div class="form-group" id="dhide">
                                <label for="form-control"><b>Rol asignado</b></label>
                                <select class="form-control" name="form_rol">
                                    <option value="Encargado">Encargado de mantenimiento</option>
                                    <option value="Tecnico">Tecnico de mantenimiento</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-option">Registrar</button>
                            <?php
                            if (isset($success_message)) {
                                echo '<br><div class="row justify-content-md-center"><div class="alert alert-success" role="alert">' . $success_message . '</div></div>';
                            }
                            if (isset($error_message)) {
                                echo '<br><div class="row justify-content-md-center"><div class="alert alert-danger" role="alert">' . $error_message . '</div></div>';
                            }
                            ?>
                        </form>
                    </div>
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