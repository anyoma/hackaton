<?php
include('usua.php');
$objc=new user();
$emr=$_POST['em1'];
$pass=$_POST['pass'];
$idi=$_POST['idi'];
$em2=md5($pass);
$emr1=substr($emr,3);
$em1=str_replace('%40','@',$emr1);


?>
<?php 
if($em1!="" and $em2!="") {
echo $objc->Iniciar2($em1,$em2,$idi); 
}else{
	echo "No cuenta con conexion a una red";
	}
?>
