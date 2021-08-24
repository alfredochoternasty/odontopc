<?php

require_once dirname(__FILE__).'/../lib/ctrlstockGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ctrlstockGeneratorHelper.class.php';

/**
 * ctrlstock actions.
 *
 * @package    odontopc
 * @subpackage ctrlstock
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ctrlstockActions extends autoCtrlstockActions
{
	
  public function getModoImpresion()
  {
    return 'landscape';
  }
  
  public function executeListDetalle(sfWebRequest $request) {
    $ctrl_stock = $this->getRoute()->getObject();
    $url = $this->generateUrl('movimiento_producto', array(
      'producto_id' => $ctrl_stock->producto_id,
      'nro_lote' => urlencode($ctrl_stock->nro_lote),
      'zona_id' => $ctrl_stock->zona_id
    ));
    $this->redirect($url);
  }
  
  public function executeListPlanillaControl(sfWebRequest $request) {
    $datos = $this->get_datos();
    $dompdf = new DOMPDF();
    $_hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $dompdf->load_html($this->getPartial("planilla_ctrl", array("listado" => $datos, 'configuration' => $this->configuration, 'filters' => $this->filters, 'hasFilters' => $_hasFilters)));
    $dompdf->set_paper('A4',$this->getModoImpresion());
    $dompdf->render();
    $dompdf->stream("planilla_control.pdf");    
    return sfView::NONE;
  }
  
  public function executeListPlanillaDistribucion(sfWebRequest $request) {
    $datos = $this->get_datos();
    $dompdf = new DOMPDF();
    $_hasFilters = $this->getUser()->getAttribute('ctrlstock.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $dompdf->load_html($this->getPartial("planilla_distribucion", array("listado" => $datos, 'configuration' => $this->configuration, 'filters' => $this->filters, 'hasFilters' => $_hasFilters)));
    $dompdf->set_paper('A4',$this->getModoImpresion());
    $dompdf->render();
    $dompdf->stream("planilla_distribucion.pdf");    
    return sfView::NONE;
  }
}
