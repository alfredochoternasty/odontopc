<?php

/**
 * facturas actions.
 *
 * @package    odontopc
 * @subpackage facturas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facafipActions extends sfActions
{
  public function executeVer(sfWebRequest $request){
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $cliente = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $this->facturas = $cliente[0]->getFacturas();
    $this->setLayout('layout_app');
  }
  
  public function executeImprimir(sfWebRequest $request){
		$rid = $request->getParameter('rid');
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
}
