<?php  //localhost
include($_SERVER['DOCUMENT_ROOT']."/hackaton/clases/usua.php");
$correo=$_POST['corr'];
$passw=$_POST['passw'];
$Objtuser= new user();

if($correo!="" || $pass!=""){
$opc=$Objtuser->conectando($correo,$passw);	


	if($opc=='SI'){
		$usrt=$Objtuser->Usuariop($correo,$passw);
		
	//echo $opc;	
	 header('Location: sistema/evaluador.php?usrt='.$usrt);	
		}

	}else{
 header('Location: index.html');
exit;
		}

?>

