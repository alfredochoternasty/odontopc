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
			
			$q = Doctrine_Query::create()->select('max(nro_recibo) as nro')->from('cobro');
			$max_nro = $q->execute();
			$nro = $max_nro[0]['nro'];
			$cobro->nro_recibo = $nro+1;
			$cobro->zona_id = $cobro->getCliente()->zona_id;
			$cobro->usuario = $this->getUser()->getGuardUser()->getId();
			$cobro->save();
			
			$monto = $cobro->getMonto();
			$saldo_cliente = $cobro->getCliente()->getSaldoCtaCte(1, null, false);
			if ($saldo_cliente >= 0) $saldo_cliente = 0;
				
			$Resumenes = Doctrine::getTable('Resumen')->findByClienteIdAndPagado($cobro['cliente_id'], 0);  
			foreach($Resumenes as $resumen){
				$saldo_resumen = $resumen->getTotalResumen() - ($resumen->getTotalCobrado() + $resumen->getTotalDevuelto() + $saldo_cliente);
				$objCobro = new CobroResumen();
				$objCobro->setCobroId($cobro->getId());
				$objCobro->setResumenId($resumen->getId());
				
				if(($monto + 5) >= $saldo_resumen){
					$objCobro->setMonto($saldo_resumen);
					$monto = $monto - $saldo_resumen;
					$resumen->pagado = 1;
					$resumen->fecha_pagado = $cobro->fecha;
					$resumen->save();
					$objCobro->save();
				}else{
					$objCobro->setMonto($monto);
					$objCobro->save();
					break;
				}
			}

			$this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $objCobro)));
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

}