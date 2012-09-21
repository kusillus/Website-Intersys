<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	 <script type="text/javascript">
	 var RecaptchaOptions = {
	    lang : 'es',theme : 'clean'
	 };
 	</script>
</head>
<body>
	<section id="formularios">
		<div class="login">
			<h2>Login</h2>
			<form action="">
				<label for="text">Usuario</label>
				<input type="text" required id="lUsuario"/>
				<label for="">Contraseña</label>
				<input type="password" required id="lContrasena"/>
				<input type="button" value="Login">
			</form>
		</div>
		<div class="registro">
			<h2>Registro</h2>
			<form action="" id="formRegistro">
				<label for="">Usuario</label>
				<input type="text" required  id="rUsuario" />
				<label for="">Email</label>
				<input type="email" required placeholder="Ingresa un correo valido para confirmar tu cuenta" id="rEmail" />
				<label for="">Contraseña</label>
				<input type="password" required  id="rContrasena1" />
				<label for="">Repita Contraseña</label>
				<input type="password" required  id="rContrasena2" />
				<label >Ingrese las palabras:</label>
				<div class="recaptcha">
					<p id="rpta">  </p>
					<?php
						require_once('recursos/recaptcha/recaptchalib.php');
						$publickey = "6LfDddYSAAAAAHSgCm9PJIGnvCFQVF6IiIn9h7sD";
						$privatekey = "6LfDddYSAAAAAJ4IYdYFI0nlH8GlMJsrQn165JqV";
						echo recaptcha_get_html($publickey, $error);
					?>
				</div>
				<input type="button" value="Registro" id="formcaptcha" />
			</form>
			<!--<form>-->
				
				<!--<button id="formcaptcha" >fgsdhfhfsdhfd</button>
    			<input type="button" value="submit" id="formcaptcha" />
			</form>-->
		</div>
	</section>
	<script type="text/javascript">
		$(document).on("ready",function(){
			$("#formcaptcha").click(function(){
				$.ajax({
					type: "POST",
					url:"logica/verificacion.php",
					data:"recaptcha_response_field="+$("#recaptcha_response_field").val()+"&recaptcha_challenge_field="+$("#recaptcha_challenge_field").val(),
					success:function(msg){
		         		$("#rpta").html(msg);
		      }})
			})
		});
	</script>
</body>
</html>