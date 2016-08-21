<?php
include('../carrer.php');
$objc=new carreras();
$idi='1';
$opciones=$objc->ListaC($idi);
?>
<?php echo  $opciones;?>
