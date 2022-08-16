<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";
include_once "database.php";
if ($datosUsuario['permiso'] == 'Encargado') {
?>

<link rel="stylesheet" href="dist/css/Style.css">
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
          <a href="index.php" id="index.php" class="selected-a">
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
          <a href="registrar.php" id="regstrar.php" class="target">
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
          <h1>Panel Administrativo</h1>
          <div class="theme-mode">
            <span class="material-symbols-outlined"> dark_mode </span>
            <span class="material-symbols-outlined"> wb_sunny </span>
          </div>
        </div>

        <!-- card-1 -->
        <div class="main-content-grid card card-1">
          <div class="card-icon">
            <span class="material-symbols-outlined"> pending </span>
          </div>
          <div class="card-progress">
            <?php
            $qry = "SELECT * FROM reportes WHERE estado = 'Pendiente'";
            $res = mysqli_query($con, $qry);
            $i = 0;
            while ($row = mysqli_fetch_assoc($res)) {
              $i++;
            }
            echo $i;
            ?>
          </div>
          <div class="card-title">
            <h4>En espera</h4>
            <br />
            <p style="font-family: 'fredoka', 'sans-serif'">Reportes</p>
          </div>
        </div>

        <!-- card-2 -->
        <div class="main-content-grid card card-2">
          <div class="card-icon">
            <span class="material-symbols-outlined"> check_circle </span>
          </div>
          <div class="card-progress">
            <?php
            $qry = "SELECT * FROM reportes WHERE estado = 'Validado' OR estado = 'Rechazado'";
            $res = mysqli_query($con, $qry);
            $i = 0;
            while ($row = mysqli_fetch_assoc($res)) {
              $i++;
            }
            echo $i;
            ?>
          </div>
          <div class="card-title">
            <h4>Revisados</h4>
            <br />
            <p style="font-family: 'fredoka', 'sans-serif'">Reportes</p>
          </div>
        </div>

        <!-- Card-3 -->
        <div class="main-content-grid card card-3">
          <div class="card-icon">
            <span class="material-symbols-outlined">pending_actions</span>
          </div>
          <div class="card-progress">
            <?php
            $qry = "SELECT * FROM inv_equipo WHERE condiciones = 'R' OR condiciones = 'M'";
            $res = mysqli_query($con, $qry);
            $i = 0;
            while ($row = mysqli_fetch_assoc($res)) {
              $i++;
            }
            echo $i;
            ?>
          </div>
          <div class="card-title">
            <h4>Pendientes</h4>
            <br />
            <p style="font-family: 'fredoka', 'sans-serif'">Mantenimientos</p>
          </div>
        </div>

        <!-- Estadistics-and-data-labels -->
        <div class="main-content-grid title-table">
          <br />
          <h2>Estadisticas</h2>
        </div>

        <!-- Chart-three-types-of-data -->
        <div class="main-content-grid grafica-estadisticas">
          <br />
          <canvas id="myChart"></canvas>
          <br />
        </div>

        <!-- Data-table -->
        <div class="main-content-grid tabla-datos"></div>
        <!-- side-content -->
        <div class="main-content-grid side-grid">
          <div class="side-content-grid SC-updates-title">
            <h3>Actualizaciones</h3>
          </div>
          <div class="side-content-grid SC-updates" style="display: flex; justify-content: center">
            <table style="font-size: 1rem;">
              <tbody>
                <?php
                $qry = "SELECT * FROM reportes ORDER BY id_reporte DESC LIMIT 4";
                $res = mysqli_query($con, $qry);
                $x = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                  $x++;
                  if ($x !=  mysqli_num_rows($res)) {
                ?>
                    <tr>
                    <?php } else { ?>
                    <tr style="border: none;">
                    <?php } ?>
                    <td>
                      <div class="update" style="border-left: 5px solid var(--main-color); padding-left:15px;">
                        <p> <?php echo $row['nombre_asignado'] . " ha subido un reporte"; ?></p>
                        <p style="position: relative; color: var(--grey-color); font-size:0.7rem; left:0px;"> <?php echo $row['fecha_realizacion']; ?></p>
                      </div>
                    </td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="side-content-grid SC-analytics-title">
            <h3>Analisis</h3>
          </div>
          <div class="side-content-grid SC-analytics" style="display: flex; justify-content: center">
            <table>
              <thead>
                <tr>
                  <th>
                    Estado del equipo
                  </th>
                  <th>

                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $qry = "SELECT * FROM inv_equipo";
                $res = mysqli_query($con, $qry);
                $operative = 0;
                $maintenance = 0;
                $nonoperative = 0;
                $num_rows = mysqli_num_rows($res);
                while ($row = mysqli_fetch_assoc($res)) {
                  switch ($row['condiciones']) {
                    case '0':
                      $operative++;
                      break;
                    case 'R':
                      $maintenance++;
                      break;
                    case 'M':
                      $nonoperative++;
                      break;
                    default:
                      break;
                  }
                }
                ?>
                <tr>
                  <td>
                    Operativo:
                  </td>
                  <td style="color: var(--success-color);">
                    <?php echo (round(((int)$operative / $num_rows), 4) * 100) . "%"; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Mantenimiento:
                  </td>
                  <td style="color: var(--warning-color);">
                    <?php echo (round(((int)$maintenance / $num_rows), 4) * 100) . "%"; ?>
                  </td>
                </tr>
                <tr style="border: none;">
                  <td>
                    No operativo:
                  </td>
                  <td style="color: var(--danger-color);">
                    <?php echo (round(((int)$nonoperative / $num_rows), 4) * 100) . "%"; ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
} else {
    echo "<script> window.location = 'reportes.php' </script>";
}
    ?>
</body>
<script></script>
<?php
include "footer.php";
?>

</html>
<script src="dist/js/script.js"></script>