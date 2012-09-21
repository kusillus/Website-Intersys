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
 	<!--[if IE]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
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
			<form id="formRegistro">
				<label for="">Usuario</label>
				<input type="text" required  id="nuevousuario" pattern="[A-Za-z0-9]+" title="Su Usuario solo puede contener Lestras y/o Numeros" />
				<label for="">Email</label>
				<input type="email" required placeholder="Ingresa un correo valido para confirmar tu cuenta" id="nuevoemail" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" />
				<label for="">Institució a la que Perteneces</label>
				<select name="org" id="org" required>
					<option value="unprg">UNPRG</option>
					<option value="usat">USAT</option>
					<option value="sipan">SIPAN</option>
					<option value="udl">UDL</option>
					<option value="udh">UDCH</option>
					<option value="jmb">JUAN MEJIA BACA</option>
					<option value="senati">SENATI</option>
					<option value="ucv">UCV</option>
					<option value="isatec">ISATEC</option>
					<option value="idad">IDAD</option>
					<option value="otra">Otra</option>
				</select>
				<label for="">Contraseña</label>
				<input type="password" required  id="con1" />
				<label for="">Repita Contraseña</label>
				<input type="password" required  id="con2" />
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
				<input type="submit" value="Registro" id="formcaptcha" />
			</form>
			<img src="images/loader.gif" alt="Cargando" class="cargando" />
			<!--<form>-->
				
				<!--<button id="formcaptcha" >fgsdhfhfsdhfd</button>
    			<input type="button" value="submit" id="formcaptcha" />
			</form>-->
		</div>
	</section>
	<script type="text/javascript">
		$(document).on("ready",function(){
			$("#formRegistro").on("submit",function(event){ 
				$("#formRegistro").css({'opacity':'.2'});
				$(".cargando").css({"display":"block"});
				validarform();
				$("#formRegistro").css({'opacity':'1'});
				$(".cargando").css({"display":"none"});
				event.preventDefault();
			})
			function validarform(){
				var rusuario=$("#nuevousuario").val(),
				remail=$("#nuevoemail").val(),
				rorg=$("#org").val(),
				rcontrasena1=$("#con1").val(),
				rcontrasena2=$("#con2").val();
				if(rcontrasena1!=rcontrasena2){
					$("#rpta").html("las <span>contraseñas</span> no Coinciden reviselas");
				}else{
					$.ajax({
						type: "POST",
						url:"logica/verificacion.php",
						data:"recaptcha_response_field="+$("#recaptcha_response_field").val()+"&recaptcha_challenge_field="+$("#recaptcha_challenge_field").val()+
						"&rusuario="+rusuario+"&rmail="+remail+"&rcontrasena="+rcontrasena1+"&rorg="+rorg,
						success:function(msg){
			         		$("#rpta").html(msg);
			            }
		        	})
				}
				
			}
		});

	</script>
</body>
</html>