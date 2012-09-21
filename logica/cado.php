<?php 
 class cado{
 	
	public function ejecutar($sql){
		$host="localhost";		
		$user="root";		
		$clave="root";		
		$bd="intersys2012";	
		$conexion=mysql_pconnect($host,$user,$clave)or die("No se pudo conectar");
		mysql_select_db("intersys2012",$conexion)or die("no se pudo encontrar la base de datos");

		$result = mysql_query ($sql,$conexion ) or die("Error en la consulta SQL");
		mysql_close($conexion);
		return $result;
	}
}
?>
