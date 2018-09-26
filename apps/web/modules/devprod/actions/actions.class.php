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
      ->select('res.id, res.fecha, dr.nro_lote')
      ->from('Resumen res')
      ->leftJoin('res.Detalle dr')
      ->where('res.cliente_id = '.$request->getparameter('cid'))
      ->andWhere('dr.producto_id = '.$request->getparameter('pid'))
      ->orderBy('res.fecha desc');
     
    $vtas = $q->fetchArray();  
  
    $options[] = '<option value=""></option>';
    foreach($vtas as $vta){
      //print_r($vta);
      $options[] = '<option value="'.$vta['id'].'">Nro: '.$vta['id'].' - Fecha: '.implode('/', array_reverse(explode('-', $vta['fecha']))).' - Nro_lote:'.$vta['Detalle'][0]['nro_lote'].'</option>';
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
	
	public function executeListFactura(sfWebRequest $request){
    if($request->hasParameter('id')){
      $did = $request->getParameter('id');
      $this->getUser()->setAttribute('did', $did);
    }else{
      $did = $this->getUser()->getAttribute('did');
    }

		if (!empty($did)) {
			$wsaa = new WSAA(dirname(__FILE__).'../../../detres/actions'); 
			$dt_expira = new DateTime($wsaa->get_expiration());
			$dt_actual = new DateTime(date("Y-m-d h:m:i"));
			if($dt_expira < $dt_actual) {
				if (!$wsaa->generar_TA()) {
					die('<br>'.$wsaa->error.'<br>');
				}
			}
			
			$ptovta = '4';
			
			$dev = Doctrine::getTable('DevProducto')->find($did);
			$rid = $dev->getResumenId();
			$resumen = Doctrine::getTable('Resumen')->find($rid);
			
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
				'PtoVta' => '4',//$resumen->getPtoVta(), 
				'Nro' => $resumen->getNroFactura()
			);
			
			$regfe['CbteTipo'] = 8; //$dev->getTipoFactura()->getCodTipoAfip();
			$regfe['Concepto'] = 1;
			$regfe['DocTipo'] = $dev->getCliente()->getCondfiscal()->getCodTipoAfip();
			$regfe['DocNro'] = $dev->getResumen()->getCuitCliente();
			$regfe['CbteFch'] = date('Ymd');
			$regfe['MonId'] = 'PES';
			$regfe['MonCotiz'] = 1;
			
			$wsfev1 = new WSFEV1(dirname(__FILE__).'../../../detres/actions');
			
			$nro = $wsfev1->FECompUltimoAutorizado($ptovta, $regfe['CbteTipo']);
			$nuevo_nro = $nro+1;

			$res = $wsfev1->FECAESolicitar($nuevo_nro, $ptovta, $regfe, $regfeasoc, $regfetrib, $regfeiva);
			$tipo_msj = 'error';
			if (is_soap_fault($res)) {
				$msj = str_replace('\'', '\'\'', 'SOAP Fault: (faultcode: '.$res->faultcode.', faultstring: '.$res->faultstring.')');
				$afip_estado = 0;
			} else {
				if(empty($res) || $res == false || $res['cae'] <= 0) {
					for ($i=0;$i < count($wsfev1->Code);$i++) {
						$a_msj[] = $wsfev1->Code[$i].' - '.$wsfev1->Msg[$i];
					}
					$msj = str_replace('\'', '\'\'', implode('//', $a_msj));
					$afip_estado = 0;
					$tipo_msj = 'error';
				} else {
					if($res['cae'] <= 0 || $res['cae'] == '' || $res['cae'] == false){
						$msj = 'CAE no obtenido';
						$afip_estado = 0;
						$tipo_msj = 'error';
					} else {
						$msj = $res['cae'];
						$afip_estado = 1;
						$dev->setNroFactura($nuevo_nro);
						$dev->setAfipVtoCae($res['fec_vto']);
						$tipo_msj = 'notice';
					}
				}
			}
			$dev->setAfipEstado($afip_estado);
			$dev->setAfipMensaje($msj);
			$dev->save();
		}

		$this->getUser()->setFlash($tipo_msj, $msj);
		$this->redirect('devprod/index');
	}
	
}
