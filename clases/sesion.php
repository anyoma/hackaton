<?php
include('usua.php');
$objc=new user();
$em1=$_POST['em1'];
$pass=$_POST['pass'];
$em2=md5($pass)


?>
<?php 
if($em1!="" and $em2!="") {
echo $objc->Iniciar($em1,$em2); 
}else{
	echo "No cuenta con conexion a una red";
	}
?>
