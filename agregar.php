<?php  //localhost
include($_SERVER['DOCUMENT_ROOT']."/hackaton/clases/usua.php");
$correo=$_POST['corr'];
$passw=$_POST['passw'];
$name=$_POST['nam'];
$ape=$_POST['ape'];
$telef=$_POST['telef'];
$nameproyecto=$_POST['nameproyecto'];
$cat=$_POST['cat'];
$descrp=$_POST['descrp'];
$idea=$_POST['idea'];
$link=$_POST['link'];
$pdf=$_FILES['pdf'];
$catego=$_POST['catego'];
$Objtuser=new user();
$opc=$Objtuser->Agregando($correo,$passw,$name,$telef,$ape,$nameproyecto,$cat,$descrp,$idea,$link,$pdf,$catego);	
$user=$Objtuser->SelectMaxu();
 header('Location: sistema/evaluador.php?usrt='.$user);	
?>

