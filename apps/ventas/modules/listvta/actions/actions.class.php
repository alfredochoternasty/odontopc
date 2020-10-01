<?php

require_once dirname(__FILE__).'/../lib/listvtaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listvtaGeneratorHelper.class.php';

/**
 * listvta actions.
 *
 * @package    odontopc
 * @subpackage listvta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listvtaActions extends autoListvtaActions
{
  public function executeIndex(sfWebRequest $request) {
    if (!$this->getUser()->hasAttribute('totales')) $this->getUser()->setAttribute('totales', true);
    parent::executeIndex($request);
  }
  
  public function executeListVerTotales(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', true);
    $this->executeIndex($request);
    $this->setTemplate('index');
  }  
  
  public function executeListVerDetallado(sfWebRequest $request){
    $this->getUser()->setAttribute('totales', false);
    $this->executeIndex($request);
    $this->setTemplate('index');
  }
  
  public function executeListImprimirPagina(sfWebRequest $request){
    if ($this->getUser()->getAttribute('totales')) {
      $this->getUser()->setFlash('error', '"Imprimir pagina" es solo para el listado detallado, utilice la opción "Imprimir todo"');
      $this->redirect('listvta/index?page=1');
    } else {
      parent::executeListImprimirPagina($request);
    }
  }  
  
  public function getModoImpresion()
  {
    return 'landscape';
  }
  
  public function descargar_pdf($imp_pag=false)
  {
    $datos = $this->get_datos($imp_pag);
    $dompdf = new DOMPDF();
    $_hasFilters = $this->getUser()->getAttribute('listvta.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $plantilla = $this->getUser()->getAttribute('totales', false)?"imprimir_tot":"imprimir";
    $dompdf->load_html($this->getPartial($plantilla, array("listado" => $datos, 'configuration' => $this->configuration, 'filters' => $this->filters, 'hasFilters' => $_hasFilters)));
    $dompdf->set_paper('A4',$this->getModoImpresion());
    $dompdf->render();
    $dompdf->stream("Listado de Ventas.pdf");    
    return sfView::NONE;
  }
}
