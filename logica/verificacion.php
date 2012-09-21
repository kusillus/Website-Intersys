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
						        		$ocado=new cado;
						        		
				//Consultamos para ver si el nombre de usuario esta disponble   SELECT * FROM  `usuario` WHERE  `usuario` LIKE  'skeiter9' or  `email` LIKE  'skeiter_9@hsdfs.com'
										$verificausuario="select usuario from usuario where usuario like '".$_POST["rusuario"]."'";
										$consulta=$ocado->ejecutar($verificausuario);
						        		if( $consulta ){
						        			$existe = mysql_num_rows($consulta);
						        			//echo $consulta;
						        			if($existe>=1){
						        				echo "Lo sentimos el nombre de Usuario solicitado ya esta en Uso " ;
						        			}else{
						        				$verificacorreo="select usuario from usuario where email like '".$_POST["rmail"]."'";
						        				$consulta2=$ocado->ejecutar($verificacorreo);
						        				$existecorreo=mysql_num_rows($consulta2);
						        				if($existecorreo>=1){
						        					echo " El <span class='error'>correo</span> Ingresado esta Siendo usado por otro usuario " ;
						        				}else{
						        					$sql="insert into usuario values ('null','".$_POST["rusuario"]."','".$_POST["rmail"]."','".$_POST["rorg"]."','".$_POST["rcontrasena"]."' );";
						        					$res=$ocado->ejecutar($sql);
													if($res){
														echo "bn";
													}else{
														echo "Ocurrio un Error en el ultimo paso";
													}
						        				}
						        			}
						        		}else{
											echo "No se ha podido registrar - error de Conexion";
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

 ?>