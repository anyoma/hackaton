<?php
require ('conex.php');
class carreras extends  DB_my{

var $Idc;
var $Nombre;
var $Id_idioma;

function carreras($Idc= "", $Nombre= "", $Id_idioma= "") {
$this->Idc = $Idc;
$this->Nombre = $Nombre;
$this->Id_idioma = $Id_idioma;


}

function ListaTep(){
	
	$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  tipos_e ORDER BY  id_tipp";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[1])." </option>\n";		
	
}
	}
return 	$combo;	
	
	
	}
//funcion nueva vacante
function Nueva_V($tep,$puesto,$pro,$sal,$hra,$act,$dv,$reqs,$pss,$ces,$id_est_v,$emp){
	$comboo="";
	$miconexion = new DB_my ();
$fech=date("Y-m-d H:i:s");	
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO vacante_p(id_vacante,id_empresa,fechapubli,puesto,id_ca,salario,horario,requisitos,descrip,dias_val,id_est_v,id_persn_add) ";		
$SQL1.="VALUES (NULL,'".$emp."','".$fech."','".$puesto."','".$pro."','".$sal."','".$hra."','".$reqs."','".$act."','".$dv."','".$id_est_v."','".$pss."');";
$miconexion->consulta($SQL1);
$comboo="Vacante envianda a  Revisión Exitosamente";
return $comboo;

	}
//fin de funcion nueva vacante	
//funcion publicar vacantes
function Actualizarv(){
$fechacv=date("Y-m-d H:i:s"); 	
	$combo="";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  vacante_p  JOIN user ON user.id_user=vacante_p.id_persn_add  WHERE id_est_v='1'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)){	
$vac=$row[0];
$Puesto=$row[4];
$desp=$row[8];
$reqs=$row[9];
$corro=$row[20];
$fechaa=$row[2];
$rech=0;

$combo.=$Puesto."-".$desp."-".$reqs."-".$corro."<br/>";
$miconexion2 = new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL2="SELECT * FROM  palabras_rev";
$miconexion2->consulta($SQL2);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
	while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
	$palabra_v=$row2[1];
	$pos = strpos($desp, $palabra_v);
	$pos2=strpos($reqs, $palabra_v);
	if ( $pos !== false ) { 
	$rech=1;
	$cont=1;
   $palabra_v1.=$palabra_v.",";	
//$combo.=" <br/> La cadena ' $palabra_v ' fue encontrada en la cadena ' $desp '" ; 
//echo " ya existe en la posición $pos <br/>" ; 
} else { 
$rech=0;
//echo $combo.=" <br/> La cadena ' $palabra_v ' no fue encontrada en la cadena ' $desp '" ; 
}
if ( $pos2 !== false ) { 
	
	$cont2=1;
   $palabra_v2.=$palabra_v.",";	
//$combo.=" <br/> La cadena ' $palabra_v ' fue encontrada en la cadena ' $desp '" ; 
//echo " ya existe en la posición $pos <br/>" ; 
} else { 
$rech=0;
//echo $combo.=" <br/> La cadena ' $palabra_v ' no fue encontrada en la cadena ' $desp '" ; 
} 

	
		
	}
	if($cont==1 || $cont2==1){
$combo.="<br/>Estimado (a)  ".$row[17]." ".$row[18];		
$combo.="<br/> La vacante: $Puesto Agregada el día: $row[2] <br/>  fue rechazada por contener palabras inapropiadas : ".$palabra_v1." en la Descripción <br/>";
$combo.=" y contener  ".$palabra_v2." en los Requísitos de la Vacante<br/>";	
$combo.=" Le sugerimos Modificar los datos de la vacante en un Máximo de 48 Horas  o el sistema lo eliminará de manera Automática<br/><br/>";
$miconexion201= new DB_my();
$miconexion201->conectar($bd, $host, $user, $pass);
$SQLup1="UPDATE vacante_p  SET id_est_v='6', fecha_valid='".$fechacv."' WHERE id_vacante='".$vac."' ";
$miconexion201->consulta($SQLup1);
	}else{
$miconexion20= new DB_my();
$miconexion20->conectar($bd, $host, $user, $pass);
$SQLup="UPDATE vacante_p  SET id_est_v='2', fecha_valid='".$fechacv."' WHERE id_vacante='".$vac."' ";
$miconexion20->consulta($SQLup);		
$combo.=" La vacante fue Aceptada <br/><br/> ";			
		}
	
	}

}
}
 return $combo;
	
	}	
	
//fin de funcion publicar vacantes
function ListaDiasv(){
$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  dias_validos ORDER BY  id_dias";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[1])." </option>\n";		
	
}
	}
return 	$combo;	
	
	
	}

function ListaHorarios(){
	$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  horarios ORDER BY  id_hor";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>   De   ".utf8_encode($row[1])."    Hasta   ".utf8_encode($row[2])." </option>\n";		
	
}
	}
return 	$combo;	
	
	
	}

function ListaSalario(){
		$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  salario ORDER BY  id_salar";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'> $ ".utf8_encode($row[1])."</option>\n";		
	
}
	}
return 	$combo;
	
	}

function ListaE($ps){
	$opcion="";
	$miconexion2 = new DB_my ();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  escolaridad  join categorias_carreras on categorias_carreras.id_cat=escolaridad.id_cat_car WHERE id_usuari='".$ps."'";
$miconexion2->consulta($SQL);
$vr=$miconexion2->numregistros();
if($vr > 0){
$opcion.="<table class='table'>";
$opcion.="<tr>";
$opcion.="<td><strong>Carrera</strong></td>";
$opcion.="<td><strong>Estatus</strong></td>";
$opcion.="<td><strong>Ver</strong></td>";
$opcion.="</tr>";
while ($row = mysql_fetch_row($miconexion2->Consulta_ID)) {
$opcion.="<tr>";
$opcion.="<td>".$row[8]."</td>";
$opcion.="<td>".$row[5]."</td>";
$opcion.="<td>Ver</td>";
$opcion.="</tr>";
}
$opcion.="</table>";
	
}else{
		
	$opcion.=" No Tiene Datos de Formación Académica";	
		}
	return $opcion;
	
	
	}

function AgregarEscolaridad($esco,$namesc,$ps,$ces,$msm,$ti){
	$comboo="";
	$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO escolaridad(id_escolaridad,id_category_estudios,nombre_escuela,id_usuari,id_semestre,estats,id_cat_car) ";		
$SQL1.="VALUES (NULL,'".$ces."','".$namesc."','".$ps."','".$msm."','".$ti."','".$esco."');";
$miconexion->consulta($SQL1);
$miconexion2 = new DB_my ();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL2="UPDATE user SET carrera='".$esco."' WHERE id_user='".$ps."';";
$miconexion2->consulta($SQL2);
	$comboo="Formacion Educativa Modificada Exitosamente";
	return $comboo;
	
	}
	
//funcion para actualizar escolaridad
function ActualizarEs($esco,$namesc,$ps,$ces,$msm,$ti){
$comboo="";
$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="UPDATE escolaridad SET id_category_estudios='".$ces."', nombre_escuela='".$namesc."' , id_semestre='".$msm."' , estats='".$ti."' , id_cat_car='".$esco."' ";		
$SQL1.=" WHERE id_usuari='".$ps."';";
$miconexion->consulta($SQL1);
$miconexion2 = new DB_my ();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL2="UPDATE user SET carrera='".$esco."' WHERE id_user='".$ps."';";
$miconexion2->consulta($SQL2);
	$comboo.="Formacion Educativa Modificada Exitosamente";
	return $comboo;	

	
	}


//fin de funcion para actualizar escolaridad	

function escolaridadC($ps){
$existe=0;	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  escolaridad WHERE id_usuari='".$ps."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
$existe=1;	
  }
  
return $existe;
	}



function Semestres(){
	$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  semestres ORDER BY  id_sem asc";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[1])."</option>\n";		
	
}
	}
return 	$combo;
	
	}

//funcion semestre elegido
function Semestre($ps){
	$objse=new carreras();
	$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  escolaridad WHERE id_usuari='".$ps."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0 ){
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsem=$row[4];
if($idsem!=""){
	
	$miconexion2 = new DB_my();
        $miconexion2->conectar($bd, $host, $user, $pass);
		$sqL2="SELECT * FROM  semestres ";
		$miconexion2->consulta($sqL2);
        $vr2=$miconexion2->numregistros();
		
		if($vr2 > 0){
			while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
				if($row2[0]==$idsem){
		$fg="selected='selected'";	
			}else{
		$fg="";	
			}
			
			$combo.="<option value='".$row2[0]."' ".$fg.">".utf8_encode($row2[1])."</option>\n";
				
			}
			
		}
			
	
	}else{
	$combo.=$objse->Semestres();	
		}
	
	}
	
	}

return $combo;
	
}

//fin de funcion semestre elegido

//funcion nombre institucion
function namIns($ps){
	$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  escolaridad WHERE id_usuari='".$ps."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0 ){
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	$combo.=$row[2];	
	}
	
	}
return $combo;	
	
	}

//fin de nombre institucion

//funcion estatus escolaridad
function estIns($ps){
	$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  escolaridad WHERE id_usuari='".$ps."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0 ){
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	$combo.=$row[5];	
	}
	
	}
return $combo;	
	
	}
//fin de estatus escolaridad

function Carrera_e($ps){
$combo="";		
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$sql1="SELECT * FROM user WHERE id_user='".$ps."';";	
$miconexion->consulta($sql1);
$vr=$miconexion->numregistros();

if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$id_dec=$row[8];		
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$sql2="SELECT * FROM categorias_carreras";
$miconexion2->consulta($sql2);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
if($row2[0]==$id_dec){
	$selc="selected='selected'";
	}else{
	$selc="";	
		}
$combo.="<option value='".$row2[0]."' ".$selc." >".utf8_encode($row2[3])."</option>\n";
}
	
	}

	
}

}
return $combo;
	}

function ListaC($idi){
$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM categorias_carreras join areas_carreras on areas_carreras.id_ar=categorias_carreras.id_are WHERE id_idioma='".$idi."'  ORDER BY id_are";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[3])."</option>\n";		
	
}
	}
return 	$combo;

	}
///++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++LISTADO Clases WS
	function ListaCWS($idi){
$combo=array();	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM categorias_carreras join areas_carreras on areas_carreras.id_ar=categorias_carreras.id_are WHERE id_idioma='".$idi."'  ORDER BY id_are";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

                     $combo[]= array(
					'id' => $row[0],
					'titulo' => utf8_encode($row[3]));	
	
}
	}
return 	$combo;

	}
function ListaPWS(){
$combo=array();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM localidad_pais WHERE Activo='1'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$combo[]= array(
					'id' => $row[0],
					'pais' => utf8_encode($row[1]));		
	
}
	}
return 	$combo;	
	
	}

function AgregarUsuarioEstudiante($nom,$ape,$em,$em2,$ed,$def,$pro,$pai,$idt){
	$opcion="";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE correo='".$em."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
$opcion.=" No se puede Agregar al usuario porque ya existe un Usuario con el siguiente correo :".$em;
	}else{
	
$conf=date("Ymd").rand(5, 15).$ape;			
$SQL1="INSERT INTO user (id_user,nombre,apellido_pat,correo,password,edad,sexo,carrera,pais,tipou,status_u,confirm,conf,foto,plan_p) ";		
$SQL1.="VALUES (NULL,'".$nom."','".$ape."','".$em."','".$em2."','".$ed."','".$def."','".$pro."','".$pai."','".$idt."','1','".$conf."','NO','../img/SIN.png','1');";
$miconexion->consulta($SQL1);
//codigo mail
$body="Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a>http://www.maletinlaboral.com/confirm/conf.php?co=".$conf."</a>";
require_once('mailer/class.phpmailer.php');
$mail=new PHPMailer();
$mail->Host='localhost';
$mail->Port=25;
$mail->Priority = 1;
$mail->From='notificaciones@maletinlaboral.com';
$mail->FromName = 'notificaciones@maletinlaboral.com';
$mail->IsHTML(true);
$mail->Username = 'notificaciones@maletinlaboral.com';
$mail->Password = 'Indivisa2016';
$mail->SMTPAuth = true;
$mail->Subject = 'Bienvenido a Maletin Laboral';
$mail->AddAddress($em);
$mail->MsgHTML("<strong>Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a href='http://www.maletinlaboral.com/confirm/conf.php?co=".$conf."'>http://www.maletinlaboral.com/confirm/conf.php?co=".$conf."</a></strong>");
if(!$mail->Send()) {
  echo "Hubo un error: " . $correo->ErrorInfo;
} else {
  echo "Mensaje enviado con exito.";
}
//codigo mail
$opcion.=" Datos Agregados Exitosamente ";		
		}
return $opcion;
	
	}	
	
function AgregarUsuariosEmpresas($nom,$ape,$em,$em2,$rf,$rz,$nrz,$pai,$idt){
	$opcion="";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE correo='".$em."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
$opcion.=" No se puede Agregar a la Empresa porque ya existe un Usuario con el siguiente correo :".$em;
	}else{
$conf=date("Ymd").rand(5, 15).$rf;		
$SQL1="INSERT INTO user (id_user,nombre,apellido_pat,correo,password,pais,tipou,Rfc_emp,status_u,confirm,conf) ";		
$SQL1.="VALUES (NULL,'".$nom."','".$ape."','".$em."','".$em2."','".$pai."','".$idt."','".$rf."','1','".$conf."','NO');";
$miconexion->consulta($SQL1);
$SQL2="INSERT INTO empresa (id_empresa,nombre,razon,RFC_e,estatus_e)";
$SQL2.="VALUES (NULL,'".$nrz."','".$rz."','".$rf."','1')";
$miconexion->consulta($SQL2);
//codigo mail
$body="Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a>http://www.maletinlaboral.com/confirm/conf.php?co=".$conf."</a>";
require_once('mailer/class.phpmailer.php');
$mail=new PHPMailer();
$mail->Host='localhost';
$mail->Port=25;
$mail->Priority = 1;
$mail->From='notificaciones@maletinlaboral.com';
$mail->FromName = 'notificaciones@maletinlaboral.com';
$mail->IsHTML(true);
$mail->Username = 'notificaciones@maletinlaboral.com';
$mail->Password = 'Indivisa2016';
$mail->SMTPAuth = true;
$mail->Subject = 'Bienvenido a Maletin Laboral';
$mail->AddAddress($em);
$mail->MsgHTML("<strong>".$rz."  Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a href='http://www.maletinlaboral.com/confirm/conf.php?co=".$conf."'>http://www.maletinlaboral.com/confirm/conf.php?co=".$conf."</a></strong>");
if(!$mail->Send()) {
  echo "Hubo un error: " . $correo->ErrorInfo;
} else {
  echo "Mensaje enviado con exito.";
}
//codigo mail
$opcion.=" Datos Agregados Exitosamente ";		
		}
return 	$opcion;	
	
	}	
	
 function IniciarEst($em,$em2){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE correo='".$em."' and password='".$em2."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
$opcion=array();
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$rfcg=$row[11];
$idtpp=$row[10];
if($idtpp==1){
	$opcion[]= array(
					'id' => $row[0],
					'nombre' => utf8_encode($row[1]), 
					'apellidos' =>utf8_encode($row[2]),
					'tipousuario' => $row[10],
					'correo' => $row[4]);
	
	}else if($idtpp==2){
		$miconexionw = new DB_my();
$miconexionw->conectar($bd, $host, $user, $pass);
$SQL2="SELECT * FROM  empresa  WHERE estatus_e='1' and RFC_e='".$rfcg."'";	
$miconexionw->consulta($SQL2);	
$vrw=$miconexionw->numregistros();	
if($vrw > 0){
	while ($row2 = mysql_fetch_row($miconexionw->Consulta_ID)) {	

                     $opcion[]= array(
					'id' => $row[0],
					'nombre' => utf8_encode($row[1]),
					'apellidos' => utf8_encode($row[2]),
					'tipousuario' => $row[10],
					'razonsocial' => utf8_encode($row2[2]),
					'rfc' => utf8_encode($row2[10]),
					'correo' => $row[4]);	
	
}
	
   }
		
		}
                     	
	
}

}else{
	$miconexion3 = new DB_my ;
$miconexion3->conectar($bd, $host, $user, $pass);
$SQL3="SELECT * FROM user WHERE correo='".$em."' and password='".$em2."' and status_u='2' OR status_u='3'";	
$miconexion3->consulta($SQL3);
$vr3=$miconexion3->numregistros();	
if($vr3 > 0){
	
$opcion.=" Su cuenta ha sido Suspedida Temporalmente Favor de Contactar al Proveedor";
	
}else{
	
$opcion.=" Error de E-mail y Password ".$em;

}

	
	}
return $opcion;
	 
	 }
	 
 function IniciarEm($em,$em2){
	 $miconexionw = new DB_my();
$miconexionw->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user  join empresa on empresa.RFC_e=user.Rfc_emp WHERE user.correo='".$em."' and password='".$em2."' and status_u='1'";	
$miconexionw->consulta($SQL);
$vr=$miconexionw->numregistros();	
if($vr > 0){
$opcion=array();
while ($row = mysql_fetch_row($miconexionw->Consulta_ID)) {	

                     $opcion[]= array(
					'id' => $row[0],
					'nombre' => utf8_encode($row[1]),
					'apellidos' =>utf8_encode($row[2]),
					'razonsocial' =>utf8_encode($row[38]),
					'rfc' => $row[11],
					'correo' => $row[4]);	
	
}

}else{
$opcion.=" Error de E-mail y Password ".$em;	
	}
return $opcion;
	 
	 
	 }
	 
function VerpefilU($userid,$tipeuser){
	$OBJcd1=new carreras();
	$OBJcd2=new carreras();
	$OBJcd3=new carreras();
	$OBJcd6=new carreras();
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE id_user='".$userid."' and tipou='".$tipeuser."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
	
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
   $url="www.maletinlaboral.com/img/fotos/".$row[20];
   $url2="www.maletinlaboral.com/img/fotos/".$row[36];
 $ciudd=$row[34];
 $estaadd=$row[33];
 $paiss=$row[9];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row[8];
 $carp=$OBJcd6->ObtenernameCar($carprof);
   
                     $opcion[]= array(
					'id' => $row[0],
					'nombre' =>utf8_encode($row[1]),
					'apellidos' =>utf8_encode($row[2]),
					'fotodeperfil' => $url,
					'imgthumb' => $url2,
					'edad' => $row[6],
					'sexo' => $row[7],
					'idprofesion' => $carprof,
					'profesion' => $carp,
					'idpais' =>  $paiss,
					'pais' => $ppais,
					'telefono' => $row[29],
					'tipousuario' => $row[10],
					'idestado' =>  $estaadd,
					'estado' => $eestado,
					'idciudad' =>  $ciudd,
					'ciudad' => $cciudad,
					'correo' => $row[4]);	
	
}

}else{
$opcion.="USUARIO_CON_DATOS_NO_ENCONTRADOS";	
	}
return $opcion; 
	
	}	
	
function Estadosm(){
	$combo=array();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM estados where activo='1' order by id_est";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$combo[]= array(
					'id' => $row[0],
					'estado' => utf8_encode($row[1]));		
	
}
	}
return 	$combo;	
	}
	
function CiudadesEST($id_estado){
		$combo=array();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM localidad_mexico WHERE id_estado='".$id_estado."' and activo='1'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$combo[]= array(
					'id' => $row[0],
					'ciudad' => utf8_encode($row[1]));		
	
}
	}
return 	$combo;
	}		
	
function AgregarPerfil($userid,$tipeuser,$nombre,$apellidos,$fotoperfil,$edad,$sexo,$profesion,$pais,$correo,$telefono,$estado,$ciudad){
$opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$fecha=date("Ymd");
$d=rand(1,67);
$na=$fotoperfil['name'];
$tmp_n=$fotoperfil['tmp_name'];
$ty=$fotoperfil['type'];
$sis=$fotoperfil['size'];
//$dirc=$_SERVER['DOCUMENT_ROOT']."/ml/img/fotos/";
$dirc=$_SERVER['DOCUMENT_ROOT']."/img/fotos/";
$namear=$dirc.$fecha.$d.basename($na);
$name_thum=$dirc.$fecha.$d."_thumb".basename($na);
$nmap=$fecha.$d."_thumb".basename($na);
$nma=$fecha.$d."_".basename($na);
$grande=$namear;
$pequeña=$dirc.$namear;
$pequeña2=$name_thum;
$pequeña3=$dirc.$nma;
if($fotoperfil!=""){
if(copy($tmp_n, $namear)) {
$this->ModificarImg($grande,$pequeña2);
$this->ModificarImgN($grande,$pequeña3);
}
}
if($fotoperfil!=""){
$SQL="UPDATE user  SET nombre='".$nombre."',apellido_pat='".$apellidos."',foto='".$nma."' , edad='".$edad."' , sexo='".$sexo."' , carrera='".$profesion."', pais='".$pais."', correo='".$correo."', celular_u='".$telefono."', Estado='".$estado."', ciu='".$ciudad."',thum_f='".$nmap."'  WHERE id_user='".$userid."' and tipou='".$tipeuser."' ";
$miconexion->consulta($SQL);	
	}else{
$SQL="UPDATE user  SET nombre='".$nombre."',apellido_pat='".$apellidos."' , edad='".$edad."' , sexo='".$sexo."' , carrera='".$profesion."', pais='".$pais."', correo='".$correo."', celular_u='".$telefono."', Estado='".$estado."', ciu='".$ciudad."' WHERE id_user='".$userid."' and tipou='".$tipeuser."' ";
$miconexion->consulta($SQL);		
		}

$opcion.="LOS_DATOS_DE_PERFIL_SE_AGREGARON_DE_MANERA_CORRECTA";
	return $opcion;
	
	}
	
 function ModificarImg($grande,$pequeña2){
	
	$ruta_imagen = $grande;

$miniatura_ancho_maximo = 150;
$miniatura_alto_maximo = 150;

$info_imagen = getimagesize($ruta_imagen);
$imagen_ancho = $info_imagen[0];
$imagen_alto = $info_imagen[1];
$imagen_tipo = $info_imagen['mime'];


$proporcion_imagen = $imagen_ancho / $imagen_alto;
$proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;

if ( $proporcion_imagen > $proporcion_miniatura ){
	$miniatura_ancho = $miniatura_alto_maximo * $proporcion_imagen;
	$miniatura_alto = $miniatura_alto_maximo;
} else if ( $proporcion_imagen < $proporcion_miniatura ){
	$miniatura_ancho = $miniatura_ancho_maximo;
	$miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
} else {
	$miniatura_ancho = $miniatura_ancho_maximo;
	$miniatura_alto = $miniatura_alto_maximo;
}

$x = ( $miniatura_ancho - $miniatura_ancho_maximo ) / 2;
$y = ( $miniatura_alto - $miniatura_alto_maximo ) / 2;

switch ( $imagen_tipo ){
	case "image/jpg":
	case "image/jpeg":
		$imagen = imagecreatefromjpeg( $ruta_imagen );
		break;
	case "image/png":
		$imagen = imagecreatefrompng( $ruta_imagen );
		break;
	case "image/gif":
		$imagen = imagecreatefromgif( $ruta_imagen );
		break;
}

$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );
$lienzo_temporal = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );

imagecopyresampled($lienzo_temporal, $imagen, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
imagecopy($lienzo, $lienzo_temporal, 0,0, $x, $y, $miniatura_ancho_maximo, $miniatura_alto_maximo);

imagejpeg($lienzo, $pequeña2, 80);
	
	}	
	
	 function ModificarImgN($grande,$pequeña3){
	
	$ruta_imagen = $grande;

$miniatura_ancho_maximo = 450;
$miniatura_alto_maximo = 450;

$info_imagen = getimagesize($ruta_imagen);
$imagen_ancho = $info_imagen[0];
$imagen_alto = $info_imagen[1];
$imagen_tipo = $info_imagen['mime'];


$proporcion_imagen = $imagen_ancho / $imagen_alto;
$proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;

if ( $proporcion_imagen > $proporcion_miniatura ){
	$miniatura_ancho = $miniatura_alto_maximo * $proporcion_imagen;
	$miniatura_alto = $miniatura_alto_maximo;
} else if ( $proporcion_imagen < $proporcion_miniatura ){
	$miniatura_ancho = $miniatura_ancho_maximo;
	$miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
} else {
	$miniatura_ancho = $miniatura_ancho_maximo;
	$miniatura_alto = $miniatura_alto_maximo;
}

$x = ( $miniatura_ancho - $miniatura_ancho_maximo ) / 2;
$y = ( $miniatura_alto - $miniatura_alto_maximo ) / 2;

switch ( $imagen_tipo ){
	case "image/jpg":
	case "image/jpeg":
		$imagen = imagecreatefromjpeg( $ruta_imagen );
		break;
	case "image/png":
		$imagen = imagecreatefrompng( $ruta_imagen );
		break;
	case "image/gif":
		$imagen = imagecreatefromgif( $ruta_imagen );
		break;
}

$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );
$lienzo_temporal = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );

imagecopyresampled($lienzo_temporal, $imagen, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
imagecopy($lienzo, $lienzo_temporal, 0,0, $x, $y, $miniatura_ancho_maximo, $miniatura_alto_maximo);

imagejpeg($lienzo, $pequeña3, 80);
	
	}	 

function VerEMpr($userid,$tipeuser){
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();
	
	$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM empresa join user on empresa.RFC_e=user.Rfc_emp WHERE id_user='".$userid."' and tipou='".$tipeuser."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
	
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
  $url="www.maletinlaboral.com/img/logos/".$row[15];
  $url2="www.maletinlaboral.com/img/logos/".$row[16];
 $ciudd=$row[19];
 $estaadd=$row[18];
 $paiss=$row[17];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
  
                     $opcion[]= array(
					'id' => $row[0],
					'nombre' =>utf8_encode($row[1]),					
					'razonsocial' =>utf8_encode($row[2]), 
					'descripcion' =>utf8_encode($row[5]),
					'telefono' => $row[12],
					'rfcc' =>utf8_encode($row[10]), 
					'correocontacto' => $row[9],
					'logo' => $url,
					'logothumb' => $url2,					
					'pais' => $ppais,
					'idpais' => $paiss,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);
	}

}else{
$opcion.="EMPRESA_CON_DATOS_NO_ENCONTRADOS";	
	}
return $opcion; 
	
	}
	
 function AgregarEms($userid,$tipeuser,$nombre,$razonsocial,$descripc,$telefono,$rfc,$correocontacto,$logo,$pais,$estado,$ciudad){
	 
	 $opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$fecha=date("Ymd");
$updta=date("Y-m-d H:i:s");
$d=rand(1,67);
$na=$logo['name'];
$tmp_n=$logo['tmp_name'];
$ty=$logo['type'];
$sis=$logo['size'];
//$dirc=$_SERVER['DOCUMENT_ROOT']."/ml/img/logos/";
$dirc=$_SERVER['DOCUMENT_ROOT']."/img/logos/";
$namear=$dirc.$fecha.$d.basename($na);
$name_thum=$dirc.$fecha.$d."_thumb".basename($na);
$nmap=$fecha.$d."_thumb".basename($na);
$nma=$fecha.$d."_".basename($na);
$grande=$namear;
$pequeña=$dirc.$namear;
$pequeña2=$name_thum;
$pequeña3=$dirc.$nma;
if($logo!=""){
if (copy($tmp_n, $namear)) {
$this->ModificarImg($grande,$pequeña2);
$this->ModificarImgN($grande,$pequeña3);
}
}
//usuario
$miconexion2 = new DB_my() ;
$miconexion2->conectar($bd, $host, $user, $pass);
$Squ="SELECT * FROM user WHERE id_user='".$userid."' and tipou='".$tipeuser."' and status_u='1'";
$miconexion2->consulta($Squ);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$jrfc=$row[11];
if($logo!=""){
$SQL="UPDATE empresa  SET nombre='".$nombre."', razon='".$razonsocial."', descripcion='".$descripc."', telefono='".$telefono."', RFC_e='".$rfc."',correo='".$correocontacto."', logo_e='".$nma."',logo_th='".$nmap."',pais='".$pais."', estad='".$estado."', ciud='".$ciudad."', fecha_modi='".$updta."'  WHERE RFC_e='".$jrfc."' ";
$miconexion->consulta($SQL);
}else{
$SQL="UPDATE empresa  SET nombre='".$nombre."', razon='".$razonsocial."', descripcion='".$descripc."', telefono='".$telefono."', RFC_e='".$rfc."',correo='".$correocontacto."', pais='".$pais."', estad='".$estado."', ciud='".$ciudad."', fecha_modi='".$updta."'  WHERE RFC_e='".$jrfc."' ";
$miconexion->consulta($SQL);	
	}
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="UPDATE user SET Rfc_emp='".$rfc."' WHERE Rfc_emp='".$jrfc."'";
$miconexion3->consulta($sqw);

}
}
//fin de usuario


$opcion.="LOS_DATOS_DE_PERFIL_DE_LA_EMPRESA_SE_AGREGARON_DE_MANERA_CORRECTA";
	return $opcion;
	 
	 }	
	 
	 function modifiPerfil($userid,$tipeuser,$nombre,$apellidos,$fotoperfil,$edad,$sexo,$profesion,$pais,$correo,$telefono,$estado,$ciudad){
$opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$fecha=date("Ymd");
$d=rand(1,67);
$na=$fotoperfil['name'];
$tmp_n=$fotoperfil['tmp_name'];
$ty=$fotoperfil['type'];
$sis=$fotoperfil['size'];
//$dirc=$_SERVER['DOCUMENT_ROOT']."/ml/img/fotos/";
$dirc=$_SERVER['DOCUMENT_ROOT']."/img/fotos/";
$namear=$dirc.$fecha.$d.basename($na);
$name_thum=$dirc.$fecha.$d."_thumb".basename($na);
$nmap=$fecha.$d."_thumb".basename($na);
$nma=$fecha.$d."_".basename($na);
$grande=$namear;
$pequeña=$dirc.$namear;
$pequeña2=$name_thum;
$pequeña3=$dirc.$nma;
if($fotoperfil!=""){
if(copy($tmp_n, $namear)) {
$this->ModificarImg($grande,$pequeña2);
$this->ModificarImgN($grande,$pequeña3);
}
}
if($fotoperfil!=""){
$SQL="UPDATE user  SET nombre='".$nombre."',apellido_pat='".$apellidos."',foto='".$nma."' , edad='".$edad."' , sexo='".$sexo."' , carrera='".$profesion."', pais='".$pais."', correo='".$correo."', celular_u='".$telefono."', Estado='".$estado."', ciu='".$ciudad."',thum_f='".$nmap."'  WHERE id_user='".$userid."' and tipou='".$tipeuser."' ";
$miconexion->consulta($SQL);		
	}else{
$SQL="UPDATE user  SET nombre='".$nombre."',apellido_pat='".$apellidos."', edad='".$edad."' , sexo='".$sexo."' , carrera='".$profesion."', pais='".$pais."', correo='".$correo."', celular_u='".$telefono."', Estado='".$estado."', ciu='".$ciudad."'  WHERE id_user='".$userid."' and tipou='".$tipeuser."' ";
$miconexion->consulta($SQL);			
		}

$opcion.="LOS_DATOS_DE_PERFIL_SE_MODIFICARON_DE_MANERA_CORRECTA";
	return $opcion;
	
	}
	
	 function ModifiEms($userid,$tipeuser,$nombre,$razonsocial,$descripc,$telefono,$rfc,$correocontacto,$logo,$pais,$estado,$ciudad){
	 
	 $opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$fecha=date("Ymd");
$updta=date("Y-m-d H:i:s");
$d=rand(1,67);
$na=$logo['name'];
$tmp_n=$logo['tmp_name'];
$ty=$logo['type'];
$sis=$logo['size'];
//$dirc=$_SERVER['DOCUMENT_ROOT']."/ml/img/logos/";
$dirc=$_SERVER['DOCUMENT_ROOT']."/img/logos/";
$namear=$dirc.$fecha.$d.basename($na);
$name_thum=$dirc.$fecha.$d."_thumb".basename($na);
$nmap=$fecha.$d."_thumb".basename($na);
$nma=$fecha.$d."_".basename($na);
$grande=$namear;
$pequeña=$dirc.$namear;
$pequeña2=$name_thum;
$pequeña3=$dirc.$nma;
if($logo!=""){
if (copy($tmp_n, $namear)) {
$this->ModificarImg($grande,$pequeña2);
$this->ModificarImgN($grande,$pequeña3);
}
}
//usuario
$miconexion2 = new DB_my() ;
$miconexion2->conectar($bd, $host, $user, $pass);
$Squ="SELECT * FROM user WHERE id_user='".$userid."' and tipou='".$tipeuser."' and status_u='1'";
$miconexion2->consulta($Squ);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$jrfc=$row[11];
if($logo!=""){
$SQL="UPDATE empresa  SET nombre='".$nombre."', razon='".$razonsocial."', descripcion='".$descripc."', telefono='".$telefono."', RFC_e='".$rfc."',correo='".$correocontacto."', logo_e='".$nma."',logo_th='".$nmap."',pais='".$pais."', estad='".$estado."', ciud='".$ciudad."', fecha_modi='".$updta."'  WHERE RFC_e='".$jrfc."' ";
$miconexion->consulta($SQL);
}else{
$SQL="UPDATE empresa  SET nombre='".$nombre."', razon='".$razonsocial."', descripcion='".$descripc."', telefono='".$telefono."', RFC_e='".$rfc."',correo='".$correocontacto."', pais='".$pais."', estad='".$estado."', ciud='".$ciudad."', fecha_modi='".$updta."'  WHERE RFC_e='".$jrfc."' ";
$miconexion->consulta($SQL);	
	}
	
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="UPDATE user SET Rfc_emp='".$rfc."' WHERE Rfc_emp='".$jrfc."'";
$miconexion3->consulta($sqw);

}
}
//fin de usuario

$opcion.="LOS_DATOS_DE_PERFIL_DE_LA_EMPRESA_SE_MODIFICARON_DE_MANERA_CORRECTA";
	return $opcion;
	 
	 }
	
function ModificarPas($userid,$tipeuser,$passw){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE id_user='".$userid."' and tipou='".$tipeuser."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$psw=md5($passw);
$SQL2A="UPDATE user SET password='".$psw."' WHERE id_user='".$userid."' and tipou='".$tipeuser."'";
$miconexion2->consulta($SQL2A);	
$opcion.="PASSWORD_MODIFICADO_DE_MANERA_CORRECTA";
}

}else{
$opcion.="USUARIO_CON_DATOS_NO_ENCONTRADOS";	
	}
return $opcion; 	
	
}	
	
function Agregandoproy($userid,$tipeuser,$nombreproyecto,$descrip,$fechai,$fechaf){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO proyectosescolares(id_pro,titulo,actividad,idusuar,fecha_in,fecha_fn) ";		
$SQL1.="VALUES (NULL,'".$nombreproyecto."','".$descrip."','".$userid."','".$fechai."','".$fechaf."');";
$miconexion->consulta($SQL1);
$opcion.="PROYECTO_AGREGADO_CORRECTAMENTE";
return $opcion; 		
	}	
	
function listadopr($userid,$tipeuser){
$combo="";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectosescolares where idusuar='".$userid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'nombreproyecto' =>utf8_encode($row[1]),
					'descripcion' =>utf8_encode($row[4]), 
					'fechainicio' => $row[6],
					'fechafin' => $row[7]);		
		
}
	}else{
$combo="NO_TIENE_PROYECTOS_PARA MOSTRAR";			
		
		}
return 	$combo;
	}

function Verpry($userid,$proyectoid){
	$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectosescolares where idusuar='".$userid."' and id_pro='".$proyectoid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'nombreproyecto' =>utf8_encode($row[1]),
					'descripcion' => utf8_encode($row[4]),
					'fechainicio' => $row[6],
					'fechafin' => $row[7]);		
		
}
	}else{
$combo="EL_PROYECTO_SELECCIONADO_NO_SE_ENCUENTRA";			
		
		}
return 	$combo;

	}	
	
function ModifiPRoyc($userid,$nombreproyecto,$descrip,$fechai,$fechaf,$proyectoid){
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="UPDATE proyectosescolares SET titulo='".$nombreproyecto."',actividad='".$descrip."',fecha_in='".$fechai."',fecha_fn='".$fechaf."' WHERE idusuar='".$userid."' and id_pro='".$proyectoid."'";
$miconexion3->consulta($sqw);	
$combo.="EL_PROYECTO_SE_HA_MODIFICADO_DE_MANERA_CORRECTA";
return 	$combo;	
	}
	
function deltproy($userid,$proyectoid){
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="DELETE FROM proyectosescolares WHERE idusuar='".$userid."' and id_pro='".$proyectoid."';";
$miconexion3->consulta($sqw);	
$combo.="EL_PROYECTO_SE_HA_ELIMINADO_DE_MANERA_CORRECTA";
return 	$combo;		
	
	}
	
function eStatusCarrera(){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM tipos_e";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'descripcion' => utf8_encode($row[1]));		
		
}
	}
return 	$combo;
	}			

function ListEstc(){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM semestres";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'descripcion' => utf8_encode($row[1]));		
		
}
	}
return 	$combo;	
	}

function AgregarFormaci($userid,$tipeuser,$idprofesional,$idestatuscarrera,$nombescuela,$idioma,$aptitudes,$idsemestre){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
if($idestatuscarrera==4){
$SQL1="INSERT INTO escolaridad(id_escolaridad,nombre_escuela,id_usuari,id_semestre,id_cat_car,id_est_escola,idiom,aptitu) ";		
$SQL1.="VALUES (NULL,'".$nombescuela."','".$userid."','".$idsemestre."','".$idprofesional."','".$idestatuscarrera."','".$idioma."','".$aptitudes."');";
$miconexion->consulta($SQL1);	
//update user
if($idprofesional!=""){
$miconexion2= new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL4="UPDATE user SET 	carrera='".$idprofesional."' WHERE id_user='".$userid."' ";
$miconexion2->consulta($SQL4);
}
//fin de update user
	}else{
$SQL1="INSERT INTO escolaridad(id_escolaridad,nombre_escuela,id_usuari,id_cat_car,id_est_escola,idiom,aptitu) ";		
$SQL1.="VALUES (NULL,'".$nombescuela."','".$userid."','".$idprofesional."','".$idestatuscarrera."','".$idioma."','".$aptitudes."');";
$miconexion->consulta($SQL1);
//update user
if($idprofesional!=""){
$miconexion2= new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL4="UPDATE user SET 	carrera='".$idprofesional."' WHERE id_user='".$userid."' ";
$miconexion2->consulta($SQL4);
}
//fin de update user		
		}

$opcion.="FORMACION_ACADEMICA_AGREGADA_CORRECTAMENTE";
return $opcion; 
		}

function ListadoFom($userid){
$combo="";	
$OBJc5=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM escolaridad where id_usuari='".$userid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$semstr=$row[4];
$smtr=$OBJc5->ObtenerSmst($semstr);
$carprof=$row[6];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row[7];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$combo[]= array(
					'id' => $row[0],
					'nombrescuela' => utf8_encode($row[2]),
					'userid' => $row[3],
					'idsemestre' => $semstr,
					'semestre' => $smtr,
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idestatus' => $statescola,
					'estatus' => $statescolar,
					'idioma' => utf8_encode($row[8]),
					'aptitudes' => utf8_encode($row[9]));		
		
}
	}else{
		
$combo="NO_TIENE_FORMACION_ACADEMICA_PARA_MOSTRAR";			
		}
return 	$combo;		
	}

function VermFormac($userid,$formacionid){
$combo="";	
$OBJc5=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM escolaridad where id_usuari='".$userid."' and id_escolaridad='".$formacionid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$semstr=$row[4];
$smtr=$OBJc5->ObtenerSmst($semstr);
$carprof=$row[6];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row[7];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$combo[]= array(
					'id' => $row[0],
					'nombrescuela' => utf8_encode($row[2]),
					'userid' => $row[3],
					'idsemestre' => $semstr,
					'semestre' => $smtr,
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idestatus' => $statescola,
					'estatus' => $statescolar,
					'idioma' => utf8_encode($row[8]),
					'aptitudes' => utf8_encode($row[9]));		
		
}
	}
return 	$combo;		

	}	
			
function carreraselec($profesionid){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM categorias_carreras where id_cat='".$profesionid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'titulo' => utf8_encode($row[3]));		
		
}
	}
return 	$combo;	
	}
	
	
function EstatcSeleccionda($estatucsid){
	$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM tipos_e where id_tipp='".$estatucsid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'titulo' => utf8_encode($row[1]));		
		
}
	}
return 	$combo;	
	}

function ModifiFormac($userid,$idprofesional,$idestatuscarrera,$nombescuela,$idioma,$aptitudes,$idsemestre,$formacionid){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
if($idestatuscarrera==4){
$SQL1="UPDATE escolaridad SET id_cat_car='".$idprofesional."',id_est_escola='".$idestatuscarrera."',nombre_escuela='".$nombescuela."',id_semestre='".$idsemestre."',idiom='".$idioma."',aptitu='".$aptitudes."' WHERE id_usuari='".$userid."' and id_escolaridad='".$formacionid."'";
$miconexion->consulta($SQL1);
//update user
if($idprofesional!=""){
$miconexion2= new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL4="UPDATE user SET 	carrera='".$idprofesional."' WHERE id_user='".$userid."' ";
$miconexion2->consulta($SQL4);
}
//fin de update user	
	}else{
$SQL1="UPDATE escolaridad SET id_cat_car='".$idprofesional."',id_est_escola='".$idestatuscarrera."',nombre_escuela='".$nombescuela."',idiom='".$idioma."',aptitu='".$aptitudes."' WHERE id_usuari='".$userid."'and  id_escolaridad='".$formacionid."'";
$miconexion->consulta($SQL1);
//update user
if($idprofesional!=""){
$miconexion2= new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL4="UPDATE user SET 	carrera='".$idprofesional."' WHERE id_user='".$userid."' ";
$miconexion2->consulta($SQL4);
}
//fin de update user			
		}

$opcion.="FORMACION_ACADEMICA_MODIFICADA_CORRECTAMENTE";
return $opcion;	
	}

function ElmFOrmac($userid,$formacionid){
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="DELETE FROM escolaridad WHERE  id_usuari='".$userid."' and id_escolaridad='".$formacionid."';";
$miconexion3->consulta($sqw);	
$combo.="LA_FORMACION_ACADEMICA_SE_HA_ELIMINADO_DE_MANERA_CORRECTA";
return 	$combo;		
	
	}	
	
function AgregarServs($userid,$nombescuela,$aptitudes,$fechai,$fechaf){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO servicio_social(id_serv,institucion,activ,id_postu,fechain,fechafnb) ";		
$SQL1.="VALUES (NULL,'".$nombescuela."','".$aptitudes."','".$userid."','".$fechai."','".$fechaf."');";
$miconexion->consulta($SQL1);
$opcion.="SERVICIO_SOCIAL_AGREGADO_CORRECTAMENTE";
return $opcion; 	
	}
	
function ListServc($userid){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM servicio_social where id_postu='".$userid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'lugar' => utf8_encode($row[1]),
					'actividades' => utf8_encode($row[3]),
					'userid' => $row[4],
					'fechainicial' => $row[5],
					'fechafinal' => $row[6]);		
		
}
	}else{
		
$combo="NO_TIENE_SERVICIO_SOCIAL_AGREGADO";			
		
		}
return 	$combo;	
	}
	
function VrUnServs($userid,$servicioid){
	$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM servicio_social where id_postu='".$userid."' and id_serv='".$servicioid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'lugar' => utf8_encode($row[1]),
					'actividades' => utf8_encode($row[3]),
					'userid' => $row[4],
					'fechainicial' => $row[5],
					'fechafinal' => $row[6]);		
		
}
	}
return 	$combo;	
	}
	
function ModifiSers($userid,$nombescuela,$aptitudes,$fechai,$fechaf,$servicioid){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="UPDATE servicio_social SET institucion='".$nombescuela."', activ='".$aptitudes."', fechain='".$fechai."', fechafnb='".$fechaf."' WHERE id_postu='".$userid."' and id_serv='".$servicioid."'";
$miconexion->consulta($SQL1);
$opcion.="EL_SERVICIO_SOCIAL_SE_HA_MODIFICADO_CORRECTAMENTE";
return $opcion;		
}

function ElimServ($userid,$servicioid){
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="DELETE FROM servicio_social WHERE  id_postu='".$userid."' and id_serv='".$servicioid."';";
$miconexion3->consulta($sqw);	
$combo.="EL_SERVICIO_SOCIAL_SE_HA_ELIMINADO_DE_MANERA_CORRECTA";
return 	$combo;		
}


function AgregrPrct($userid,$lugar,$aptitudes,$fechai,$fechaf){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO practicas_prof(id_prac,institucion,actividades_p,id_person,fechaip,fechafp) ";		
$SQL1.="VALUES (NULL,'".$lugar."','".$aptitudes."','".$userid."','".$fechai."','".$fechaf."');";
$miconexion->consulta($SQL1);
$opcion.="PRACTICA_PROFESIONAL_AGREGADA_CORRECTAMENTE";
return $opcion;		
	}
	
function listaprac($userid){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM practicas_prof where id_person='".$userid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'lugar' => utf8_encode($row[1]),
					'actividades' => utf8_encode($row[3]),
					'userid' => $row[4],
					'fechainicial' => $row[5],
					'fechafinal' => $row[6]);		
		
}
	}else{
		
$combo="NO_TIENE_PRACTICAS_PROFESIONALES_AGREGADAS";			
		
		}
return 	$combo;		
 }


function detallepract($userid,$practicaid){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM practicas_prof where id_person='".$userid."' and id_prac='".$practicaid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'lugar' => utf8_encode($row[1]),
					'actividades' => utf8_encode($row[3]),
					'userid' => $row[4],
					'fechainicial' => $row[5],
					'fechafinal' => $row[6]);		
		
}
	}
return 	$combo;	
}

function ModPract($userid,$lugar,$aptitudes,$fechai,$fechaf,$practicaid){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="UPDATE practicas_prof SET institucion='".$lugar."',actividades_p='".$aptitudes."',fechaip='".$fechai."', fechafp='".$fechaf."'  WHERE id_person='".$userid."' and id_prac='".$practicaid."'";
$miconexion->consulta($SQL1);
$opcion.="LA_PRACTICA_PROFESIONAL_SE_HA_MODIFICADO_CORRECTAMENTE";
return $opcion;		
	}

function DelPrac($userid,$practicaid){
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="DELETE FROM practicas_prof WHERE  id_person='".$userid."' and id_prac='".$practicaid."';";
$miconexion3->consulta($sqw);	
$combo.="LA_PRACTICA_PROFESIONAL_SE_HA_ELIMINADO_DE_MANERA_CORRECTA";
return 	$combo;	
	}
	
function Salary(){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM salario";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'salario' => $row[1]);		
		
}
	}
return 	$combo;		
	}
	
function diasval(){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM dias_validos";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'diasvalidos' => utf8_encode($row[1]));		
		
}
	}
return 	$combo;		
	
	}		
		
function liESTVacan(){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM estatus_vac";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'estatus' => utf8_encode($row[1]));		
		
}
	}
return 	$combo;		
	
	}

function AddAgregarVac($userid,$tipeuser,$idcarreraprof,$namepuesto,$salarioid,$descripcionpuesto,$requisitos,$diasvalidosid,$idestatuscarrera){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$fechaactual=date("Y-m-d H:i:s");
$SQL="SELECT * FROM empresa join user on empresa.RFC_e=user.Rfc_emp where user.id_user='".$userid."' and tipou='".$tipeuser."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idmprsa=$row[0];
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO vacante_p(id_vacante,id_empresa,fechapubli,puesto,id_ca,salario,requisitos,descrip,dias_val,id_est_v,id_persn_add,id_tipoescolarid) ";		
$SQL1.="VALUES (NULL,'".$idmprsa."','".$fechaactual."','".$namepuesto."','".$idcarreraprof."','".$salarioid."', '".$requisitos."', '".$descripcionpuesto."', '".$diasvalidosid."', '1', '".$userid."','".$idestatuscarrera."');";
$miconexion2->consulta($SQL1);
$opcion.="LA_VACANTE_ESTA_SIENDO_REVISADA_Y_EN_UNAS_HORAS_SE_PUBLICARA_CORRECTAMENTE";
		
}
	}	
return 	$opcion;
	}

function VacantesRevs($userid,$tipeuser){
$OBJcd14=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$combo="";
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$fechaactual=date("Y-m-d H:i:s");
$SQL="SELECT * FROM empresa join user on empresa.RFC_e=user.Rfc_emp where user.id_user='".$userid."' and tipou='".$tipeuser."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idmprsa=$row[0];
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p WHERE id_empresa='".$idmprsa."' AND id_est_v='1'";
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar);		
		
}
	}else{
	$combo.="NO_TIENE_VACANTES_EN_REVISION";	
		}
	
  }
  
}
return $combo;	
}

function VacantePublicadas($userid,$tipeuser){
$combo="";
$OBJcd14=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$fechaactual=date("Y-m-d H:i:s");
$SQL="SELECT * FROM empresa join user on empresa.RFC_e=user.Rfc_emp where user.id_user='".$userid."' and tipou='".$tipeuser."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idmprsa=$row[0];
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p WHERE id_empresa='".$idmprsa."' AND id_est_v='2'";
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar);		
		
}
	}else{
	$combo.="NO_TIENE_VACANTES_PUBLICADAS";	
		}
	
  }
  
}
return $combo; 	
	}	

function VacantRch($userid,$tipeuser){
$combo="";
$OBJcd14=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$fechaactual=date("Y-m-d H:i:s");
$SQL="SELECT * FROM empresa join user on empresa.RFC_e=user.Rfc_emp where user.id_user='".$userid."' and tipou='".$tipeuser."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idmprsa=$row[0];
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p WHERE id_empresa='".$idmprsa."' AND id_est_v='6'";
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => $row2[15],
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar);		
		
}
	}else{
	$combo.="NO_TIENE_VACANTES_RECHAZADAS";	
		}
	
  }
  
}
return $combo;	
	}
	
function ModifiVact($userid,$idcarreraprof,$namepuesto,$salarioid,$descripcionpuesto,$requisitos,$diasvalidosid,$idestatuscarrera,$vacanteid){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$fechaactual=date("Y-m-d H:i:s");
$SQL="SELECT * FROM vacante_p where id_vacante='".$vacanteid."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$estatusv=$row[12];
$motivor=$row[15];
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
if($estatusv==6){
$SQL1q="UPDATE vacante_p SET puesto='".$namepuesto."', id_ca='".$idcarreraprof."', salario='".$salarioid."', requisitos='".$requisitos."', descrip='".$descripcionpuesto."', dias_val='".$diasvalidosid."', id_est_v='1', motivo_r='', id_tipoescolarid='".$idestatuscarrera."', personmodi='".$userid."', fechamodf='".$fechaactual."'  WHERE id_vacante='".$vacanteid."'";
$miconexion2->consulta($SQL1q);
$opcion.="LA_VACANTE_SE_HA_MODIFICADO_CORRECTAMENTE";	
		}else{
$SQL1q="UPDATE vacante_p SET puesto='".$namepuesto."', id_ca='".$idcarreraprof."', salario='".$salarioid."', requisitos='".$requisitos."', descrip='".$descripcionpuesto."', dias_val='".$diasvalidosid."', id_tipoescolarid='".$idestatuscarrera."', personmodi='".$userid."', fechamodf='".$fechaactual."'  WHERE id_vacante='".$vacanteid."'";
$miconexion2->consulta($SQL1q);	
$opcion.="LA_VACANTE_SE_HA_MODIFICADO_CORRECTAMENTE";		
		
		}


}
}

return $opcion;
		}
		
function Vrdetallevc($vacanteid){
$OBJcd14=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p WHERE id_vacante='".$vacanteid."'";
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => $row2[4],
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => $row2[8],
					'descripcion' => $row2[9],
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => $row2[15],
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar);		
		
}
	}	
return $combo;	
	
	}			
	
function DelVacn($vacanteid){
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL1q="UPDATE vacante_p SET id_est_v='4' WHERE id_vacante='".$vacanteid."'";
$miconexion2->consulta($SQL1q);
$opcion.="LA_VACANTE_SE_HA_ELIMINADO_CORRECTAMENTE";
return $opcion;	
	}
	
function GeneralVs(){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' =>$carprof,
					'carrera' =>$carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="NO_HAY_VACANTES_EXISTENTES";	
		}	
return $combo;
	}		

function VacntsEst($idestado){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();	
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' AND estad='".$idestado."' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
$carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="NO_HAY_VACANTES_EXISTENTES_DEL_ESTADO_SELECCIONADO";	
		}	
return $combo;	
	}
	
function VciudadEs($idestado,$ciudadid){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();	
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' AND estad='".$idestado."' and ciud='".$ciudadid."' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' =>  $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="NO_HAY_VACANTES_EXISTENTES_DEL_ESTADO_Y_CIUDAD_SELECCIONADOS";	
		}	
return $combo;	
	}	
	
function VacantCEP($idestado,$ciudadid,$carreraid){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' AND estad='".$idestado."' and ciud='".$ciudadid."' AND id_ca='".$carreraid."' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' =>$diasvl,
					'iddiasvalidos' =>$validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="NO_HAY_VACANTES_EXISTENTES_DEL_ESTADO_PROFESION_Y_CIUDAD_SELECCIONADAS";	
		}	
return $combo;	
	}
	
function VacCEPS($idestado,$ciudadid,$carreraid,$salarioid){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' AND estad='".$idestado."' and ciud='".$ciudadid."' AND id_ca='".$carreraid."' AND salario='".$salarioid."' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl= $row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' =>$diasvl,
					'iddiasvalidos' =>$validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="NO_HAY_VACANTES_EXISTENTES_DEL_ESTADO_PROFESION_CIUDAD_Y_SALARIO_SELECCIONADOS";	
		}	
return $combo;	
	
	}
	
function VacanteUnica($vacanteid){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();	
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' AND  id_vacante='".$vacanteid."' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' =>$diasvl,
					'iddiasvalidos' =>$validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="LA_VACANTE_SELECCIONADA_NO_SE_ENCUENTRA";	
		}	
return $combo;	
	}	
	
function VacEmpre($empresaid){
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' AND vacante_p.id_empresa='".$empresaid."' order By fecha_valid DESC";	
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {	
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
$combo[]= array(
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' => $diasvl,
					'iddiasvalidos' => $validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}else{
		
	$combo="LA_EMPRESA_NO_TIENE_VACANTES_PUBLICADAS";	
		}	
return $combo;	
	}		
function ObtenerCid($ciudd){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM localidad_mexico WHERE idlocalidad='".$ciudd."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]);
}

}else{
$textoc="";		
	}
return $textoc;	
	}
	
function ObtenerEsd($estaadd){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM estados WHERE id_est='".$estaadd."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]);
}

}else{
$textoc="";		
	}
return $textoc;		
	}	
	
function  ObtenerPS($paiss){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM localidad_pais WHERE idregistro='".$paiss."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]);
}

}else{
$textoc="";		
	}
return $textoc;		
	
	}	
	
function ObtenerSlsd($salaryd){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM salario WHERE id_salar='".$salaryd."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc="$".$row2[1];
}

}else{
$textoc="";		
	}
return $textoc;	
	
	}
	
function ObtenerSmst($semstr){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM semestres WHERE id_sem='".$semstr."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=$row2[1];
}

}else{
$textoc="";		
	}
return $textoc;	
	
	}
	
function ObtenernameCar($carprof){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM categorias_carreras WHERE id_cat='".$carprof."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[3]);
}

}else{
$textoc="";		
	}
return $textoc;	
	}	
	

function ObtenertiposEs($statescola){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM tipos_e WHERE id_tipp='".$statescola."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]);
}

}else{
$textoc="";		
	}
return $textoc;	
	
	}
	
function Obtenerdiasvl($diasvl){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM dias_validos WHERE id_dias='".$diasvl."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]);
}

}else{
$textoc="";		
	}
return $textoc;	
	
	}	
	
function ObtenerEstVcts($stasu){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM estatus_vac WHERE id_va_es='".$stasu."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]);
}

}else{
$textoc="";		
	}
return $textoc;		
	}	

function ObtenerListadoAcaprof(){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM areas_carreras WHERE id_ar < '12'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'nombre_area' => utf8_encode($row[1]));		
		
}
	}
return 	$combo;	
	
	}
	
function CarProfAR($areaid){
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM categorias_carreras WHERE id_idioma='1' and id_are='".$areaid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo[]= array(
					'id' => $row[0],
					'profesion' => utf8_encode($row[3]));		
		
}
	}
return 	$combo;	
	
	}
	
function ObtenerEMPsas(){
$combo="";	
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM empresa where estatus_e='1' order By id_empresa";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$url="www.maletinlaboral.com/img/logos/".$row[15];
  $url2="www.maletinlaboral.com/img/logos/".$row[16];
 $ciudd=$row[19];
 $estaadd=$row[18];
 $paiss=$row[17];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);

$combo[]= array(
					'id' => $row[0],
					'nombre' =>utf8_encode($row[1]),					
					'razonsocial' =>utf8_encode($row[2]), 
					'descripcion' =>utf8_encode($row[5]),
					'telefono' => $row[12],
					'rfcc' =>utf8_encode($row[10]), 
					'correocontacto' => $row[9],
					'logo' => $url,
					'logothumb' => $url2,	
					'idpais' => $paiss,				
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}
return 	$combo;	
	
	
	}
	
function ListadoEmpleeossuger($userid){
$a="";
$combo="";	
$cadena1="";
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user join escolaridad on escolaridad.id_usuari=user.id_user where id_user='".$userid."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	$cadena_coinci1="";	
$ciudd=$row[34];
 $estaadd=$row[33];
 $paiss=$row[9];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row[8];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row[44];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$aptitudes=$row[46];
if($paiss!=""){
$cadena1.=" and pais='".$paiss."'";	
$cadena_coinci1.=" País: ".$ppais;
	}
if($estaadd!=""){
$cadena1.=" and estad='".$estaadd."'";	
if($cadena_coinci1!=""){
	$cadena_coinci1.=",Estado: ".$eestado;
	}else{
	$cadena_coinci1.="Estado: ".$eestado;	
		}
	}	
if($ciudd!=""){
$cadena1.=" and ciud='".$ciudd."'";	
if($cadena_coinci1!=""){
	$cadena_coinci1.=",Ciudad: ".$cciudad;
	}else{
	$cadena_coinci1.="Ciudad: ".$cciudad;	
		}
	}
if($statescola!=""){
$cadena1.=" and id_tipoescolarid='".$statescola."'";
if($cadena_coinci1!=""){
	$cadena_coinci1.=",Estatus Escolar: ".$statescolar;
	}else{
	$cadena_coinci1.="Estatus Escolar: ".$statescolar;	
		}	
	}
if($carprof!=""){
$cadena1.=" and id_ca='".$carprof."'";	
if($cadena_coinci1!=""){
	$cadena_coinci1.=",Carrera Profesional: ".$carp;
	}else{
	$cadena_coinci1.="Carrera Profesional: ".$carp;	
		}	

	}
	
if($cadena1!=""){	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);		
$sqlbv="SELECT * FROM vacante_p join empresa on empresa.id_empresa=vacante_p.id_empresa WHERE id_est_v='2' ".$cadena1." order By fecha_valid DESC";
$miconexion2->consulta($sqlbv);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
	$cadn=$row[1]." ".$row[2].", las siguientes vacantes coinciden con su Perfil en: ".$cadena_coinci1;
	while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
	$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);
//codigo de buscar en requisitos
if($aptitudes!=""){
	
	}else{
$palabra_aptitud="Para Sugerirle Vacantes de Acorde a Sus Aptitudes, le sugerimos Agregar sus Aptitudes en Formacion Academica";		
		}
//fin de codigo de buscar en requisitos

$combo[]= array(
					'coinciden_en' => utf8_encode($cadn),
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' =>$diasvl,
					'iddiasvalidos' =>$validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' => $statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' =>  $paiss,
					'pais' => $ppais,
					'idestado' =>  $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);	
		
	}
	
	
	}else{
	$combo="EL_USUARIO_NO_TIENE_VACANTES_SUGERIDAS_LE_RECOMENDAMOS_AGREGAR_SUS_DATOS_PERSONALES";	
		}	

}else{
	
	}
//$combo=utf8_encode($cadn);
//$combo=utf8_encode($sqlbv);
}

}else{
$combo="EL_USUARIO_NO_TIENE_VACANTES_SUGERIDAS_LE_RECOMENDAMOS_AGREGAR_SUS_DATOS_DE_FORMACION_ACADEMICA";	
	}
return $combo;	
	}
	
function Postuland($userid,$vacante_id){
//obteniendo el id de empresa
$id_empresa="";
$miconexion4 = new DB_my ;
$miconexion4->conectar($bd, $host, $user, $pass);
$Sdg="SELECT * FROM vacante_p join empresa on vacante_p.id_empresa=empresa.id_empresa where id_vacante='".$vacante_id."'";
$miconexion4->consulta($Sdg);
$vr4=$miconexion4->numregistros();
if($vr4 > 0){
while ($row4 = mysql_fetch_row($miconexion4->Consulta_ID)) {
$id_empresa.=$row4[1];	
}
}
//fin de obteniendo el id de la empresa	
$fechac=date("Y-m-d H:i:s");
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user join escolaridad on escolaridad.id_usuari=user.id_user where id_user='".$userid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
$ciudd=$row[34];
 $estaadd=$row[33];
 $paiss=$row[9];
 if($ciudd!="" && $estaadd!="" && $paiss!=""){
	$cadddn=1;
	 }else{
	$cadddn="NO_PUEDE_POSTULARSE_A_UNA_VACANTE_REQUIERE_AGREGAR_SUS_DATOS_DE_PERFIL" ;	 
		 
		 }		

}
if($cadddn==1){
$miconexion3 = new DB_my ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqld="SELECT * FROM postulacion WHERE useridd='".$userid."' AND id_vacant='".$vacante_id."'";
$miconexion3->consulta($sqld);
$vr3=$miconexion3->numregistros();
if($vr3==0){

$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO postulacion(id_postulaci,useridd,id_vacant,fecha_postula,emprs) ";		
$SQL1.="VALUES (NULL,'".$userid."','".$vacante_id."','".$fechac."','".$id_empresa."');";
$miconexion2->consulta($SQL1);	
//codigo para agregar estadisticas para la vacante
$miconexion5 = new DB_my();
$miconexion5->conectar($bd, $host, $user, $pass);
$Sqlds="SELECT * FROM estadistica_vacante WHERE id_emprs='".$id_empresa."' and id_vacantes='".$vacante_id."'";
$miconexion5->consulta($Sqlds);
$vr5=$miconexion5->numregistros();
if($vr5 > 0){
while ($row5 = mysql_fetch_row($miconexion5->Consulta_ID)) {
$numro=$row5[3];
$nmros=$numro + 1;
$idestadist=$row5[0];	
$miconexion6 = new DB_my();
$miconexion6->conectar($bd, $host, $user, $pass);
$SQL1q="UPDATE estadistica_vacante SET numeros='".$nmros."', fecha_agr='".$fechac."' WHERE id_vacantes='".$vacante_id."'";
$miconexion6->consulta($SQL1q);	
}
}else{
$miconexion7 = new DB_my();
$miconexion7->conectar($bd, $host, $user, $pass);
$SQL17="INSERT INTO estadistica_vacante(id_estadist,id_emprs,id_vacantes,numeros,fecha_agr)";		
$SQL17.="VALUES (NULL,'".$id_empresa."','".$vacante_id."','1','".$fechac."');";
$miconexion7->consulta($SQL17);		
	}

//fin de codigo para agregar estadisticas para la vacante
$postl="EXITO_EN_LA_POSTULACION";
	
	}else{
$postl="NO_PUEDE_POSTULARSE_A_LA_VACANTE_PORQUE_YA_SE_HA_POSTULADO_CON_ANTERIORIDAD_A_LA_MISMA_VACANTE";		
		}

	
	}else{
$postl=$cadddn;
		}
$restp=$postl;
}else{
$restp="NO_PUEDE_POSTULARSE_A_UNA_VACANTE_REQUIERE_AGREGAR_SUS_DATOS_DE_FORMACION_ACADEMICA";	
	}
return $restp;	
	}	

function ListadoVcTPostuladaU($userid){
$combo="";	
$OBJcd14=new carreras();
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();	
$OBJcd6=new carreras();
$OBJcd7=new carreras();
$OBJcd9=new carreras();
$OBJcd10=new carreras();
$miconexion2= new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM vacante_p JOIN empresa ON empresa.id_empresa = vacante_p.id_empresa JOIN postulacion ON postulacion.id_vacant=vacante_p.id_vacante WHERE id_est_v =  '2' and useridd='".$userid."'";
$miconexion2->consulta($SQL);
$vr=$miconexion2->numregistros();
if($vr > 0){
while ($row2= mysql_fetch_row($miconexion2->Consulta_ID)){
$url2="www.maletinlaboral.com/img/logos/";
$salaryd=$row2[6];
$salad=$OBJcd14->ObtenerSlsd($salaryd);
$ciudd=$row2[38];
 $estaadd=$row2[37];
 $paiss=$row2[36];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row2[5];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row2[16];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$diasvl=$row2[11];
$validos=$OBJcd9->Obtenerdiasvl($diasvl);
$stasu=$row2[12];
$tstatus=$OBJcd10->ObtenerEstVcts($stasu);	
$combo[]= array(
				
					'id' => $row2[0],
					'empresaid' => $row2[1],
					'fechapublicacion' => $row2[2],
					'puesto' => utf8_encode($row2[4]),
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idsalario' => $salaryd,
					'salario' => $salad,
					'requisitos' => utf8_encode($row2[8]),
					'descripcion' => utf8_encode($row2[9]),
					'id_diasvalidos' =>$diasvl,
					'iddiasvalidos' =>$validos,
					'idestatus' => $stasu,
					'estatus' => $tstatus,
					'motivorechazo' => utf8_encode($row2[15]),
					'idtipoescolaridad' =>$statescola,
					'tipoescolaridad' => $statescolar,
					'nombreempresa' => utf8_encode($row2[20]),
					'razonsocial' => utf8_encode($row2[21]),
					'correocontacto' => $row2[28],
					'telefono' => $row2[31],
					'logo' => $url2.$row2[35],
					'idpais' => $paiss,
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad,
					'fecha_postulacion_usuario' => $row2[42]);
	
}

}else{
$combo="EL_USUARIO_NO_TIENE_POSTULACIONES";	
	}
return $combo;
	}
function ObtenerUservc($postul){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM user WHERE id_user='".$postul."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]." ".$row2[2]);
}

}else{
$textoc="";		
	}
return $textoc;		
	}
	
function NotifiEmp($userid,$tipeuser,$fechacorte){
$combo="";
$OBJc1=new carreras();
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user join empresa on empresa.RFC_e=user.Rfc_emp where id_user='".$userid."' and tipou='".$tipeuser."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idemp=$row[37];
$miconexion2 = new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
if($fechacorte==""){
$sql2="SELECT * FROM postulacion JOIN vacante_p ON vacante_p.id_vacante=postulacion.id_vacant WHERE emprs='".$idemp."' AND id_est_v='2'";
}else{
$sql2="SELECT * FROM postulacion JOIN vacante_p ON vacante_p.id_vacante=postulacion.id_vacant WHERE emprs='".$idemp."' AND id_est_v='2' and fecha_postula > '".$fechacorte."'";	
	}
$miconexion2->consulta($sql2);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$postul=$row2[1];
$postu=$OBJc1->ObtenerUservc($postul);
	$combo[]= array(
				
					'NotificacionNueva' => 'SI',
					'Puesto' =>utf8_encode($row2[10]),
					'FECHA_CORTE' => date("Y-m-d H:i:s"),
					'Postulante' =>$postu);
	
  }
	
	
	}else{
$combo.="NO_TIENE_POSTULADOS_A_SUS_VACANTES_FECHA_CORTE:".date("Y-m-d H:i:s");		
		}

}
}
return $combo;	
	
	}	

function ListadoPersonasPorVacant($vacanteid){
$OBJcd6=new carreras();
$combo="";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM postulacion join user on user.id_user=postulacion.useridd where id_vacant='".$vacanteid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$carprof=$row[14];
$carp=$OBJcd6->ObtenernameCar($carprof);
$combo[]= array(
				
					'idusuario' => $row[6],
					'Nombre' =>utf8_encode($row[7]." ".$row[8]),
					'Correo' => $row[10],
					'idvacante' => $vacanteid,
					'Carreraprofesional' =>$carp);
					
}
}
	
return $combo;	
	}

function ObtenerEmpresavc($vacanteid){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM vacante_p WHERE id_vacante='".$vacanteid."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=$row2[1];
}

}else{
$textoc="";		
	}
return $textoc;		
	}	

function PerfilUserVacant($vacanteid,$idusuario){
$fechac=date("Y-m-d H:i:s");
$OBJcd56=new carreras();
$OBJcd1=new carreras();
	$OBJcd2=new carreras();
	$OBJcd3=new carreras();
	$OBJcd6=new carreras();
$combo="";	
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user join postulacion on user.id_user=postulacion.useridd where id_vacant='".$vacanteid."' and useridd='".$idusuario."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idempr=$OBJcd56->ObtenerEmpresavc($vacanteid);
//codigo de visita perfil
$miconexion2= new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$sw3="SELECT * FROM visita_perfil where idusuario_est='".$idusuario."' and idemprsas='".$idempr."'";
$miconexion2->consulta($sw3);
$vr3=$miconexion2->numregistros();
if($vr3 > 0){
	
}else{
$miconexion7 = new DB_my();
$miconexion7->conectar($bd, $host, $user, $pass);
$SQL17="INSERT INTO  visita_perfil(id_visit,idusuario_est,idemprsas,fechavisit)";		
$SQL17.="VALUES (NULL,'".$idusuario."','".$idempr."','".$fechac."');";
$miconexion7->consulta($SQL17);		
	}
//fin de codigo de visita de perfil
$url="www.maletinlaboral.com/img/fotos/".$row[20];
   $url2="www.maletinlaboral.com/img/fotos/".$row[36];
 $ciudd=$row[34];
 $estaadd=$row[33];
 $paiss=$row[9];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);
 $carprof=$row[8];
 $carp=$OBJcd6->ObtenernameCar($carprof);
   
                      $combo[]= array(
					'id' => $row[0],
					'nombre' =>utf8_encode($row[1]),
					'apellidos' =>utf8_encode($row[2]),
					'fotodeperfil' => $url,
					'imgthumb' => $url2,
					'edad' => $row[6],
					'sexo' => $row[7],
					'idprofesion' => $carprof,
					'profesion' => $carp,
					'idpais' =>  $paiss,
					'pais' => $ppais,
					'telefono' => $row[29],
					'tipousuario' => $row[10],
					'idestado' =>  $estaadd,
					'estado' => $eestado,
					'idciudad' =>  $ciudd,
					'ciudad' => $cciudad,
					'correo' => $row[4]);

//codigo proyectos escolares
$miconexion12= new DB_my();
$miconexion12->conectar($bd, $host, $user, $pass);
$SQL12="SELECT * FROM proyectosescolares where idusuar='".$idusuario."'";
$miconexion12->consulta($SQL12);
$vr12=$miconexion12->numregistros();
if($vr12 > 0){
while ($row12 = mysql_fetch_row($miconexion12->Consulta_ID)) {	

$combo[]= array(
					'ProyectosEscolares' =>'Proyectos_Escolares',
					'id' => $row12[0],
					'nombreproyecto' =>utf8_encode($row12[1]),
					'descripcion' =>utf8_encode($row12[4]), 
					'fechainicio' => $row12[6],
					'fechafin' => $row12[7]);		
		
}
	}
//fin de codigo de proyectos escolares	
//codigo formacion escolar
$OBJc58=new carreras();
$OBJcd68=new carreras();
$OBJcd78=new carreras();
$miconexion18= new DB_my();
$miconexion18->conectar($bd, $host, $user, $pass);
$SQL18="SELECT * FROM escolaridad where id_usuari='".$idusuario."'";
$miconexion18->consulta($SQL18);
$vr18=$miconexion18->numregistros();
if($vr18 > 0){
while ($row18 = mysql_fetch_row($miconexion18->Consulta_ID)) {	
$semstr=$row18[4];
$smtr=$OBJc58->ObtenerSmst($semstr);
$carprof=$row18[6];
$carp=$OBJcd68->ObtenernameCar($carprof);
$statescola=$row18[7];
$statescolar=$OBJcd78->ObtenertiposEs($statescola);
$combo[]= array(
					'formacion_academica' => 'formacion_academica',
					'id' => $row18[0],
					'nombrescuela' => utf8_encode($row18[2]),
					'userid' => $row18[3],
					'idsemestre' => $semstr,
					'semestre' => $smtr,
					'idcarrera' => $carprof,
					'carrera' => $carp,
					'idestatus' => $statescola,
					'estatus' => $statescolar,
					'idioma' => utf8_encode($row18[8]),
					'aptitudes' => utf8_encode($row18[9]));		
		
}
	}

//fin de codigo de formacion escolar
//codigo de servicio social
$miconexion19= new DB_my();
$miconexion19->conectar($bd, $host, $user, $pass);
$SQL19="SELECT * FROM servicio_social where id_postu='".$idusuario."'";
$miconexion19->consulta($SQL19);
$vr19=$miconexion19->numregistros();
if($vr19 > 0){
while ($row19 = mysql_fetch_row($miconexion19->Consulta_ID)) {	

$combo[]= array(
					'servicio_social' => 'servicio_social',
					'id' => $row19[0],
					'lugar' => utf8_encode($row19[1]),
					'actividades' => utf8_encode($row19[3]),
					'userid' => $row19[4],
					'fechainicial' => $row19[5],
					'fechafinal' => $row19[6]);		
		
}
	}
//fin de codigo de servicio social
//codigo de practicas profesionales
$miconexion21= new DB_my();
$miconexion21->conectar($bd, $host, $user, $pass);
$SQL21="SELECT * FROM practicas_prof where id_person='".$idusuario."'";
$miconexion21->consulta($SQL);
$vr21=$miconexion21->numregistros();
if($vr21 > 0){
while ($row21 = mysql_fetch_row($miconexion21->Consulta_ID)) {	

$combo[]= array(
					'practicas_profesionales' => 'practicas_profesionales',
					'id' => $row21[0],
					'lugar' => utf8_encode($row21[1]),
					'actividades' => utf8_encode($row21[3]),
					'userid' => $row21[4],
					'fechainicial' => $row21[5],
					'fechafinal' => $row21[6]);		
		
}
	}
//fin de codigo de practicas profesionales
				
}
}
	
return $combo;		
	
	}	
	
function HistorialNotifiEM($userid,$tipeuser){
	$combo="";
$OBJc1=new carreras();
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user join empresa on empresa.RFC_e=user.Rfc_emp where id_user='".$userid."' and tipou='".$tipeuser."'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idemp=$row[37];
$miconexion2 = new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);

$sql2="SELECT * FROM postulacion JOIN vacante_p ON vacante_p.id_vacante=postulacion.id_vacant WHERE emprs='".$idemp."'";	
	
$miconexion2->consulta($sql2);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$postul=$row2[1];
$postu=$OBJc1->ObtenerUservc($postul);
	$combo[]= array(
				
					'Notificacion' => 'SI',
					'Puesto' =>utf8_encode($row2[10]),
					'idvacante' => $row2[2],
					'idusuario' => $row2[1],
					'Postulante' =>$postu);
	
  }
	
	
	}else{
$combo.="NO_TIENE_NOTIFICACIONES";		
		}

}
}
return $combo;	
	
	}
	
function ObtenerNameEm($id_empresa){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM empresa WHERE id_empresa='".$id_empresa."'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[2]);
}

}else{
$textoc="";		
	}
return $textoc;		
	
	}	
	
function NuevaNotUsrest($userid,$tipeuser,$fechacorte){
$OBJc1=new carreras();
$fechac=date("Y-m-d H:i:s");	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
if($fechacorte==""){
$SQL="SELECT * FROM visita_perfil  join  user on visita_perfil.idusuario_est=user.id_user where id_user='".$userid."' and tipou='".$tipeuser."'";
}else{
$SQL="SELECT * FROM visita_perfil  join  user on visita_perfil.idusuario_est=user.id_user where id_user='".$userid."' and tipou='".$tipeuser."' and fechavisit > '".$fechacorte."'";	
	}
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
$id_empresa=$row[2];
$name_empresa=$OBJc1->ObtenerNameEm($id_empresa);
	$combo[]= array(
				
					'NotificacionNuevaVisitaPerfil' => 'SI',
					'Empresa' =>$name_empresa,
					'FECHA_CORTE' => date("Y-m-d H:i:s"));
	
}

}else{
$combo.="NO_TIENE_NOTIFICACIONES_FECHA_CORTE:".$fechac;	
	
	}
	
return $combo;	
	}	

function HistorialNotUsr($userid,$tipeuser){
$OBJc1=new carreras();
$fechac=date("Y-m-d H:i:s");	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM visita_perfil  join  user on visita_perfil.idusuario_est=user.id_user where id_user='".$userid."' and tipou='".$tipeuser."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
$id_empresa=$row[2];
$name_empresa=$OBJc1->ObtenerNameEm($id_empresa);
	$combo[]= array(
				
					'NotificacionHistorialVisitaPerfil' => 'SI',
					'empresaid' => $id_empresa,
					'Empresa' =>$name_empresa);
	
}

}else{
$combo.="NO_TIENE_NOTIFICACIONES".$fechac;	
	
	}
	
return $combo;	
	
	}
	
function ObtenerIdEMP($userid){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM empresa JOIN user on user.Rfc_emp=empresa.RFC_e WHERE id_user='".$userid."' and tipou='2'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=$row2[0];
}

}else{
$textoc="";		
	}
return $textoc;	
	
	}	
	
function NuevomsjEMp($userid,$tipeuser,$mensaje,$idestudiante,$adjunto){
$OBJcp1=new carreras();
$opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$fecha=date("Ymd");
$fechac=date("Y-m-d H:i:s");	
$d=rand(1,67);
$na=$adjunto['name'];
$tmp_n=$adjunto['tmp_name'];
$ty=$adjunto['type'];
$sis=$adjunto['size'];
//$dirc=$_SERVER['DOCUMENT_ROOT']."/ml/img/adjuntos/";
$dirc=$_SERVER['DOCUMENT_ROOT']."/img/adjuntos/";
$namear=$dirc.$fecha.$d.basename($na);
$name_thum=$dirc.$fecha.$d."_thumb".basename($na);
$nmap=$fecha.$d."_thumb".basename($na);
$nma=$fecha.$d."_".basename($na);
$grande=$namear;
$pequeña=$dirc.$namear;
$pequeña2=$name_thum;
$pequeña3=$dirc.$nma;
if($adjunto!=""){
copy($tmp_n, $namear);
}
$empress=$OBJcp1->ObtenerIdEMP($userid);
if($adjunto!=""){
$SQL="INSERT INTO mensajeria(id_mensj,mensaje,id_user_est,id_emp,fecha_c,principal,respuesta,adjunt)";		
$SQL.="VALUES (NULL,'".$mensaje."','".$idestudiante."','".$empress."','".$fechac."','1','0','".$nma."');";
$miconexion->consulta($SQL);	
	}else{
$SQL="INSERT INTO mensajeria(id_mensj,mensaje,id_user_est,id_emp,fecha_c,principal,respuesta)";		
$SQL.="VALUES (NULL,'".$mensaje."','".$idestudiante."','".$empress."','".$fechac."','1','0');";
$miconexion->consulta($SQL);		
		}

$opcion.="EL_MENSAJE_SE_ENVIO_DE_MANERA_CORRECTA";
	return $opcion;	
	}
	
function respuestadeMnsjaemp($userid,$tipeuser,$mensaje,$idempresa,$adjunto){
$OBJcp1=new carreras();
$opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$fecha=date("Ymd");
$fechac=date("Y-m-d H:i:s");	
$d=rand(1,67);
$na=$adjunto['name'];
$tmp_n=$adjunto['tmp_name'];
$ty=$adjunto['type'];
$sis=$adjunto['size'];
//$dirc=$_SERVER['DOCUMENT_ROOT']."/ml/img/adjuntos/";
$dirc=$_SERVER['DOCUMENT_ROOT']."/img/adjuntos/";
$namear=$dirc.$fecha.$d.basename($na);
$name_thum=$dirc.$fecha.$d."_thumb".basename($na);
$nmap=$fecha.$d."_thumb".basename($na);
$nma=$fecha.$d."_".basename($na);
$grande=$namear;
$pequeña=$dirc.$namear;
$pequeña2=$name_thum;
$pequeña3=$dirc.$nma;
if($adjunto!=""){
copy($tmp_n, $namear);
}
//$empress=$OBJcp1->ObtenerIdEMP($userid);
if($adjunto!=""){
$SQL="INSERT INTO mensajeria(id_mensj,mensaje,id_user_est,id_emp,fecha_c,principal,respuesta,adjunt)";		
$SQL.="VALUES (NULL,'".$mensaje."','".$userid."','".$idempresa."','".$fechac."','0','1','".$nma."');";
$miconexion->consulta($SQL);	
	}else{
$SQL="INSERT INTO mensajeria(id_mensj,mensaje,id_user_est,id_emp,fecha_c,principal,respuesta)";		
$SQL.="VALUES (NULL,'".$mensaje."','".$userid."','".$idempresa."','".$fechac."','0','1');";
$miconexion->consulta($SQL);		
		}

$opcion.="EL_MENSAJE_SE_ENVIO_DE_MANERA_CORRECTA";
	return $opcion;	
}

function Obtenernameest($idusuarioe){
$textoc="";	
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$Sqw="SELECT * FROM  user  WHERE id_user='".$idusuarioe."' and tipou='1'";		
$miconexion2->consulta($Sqw);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
$textoc=utf8_encode($row2[1]."  ".$row2[2]);
}

}else{
$textoc="";		
	}
return $textoc;	
	
	}

function ListadContactparaMsjsparaEmp($userid,$tipeuser){
$OBJcp1=new carreras();
$empress=$OBJcp1->ObtenerIdEMP($userid);
if($empress!=""){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM mensajeria where id_emp='".$empress."' GROUP BY id_user_est ";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idusuarioe=$row[3];
$usuarios=$OBJcp1->Obtenernameest($idusuarioe);
$combo[]= array(
				
					'Estudiante' => $usuarios,
					'idestudiante' => $idusuarioe,
					'idempresa' => $row[4]);
	

}
}else{
$combo.="NO_TIENE_MENSAJES";	
	
	}
	
	}else{
$combo.="NO_TIENE_MENSAJES";		
		}	
return $combo;	
	
	}

function Listadocontactosempresaparauser($userid,$tipeuser){
$OBJcp1=new carreras();
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM mensajeria where id_user_est='".$userid."' GROUP BY id_emp ";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$id_empresa=$row[4];
$emprsa=$OBJcp1->ObtenerNameEm($id_empresa);
$combo[]= array(
				
					'Empresa' => $emprsa,
					'idempresa' => $id_empresa,
					'idestudiante' => $row[3]);
	

}
}else{
$combo.="NO_TIENE_MENSAJES";	
	
	}	
	
return $combo;	
	}	
	
function Detalledelosmsjs($idempresa,$idestudiante){
	$OBJcp1a=new carreras();
	$OBJcp1=new carreras();
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM mensajeria where id_user_est='".$idestudiante."' and id_emp='".$idempresa."'";		
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$id_empresa=$row[4];
$emprsa=$OBJcp1a->ObtenerNameEm($id_empresa);
$idusuarioe=$row[3];
$usuarios=$OBJcp1->Obtenernameest($idusuarioe);
if($row[8]!=""){
$url="www.maletinlaboral.com/img/adjuntos/".$row[8];
}else{
$url="";	
	}
$combo[]= array(
				
				    'idmensaj' => $row[0],
					'mensaje' => $row[2],
					'Empresa' => $emprsa,
					'idempresa' => $id_empresa,
					'Estudiante' =>$usuarios,
					'idestudiante' => $row[3],
					'fecha' =>$row[5],
					'adjunto' =>$url);



}

}else{
$combo.="NO_TIENE_MENSAJES";	
	}
return $combo;	
	}

function AlertaNuevomsjEstud($userid,$tipeuser,$fechacorte){
	$OBJcp1a=new carreras();
	$OBJcp1=new carreras();	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
if($fechacorte==''){
$SQLa="SELECT * FROM mensajeria where id_user_est='".$userid."' and respuesta='0'";		
	}else{
$SQLa="SELECT * FROM mensajeria where id_user_est='".$userid."' and fecha_c > '".$fechacorte."' and respuesta='0'";			
		}
$miconexion->consulta($SQLa);	
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$id_empresa=$row[4];
$emprsa=$OBJcp1a->ObtenerNameEm($id_empresa);
$idusuarioe=$row[3];
$usuarios=$OBJcp1->Obtenernameest($idusuarioe);
if($row[8]!=""){
$url="www.maletinlaboral.com/img/adjuntos/".$row[8];
}else{
$url="";	
	}
$combo[]= array(
				
				    'numeronuevosmsjs' => $vr,
				    'idmensaj' => $row[0],
					'mensaje' => $row[2],
					'Empresa' => $emprsa,
					'idempresa' => $id_empresa,
					'Estudiante' =>$usuarios,
					'idestudiante' => $row[3],
					'fecha' =>$row[5],
					'adjunto' =>$url);



}

}else{
$combo.="NO_TIENE_MENSAJES";	
	}
return $combo;			
	}	
	
function NuevoAlempsnuevomsj($userid,$tipeuser,$fechacorte){
$OBJcp1ji=new carreras();
	$OBJcp1a=new carreras();
	$OBJcp1=new carreras();	
$empress=$OBJcp1ji->ObtenerIdEMP($userid);
if($empress!=""){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
if($fechacorte==''){
$SQL="SELECT * FROM mensajeria where id_emp='".$empress."'  and respuesta='1'";	
	}else{
$SQL="SELECT * FROM mensajeria where id_emp='".$empress."'  and respuesta='1' and fecha_c > '".$fechacorte."'";		
		}
	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$id_empresa=$row[4];
$emprsa=$OBJcp1a->ObtenerNameEm($id_empresa);
$idusuarioe=$row[3];
$usuarios=$OBJcp1->Obtenernameest($idusuarioe);
if($row[8]!=""){
$url="www.maletinlaboral.com/img/adjuntos/".$row[8];
}else{
$url="";	
	}
$combo[]= array(
				
				    'numeronuevosmsjs' => $vr,
				    'idmensaj' => $row[0],
					'mensaje' => $row[2],
					'Empresa' => $emprsa,
					'idempresa' => $id_empresa,
					'Estudiante' =>$usuarios,
					'idestudiante' => $row[3],
					'fecha' =>$row[5],
					'adjunto' =>$url);


}
}else{
$combo.="NO_TIENE_MENSAJES";	
	
	}
	
	}else{
$combo.="NO_TIENE_MENSAJES";		
		}	
return $combo;		
	
	}
	
function ListadPrfVcts($userid,$tipeuser){
$combo="";
$OBJcp1ji=new carreras();
$OBJcd1a=new carreras();
$OBJcd2a=new carreras();
$OBJcd3a=new carreras();
$OBJcd6=new carreras();
$OBJcd7=new carreras();	
$empress=$OBJcp1ji->ObtenerIdEMP($userid);
if($empress!=""){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM empresa join vacante_p on vacante_p.id_empresa=empresa.id_empresa where empresa.id_empresa='".$empress."' and id_est_v='2'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)){
$ciudd=$row[19];
 $estaadd=$row[18];
 $paiss=$row[17];
 $ppais=$OBJcd1a->ObtenerPS($paiss);
 $eestado=$OBJcd2a->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3a->ObtenerCid($ciudd);
 
$cadena1.=" and pais='".$paiss."'";	
$cadena_coinci1.=" País: ".$ppais;
$cadena1.=" and Estado='".$estaadd."'";	
$cadena_coinci1.=",Estado: ".$eestado;
$cadena1.=" and ciu='".$ciudd."'";
$cadena_coinci1.=",Ciudad: ".$cciudad;
$vacante_idd=$row[20];
$puesto=$row[24];
$carprof=$row[25];
$carp=$OBJcd6->ObtenernameCar($carprof);
$statescola=$row[36];
$statescolar=$OBJcd7->ObtenertiposEs($statescola);
$aptitudes=$row[28];
$cadena1.=" and id_est_escola='".$statescola."' and carrera='".$carprof."' ";
$cadena_coinci1.=",Estatus Escolar: ".$statescolar.",Carrera Profesional: ".$carp;	

	/*
$combo[]= array(
				
				    'ands' => utf8_encode($cadena1),
					'idpersona' => utf8_encode($cadena_coinci1));	
					*/
//codigo usuario
$miconexion3= new DB_my();
$miconexion3->conectar($bd, $host, $user, $pass);
$SQL3="SELECT * FROM user join escolaridad on escolaridad.id_usuari=user.id_user where tipou='1' ".$cadena1."";
$miconexion3->consulta($SQL3);
$vr3=$miconexion3->numregistros();
if($vr3 > 0){
while ($row3= mysql_fetch_row($miconexion3->Consulta_ID)) {	
$idusuari=$row3[0];
$names=utf8_encode($row3[1]." ".$row3[2]);

$combo[]= array(
				
				
				    'coiciden en:' => $cadena_coinci1,
				    'vacanteid' => $vacante_idd,
					'puesto' => $puesto,
					'idusuario' => $idusuari,
				  'nombre' =>$names);


}
}else{
$combo[]= array(
				
				    'vacanteid' => $vacante_idd,
					'puesto' => utf8_encode($puesto),
					'nocoinciden' => utf8_encode($cadena_coinci1));	
	}
//fin de codigo usuario					
					
}

}else{
$combo.="NO_TIENE_SUGERENCIAS_DE_PERFILES";		
	
	}

}else{
$combo.="NO_TIENE_SUGERENCIAS_DE_PERFILES";		
	}
return $combo;
	}
	
function Agregandovol($userid,$lugar,$actividad,$fechain,$fechafnd){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO voluntariados(id_voluntariado,institucion,actividades_v,id_persona,fecha_in,fecha_fnd) ";		
$SQL1.="VALUES (NULL,'".$lugar."','".$actividad."','".$userid."','".$fechain."','".$fechafnd."');";
$miconexion->consulta($SQL1);
$opcion.="VOLUNTARIADO_AGREGADO_CORRECTAMENTE";
return $opcion; 		
	}										

function ListadoVl($userid){
$OBJc1=new carreras();
$fechac=date("Y-m-d H:i:s");	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM voluntariados where id_persona='".$userid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	$combo[]= array(
				
					'idvoluntariado' => $row[0],
					'Institucion' => utf8_encode($row[1]),
					'actividad' => utf8_encode($row[3]),
					'idpersona' =>$row[4]);
	
}

}else{
$combo.="NO_TIENE_VOLUNTARIADOS";	
	
	}
	
return $combo;		
	
	}
	
function Detalledevol($userid,$voluntariadoid){
$OBJc1=new carreras();
$fechac=date("Y-m-d H:i:s");	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM voluntariados where id_persona='".$userid."' and id_voluntariado='".$voluntariadoid."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	$combo[]= array(
				
					'idvoluntariado' => $row[0],
					'Institucion' => utf8_encode($row[1]),
					'actividad' => utf8_encode($row[3]),
					'idpersona' =>$row[4],
					'fechainicio' =>$row[5],
					'fechafin' =>$row[6]);
	
}

}else{
$combo.="NO_TIENE_VOLUNTARIADOS";	
	
	}
	
return $combo;		
	}
	
function ModifiVolt($userid,$lugar,$actividad,$fechain,$fechafnd,$voluntariadoid){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="UPDATE voluntariados SET institucion='".$lugar."', actividades_v='".$actividad."', fecha_in='".$fechain."', fecha_fnd='".$fechafnd."' WHERE id_persona='".$userid."' and 	id_voluntariado='".$voluntariadoid."'";
$miconexion->consulta($SQL1);
$opcion.="EL_VOLUNTARIADO_SE_HA_MODIFICADO_CORRECTAMENTE";
return $opcion;		
	
	}
	
function EliminarVolt($userid,$voluntariadoid){
$miconexion3 = new DB_my() ;
$miconexion3->conectar($bd, $host, $user, $pass);
$sqw="DELETE FROM voluntariados WHERE  id_persona='".$userid."' and id_voluntariado='".$voluntariadoid."';";
$miconexion3->consulta($sqw);	
$combo.="EL_VOLUNTARIADO_SE_HA_ELIMINADO_DE_MANERA_CORRECTA";
return 	$combo;		
	}

function CambiarOcupaddvc($userid,$vacanteid){
$fechac=date("Y-m-d H:i:s");
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="UPDATE vacante_p SET id_est_v='3', personmodi='".$userid."', fecha_ocupada='".$fechac."' WHERE id_vacante='".$vacanteid."'";
$miconexion->consulta($SQL1);
$opcion.="LA_VACANTE_HA_SIDO_OCUPADA";
return $opcion;		
	
	}

function ObtenerEMPsas2($idempresa){
$combo="";	
$OBJcd1=new carreras();
$OBJcd2=new carreras();
$OBJcd3=new carreras();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM empresa where estatus_e='1' and id_empresa='".$idempresa."' order By id_empresa";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$url="www.maletinlaboral.com/img/logos/".$row[15];
  $url2="www.maletinlaboral.com/img/logos/".$row[16];
 $ciudd=$row[19];
 $estaadd=$row[18];
 $paiss=$row[17];
 $ppais=$OBJcd1->ObtenerPS($paiss);
 $eestado=$OBJcd2->ObtenerEsd($estaadd);
 $cciudad=$OBJcd3->ObtenerCid($ciudd);

$combo[]= array(
					'id' => $row[0],
					'nombre' =>utf8_encode($row[1]),					
					'razonsocial' =>utf8_encode($row[2]), 
					'descripcion' =>utf8_encode($row[5]),
					'telefono' => $row[12],
					'rfcc' =>utf8_encode($row[10]), 
					'correocontacto' => $row[9],
					'logo' => $url,
					'logothumb' => $url2,	
					'idpais' => $paiss,				
					'pais' => $ppais,
					'idestado' => $estaadd,
					'estado' => $eestado,
					'idciudad' => $ciudd,
					'ciudad' => $cciudad);		
		
}
	}
return 	$combo;	
	
	
	}
function ModificarPas2($correoo){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE correo='".$correoo."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
$userid=$row[0];		
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$uno=date("Ymd");
$uno2=rand(5, 45);
$psww=$uno.$uno2;
$psw1=md5($psww);
$SQL2A="UPDATE user SET password='".$psw1."' WHERE id_user='".$userid."' and correo='".$correoo."'";
$miconexion2->consulta($SQL2A);	
//correo
$body="Maletin Laboral le envia su nuevo password ";
require_once('mailer/class.phpmailer.php');
$mail=new PHPMailer();
$mail->Host='localhost';
$mail->Port=25;
$mail->Priority = 1;
$mail->From='notificaciones@maletinlaboral.com';
$mail->FromName = 'notificaciones@maletinlaboral.com';
$mail->IsHTML(true);
$mail->Username = 'notificaciones@maletinlaboral.com';
$mail->Password = 'Indivisa2016';
$mail->SMTPAuth = true;
$mail->Subject = 'Cambio de Password Maletin Laboral';
$mail->AddAddress($correoo);
$mail->MsgHTML("<strong>Maletin Laboral le envia su nuevo password : ".$psw."  </strong>");
if(!$mail->Send()) {
  echo "Hubo un error: " . $correo->ErrorInfo;
} else {
  echo "Mensaje enviado con exito.";
}

//fin de correo

$opcion.="PASSWORD_MODIFICADO_DE_MANERA_CORRECTA";
}

}else{
$opcion.="CORREO_CON_DATOS_NO_ENCONTRADOS";	
	}
return $opcion; 	
	
}	
	
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++FIN DE LISTADO Clases WS
		
//funcion lista categorias no formales
function Listactnf(){
	$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM categoria_nof";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[1])."</option>\n";		
	
}
	}
return 	$combo;
	
	}
//fin  de funcion lista categorias no formales
//funcion que obtiene el combo de opciones de escolaridad
function ComboEscolaridad(){
	$combo=" <option value=''>Seleccione</option>";	
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM categorias_estudios";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$combo.="<option value='".$row[0]."'>".utf8_encode($row[1])."</option>\n";		
	
}
	}
return 	$combo;
	
	
	}

//fin  de funcion que obtiene el combo de opciones de escolaridad

	
	
	}
?>