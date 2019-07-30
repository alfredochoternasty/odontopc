<?php

include "barcode.class.php";
$nro = $_GET['nro'];
$bc = new BarcodeI25();
$bc->tipoRetorno = 1;
$bc->SetCode($nro);
$bc->Generate();

?>