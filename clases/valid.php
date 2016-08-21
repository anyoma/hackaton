<?php
include('usua.php');
$objc=new user();
$em=$_POST['em'];
$idi=$_POST['idi'];



?>
<?php 
if( $em!="" and  $idi!=""){
echo $objc->reestablecerp($em,$idi); 
}else{
	echo "No cuenta con conexion a una red";
	}
?>
