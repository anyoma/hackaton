<?php
require ('conex.php');
class localidad_pais extends  DB_my{

var $Idregistro;
var $Nombre;


function localidad_pais($Idregistro= "", $Nombre= "") {
$this->Idregistro = $Idregistro;
$this->Nombre = $Nombre;


}

function ListaCP(){
$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM localidad_pais";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[1])."</option>\n";		
	
}
	}
return 	$combo;

	}	
	//funcion ciudad
function ListaCid($estd){
$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM localidad_mexico where id_estado='".$estd."'";	
	$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
if($estd==$row[0]){
	$yq="selected='selected'";
	}else{
	$yq="";	
		}
$combo.="<option value='".$row[0]."' ".$yq.">".utf8_encode($row[1])."</option>\n";		
	
}
	}
return 	$combo;
	
	}
//fin de funcion ciudad	
	
	}
?>