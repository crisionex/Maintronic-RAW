<?php

if (isset($_POST['form_email']) && isset($_POST['form_password'])) {

	if (!empty(trim($_POST['form_email'])) && !empty(trim($_POST['form_password']))) {

		$form_email = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['form_email'])));
		$query = mysqli_query($con, "SELECT * FROM `usuarios` WHERE correo = '$form_email'");

		if (mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			echo password_verify($_POST['form_password'], $row['pswd']);

			if (password_verify($_POST['form_password'], $row['pswd'])) {

				session_regenerate_id(true);
				$_SESSION['email'] = $form_email;
				header('Location: ../index.php');
				exit;
			} else {
				$error_message = "Informacion incorrecta";
			}
		} else {
			$error_message = "Contraseña o email incorrectos.";
		}
	} else {
		$error_message = "Por favor complete los campos vacios.";
	}
}
