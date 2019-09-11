<?php

$conn = mysql_connect('localhost', 'odosis', 'maf/2826');
mysql_select_db('ntiimplantes_db', $conn);

$a = $_GET;

$sql_existe = "select count(dni) as existe from cliente where dni = ",$a['dni'];
$rs = mysql_query($sql_existe);
$rs_existe = mysql_fetch_array($rs);

$campos = array();
if ($rs_existe['existe'] > 0) {
	$dni = $a['dni'];
	unset($a['dni']);
	foreach($a as $k => $v) {
		$campos[] = $k." = '".$v."'";
	}
  $sql = 'update cliente set '.implode(', ', $campos).' where dni = '.$dni;
} else {
  $campos = implode(', ', array_keys($a));
  $valores = implode('\', \'', $a);
  $sql = 'insert into cliente('.$campos.') values(\''.$valores.'\');';
}

$rs = mysql_query($sql);

if ($rs) {
  echo true;
} else {
  echo false;
}

?>