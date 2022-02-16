<?php

require_once dirname(__FILE__).'/../lib/cobroGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cobroGeneratorHelper.class.php';

/**
 * cobro actions.
 *
 * @package    odontopc
 * @subpackage cobro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cobroActions extends autoCobroActions
{
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid()) {
			$notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
			$cobro = $form->save();
			
			$cobro->nro_recibo = Doctrine::getTable('Cobro')->getProxNroRecibo();
			$cobro->zona_id = $cobro->getCliente()->zona_id;
			$cobro->usuario = $this->getUser()->getGuardUser()->getId();
			$cobro->save();
			
			$saldo_cliente = $cobro->getCliente()->getSaldoCtaCte(1, null, false); //saldo negativo es favor del cliente
			if ($saldo_cliente >= 0) $saldo_cliente = 0; //si tiene saldo deudor no importa cuanto es
				
			$monto_cobrado = $cobro->getMonto(); //24.500
			$fact_imapagas = Doctrine::getTable('Resumen')->getFacturasImpagasCliente($cobro['cliente_id']);  
			foreach($fact_imapagas as $factura){
				$saldo_factura = $factura->getTotalResumen() - ($factura->getTotalCobrado() + $factura->getTotalDevuelto() + $saldo_cliente);
				// 34.370 - (0 + 0 + 0)
				$CobroResumen = new CobroResumen();
				$CobroResumen->setCobroId($cobro->getId());
				$CobroResumen->setResumenId($factura->getId());
				
				if(($monto_cobrado + 10) >= $saldo_factura){//tolerancia de 10 pesos
					$CobroResumen->setMonto($saldo_factura);
					$monto_cobrado = $monto_cobrado - $saldo_factura; //actualizo el monto cobrado para la proxima factura
					$factura->pagado = 1;
					$factura->fecha_pagado = $cobro->fecha;
					$factura->save();
					$CobroResumen->setMonto($saldo_factura);
					$CobroResumen->save();
				}else{
					$CobroResumen->setMonto($monto_cobrado);
					$CobroResumen->save();
					break;
				}
			}

			$this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $CobroResumen)));
			$cobro_alerta = $this->getUser()->getVarConfig('cobro_alerta');
			if ($cobro->getCliente()->zona_id > 1 && $cobro_alerta == 'S') {
				$cobro_alerta_mail = $this->getUser()->getVarConfig('cobro_alerta_mail');
				$cobro_modelo_impresion = $this->getUser()->getVarConfig('cobro_modelo_impresion');
				$mensaje = Swift_Message::newInstance();
				$mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
				$mensaje->setTo(array($cobro_alerta_mail));
				$mensaje->setSubject('Cobro realizado en '.$cobro->getCliente()->getZona());
				$mensaje->setBody($this->getPartial($cobro_modelo_impresion, array("cobro" => $cobro)));
				$mensaje->setContentType("text/html");
				$this->getMailer()->send($mensaje);
			}

			if ($request->hasParameter('_save_and_add')){
				$this->getUser()->setFlash('notice', $notice.' You can add another one below.');
				$this->redirect('@cobro_new');
			} else {
				$this->getUser()->setFlash('notice', $notice);
				$this->redirect('cobro/index');
			}
    } else {
		$this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    
    $cobro_resumen = Doctrine::getTable('CobroResumen')->findByCobroId($this->getRoute()->getObject()->getId());
    foreach($cobro_resumen as $cr){
      $cr->delete(); 
      $resumen = Doctrine::getTable('Resumen')->find($cr->getResumen()->getId());
      $resumen->pagado = 0;
      $resumen->fecha_pagado = null;
      $resumen->save();
    }    
    
    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@cobro');
  }
	
  public function executeGuardarnuevobanco(sfWebRequest $request){
    $objProd = new Banco();
    $datos = $request->getParameter('banco');
    
    $objProd->setNombre($datos['nombre']);
    $objProd->save();
    
    return $this->renderText(json_encode($objProd->getId()));
  }
	
	
 	public function executeListRecibo(sfWebRequest $request){
    if($request->hasParameter('id')){
      $cid = $request->getParameter('id');
      $this->getUser()->setAttribute('cid', $cid);
    }else{
      $cid = $this->getUser()->getAttribute('cid');
    }
		$cobro = Doctrine::getTable('Cobro')->find($cid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("recibo", array("cobro" => $cobro)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("recibo.pdf");    
    return sfView::NONE;
  }

  public function executeListMail(sfWebRequest $request){
    if($request->hasParameter('id')){
      $cid = $request->getParameter('id');
      $this->getUser()->setAttribute('cid', $cid);
    }else{
      $cid = $this->getUser()->getAttribute('cid');
    }
		$cobro = Doctrine::getTable('Cobro')->find($cid);
    
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
    $mensaje->setTo($cobro->getCliente()->getEmail());
    $mensaje->setSubject('Recibo de pago');
    $mensaje->setBody($this->getPartial("recibo", array("cobro" => $cobro)));
    $mensaje->setContentType("text/html");
    $this->getMailer()->send($mensaje);
    
    $this->getUser()->setFlash('notice', 'El mail se enviado correctamente a la direccion '.$cobro->getCliente()->getEmail());
    $this->redirect('@cobro');
  }

  public function executeIndex(sfWebRequest $request)
  {
    if ($request->getParameter('sort')) $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));

    if ($request->getParameter('page')) $this->setPage($request->getParameter('page'));

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->hasFilters = $this->getUser()->getAttribute('cobro.filters', $this->configuration->getFilterDefaults(), 'admin_module');
		if ($this->hasFilters) {
			$consulta = $this->buildQuery($this->getFilters());
			$cobros = $consulta->execute();
			$this->total = 0;
			foreach ($cobros as $cobro) $this->total += $cobro->monto;
		}
  }
	
	public function executeDescargar(sfwebRequest $request)
	{
			$cobro = Doctrine::getTable('cobro')->find($request->getParameter('cid'));
			$archivo = sfConfig::get('sf_upload_dir').'/cobros/'.$cobro->archivo;
			list($nom, $ext) = explode('.', $cobro->archivo);
			header('Content-Description: File Transfer');
			header('Accept-Ranges: bytes');
			header('Content-Disposition: attachment; filename='.$cobro.'-'.$cobro->getCliente().'.'.$ext);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Content-Length: '.filesize($archivo));
			ob_clean();
			flush();
			readfile($archivo);
			return sfView::NONE;
	}

}