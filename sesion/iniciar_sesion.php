<?php
session_start();
require '../database.php';
require 'login.php';

if (isset($_SESSION['email'])) {
  header('Location: ../index.php');
  exit;
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- google icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- google-icons-style -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../dist/css/stylelogin.css" />
  <title>Iniciar sesion</title>
</head>

<body>
  <form action="" method="POST">
    <div class="login-grid login">
      <form>
        <div class="login-grid-content title">
          <h1>MecaMatic</h1>
          </h1>
          <br>
          <h2>Iniciar Sesion</H2>
          <br>
        </div>
        <div class="login-grid-content email">
          <label for="email" class="email-label">Correo electronico</label><br>
          <input type="email" class="email-textfield" id="email" aria-describedby="emailHelp" name="form_email" required>
        </div>
        <div class="login-grid-content password">
          <label for="password" class="password-label">Contraseña</label><br>
          <input type="password" class="password-textfield" id="password" name="form_password" required>
        </div>
        <button type="submit" class="login-grid-content btn-login">Iniciar sesion</button>
      </form>
      <div class="theme-mode">
        <span class="material-symbols-outlined"> dark_mode </span>
        <span class="material-symbols-outlined"> wb_sunny </span>
      </div>
    </div>
    <?php
    if (isset($success_message)) {
      echo '<br><div class=""><div class="" role="alert">' . $success_message . '</div></div>';
    }
    if (isset($error_message)) {
      echo '<br><div class=""><div class="" role="alert">' . $error_message . '</div></div>';
    }
    ?>
  </form>
</body>

<script>
  const themeMode = document.querySelector(".theme-mode");

  themeMode.addEventListener("click", () => {
    document.body.classList.toggle("dark-theme");
  });
</script>

</html>