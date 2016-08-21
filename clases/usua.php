<?php
require ('conex.php');
class user extends  DB_my{

var $Id_user;
var $Nombre;
var $Apellido_pat;
var $Correo;
var $Password;
var $Edad;
var $Sexo;
var $Carrera;
var $Pais;
var $Tipou;

function user($Id_user= "", $Nombre= "", $Apellido_pat= "",$Correo= "",$Password= "",$Edad= "",$Sexo= "",$Carrera= "",$Pais= "",$Tipou= "" ) {
$this->Id_user = Id_user;
$this->Nombre = $Nombre;
$this->Apellido_pat = $Apellido_pat;
$this->Correo = $Correo;
$this->Password = $Password;
$this->Edad = $Edad;
$this->Sexo = $Sexo;
$this->Carrera = $Carrera;
$this->Pais = $Pais;
$this->Tipou = $Tipou;

}

function conectando($correo,$passw){

$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser  WHERE correo='".$correo."' and 	pass='".$passw."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	$opcion.="SI";
	}else{
$opcion.="NO";		
	}
return $opcion;	
	}
	
function Usuariop($correo,$passw){
	$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser  WHERE correo='".$correo."' and 	pass='".$passw."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr=$row[0];
}
	}else{
$idsr=0;		
	}
return $idsr;
	
	}
	
function ObtenerNameTipoUser($idusr){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser  WHERE idusr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr=$row[9];
}
	}else{
$idsr=0;		
	}
return $idsr;
	
	}
	
function verProy($proy){
	$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectos  WHERE idproyecto='".$proy."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr="  <form class='form-horizontal'><div class='form-group'>
                            <label for='name'>
                                Nombre del Proyecto</label>
                            <input type='text' disabled='disabled' name='nameproyecto' class='form-control' id='name' value='".$row[1]."'/>
                        </div>";
						
$idsr.="<div class='form-group'>
                  <label>Idea de Negocio</label>
                  <textarea name='descrp' class='form-control' rows='3'   disabled='disabled' >".$row[5]."</textarea>
                </div>";	
				
				$idsr.=" <br/> <strong>Video :</strong> <br/><br/><a href='".$row[8]."'  target='_blank'>".$row[8]."</a><br/><br/>";	
		        $idsr.=" <br/> <strong> PDF : </strong> <br/><br/><a href='http://www.icemerida.org/hackaton/pdfs/".$row[7]."'  target='_blank'>".$row[7]."</a><br/><br/>";
				if($row[10]=='1'){
				$idsr.=" <br/> <strong> Categoría : </strong><br/>  Emprendimiento Social <br/><br/>";	
					}else if($row[10]=='2'){
					$idsr.=" <br/> <strong> Categoría :</strong><br/> Idea de Negocio <br/><br/>";		
						}else if($row[10]=='3'){
							$idsr.=" <br/> <strong>Categoría : </strong> <br/>  Negocio Emprendido <br/><br/>";	
							
							}
							if($row[9]=='1'){
				$idsr.=" <br/> <strong> Area :</strong><br/>  Tecnología <br/><br/>";	
					}else if($row[9]=='2'){
					$idsr.=" <br/> <strong> Area :</strong><br/> Alimentos <br/><br/>";		
						}else if($row[9]=='3'){
							$idsr.=" <br/> <strong>Area :</strong> <br/>  Construcción <br/><br/>";	
							
							}else if($row[9]=='4'){
							$idsr.=" <br/> <strong>Area :</strong> <br/>  Agricultura <br/><br/>";	
							
							}
					$idsr.=" <br/> <strong>Estatus :</strong> <br/>  En Proceso <br/><br/>";
					$idsr.=" <div class='clearfix'>
                    <span class='pull-left'> Resolucion de una Necesidad</span>
                    <small class='pull-right'>90%</small></div>   <div class='progress xs'>
                    <div class='progress-bar progress-bar-green' style='width: 90%;'></div>
                  </div>";
				  $idsr.=" <div class='clearfix'>
                    <span class='pull-left'> Potencial de Impacto</span>
                    <small class='pull-right'>50%</small></div>   <div class='progress xs'>
                    <div class='progress-bar progress-bar-green' style='width: 50%;'></div>
                  </div>";
				   $idsr.=" <div class='clearfix'>
                    <span class='pull-left'> Construccion de Alianzas</span>
                    <small class='pull-right'>70%</small></div>   <div class='progress xs'>
                    <div class='progress-bar progress-bar-green' style='width: 70%;'></div>
                  </div>";
				  $idsr.=" <div class='clearfix'>
                    <span class='pull-left'> Escalabilidad y Replicabilidad</span>
                    <small class='pull-right'>50%</small></div>   <div class='progress xs'>
                    <div class='progress-bar progress-bar-green' style='width: 50%;'></div>
                  </div>";
				   $idsr.=" <div class='clearfix'>
                    <span class='pull-left'> Generacion de Empleo</span>
                    <small class='pull-right'>65%</small></div>   <div class='progress xs'>
                    <div class='progress-bar progress-bar-green' style='width: 65%;'></div>
                  </div>";
				  $idsr.=" <div class='clearfix'>
                    <span class='pull-left'> Innovacion</span>
                    <small class='pull-right'>50%</small></div>   <div class='progress xs'>
                    <div class='progress-bar progress-bar-green' style='width: 50%;'></div>
                  </div>";
                  	$idsr.="<div class=form-group'>
                  <label>Observaciones Generales</label>
                  <textarea class='form-control' rows='3' >".$row[11]."</textarea>
                </div>";
				$idsr.="<div class=form-group'>
                  <label>Fortalezas</label>
                  <textarea class='form-control' rows='3' >".$row[13]."</textarea>
                </div>";
				$idsr.="<div class=form-group'>
                  <label>Areas de Oportunidad</label>
                  <textarea class='form-control' rows='3' >".$row[14]."</textarea>
                </div>";
				$idsr.="<div class=form-group'>
                  <label>Instituciones Sugeridas</label>
                  <textarea class='form-control' rows='3' >".$row[12]."</textarea>
                </div>";
					
					$idsr.=" <br/> <strong>Calificacion :</strong> <br/>".$row[15]." <br/><br/>";
					$idsr.=" <br/> <button type='submit' class='btn btn-skin pull-right' id='btnContactUs'>
                            Calificar</button><br/>";
					$idsr.=" </form>";		
															
}
	}else{
$idsr=0;		
	}
return $idsr;
	}	
	
function ObtenerProy($idusr){
$Objtuser=new user();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectos join categorias on categorias.id_cat=proyectos.tipo_c join catgo on catgo.idcatp=proyectos.id_catgoride_empre where estatus='1'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	$idsr="<table class='table table-bordered table-hover'>";
	$idsr.="<tr><td> <strong>Nombre De Proyecto</strong></td>";
	$idsr.="<td><strong>Area</strong></td>";
	$idsr.="<td><strong>Categoria</strong></td>";
	$idsr.="<td><strong>Ver Proyecto</strong></td>";
	
	$idsr.="</tr>";
	
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr.="<tr>";
$idsr.="<td>".$row[1]."</td>";
$idsr.="<td>".$row[23]."</td>";
$idsr.="<td>".$row[25]."</td>";
$idsr.="<td><a href='evaluador.php?usrt=".$idusr."&proy=".$row[0]."' >Ver</a></td>";
$idsr.="</tr>";											
}
$idsr.="</table>";
	}else{
$idsr=0;		
	}
return $idsr;		
	
	}	
	
function ObtenerPerfilEv($idusr){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser join categorias on categorias.id_cat=usuarios.id_catego WHERE idusr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr="<div class='form-group'><label for='name'>Nombre</label>
 <input type='text' name='nam' class='form-control' id='name' value='".$row[1]."' />
   </div>";
 $idsr.= "<div class='form-group'>
                            <label for='name'>
                               Apellidos</label>
                            <input type='text' name='ape' class='form-control' id='name' value='".$row[2]."' />
                        </div>";
	$idsr.="<div class='form-group'>
                            <label for='email'>
                                Email Address</label>
                            <div class='input-group'>
                                <span class='input-group-addon'><span class='glyphicon glyphicon-envelope'></span>
                                </span>
                                <input type='email' name='corr' class='form-control' id='email' value='".$row[4]."' /></div></div>";
$idsr.=" <div class='form-group'>
                            <label for='name'>
                                Telefono</label>
                            <input type='text' name='telef' class='form-control' id='name'  value='".$row[6]."' />
                        </div>";	
						
$idsr.="<input type='hidden' name='idusr' value='".$row[0]."' />";	
$idsr.="<br/> <strong> Areas de Especialidad : </strong><div class='form-group'>
                <label>
                  <input type='checkbox' name='r2' class='minimal-red' >
				  Tecnologia
                </label>
                <label>
                  <input type='checkbox' name='r2' class='minimal-red'>
				  Alimentos
                </label>
                <label>
                  <input type='checkbox' name='r2' class='minimal-red' >
                 Construccion
                </label>
				<label>
                  <input type='checkbox' name='r2' class='minimal-red' >
                 Agricultura
                </label>
              </div>";													
}
	}else{
$idsr=0;		
	}
return $idsr;	
	
	}	

function ObtenerCalificaciones(){
$Objtuser=new user();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectos join categorias on categorias.id_cat=proyectos.tipo_c  order by calif DESC";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	$idsr="<table class='table table-bordered table-hover'>";
	$idsr.="<tr><td> <strong>Nombre De Proyecto</strong></td>";
	$idsr.="<td><strong>Area</strong></td>";
	$idsr.="<td><strong>Calificaciones</strong></td>";
	
	$idsr.="</tr>";
	
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr.="<tr>";
$idsr.="<td>".$row[1]."</td>";
$idsr.="<td>".$row[23]."</td>";
$idsr.="<td>".$row[15]."</td>";
$idsr.="</tr>";											
}
$idsr.="</table>";
	}else{
$idsr=0;		
	}
return $idsr;	
	
	}

function ObtenerProyectos(){
$Objtuser=new user();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectos join categorias on categorias.id_cat=proyectos.tipo_c ";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	$idsr="<table class='table table-bordered table-hover'>";
	$idsr.="<tr><td> <strong>Nombre De Proyecto</strong></td>";
	$idsr.="<td><strong>Area</strong></td>";
	$idsr.="<td><strong>Evaluadores</strong></td>";
	$idsr.="<td><strong>Eliminar</strong></td>";
	$idsr.="</tr>";
	
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr.="<tr>";
$idsr.="<td>".$row[1]."</td>";
$idsr.="<td>".$row[23]."</td>";
$idsr.="<td>".$Objtuser->UserEv()."</td>";
$idsr.="<td><div class='form-group'>
                <label>
                  <input type='radio' name='r2' class='minimal-red' >
                </label>
               
              </div></td>";
$idsr.="</tr>";											
}
$idsr.="</table>";
	}else{
$idsr=0;		
	}
return $idsr;
	

	}	
	
function UserEv(){
	$comboo="";
	$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios  WHERE tipouser='2'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	 $comboo.="<select class='form-control'>";
	$comboo.="<option value='' >Seleccione</option>";
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	
		$comboo.="<option value='".$row[0]."'  >".$row[1]." ".$row[2]."</option>";
	}
$comboo.="</select>";	
     }
		
		return $comboo;
	
	}	
	
	
function ObtenerEvaluadores(){

$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join categorias  on  categorias.id_cat=usuarios.id_catego WHERE tipouser='2'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	$idsr="<table class='table table-bordered table-hover'>";
	$idsr.="<tr><td> <strong>Nombre</strong></td>";
	$idsr.="<td><strong>Correo</strong></td>";
	$idsr.="<td><strong>Especialidad</strong></td>";
	$idsr.="<td><strong>Editar</strong></td>";
	$idsr.="</tr>";
	
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr.="<tr>";
$idsr.="<td>".$row[1]." ".$row[2]."</td>";
$idsr.="<td>".$row[4]."</td>";
$idsr.="<td>".$row[9]."</td>";
$idsr.="<td>Editar</td>";
$idsr.="</tr>";											
}
$idsr.="</table>";
	}else{
$idsr=0;		
	}
return $idsr;
	}	
	
function Agregando($correo,$passw,$name,$telef,$ape,$nameproyecto,$cat,$descrp,$idea,$link,$pdf,$catego){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);	
$objy=new user();
$SQL1="INSERT INTO usuarios(idusr,nombre_u,apellidos_u,tipouser,correo,pass,telefono) ";		
$SQL1.="VALUES (NULL,'".$name."','".$ape."','1','".$correo."','".$passw."','".$telef."');";	
$miconexion->consulta($SQL1);
$miconexion2 = new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$opcu=$objy->SelectMaxu();
$objy->Agregapt($nameproyecto,$cat,$descrp,$idea,$link,$pdf,$catego,$opcu);
return true;	
	}

function Agregapt($nameproyecto,$cat,$descrp,$idea,$link,$pdf,$catego,$opcu){
$miconexion2= new DB_my();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL1a="INSERT INTO proyectos(idproyecto,nombre,estatus,descripcion,idea_negocio,id_usr,pdfg,video_you,tipo_c,id_catgoride_empre) ";		
$SQL1a.="VALUES (NULL,'".$nameproyecto."','1','".$descrp."','".$idea."','".$opcu."','".$pdf['name']."','".$link."','".$cat."','".$catego."');";	
$miconexion2->consulta($SQL1a);
$dirc=$_SERVER['DOCUMENT_ROOT']."/hackaton/pdfs/";
$namear=$dirc.$pdf['name'];
$tmp_n=$pdf['tmp_name'];

if(copy($tmp_n, $namear)) {
}

return true;	
	
	}	
	
function ObtenerPerfil($idusr){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser  WHERE idusr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr="<div class='form-group'><label for='name'>Nombre</label>
 <input type='text' name='nam' class='form-control' id='name' value='".$row[1]."' />
   </div>";
 $idsr.= "<div class='form-group'>
                            <label for='name'>
                               Apellidos</label>
                            <input type='text' name='ape' class='form-control' id='name' value='".$row[2]."' />
                        </div>";
	$idsr.="<div class='form-group'>
                            <label for='email'>
                                Email Address</label>
                            <div class='input-group'>
                                <span class='input-group-addon'><span class='glyphicon glyphicon-envelope'></span>
                                </span>
                                <input type='email' name='corr' class='form-control' id='email' value='".$row[4]."' /></div></div>";
$idsr.=" <div class='form-group'>
                            <label for='name'>
                                Telefono</label>
                            <input type='text' name='telef' class='form-control' id='name'  value='".$row[6]."' />
                        </div>";	
						
$idsr.="<input type='hidden' name='idusr' value='".$row[0]."' />";													
}
	}else{
$idsr=0;		
	}
return $idsr;
	
	}	
	
	
	
function ProyectoActual($idusr){
	$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectos  WHERE id_usr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr="<div class='form-group'>
                            <label for='name'>
                                Nombre del Proyecto</label>
                            <input type='text' disabled='disabled' name='nameproyecto' class='form-control' id='name' value='".$row[1]."'/>
                        </div>";
						
$idsr.="<div class='form-group'>
                  <label>Idea de Negocio</label>
                  <textarea name='descrp' class='form-control' rows='3'   disabled='disabled' >".$row[5]."</textarea>
                </div>";	
				
				$idsr.=" <br/> <strong>Video :</strong> <br/><br/><a href='".$row[8]."'  target='_blank'>".$row[8]."</a><br/><br/>";	
		        $idsr.=" <br/> <strong> PDF : </strong> <br/><br/><a href='http://www.icemerida.org/hackaton/pdfs/".$row[7]."'  target='_blank'>".$row[7]."</a><br/><br/>";
				if($row[10]=='1'){
				$idsr.=" <br/> <strong> Categoría : </strong><br/>  Emprendimiento Social <br/><br/>";	
					}else if($row[10]=='2'){
					$idsr.=" <br/> <strong> Categoría :</strong><br/> Idea de Negocio <br/><br/>";		
						}else if($row[10]=='3'){
							$idsr.=" <br/> <strong>Categoría : </strong> <br/>  Negocio Emprendido <br/><br/>";	
							
							}
							if($row[9]=='1'){
				$idsr.=" <br/> <strong> Area :</strong><br/>  Tecnología <br/><br/>";	
					}else if($row[9]=='2'){
					$idsr.=" <br/> <strong> Area :</strong><br/> Alimentos <br/><br/>";		
						}else if($row[9]=='3'){
							$idsr.=" <br/> <strong>Area :</strong> <br/>  Construcción <br/><br/>";	
							
							}else if($row[9]=='4'){
							$idsr.=" <br/> <strong>Area :</strong> <br/>  Agricultura <br/><br/>";	
							
							}
					$idsr.=" <br/> <strong>Estatus :</strong> <br/>  En Proceso <br/><br/>";			
															
}
	}else{
$idsr=0;		
	}
return $idsr;
	
	}	
	
	
function ObtenerPostE($idusr){
	$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM proyectos  WHERE id_usr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr="<div class='form-group'>
                            <label for='name'>
                                Nombre del Proyecto</label>
                            <input type='text' disabled='disabled' name='nameproyecto' class='form-control' id='name' value='".$row[1]."'/>
                        </div>";
						$idsr.="<BR/><BR/> <strong> Calificación : </strong>".$row[15]."<BR/><BR/>";
$idsr.="<div class='form-group'>
                  <label>Observaciones Generales</label>
                  <textarea name='descrp' class='form-control' rows='3'   disabled='disabled' >".$row[11]."</textarea>
                </div>";
				$idsr.="<div class='form-group'>
                  <label>Fortalezas Encontradas</label>
                  <textarea name='descrp' class='form-control' rows='3'   disabled='disabled' >".$row[13]."</textarea>
                </div>";
				$idsr.="<div class='form-group'>
                  <label>Areas de Oportunidades</label>
                  <textarea name='descrp' class='form-control' rows='3'   disabled='disabled' >".$row[14]."</textarea>
                </div>";
				$idsr.="<div class='form-group'>
                  <label>Institucion Sugerida</label>
                  <textarea name='descrp' class='form-control' rows='3'   disabled='disabled' >".$row[12]."</textarea>
                </div>";
					
				
			
															
}
	}else{
$idsr=0;		
	}
return $idsr;
	
	}
	
function SelectMaxu(){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT MAX(idusr)  FROM  usuarios where tipouser='1'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr=$row[0];
}
	}else{
$idsr=0;		
	}
return $idsr;	
	}				



function ObtenerNombre($idusr){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser  WHERE idusr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr=$row[1]." ".$row[2];
}
	}else{
$idsr=0;		
	}
return $idsr;	
	}
	
function Obtenertipe($idusr){
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM usuarios join   tipouser  on  tipouser.idtipo=usuarios.tipouser  WHERE idusr='".$idusr."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr=$row[3];
}
	}else{
$idsr=0;		
	}
return $idsr;
	
	}		


function ListaU($nom,$ape,$em,$em2,$ed,$def,$pro,$pai,$idt){
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
$body="Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a>http://www.icemerida.org/confirm/conf.php?co=".$conf."</a>";
require_once('mailer/class.phpmailer.php');
$mail=new PHPMailer();
$mail->Host='localhost';
$mail->Port=25;
$mail->Priority = 1;
$mail->From='notificaciones@icemerida.org';
$mail->FromName = 'notificaciones@icemerida.org';
$mail->IsHTML(true);
$mail->Username = 'notificaciones@icemerida.org';
$mail->Password = 'indivisa2015';
$mail->SMTPAuth = true;
$mail->Subject = 'Bienvenido a Maletin Laboral';
$mail->AddAddress($em);
$mail->MsgHTML("<strong>Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a href='http://www.icemerida.org/confirm/conf.php?co=".$conf."'>http://www.icemerida.org/confirm/conf.php?co=".$conf."</a></strong>");
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
	
function ListaUE($nom,$ape,$em,$em2,$rf,$rz,$nrz,$pai,$idt){
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
$body="Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a>http://www.icemerida.org/confirm/conf.php?co=".$conf."</a>";
require_once('mailer/class.phpmailer.php');
$mail=new PHPMailer();
$mail->Host='localhost';
$mail->Port=25;
$mail->Priority = 1;
$mail->From='notificaciones@icemerida.org';
$mail->FromName = 'notificaciones@icemerida.org';
$mail->IsHTML(true);
$mail->Username = 'notificaciones@icemerida.org';
$mail->Password = 'indivisa2015';
$mail->SMTPAuth = true;
$mail->Subject = 'Bienvenido a Maletin Laboral';
$mail->AddAddress($em);
$mail->MsgHTML("<strong>".$rz."  Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a href='http://www.icemerida.org/confirm/conf.php?co=".$conf."'>http://www.icemerida.org/confirm/conf.php?co=".$conf."</a></strong>");
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
	

function reestablecerp($em,$idi){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$confp=date("Ymd").rand(5, 28).date("Ymd");
$SQL="SELECT * FROM user WHERE correo='".$em."' and status_u='1'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	

$ID=$row[0];
$paa=md5($confp);
$sql2="UPDATE user SET password='".$paa."' WHERE id_user='".$ID."';";
$miconexion->consulta($sql2);
//codigo mail
$body="Bienvenido a Maletin Laboral le sugerimos confirmar su correo dando clic al siguiente link <a>http://www.icemerida.org/confirm/conf.php?co=".$conf."</a>";
require_once('mailer/class.phpmailer.php');
$mail=new PHPMailer();
$mail->Host='localhost';
$mail->Port=25;
$mail->Priority = 1;
$mail->From='notificaciones@icemerida.org';
$mail->FromName = 'notificaciones@icemerida.org';
$mail->IsHTML(true);
$mail->Username = 'notificaciones@icemerida.org';
$mail->Password = 'indivisa2015';
$mail->SMTPAuth = true;
$mail->Subject = 'Se reestablecio su Password de Maletin Laboral';
$mail->AddAddress($em);
$mail->MsgHTML("<strong>Se reestablecio su Password de Maletin Laboral es: ".$confp."</strong>");
if(!$mail->Send()) {
  echo "Hubo un error: " . $correo->ErrorInfo;
} else {
  echo "Mensaje enviado con exito.";
}
//codigo mail
	
}	
$opcion.=" Su nuevo pass fue enviado a su correo Exitosamente ";
}else{
$opcion.=" El correo no se encuentra registrado ".$em;	
	}
	
	}	
	
function Iniciar($em1,$em2){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE correo='".$em1."' and password='".$em2."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
$opcion.=1;
}else{
$opcion.=" Error de E-mail y Password ".$em1;	
	}
return $opcion; 
	}	
//funciom in	
function Iniciar2($em1,$em2,$idi){
$miconexion = new DB_my ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE correo='".$em1."' and password='".$em2."' and status_u='1'";	
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();	
if($vr > 0){
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {	
$idsr=$row[0];
$nom=$row[1]." ".$row[2];
$tp=$row[10];
$cfg=$row[12];
$rff=$row[11];
//+++++++
$miconexion2 = new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL2A="SELECT * FROM modulos where id_tipo='".$tp."'";
$miconexion2->consulta($SQL2A);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
///menuuu
$opcion.="
 <nav class='navbar navbar-default'>
  <div class='container-fluid'>
       <div class='navbar-header'>&nbsp;&nbsp;&nbsp;<strong>".$nom."</strong>
	   <input type='hidden' name='idd' id='idd' value='".$idsr."' />
	    <input type='hidden' name='tpp' id='tpp' value='".$tp."' />
		
      <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <a class='navbar-brand' href='#'></a>
    </div>

   
    <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
      <ul class='nav navbar-nav'>";
	while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
		if($row2[5]!=""){
			$h=$row2[5];
			}else{
			$h="#";	
				}	
	$opcion.=" <li><a href='".$h."?ps=".$idsr."&tp=".$tp."'><img src='".$row2[4]."' border='0' />&nbsp;&nbsp;<strong>".utf8_encode($row2[1])."</strong></a></li>
	
	
 	";
	
	} 
	if($tp=='2' && $rff!=""){
$miconexion3 = new DB_my ;
$miconexion3->conectar($bd, $host, $user, $pass);
$SQL2A="SELECT * FROM empresa where RFC_e='".$rff."' and estatus_e='1'";
$miconexion3->consulta($SQL2A);
$vr3=$miconexion3->numregistros();
if($vr3 > 0){
	while ($row3 = mysql_fetch_row($miconexion3->Consulta_ID)) {
$opcion.="<input type='hidden' name='idEE' id='idEE' value='".$row3[0]."' />";
$opcion.="<input type='hidden' name='Nam' id='Nam' value='".$row3[1]."' />";
$opcion.="<input type='hidden' name='Rza' id='Rza' value='".$row3[2]."' />";	
$opcion.="<input type='hidden' name=RFd'' id='RFd' value='".$row3[12]."' />";
	}
	
	}
		
		
		
		}
	$opcion.=" <li><a href='inicia.html'><strong>Salir</strong></a></li>"; 
  $opcion.="</ul>
      

    </div>
  </div>
</nav>
";
///menuuu	
}

//++++++++
}
}else{
$opcion.=" Error de E-mail y Passwordd ".$em1;	
	}
return $opcion; 
	}		
//fin funciom in	

function Cuenta($ps,$tp){
	$opcion="";	
$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE id_user='".$ps."' and tipou='".$tp."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	$opcion.="<form  name='formulario' id='formulario'><label >Nombres </label><input type='text' class='form-control' id='nom' name='nom' value='".$row[1]."' ><label >Apellidos</label><input type='text' class='form-control' id='ape' name='ape'  value='".$row[2]."' ><label >Email </label><input type='email' class='form-control' id='em' name='em'  value='".$row[4]."'>   <label for='exampleInputPassword1'>Contraseña</label><input type='password' class='form-control' id='pas' name='pas' value='".$row[5]."'><input type='hidden' class='form-control' id='pas1' name='pas1' value='".$row[5]."'><input type='hidden' name='idpp' id='idpp' value='".$row[0]."' ><br/><div  align='right'><button type='submit' class='btn btn-default'>Modificar</button></div> ";
	
	
	$opcion.="</form>";	
	}
	
}else{
$opcion.=" Error de Conexión de red ";	
	}
return $opcion; 	
	
	}
	
//codigo funcion cuenta
function Updat($nom,$ape,$em,$pas,$idpp,$pas1){
	$ps="";
	if($pas==$pas1){
		$ps=$pas1;
		}else{
	    $ps=md5($pas);
			}
	$opcion="";	
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="UPDATE user  SET nombre='".$nom."',apellido_pat='".$ape."',correo='".$em."' , password='".$ps."'  WHERE id_user='".$idpp."' ";
$miconexion->consulta($SQL);	
$opcion.="Los datos se modificaron de manera correcta";
	return $opcion;
	}
//fin de codigo funcion cuenta

//funcion meses
function Mses($mss){
	$meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo', 4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto', 9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
	$nm=count($meses);
    $vy="";	
	foreach($meses as $keys => $values){
		if($mss==$keys){
		$vy.="selected='selected'";	
			}else{
		$vy="";			
				}
    $comb.="<option value='".$keys."' ".$vy.">".$values."</option>";
   }
   
   return  $comb;
		
}
//fin de funcion meses
//funcion estado civil
function estadoc($ecv){
		$estc=array('C'=>'Casado(a)','S'=>'Soltero(a)','D'=>'Divorciado(a)');
		foreach($estc as $keys => $values){
					if($ecv==$keys){
		$vy.="checked='checked'";	
			}else{
		$vy="";			
				}
		  $comb.="<label class='radio-inline'>
 <input type='radio' name='ec' id='ec' value='".$keys."' ".$vy.">". $values."
</label>";	
			}
	
	 return  $comb;
	
	}
//fin de funcion estado civil

//codigo de datos
function DatosP($ps,$tp){
	
	$opcion="";	
$objus=new user();
$miconexion = new DB_my();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE id_user='".$ps."' and tipou='".$tp."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){

	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
	if($row[7]=='F'){
		$mss=$row[18];
		$ecv=$row[16];
		$estdd=$row[33];
		$paif=$row[9];
	$contenid="  <option value='F' selected='selected'>Femenino</option>
  <option value='M'>Masculino</option>";	
		}else{
			$contenid="  <option value='F' >Femenino</option>
  <option value='M' selected='selected'>Masculino</option>";
			}	
	$opcion.="<br/><img src='".$row[20]."'  border'0'/><br/><br/><label >Nombre : </label>  <br/>".$row[1]." ".$row[2]." <br/> <label >Sexo : </label>  <select name='def' id='def'  class='form-control'>".$contenid."
</select><br/> 
<label >Fecha de Nacimiento : </label> 
<select  name='dn' id='dn'  class='form-control'>";
if($row[17]!=""){
$opcion.="	<option value='".$row[17]."' selected='selected'>".$row[17]."</option>";
	}else{
$opcion.="<option value=''>Seleccione</option>";		
		}
$opcion.="<option value='01'>01</option><option value='02' >02</option><option value='03' >03</option><option value='04' >04</option><option value='05' >05</option><option value='06' >06</option><option value='07' >07</option><option value='08' >08</option><option value='09' >09</option><option value='10' >10</option><option value='11' >11</option><option value='12' >12</option><option value='13' >13</option><option value='14' >14</option><option value='15' >15</option><option value='16' >16</option><option value='17' >17</option><option value='18' >18</option><option value='19' >19</option><option value='20' >20</option><option value='21' >21</option><option value='22' >22</option><option value='23' >23</option><option value='24' >24</option><option value='25' >25</option><option value='26' >26</option><option value='27' >27</option><option value='28' >28</option><option value='29' >29</option><option value='30' >30</option><option value='31' >31</option>";
$opcion.="</select><br/>";
$opcion.="<select name='mn' id='mn'  class='form-control'>";
if($row[18]==""){
$opcion.="	<option value=''>Seleccione</option>";		
		}	
$opcion.=$objus->Mses($mss);	
$opcion.="</select><br/>";
$opcion.="<select name='an' id='an'  class='form-control'>";
if($row[19]==""){
$opcion.="	<option value=''>Seleccione</option>";		
		}else{
$opcion.="	<option value='".$row[19]."' selected='selected'>".$row[19]."</option>";			
			}
$opcion.="<option value='1985'>1985</option><option value='1986'>1986</option><option value='1987'>1987</option><option value='1988'>1988</option><option value='1989'>1989</option><option value='1990'>1990</option><option value='1991' >1991</option><option value='1992' >1992</option><option value='1993' >1993</option><option value='1994' >1994</option><option value='1995' >1995</option><option value='1996' >1996</option><option value='1997' >1997</option><option value='1998' >1998</option><option value='1999' >1999</option>";			
$opcion.="</select>";
/*
$opcion.="<label >Curp</label><input type='text' class='form-control' id='cur' name='cur' value='".$row[26]."' > ";
$opcion.="<label >RFC</label><input type='text' class='form-control' id='rfcur' name='rfcur' value='".$row[27]."' >";
$opcion.="<label >Pasaporte</label><input type='text' class='form-control' id='pspr' name='pspr' value='".$row[31]."' > "; */
$opcion.="<label >Teléfono</label><input type='text' class='form-control' id='tl' name='tl' value='".$row[28]."' > ";
$opcion.="<label >Móvil</label><input type='text' class='form-control' id='cl' name='cl' value='".$row[29]."' > ";
/*$opcion.="<label >Número de Seguridad Social</label><input type='text' class='form-control' id='ns' name='ns' value='".$row[30]."' >"; */ /*
$opcion.="<label >Estado Civil: </label> <br/> 
";
$opcion.=$objus->estadoc($ecv)."<br/><br/> "; */
/*	
$opcion.="<label >Ubicación :</label><br/> ";
$opcion.="<label >Calle</label><input type='text' class='form-control' id='ca' name='ca' value='".$row[21]."' > ";
$opcion.="<label >Número Exterior</label><input type='text' class='form-control' id='nmo' name='nmo' value='".$row[22]."' > ";
$opcion.="<label >Cruzamientos</label><input type='text' class='form-control' id='cr' name='cr' value='".$row[23]."' > ";
$opcion.="<label >Colonia</label><input type='text' class='form-control' id='co' name='co' value='".$row[24]."' > ";
$opcion.="<label >Código Postal</label><input type='text' class='form-control' id='cpo' name='cpo' value='".$row[25]."' > 
<input type='hidden' class='form-control' id='idpa' name='idpa' value='".$row[9]."' ><br/>";*/
$opcion.="<input type='hidden' class='form-control' id='idpa' name='idpa' value='".$row[9]."' ><br/>";


//codigo pais estado y ciudad
$miconexion2 = new DB_my ;
$miconexion2->conectar($bd, $host, $user, $pass);
$SQLR="SELECT * FROM localidad_pais WHERE idregistro='".$row[9]."'";
$miconexion2->consulta($SQLR);
$vr2=$miconexion2->numregistros();
if($vr2 > 0){
	while ($row2 = mysql_fetch_row($miconexion2->Consulta_ID)) {
		$internacional=$row2[1];
	}
	
	}

//fin de codigo pais estado y ciudad
$opcion.="<br/><label >País :</label>".utf8_encode($internacional)."<br/>";
if($row[9]=='146'){
$opcion.="<div id='estadd'><label >Estado</label><select name='estd' id='estd'  class='form-control'>";
$opcion.=$objus->Est($estdd,$paif);
$opcion.="</select><br/><label >Ciudad</label><select name='cdd' id='cdd'  class='form-control'>";	
$opcion.="</select></div>";
	}else{
$opcion.="<label >Estado</label><input type='text' class='form-control' id='ed' name='ed' value='".$row[33]."' > ";		
$opcion.="<label >Ciudad</label><input type='text' class='form-control' id='cd' name='cd' value='".$row[34]."' > ";		
		
		}

	
		
	}
	
}else{
$opcion.=" Error de Conexión de red ";	
	}
return $opcion; 
	}

//fin de codigo de datos

//funcion de estado
function Est($estdd,$paif){
	$comboo="";
	$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM estados WHERE id_pai='".$paif."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	$comboo.="<option value='' >Seleccione</option>";
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
		if($row[0]==$estdd){
		$fg="selected='selected'";	
			}else{
		$fg="";		
				}
		
		$comboo.="<option value='".$row[0]."' ".$fg." >".utf8_encode($row[1])."</option>";
	}
     }
		
		return $comboo;
	
	}
//fin de funcion de estado
//funcion empleos no formales
function Addtrabajonf($ps,$ctpro,$jfi,$ngf,$tlf,$dlf,$crn,$puesto,$act,$def){
	$comboo="";
	$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO empleosnf(id_nf,id_cat,puesto,jefe_inmediato,nombre_emp,actividades,telefono_dir,direcc,corre,id_usru,tiempo_nf) ";		
$SQL1.="VALUES (NULL,'".$ctpro."','".$puesto."','".$jfi."','".$ngf."','".$act."','".$tlf."','".$dlf."','".$crn."','".$ps."','".$def."');";
$miconexion->consulta($SQL1);
	$comboo="Empleo No Formal Agregado Exitosamente";
	return $comboo;
	}
//fin de funcion empleos no formales
//funcion ver trabajos no formales
function vertrabajonf($ps){
	$opcion="";
	$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM empleosnf WHERE id_usru='".$ps."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
$opcion.="<table class='table'>";
$opcion.="<tr>";
$opcion.="<td><strong>Puesto</strong></td>";
$opcion.="<td><strong>Tiempo Laborado</strong></td>";
$opcion.="<td><strong>Ver</strong></td>";
$opcion.="</tr>";
while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
$opcion.="<tr>";
$opcion.="<td>".$row[2]."</td>";
$opcion.="<td>".$row[12]."</td>";
$opcion.="<td>Ver</td>";
$opcion.="</tr>";
}
$opcion.="</table>";
	
}else{
		
	$opcion.=" No Tiene Empleos No Formales ";	
		}
	return $opcion;
	}


//fin de funcion ver trabajos no formales
//funcion proyectos escolares
function Addproy($ps,$tit,$act,$sem){
	$comboo="";
	$miconexion = new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL1="INSERT INTO proyectosescolares(id_pro,titulo,asignatura,semestre,actividad,idusuar) ";		
$SQL1.="VALUES (NULL,'".$tit."','','".$sem."','".$act."','".$ps."');";
$miconexion->consulta($SQL1);
	$comboo="Proyecto Escolar Agregado Exitosamente";
	return $comboo;
	
	}
//funcion proyectos escolares
//funcion ver listado proyectos escolares
function verproye($ps){
		$opcion="";
	$miconexion2 = new DB_my ();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM  proyectosescolares WHERE idusuar='".$ps."'";
$miconexion2->consulta($SQL);
$vr=$miconexion2->numregistros();
if($vr > 0){
$opcion.="<table class='table'>";
$opcion.="<tr>";
$opcion.="<td><strong>Título</strong></td>";
$opcion.="<td><strong>Asignatura</strong></td>";
$opcion.="<td><strong>Ver</strong></td>";
$opcion.="</tr>";
while ($row = mysql_fetch_row($miconexion2->Consulta_ID)) {
$opcion.="<tr>";
$opcion.="<td>".$row[1]."</td>";
$opcion.="<td>".$row[2]."</td>";
$opcion.="<td>Ver</td>";
$opcion.="</tr>";
}
$opcion.="</table>";
	
}else{
		
	$opcion.=" No Tiene Proyectos Escolares ";	
		}
	return $opcion;
	
	}
//fin de funcion proyectos escolares

//funcion datos empresa
function DatE($ps,$tp){
$opcion="";
$miconexion= new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE id_user='".$ps."' and tipou='".$tp."'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
		$rfg=$row[11];
$miconexion2= new DB_my ();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL2a="SELECT * FROM empresa WHERE RFC_e='".$rfg."'";
$miconexion2->consulta($SQL2a);
$vr2=$miconexion2->numregistros();
		while ($row2= mysql_fetch_row($miconexion2->Consulta_ID)) {
			$opcion.="<label >Nombre Comercial Empresa * </label>
    <input type='text' class='form-control' id='nrz' name='nrz' value='".$row2[1]."' ><br/>";
	$opcion.="<label >Razón Social *</label>
    <input type='text' class='form-control' id='rz' name='rz' value='".$row2[2]."' ><br/>";
	$opcion.="<label >RFC *</label>
    <input type='text' class='form-control' id='rf' name='rf'  value='".$row2[10]."' ><br/>";
	$opcion.="<label >Teléfono *</label>
    <input type='text' class='form-control' id='tf' name='tf'  value='".$row2[12]."' ><br/>";
	$opcion.="<label >Descripción</label> <textarea name='act' id='act' class='form-control' rows='3'>".$row2[5]."</textarea>
   <br/>"; /*
   $opcion.="<label >Misión</label> <textarea name='mt' id='mt' class='form-control' rows='3'>".$row2[4]."</textarea>
   <br/>";
    $opcion.="<label >Visión</label> <textarea name='vt' id='vt' class='form-control' rows='3'>".$row2[3]."</textarea>
   <br/><input type='hidden' name='ps' id='ps' value='' ><input type='hidden' name='idmp' id='idmp' value='".$row2[0]."' ><input type='hidden' name='rfa' id='rfa' value='".$row2[10]."' ><br/><br/><button type='submit' class='btn btn-default'>Modificar Datos</button> "; */
   $opcion.="
   <br/><input type='hidden' name='ps' id='ps' value='' ><input type='hidden' name='idmp' id='idmp' value='".$row2[0]."' ><input type='hidden' name='rfa' id='rfa' value='".$row2[10]."' ><br/><br/><button type='submit' class='btn btn-default'>Modificar Datos</button> ";
			
		}
		
	}
}
	
return $opcion;	
	}
//fin de duncion de datos empresa
//funcion update empresa
function UpdatE($nrz,$rz,$rf,$tf,$act,$mt,$vt,$idmp,$ps,$rfa){
$fech=date("Y-m-d H:i:s");
$miconexion = new DB_my() ;
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="UPDATE empresa  SET nombre='".$nrz."', razon='".$rz."', mision='' ,telefono='".$tf."', vision='', descripcion='".$act."', RFC_e='".$rf."', fecha_modi='".$fech."', id_pe_mod='".$ps."'  WHERE id_empresa='".$idmp."' ;";
$miconexion->consulta($SQL);	
$miconexion2= new DB_my() ;
$miconexion2->conectar($bd, $host, $user, $pass);
$dql2="UPDATE user SET Rfc_emp='".$rf."' WHERE Rfc_emp='".$rfa."' ;";
$miconexion2->consulta($dql2);
$opcion.="Los datos se modificaron de manera correcta";
	return $opcion;	
	
	}
//fin de update empresa

//ver emp
function vermp($pss){
	
	$opcion="";
$miconexion= new DB_my ();
$miconexion->conectar($bd, $host, $user, $pass);
$SQL="SELECT * FROM user WHERE id_user='".$pss."' and tipou='2' or tipou='3'";
$miconexion->consulta($SQL);
$vr=$miconexion->numregistros();
if($vr > 0){
	while ($row = mysql_fetch_row($miconexion->Consulta_ID)) {
		$rfg=$row[11];
$miconexion2= new DB_my ();
$miconexion2->conectar($bd, $host, $user, $pass);
$SQL2a="SELECT * FROM empresa WHERE RFC_e='".$rfg."'";
$miconexion2->consulta($SQL2a);
$vr2=$miconexion2->numregistros();
		while ($row2= mysql_fetch_row($miconexion2->Consulta_ID)) {
			$opcion.=$row2[0];
			
		}
		
	}
}
	
return $opcion;	
	
	}
//fin de ver emp

	
	}
?>