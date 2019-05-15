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
	
}
