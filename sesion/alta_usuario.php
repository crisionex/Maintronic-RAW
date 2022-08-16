<?php
if (isset($_POST['form_usuario']) && isset($_POST['form_email']) && isset($_POST['form_password'])) {

	if (!empty(trim($_POST['form_usuario'])) && !empty(trim($_POST['form_email'])) && !empty($_POST['form_password'])) {

		$form_usuario = mysqli_real_escape_string($con, htmlspecialchars($_POST['form_usuario']));
		$form_email = mysqli_real_escape_string($con, htmlspecialchars($_POST['form_email']));
		$form_rol = mysqli_real_escape_string($con, htmlspecialchars($_POST['form_rol']));

		if (filter_var($form_email, FILTER_VALIDATE_EMAIL)) {
			$verifico_email = mysqli_query($con, "SELECT `correo` FROM `usuarios` WHERE correo = '$form_email'");

			if (mysqli_num_rows($verifico_email) > 0) {
				$error_message = "El email ingresado ya se encuentra utilizado, utilice otro correo para registrarse.";
			} else {
				$usuario_hash_password = password_hash($_POST['form_password'], PASSWORD_DEFAULT);

				$inserto_usuario = mysqli_query($con, "INSERT INTO `usuarios` (nombre, correo, pswd, permiso) VALUES ('$form_usuario', '$form_email', '$usuario_hash_password', '$form_rol')");
				
				if ($inserto_usuario === TRUE) {
					$success_message = "Registro exitoso";
				} else {
					$error_message = "Algo no salió como esperabamos, error.";
				}
			}
		} else {
			$error_message = "La dirección de email ingresada no es válida.";
		}
	} else {
		$error_message = "Por favor complete los campos vacios.";
	}
}