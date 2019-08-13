<?php

require_once dirname(__FILE__).'/../lib/devprodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/devprodGeneratorHelper.class.php';
require_once dirname(__FILE__).'../../../detres/actions/afipfe/wsaa.class.php';
require_once dirname(__FILE__).'../../../detres/actions/afipfe/wsfev1.class.php';

/**
 * devprod actions.
 *
 * @package    odontopc
 * @subpackage devprod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class devprodActions extends autoDevprodActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
		$cliente_id = $this->getUser()->getAttribute('cliente_id');
		if (!empty($cliente_id)) $this->form->setDefault('cliente_id', $cliente_id);
    $this->dev_producto = $this->form->getObject();
  }	
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $dev_producto = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'detalle_compra.save', array('object' => $dev_producto)));
      $cobro = new Cobro();
      $cobro->setFecha(date('Y-m-d'));
      $cobro->setClienteId($dev_producto->getClienteId());
      $cobro->setResumenId($dev_producto->getResumenId());			
			$detalle_resumen = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($dev_producto->getResumenId(), $dev_producto->getProductoId());			
      $cobro->setMonedaId($detalle_resumen[0]->getMonedaId());
      $cobro->setMonto($dev_producto->getTotal());
      $cobro->setTipoId(5);
      $cobro->setDevprodId($dev_producto->getId());
      $cobro->save();
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->getUser()->setAttribute('cliente_id', $dev_producto->getClienteId());
        $this->redirect('@dev_producto_new');
      }else{
				$this->getUser()->setAttribute('cliente_id', 0);
        if ($request->hasParameter('rtn')){
          return $dev_producto->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          $this->redirect('@dev_producto');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    
    $objid = $request->getParameter('id');
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    $cobro = Doctrine::getTable('Cobro')->findByDevprodId($objid);
    $this->getRoute()->getObject()->delete();
    $cobro->delete();
    $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $this->getRoute()->getObject())));

    $this->redirect('@dev_producto');
  }
  
  public function executeBuscarprecio(sfWebRequest $request){
    $producto = $request->getParameter('pid');
    $resumen = $request->getParameter('rid');
    if(empty($rid)){
      $rid = $this->getUser()->getAttribute('rid');
    }
    $prec_prod = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($resumen, $producto);
    $datos['precio'] = sprintf("%01.2f", $prec_prod[0]->getPrecio());
    $datos['iva'] = sprintf("%01.2f", $prec_prod[0]->getIva()/$prec_prod[0]->getCantidad());
    $datos['cant'] = sprintf("%01.2f", $prec_prod[0]->getCantidad());
		$total = $datos['iva'] + $datos['precio'];
    $datos['total'] = sprintf("%01.2f", $total);
    return $this->renderText(json_encode($datos));
  }
  
  public function executeGet_vtas_cliente(sfWebRequest $request){
  
    $q = Doctrine_Query::create()
      ->select('res.id, t.nombre, res.pto_vta, res.nro_factura, res.fecha, dr.nro_lote')
      ->from('Resumen res')
      ->leftJoin('res.Detalle dr')
      ->leftJoin('res.TipoFactura t')
      ->where('res.cliente_id = '.$request->getparameter('cid'))
      ->andWhere('dr.producto_id = '.$request->getparameter('pid'))
      ->orderBy('res.fecha desc');
     
    $vtas = $q->fetchArray();  
  
    $options[] = '<option value=""></option>';	
    foreach ($vtas as $vta) {
      $options[] = '<option value="'.$vta['id'].'">'.$vta['TipoFactura']['nombre'].'-'.$vta['pto_vta'].'-'.str_pad($vta['nro_factura'], 8, 0,STR_PAD_LEFT).' - Fecha: '.implode('/', array_reverse(explode('-', $vta['fecha']))).' - Nro_lote:'.$vta['Detalle'][0]['nro_lote'].'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_prod_vta(sfWebRequest $request){
    $vtas = Doctrine::getTable('DetalleResumen')->findByResumenId($request->getparameter('rid'));
    $options[] = '<option value=""></option>';
    foreach($vtas as $vta){
      $options[] = '<option value="'.$vta->getProductoId().'">'.$vta->getProducto().'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_vta_lotes(sfWebRequest $request){
    $lotes = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($request->getparameter('rid'), $request->getparameter('pid'));  
    $cantidad = $lotes[0]['cantidad'];
    $options[] = '<option value="1" selected >1</option>';
    for($i = 2; $i <= $cantidad; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_lote(sfWebRequest $request){
    $prods = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($request->getparameter('rid'), $request->getparameter('pid'));  
    echo $prods[0]['nro_lote'];
    return sfView::NONE;
  }
	
  public function executeListImprimir(sfWebRequest $request){
    $rid = $request->getParameter('id');
    $dev_producto = Doctrine::getTable('DevProducto')->find($rid);
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("dev_producto" => $dev_producto)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream($dev_producto.".pdf");    
		$this->forward('dev_producto', 'index');
    return sfView::NONE;
  }  
	
	public function executeListListado(sfWebRequest $request){
    $filtro = new DevProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
		$pagina = $this->getUser()->getAttribute('traza.page', '1', 'admin_module')-1;
		$consulta->limit(30)->offset($pagina * 30);		
    $listado = $consulta->execute();
	
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("listado", array("dev_productos" => $listado)));
    $dompdf->set_paper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("productos_devueltos.pdf");    
		$this->forward('dev_producto', 'index');
    return sfView::NONE;
  }
	
  public function executeListMail(sfWebRequest $request){
    $dev_producto = Doctrine::getTable('DevProducto')->find($this->getRequestParameter('id'));
    
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI Implantes'));
    $mensaje->setTo($dev_producto->getCliente()->getEmail());
    $mensaje->setSubject('Nota de Credito - NTI Implantes');

    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("devprod/imprimir", array("dev_producto" => $dev_producto)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
	
		$factura = $dompdf->output();
		$adjunto = new Swift_Attachment($factura, $dev_producto->getFactura().'.pdf', 'application/pdf');
		$mensaje->attach($adjunto);
    $this->getMailer()->send($mensaje);
    
    $this->getUser()->setFlash('notice', 'El mail se enviado correctamente a la direccion '.$dev_producto->getCliente()->getEmail());
    $this->redirect('dev_producto');    
  }

	public function executeListFactura(sfWebRequest $request){
    if($request->hasParameter('id')){
      $did = $request->getParameter('id');
      $this->getUser()->setAttribute('did', $did);
    }else{
      $did = $this->getUser()->getAttribute('did');
    }

		if (!empty($did)) {
			$wsaa = new WSAA(dirname(__FILE__).'/../../detres/actions'); 
			$dt_expira = new DateTime($wsaa->get_expiration());
			$dt_actual = new DateTime(date("Y-m-d h:m:i"));
			if($dt_expira < $dt_actual) {
				if (!$wsaa->generar_TA()) {
					die('<br>'.$wsaa->error.'<br>');
				}
			}
			
			$dev = Doctrine::getTable('DevProducto')->find($did);
			$rid = $dev->getResumenId();
			$resumen = Doctrine::getTable('Resumen')->find($rid);
			
			$ptovta = '0005';
			
			$regfe['ImpTotal'] = $dev->getTotal();
			$regfe['ImpOpEx'] = 0;
			$regfe['ImpIVA'] = $dev->getIva();
			$regfe['ImpTrib'] = 0;
			$regfe['ImpTotConc'] = 0;
			$regfe['ImpNeto'] = $dev->getPrecio();
			$regfeiva[] = array(
				'Id' => 5, 
				'BaseImp' => $dev->getPrecio(),
				'Importe' => $dev->getIva(),
			);
			$regfetrib = '';
			$regfeasoc[] = array(
				'Tipo' => $resumen->getTipoFactura()->getCodTipoAfip(), 
				'PtoVta' => $ptovta, //$resumen->pto_vta, 
				'Nro' => $resumen->getNroFactura()
			);
			
			$factura_cancela = Doctrine::getTable('TipoFactura')->find($resumen->getTipoFactura()->id_fact_cancela);
			$regfe['CbteTipo'] = $factura_cancela->cod_tipo_afip;
			$regfe['Concepto'] = 1;
			$regfe['DocTipo'] = $resumen->getCliente()->getCondfiscal()->getCodTipoAfip();
			$regfe['DocNro'] = $dev->getResumen()->getCuitCliente();
			$regfe['CbteFch'] = date('Ymd');
			$regfe['MonId'] = 'PES';
			$regfe['MonCotiz'] = 1;
			
			$wsfev1 = new WSFEV1(dirname(__FILE__).'/../../detres/actions');
			
			$nro = $wsfev1->FECompUltimoAutorizado($ptovta/*$resumen->pto_vta*/, $regfe['CbteTipo']);
			$nuevo_nro = $nro+1;

			$res = $wsfev1->FECAESolicitar($nuevo_nro, $ptovta/*$resumen->pto_vta*/, $regfe, $regfeasoc, $regfetrib, $regfeiva);
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
						$dev->setAfipCae($res['cae']);
						$dev->setNroFactura($nuevo_nro);
						$dev->setPtoVta($resumen->pto_vta);
						$dev->setTipofacturaId($resumen->getTipoFactura()->id_fact_cancela);
						$dev->setAfipVtoCae($res['fec_vto']);
						
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
			
			$msj .= $msj2;
			$dev->setAfipEstado($afip_estado);
			$dev->setAfipMensaje($msj2);
			$dev->setAfipEnvio($wsfev1->client->__getLastRequest());
			$dev->setAfipRespuesta($wsfev1->client->__getLastResponse());
			
			$dev->save();
		}

		$this->getUser()->setFlash($tipo_msj, $msj);
		$this->redirect('devprod/index');
	}
	
}
