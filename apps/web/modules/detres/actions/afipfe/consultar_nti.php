<?php
include('wsaa.class.php');
include('wsfev1.class.php');

$wsaa = new WSAA(); 
$dt_expira = new DateTime($wsaa->get_expiration());
$dt_actual = new DateTime(date("Y-m-d h:m:i"));
if($dt_expira < $dt_actual) {
	if (!$wsaa->generar_TA()) {
		die('<br>'.$wsaa->error.'<br>');
	}
}

$cid = '';
if(!empty($_GET['cid'])){
  $cid = addslashes($_GET['cid']);
  settype($cid, "integer");
}


if(!empty($cid)){
	mysql_connect('localhost', 'root', '');
	mysql_select_db('ventas');

  $sql = "
    select 
      1 as id,
      '4000' as pto_venta, 
      6 as cbte_tipo,
      '20180911' cbte_fch, 
			1 as concepto, 
      80 as doc_tipo, 
      replace(c.cuit, '-', '') as doc_nro, 
      'PES' as mon_id, 
      1 as mon_cotiz, 
      sum(total) as importetotal, 
      0 as importeex, 
      0 as netonogravado, 
      sum(sub_total) as netogravado, 
      21 as tasaiva, 
      sum(iva) as importeiva,
			0 as tasatrib, 
			0 as importetrib
    from 
      resumen r
				join detalle_resumen dr on r.id = dr.resumen_id
				join cliente c on r.cliente_id = c.id
    where 
      r.id = $cid
		";
	$rs = mysql_query($sql);
  
	$regfe['ImpTotal'] = 0;
	$regfe['ImpOpEx'] = 0;
	$regfe['ImpIVA'] = 0;
	$regfe['ImpTrib'] = 0;
	$regfe['ImpTotConc'] = 0;
	$regfe['ImpNeto'] = 0;
	$regfeasoc = '';//Detalle de otros comprobantes relacionados con el comprobante (solo notas de crédito y débito)
	$regfetrib = '';//Detalle de tributos relacionados con el comprobante
	$regfeiva = '';//Detalle de alícuotas relacionadas con el comprobante

	$cid2 = $cid-1;
	$wsfev1 = new WSFEV1();
	
	while($ar = mysql_fetch_array($rs)) {
		$nro = $wsfev1->FECompUltimoAutorizado($ar['pto_venta'], $ar['cbte_tipo']);  
		
		$nuevo_nro = $nro+1;
		$ptovta = $ar['pto_venta'];
		
		$regfe['ImpTotal'] += $ar['importetotal'];
		$regfe['ImpOpEx'] += $ar['importeex'];
		$regfe['ImpIVA'] += $ar['importeiva'];
		$regfe['ImpTrib'] += $ar['importetrib'];
		$regfe['ImpTotConc'] += $ar['netonogravado'];
		$regfe['ImpNeto'] += $ar['netogravado'];
		
		unset($ar['pto_venta'], $ar['id'], $ar['ImporteTotal'], $ar['ImporteEx'], $regfe['TasaIVA'], $regfe['TasaTrib'], $regfe['ImporteTrib'], $regfe['NetoNoGravado'], $regfe['NetoGravado']);
		foreach($ar as $k => $v){
		  $clave = str_replace(' ', '', ucwords(str_replace('_', ' ', $k)));
		  //if($clave == 'CbteFch') $v = str_replace('-', '', $v);
		  if($clave == 'CbteFch') $v = date('Ymd');
		  $regfe[$clave] = $v;
		}
		
		if($ar['importeiva'] > 0){
			$regfeiva[] = array('Id' => 5, 'BaseImp' => $ar['netogravado'], 'Importe' => $ar['importeiva']);
		}
		if($ar['importetrib'] > 0){
			$regfetrib[] = array('Id' => 99, 'Desc' => 'algo', 'BaseImp' => $ar['netogravado'], 'Alic' => $ar['tasatrib'], 'Importe' => $ar['importetrib']);
		}
		
		
		$res = $wsfev1->FECAESolicitar($nuevo_nro, $ptovta, $regfe, $regfeasoc, $regfetrib, $regfeiva);
		if (is_soap_fault($res)) {
			$msj = str_replace('\'', '\'\'', 'SOAP Fault: (faultcode: '.$res->faultcode.', faultstring: '.$res->faultstring.')');
			$sql = 'update resumen set afip_estado = 0, afip_mensaje = \''.$msj.'\' where cod = '.$cid;
				mysql_connect('localhost', 'root', '');
	mysql_select_db('ventas');
			mysql_query($sql);
		} else {
			if(empty($res) || $res == false || $res['cae'] <= 0) {
				for ($i=0;$i < count($wsfev1->Code);$i++) {
					$a_msj[] = $wsfev1->Code[$i].' - '.$wsfev1->Msg[$i];
				}
				$msj = str_replace('\'', '\'\'', implode('//', $a_msj));
				$sql = 'update resumen set afip_estado = 0, afip_mensaje = \''.$msj.'\' where cod = '.$cid;
					mysql_connect('localhost', 'root', '');
	mysql_select_db('ventas');
				mysql_query($sql);
			} else {
			  if($res['cae'] <= 0 || $res['cae'] == '' || $res['cae'] == false){
				$sql = 'update resumen set afip_estado = 0, afip_mensaje = \'CAE no obtenido\' where cod = '.$cid;
					mysql_connect('localhost', 'root', '');
	mysql_select_db('ventas');
				mysql_query($sql);
			  } else {
				$sql = 'update resumen set afip_estado = 1, afip_mensaje = \''.$res['cae'].'\', afip_nro_comp = '.$nro.' where cod = '.$cid;
					mysql_connect('localhost', 'root', '');
	mysql_select_db('ventas');
				mysql_query($sql);
			  }
			}
		}
	}
	
	//header('refresh:5;url=consultar_nti.php?cid='.$cid2);
}

?>