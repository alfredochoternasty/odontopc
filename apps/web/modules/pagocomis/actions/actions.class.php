<?php

require_once dirname(__FILE__).'/../lib/pagocomisGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pagocomisGeneratorHelper.class.php';

/**
 * pagocomis actions.
 *
 * @package    odontopc
 * @subpackage pagocomis
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pagocomisActions extends autoPagocomisActions
{
	
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
		$pago_id = $this->getRoute()->getObject()->getId();
		$this->getRoute()->getObject()->delete();
    $count = Doctrine_Query::create()
      ->update('resumen')
			->set('pago_comision_id ', 'null')
      ->where('pago_comision_id = '.$pago_id)
      ->execute();
		$this->getUser()->setFlash('notice', 'Borrada correctamente');

    $this->redirect('@pago_comision');
  }
	
  public function executeListImprimir(sfWebRequest $request){
		$id_pago = $request->getParameter('id');
		$pago = Doctrine::getTable('PagoComision')->find($id_pago);
    $facturas = Doctrine::getTable('Resumen')->findByPagoComisionId($id_pago);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial('imprimir', array('pago' => $pago, 'facturas' => $facturas)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("pago_comision.pdf");    
    return sfView::NONE;
  }
	
  public function executeListMail(sfWebRequest $request){
		$id_pago = $request->getParameter('id');
		$pago = Doctrine::getTable('PagoComision')->find($id_pago);
    $facturas = Doctrine::getTable('Resumen')->findByPagoComisionId($id_pago);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial('imprimir', array('pago' => $pago, 'facturas' => $facturas)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();

    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI Implantes'));
    $mensaje->setTo($pago->getRevendedor()->getEmail());
    $mensaje->setSubject('Pago de Comisiones - NTI Implantes');
	
		$detalle = $dompdf->output();
		$adjunto = new Swift_Attachment($detalle, 'pago_comision.pdf', 'application/pdf');
		$mensaje->attach($adjunto);
    $this->getMailer()->send($mensaje);
    
    $this->getUser()->setFlash('notice', 'El mail se enviado correctamente a la direccion '.$pago->getRevendedor()->getEmail());
    $this->redirect('pago_comision');    
  }
}
