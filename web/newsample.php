<?php

include "barcode.class.php";

$bc = new BarcodeI25();
$bc->tipoRetorno = 1;
$bc->SetCode("307122724610010000368521160964632201901050");
$bc->Generate();

?>