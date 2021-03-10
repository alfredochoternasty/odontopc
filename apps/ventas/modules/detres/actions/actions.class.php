<?php

require_once dirname(__FILE__).'/../lib/detresGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detresGeneratorHelper.class.php';
require_once dirname(__FILE__).'/afipfe/wsaa.class.php';
require_once dirname(__FILE__).'/afipfe/wsfev1.class.php';

/**
 * detres actions.
 *
 * @package    odontopc
 * @subpackage detres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
 
class detresActions extends autoDetresActions
{

  public function executeBatch(sfWebRequest $request){
    $request->checkCSRFProtection();
    if (!$ids = $request->getParameter('ids')){
      $this->getUser()->setFlash('error', 'You must at least select one item.');
      $this->redirect('@detalle_resumen');
    }

    if (!$action = $request->getParameter('batch_action')){
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');
      $this->redirect('@detalle_resumen');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action))){
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action))){
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }
    
    $this->$method($request);
    $this->redirect('@detalle_resumen');
  }
    
  public function executeActprecio(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    $rid = $request->getParameter('rid');
    if(empty($rid)){
      $rid = $this->getUser()->getAttribute('rid');
    }
    $resumen = Doctrine::getTable('Resumen')->find($rid);
		
		/*
		if (!empty($resumen->det_remito_id)) {
			$remito = Doctrine::getTable('Resumen')->find($resumen->remito_id);
			$det = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($resumen->remito_id, $pid);
			if (!empty($det[0])) {
				$precio = $det[0]->precio;
				$moneda = $det[0]->moneda_id;
			} else { 
				$precio = 0;
				$moneda = 0;
			}
		}
		*/
    $lis = $resumen->getCliente()->getListaPrecio();
    $prec_prod = Doctrine::getTable('Producto')->find($pid)->getPrecioFinal($lis);
		list($precio, $moneda) = explode('##', $prec_prod);
    return $this->renderText(json_encode(sprintf("%01.2f", $precio).'=='.$moneda));
  }
  
  public function executeLote(sfWebRequest $request){
    $prod = null;
    $prod = $request->getParameter('pid');
    if(!empty($prod)){
      $q = Doctrine_Query::create()
          ->from('lote l')
          ->where('l.producto_id = ?', $prod)
          ->andWhere("l.nro_lote not like 'er%'")
          ->andWhere('l.stock > 0')
          ->andWhere("l.fecha_vto > '".date('Y-m-d')."' or l.fecha_vto is null")
          ->orderBy('fecha_vto desc, l.id asc');
      $lotes = $q->execute();
      $nro_lote = '#';
      foreach($lotes as $lote){
        $nro_lote = $lote->getNroLote().' == '.$lote->getStock();
      }
    }else{
      $nro_lote = '#';
    }
    return $this->renderText(json_encode($nro_lote));
  }  
  
  public function executeNew(sfWebRequest $request){
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->getUser()->setAttribute('rid', $rid);
    }else{
      $rid = $this->getUser()->getAttribute('rid');
    }
	
    $detres = new DetalleResumen();
    $detres->setResumenId($rid);
		if ($detres->getResumen()->afip_estado > 0) {
			$this->getUser()->setFlash('error', 'Esta venta ya fue enviada a la AFIP y no se puede modificar');
			$this->redirect( 'detres/index?rid='.$rid);
		} else {
			$this->getUser()->setAttribute('tipofactura', $detres->getResumen()->tipofactura_id);
			$this->form = new DetalleResumenForm($detres);
			$this->detalle_resumen = $this->form->getObject();  
			$this->pager2 = Doctrine::getTable('DetalleResumen')->findByResumenId($rid);
		}
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->getUser()->setAttribute('rid', $rid);
    }else{
      $rid = $this->getUser()->getAttribute('rid');
    }
    $this->setFilters(array("resumen_id" => $rid));
		//$factura = Doctrine::getTable('Resumen')->find($rid);
		//if ($factura->afip_estado > 1) $this->getUser()->setFlash('notice', str_replace('<br>', '', $factura->afip_mensaje)); 
    parent::executeIndex($request);
  }

  public function executeDelete(sfWebRequest $request){
    $request->checkCSRFProtection();
		$detalle_resumen = $this->getRoute()->getObject();
		$tipofactura = $detalle_resumen->getResumen()->tipofactura_id;
		if (!empty($detalle_resumen->det_remito_id)) {
			$det_remito_id = $detalle_resumen->det_remito_id;
			$detalle_remito = Doctrine::getTable('DetalleResumen')->find($det_remito_id);
			$detalle_remito->cant_vend_remito -= $detalle_resumen->cantidad;
			$detalle_remito->save();
			if ($detalle_resumen->getResumen()->getCliente()->zona_id > 1) {
				$this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.delete', array('object' => $this->getRoute()->getObject())));
			}
		} elseif ($tipofactura != 5 && $tipofactura != 7) {
			$this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.delete', array('object' => $this->getRoute()->getObject())));
		}
    $rid = $this->getRoute()->getObject()->getResumenId();
    $this->getRoute()->getObject()->delete();
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    $this->redirect('detres/index?rid='.$rid);
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
			$detalle_resumen = $form->save();

			$lista_id = $detalle_resumen->getProducto()->getListaId();
			$moneda_id = $detalle_resumen->getProducto()->getLista()->getMonedaId();
			if (empty($lista_id)) {
				$lista_id = $detalle_resumen->getResumen()->getCliente()->getListaId();
				$moneda_id = $detalle_resumen->getResumen()->getCliente()->getLista()->getMonedaId();
			}
			$detalle_resumen->setListaId($lista_id);
			$detalle_resumen->setMonedaId($moneda_id);
			
			//esto es para notas de debito
			$tipofactura = $detalle_resumen->getResumen()->tipofactura_id;
			if ($tipofactura == 5 || $tipofactura == 7) {
				$detalle_resumen->setSubTotal($detalle_resumen->precio);
				$detalle_resumen->setTotal($detalle_resumen->precio);
			}
			
			// para ventas con tarj de credito
			$recargo = $detalle_resumen->getResumen()->getTipoVenta()->porc_recargo/100?:0;
			$detalle_resumen->precio += $detalle_resumen->precio * $recargo;
			$detalle_resumen->sub_total += $detalle_resumen->sub_total * $recargo;
			$detalle_resumen->iva += $detalle_resumen->iva * $recargo;
			$detalle_resumen->total += $detalle_resumen->total * $recargo;
			
			$detalle_resumen->save();
			
      // si se vende de un remito sumar esa cantidad para el stock del remito
			if (!empty($detalle_resumen->det_remito_id)) {
				$det_remito_id = $detalle_resumen->det_remito_id;
				$detalle_remito = Doctrine::getTable('DetalleResumen')->find($det_remito_id);
				$detalle_remito->cant_vend_remito += $detalle_resumen->cantidad;
				$detalle_remito->save();
        
        // si la venta es de una zona distinta a la casa central, descontar stock, si no ya se desconto cuando se hizo el remito
				if ($detalle_resumen->getResumen()->getCliente()->zona_id != 1) {
					$this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
        }
			} elseif ($tipofactura != 5 && $tipofactura != 7) {
				$this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
			}
			
      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('detres/new?rid='.$detalle_resumen->getResumenId());
      } else {
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('detres/index?rid='.$detalle_resumen->getResumenId());
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $rid = $this->getUser()->getAttribute('rid', 1);
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    $dompdf = new DOMPDF();
		$modelo_impresion = $resumen->getTipoFactura()->modelo_impresion;
    $dompdf->load_html($this->getPartial($modelo_impresion, array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream($resumen.".pdf");
		$this->forward('resumen', 'index');
    return sfView::NONE;
  }
  
  public function executeGet_lotes_producto(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    $rid = $request->getParameter('rid');
    if(empty($rid)){
      $rid = $this->getUser()->getAttribute('rid');
    }
		$resumen = Doctrine::getTable('Resumen')->find($rid);
		$zona = $resumen->getCliente()->getZonaId();
		
    $q = Doctrine_Query::create();    
		$q->select('l.nro_lote, l.fecha_vto, l.stock');
    $q->from('Lote l');
    $q->where('l.producto_id = '.$pid);
		$q->andWhere("l.zona_id = $zona");
    $q->andWhere("l.fecha_vto > curdate() or l.fecha_vto is null");
		$q->andWhere('l.stock > 0');
		$q->andWhere('l.activo = 1');
		$q->andWhere('l.externo = 0');
    $q->orderBy('l.fecha_vto ASC, l.id ASC');
    $lotes_stock = $q->fetchArray();
	
		if ($zona == 1 && $resumen->tipofactura_id != 4) {
			$q = Doctrine_Query::create();
			// $q->select('dr.nro_lote, (dr.cantidad - sum(coalesce(dr2.cantidad, 0))+sum(coalesce(dr2.bonificados, 0))) vend_remito');
			$q->select('dr.nro_lote, sum(dr.cantidad - dr.cant_vend_remito) vend_remito');
			$q->from('DetalleResumen dr');
			$q->leftJoin("dr.Resumen r");
			$q->leftJoin("dr.DetalleRemito dr2");
			$q->where('dr.producto_id = '.$pid);
			$q->andWhere("r.tipofactura_id = 4");
			$q->groupBy("dr.nro_lote");
			$lotes_remito = $q->fetchArray();
			$lotes = array_merge($lotes_stock, $lotes_remito);
		} else {
			$lotes = $lotes_stock;
		}
  
    $options[] = '<option value=""></option>';
    foreach($lotes as $lote){
			if (!empty($lote['fecha_vto'])) {
				$fec_vto = ' - Vto: '.implode('/', array_reverse(explode('-', $lote['fecha_vto'])));
			} else {
				$fec_vto = '';
			}
			
			if (!empty($lote['stock'])) {
				$stock = ' - Stock: '.$lote['stock'];
			} elseif (!empty($lote['vend_remito']) || !empty($lote['d__0'])) {
				$stock = ' - Disponibles en Remito: '.$lote['vend_remito'];
			} else {
				$stock = '';
			}
			if (!empty($stock)) $options[] = '<option value="'.$lote['nro_lote'].'">'.$lote['nro_lote'].$fec_vto.$stock.'</option>';
    }
		
    echo implode($options);
    return sfView::NONE;
  }  
  
  public function executeGet_prod_remito(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    $lid = $request->getParameter('lid');
	  
		$u_id = $this->getUser()->getGuardUser()->getId();
		$uz = Doctrine_Core::getTable('UsuarioZona')->findByUsuario($u_id);		

		$q = Doctrine_Query::create();
		$q->from('DetalleResumen dr');
		$q->leftJoin("dr.Resumen r");
		$q->leftJoin("r.Cliente c");
		$q->leftJoin("c.Zona z");
		$q->where('dr.producto_id = '.$pid);
		$q->andWhere("dr.nro_lote = '$lid'");
		$q->andWhere("r.tipofactura_id = 4");
		$q->orderBy('r.fecha desc');
		
		if ($uz[0]->zona_id != 1) {
			$zona = Doctrine_Core::getTable('Zona')->find($uz[0]->zona_id);
			$q->andWhere('r.cliente_id = '.$zona->cliente_id);
			$q->leftJoin('r.Compra');
			$q->andWhere("r.Compra.remito_id is not null");
		} else {
			$options[] = '<option value=""></option>';
		}
    $remitos = $q->execute();
  
    foreach($remitos as $remito){
			if ($remito->RemitoProductoCantVend() < $remito->cantidad) {
				$fecha = $remito->getResumen()->getFechaDMY();
				$options[] = '<option value="'.$remito->id.'">'.$remito->getResumen()->getCliente().'- Fecha: '.$fecha.' - Nro: '.$remito->getResumen()->nro_factura.'</option>';
			}
    }
	//echo $q->getSQLQuery();
    echo implode($options);
    return sfView::NONE;
  }

  public function executeGet_stock_remito(sfWebRequest $request){
    $det_remito_id = $request->getParameter('drid');
		$detalle_remito = Doctrine_Core::getTable('DetalleResumen')->find($det_remito_id);
		$vendidos = $detalle_remito->RemitoProductoCantVend();
		$devueltos = $detalle_remito->RemitoProductoCantDev();
		$stock = $detalle_remito->cantidad - ($vendidos - $devueltos);
    $options[] = '<option value="1">1</option>';
    for($i = 2; $i <= $stock; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_cantidad_lote(sfWebRequest $request){
    $lid = $request->getParameter('lid');
    $rid = $request->getParameter('rid');
    if(empty($rid)){
      $rid = $this->getUser()->getAttribute('rid');
    }
		
		$resumen = Doctrine::getTable('Resumen')->find($rid);
		$zona = $resumen->getCliente()->getZonaId();
		
		$q = Doctrine_Query::create()
			->select('l.stock')
			->from('Lote l')
			->where('l.nro_lote = \''.$request->getparameter('lid').'\'')
			->andWhere('l.zona_id = '.$zona)
			->andWhere('l.producto_id = \''.$request->getparameter('pid').'\'')
			->andWhere('l.stock > 0 ')
			->andWhere("l.nro_lote not like 'er%'")
			->andWhere("l.fecha_vto > '".date('Y-m-d')."' or l.fecha_vto is null");
		$lotes = $q->fetchArray();  
		$cantidad = $lotes[0]['stock'];
		
    $options[] = '<option value="1">1</option>';
    for($i = 2; $i <= $cantidad; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeListRemito(sfWebRequest $request){
    $rid = $this->getUser()->getAttribute('rid', 1);
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("remito", array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("remito.pdf");    
    return sfView::NONE;
  }  
  
  public function executeCae(sfWebRequest $request){
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->getUser()->setAttribute('rid', $rid);
    }else{
      $rid = $this->getUser()->getAttribute('rid');
    }
		
		$resumen = Doctrine::getTable('Resumen')->find($rid);
		
		$modulo_factura = $this->getUser()->getVarConfig('modulo_factura');
		if ($modulo_factura == 'S') {
			$wsaa = new WSAA(dirname(__FILE__)); 
			$dt_expira = new DateTime($wsaa->get_expiration());
			$dt_actual = new DateTime(date("Y-m-d h:m:i"));
			//if($dt_expira < $dt_actual) {
				if (!$wsaa->generar_TA()) {
					die('<br>'.$wsaa->error.'<br>');
				}
			//}
			
			$ptovta = '0005';
			
			$regfe['ImpTotal'] = $resumen->getTotalResumen();
			$regfe['ImpOpEx'] = 0;
			$regfe['ImpIVA'] = $resumen->getIVATotalResumen();
			$regfe['ImpTrib'] = 0;
			$regfe['ImpTotConc'] = 0;
			$regfe['ImpNeto'] = $resumen->getSubTotalResumen();
			$regfeasoc = '';
			$regfetrib = '';
			$regfeiva[] = array(
				'Id' => 5, 
				'BaseImp' => $resumen->getSubTotalResumen(), 
				'Importe' => $resumen->getIVATotalResumen()
			);
			
			$regfe['CbteTipo'] = $resumen->getTipoFactura()->getCodTipoAfip();
			$regfe['Concepto'] = 1;
			$regfe['DocTipo'] = $resumen->getCliente()->getCondfiscal()->cod_tipo_afip;
			if ($regfe['DocTipo'] == '96') {
				$regfe['DocNro'] = $resumen->getCliente()->dni;
			} else {
				$regfe['DocNro'] = $resumen->getCuitCliente();
			}
			$regfe['CbteFch'] = date('Ymd'); //$resumen->getFechaYMD();
			$regfe['MonId'] = 'PES';
			$regfe['MonCotiz'] = 1;			
			
			$wsfev1 = new WSFEV1(dirname(__FILE__));
			
			// me fijo si vamos bien con los numeros de facturas
			$ultimo_nro_afip = $wsfev1->FECompUltimoAutorizado($ptovta, $regfe['CbteTipo']);
			$q = Doctrine_Query::create()
			->select('max(nro_factura) as ultimo')
			->from('Resumen')
			->where('tipofactura_id = '.$resumen->tipofactura_id)
			->andWhere("pto_vta = '".$ptovta."'")
			->andWhere('afip_estado >= 1')
			->andWhere('nro_factura is not null');
			$ultimo_nro_sistema = $q->fetchArray();
			if ($ultimo_nro_sistema[0]['ultimo'] != $ultimo_nro_afip) {
				$this->getUser()->setFlash('error', 'El último número de factura registrado en la afip (nro: '.$ultimo_nro_afip.') no coincide con el último número registrado en el sistema (nro: '.$ultimo_nro_sistema[0]['ultimo'].')');
				$this->redirect('detres/index?rid='.$this->getRequestParameter('rid'));
			}
			$nuevo_nro = $ultimo_nro_afip+1;
			
			// esto xq aveces manda 2 veces el comprobante a la afip
			$resumen2 = Doctrine::getTable('Resumen')->find($rid);
			if (empty($resumen2->afip_estado) && empty($resumen2->afip_cae)) {
				$res = $wsfev1->FECAESolicitar($nuevo_nro, $ptovta, $regfe, $regfeasoc, $regfetrib, $regfeiva);
				$tipo_msj = 'error';
				$afip_estado = 0;
				$msj = '';
				$msj2 = '';
				if (is_soap_fault($res)) {
					$msj2 = str_replace('\'', '\'\'', 'SOAP Fault: (faultcode: '.$res->faultcode.', faultstring: '.$res->faultstring.')');
				} else {
					if (empty($res) || $res == false || $res['resultado'] == 'R') {
						for ($i=0;$i < count($wsfev1->Code);$i++) {
							$a_msj[] = $wsfev1->Code[$i].' - '.$wsfev1->Msg[$i];
						}
						$msj2 = str_replace('\'', '\'\'', implode('//', $a_msj));
					} elseif ($res['resultado'] == 'A') {
						$afip_estado = 1;
						$resumen->setFecha(date("Y-m-d"));
						$resumen->setAfipCae($res['cae']);
						$resumen->setNroFactura($nuevo_nro);
						$resumen->setPtoVta($ptovta);
						$resumen->setAfipVtoCae($res['fec_vto']);
						
						$msj = 'La venta fue informada correctamen a la AFIP, CAE: '.$res['cae'];
						$tipo_msj = 'notice';
						
						for ($i=0;$i < count($wsfev1->Code);$i++) {
							$a_msj[] = $wsfev1->Code[$i].' - '.$wsfev1->Msg[$i];
						}
						if (!empty($a_msj)) {
							$afip_estado = 2;
							$msj2 = '. Se encontraron los siguientes mensajes: '.str_replace('\'', '\'\'', implode('//', $a_msj));
						}
					}
				}
			}
			
			$msj .= $msj2;
			$resumen->setAfipEstado($afip_estado);
			$resumen->setAfipMensaje($msj2);
			$resumen->setAfipEnvio($wsfev1->client->__getLastRequest());
			$resumen->setAfipRespuesta($wsfev1->client->__getLastResponse());
		} else {
			$resumen->setAfipEstado(1);
		}
		
		$esta_cargado = count(Doctrine::getTable('CobroResumen')->findByResumenId($resumen->getId()));
		if ($esta_cargado == 0) {
			$saldo_cliente = $resumen->getCliente()->getSaldoCtaCte(1, null, false) - $resumen->getTotalResumen();
			if ($saldo_cliente <= 0) { // si tiene saldo a favor
				$saldo_resumen = $resumen->getTotalResumen() - $resumen->getTotalCobrado() + $resumen->getTotalDevuelto();
				$objCobro = new CobroResumen();
				$objCobro->setResumenId($resumen->getId());			
				if (abs($saldo_cliente-10) >= $saldo_resumen) {//tolerancia de 10 pesos
					$objCobro->setMonto($resumen->getTotalResumen());
					$resumen->setPagado(1);
					$resumen->setFechaPagado(date('Y-m-d'));
				} else {
					$objCobro->setMonto(abs($saldo_cliente));
				}
				$objCobro->save();
			}
		}
		
		$resumen->save();
		
		$this->getUser()->setFlash($tipo_msj, $msj);
		$this->redirect('detres/index?rid='.$this->getRequestParameter('rid'));
  }  
}