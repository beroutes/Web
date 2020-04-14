<?php
	if(isset($_POST['email'])) {

		// EDIT THE 2 LINES BELOW AS REQUIRED
		$email_to = "beroutes@exodusttt.es";
		$email_subject = "Mensaje de Contacta con nosotros";

		function died($error) {
			// your error code can go here
			echo "Lo sentimos mucho, hemos encontrado errores en el envio del formulario. ";
			echo "Los errores aparecen debajo.<br /><br />";
			echo $error."<br /><br />";
			echo "Por favor, vuelve atras y corrige los errores.<br /><br />";
			die();
		}


		// validation expected data exists
		if(!isset($_POST['name']) ||
			!isset($_POST['email']) ||
			!isset($_POST['message'])) {
			died('Lo sentimos, algo ha fallado al realizar el envio del formulario.');       
		}



		$name = $_POST['name']; // required
		$email_from = $_POST['email']; // required
		$message = $_POST['message']; // required

		$error_message = "";
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

		if(!preg_match($email_exp,$email_from)) {
			$error_message .= 'El Email introducido no es correcto.<br />';
		}

		$string_exp = "/^[A-Za-z .'-]+$/";

		if(!preg_match($string_exp,$name)) {
			$error_message .= 'El nombre no es válido.<br />';
		}

		if(strlen($message) < 2) {
			$error_message .= 'El mensaje introducido no es válido.<br />';
		}

		if(strlen($error_message) > 0) {
			died($error_message);
		}

		$email_message = "Form details below.\n\n";


		function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
		}

		$email_message .= "Nombre: ".clean_string($name)."\n";
		$email_message .= "Email: ".clean_string($email_from)."\n";
		$email_message .= "Mensaje: ".clean_string($message)."\n";

		// create email headers
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);  

		header('Refresh: 5; URL=http://exodusttt.es/');
	}
?>

Gracias por contactar con nosotros. Responderemos en breve.

	

	
	