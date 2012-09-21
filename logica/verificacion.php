<?php 

						require_once('../recursos/recaptcha/recaptchalib.php');
						require_once('cado.php');

						// Get a key from https://www.google.com/recaptcha/admin/create
						$publickey = "6LfDddYSAAAAAHSgCm9PJIGnvCFQVF6IiIn9h7sD";
						$privatekey = "6LfDddYSAAAAAJ4IYdYFI0nlH8GlMJsrQn165JqV";
						# the response from reCAPTCHA
						$resp = null;
						# the error code from reCAPTCHA, if any
						$error = null;
 //+remail+rcontrasena1,
						# was there a reCAPTCHA response?
						if ($_POST["recaptcha_response_field"]!=""&& $_POST["rusuario"]!=""){
							if ($_POST["recaptcha_response_field"]) {
						        $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

						        if ($resp->is_valid) {
						        		$sql="insert into usuario values ('null','".$_POST["rusuario"]."','".$_POST["rmail"]."','".$_POST["rorg"]."','".$_POST["rcontrasena"]."' );";
										//echo $sql;
						        		$ocado=new cado;
										/*$sql="insert into usuario ('null','".$_POST["rusuario"]."','".$_POST["rmail"]."','".$_POST["rorg"]."','".$_POST["rcontrasena"]."' );";
										echo $sql;*/
										$res=$ocado->ejecutar($sql);
						        		if( $res ){
						        			echo "<span>Su registro ha sido exitoso :D</span> ";
						        		}else{
											echo "No se ha podido registrar";
						        		}

						        } else {
						                # set the error code so that we can display it
						                $error = $resp->error;
						                //echo '<p id="rpta">mal</p>';
						                echo  "El reCAPTCHA es incorrecto, intentelo de nuevo";
						        }
							}
						}else{
							echo "Debe Ingresar las palabras :p";
						}
						


						/*$totEmp = mysql_num_rows($resEmp);
Mostrando los resultados.
Finalmente mostramos los resultados obtenidos de nuestra consulta, para ello extraemos cada resultado utilizando la función mysql_fetch_assoc la cual devuelve una matriz asociativa utilizando los nombres de los campos de la tabla.
if ($totEmp> 0) {
   while ($rowEmp = mysql_fetch_assoc($resEmp)) {
      echo "<strong>".$rowEmp['nombre']."</strong><br>";
      echo "Direccion: ".$rowEmp['direccion']."<br>";
      echo "Telefono: ".$rowEmp['telefono']."<br><br>";
   }
}*/
 ?>