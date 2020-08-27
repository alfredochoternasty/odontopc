<?php

require_once dirname(__FILE__).'/../lib/detlisGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detlisGeneratorHelper.class.php';

/**
 * detlis actions.
 *
 * @package    odontopc
 * @subpackage detlis
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detlisActions extends autoDetlisActions
{
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('lid')){
      $lid = $request->getParameter('lid');
    }else{
      $lid = $this->getUser()->getAttribute('lid');
    }
    $this->setFilters(array("lista_id" => $lid));
    $this->getUser()->setAttribute('lid', $lid);
    parent::executeIndex($request);
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $detlis = new DetLisPrecio();
    $lid = $this->getRequestParameter('lid');
    if(empty($lid)) $lid = $this->getUser()->getAttribute('lid',0);
    $detlis->setListaId($lid);
    $this->form = new DetLisPrecioForm($detlis);
    unset($this->form['grupoprod_id']);
    $this->det_lis_precio = $this->form->getObject();
  }
  
  public function executeAgg(sfWebRequest $request)
  {
    $detlis = new DetLisPrecio();
    $detlis->setListaId($this->getUser()->getAttribute('lid',0));
    $this->form = new DetLisPrecioForm($detlis);
    unset($this->form['producto_id']);
    $this->det_lis_precio = $this->form->getObject();
    $this->setTemplate('new');
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $lid = $this->getUser()->getAttribute('lid');
    $filtro = new ProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $consulta->leftJoin('r.Grupo gr');
    $consulta->addWhere('grupoprod_id <> 1');
    $consulta->andWhere('grupoprod_id <> 15');
    $consulta->orderBy('gr.nombre asc, r.orden_grupo asc, r.nombre asc');
    $productos = $consulta->execute();

    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("productos" => $productos, "lista"=>$lid)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("precios.pdf");    

    return sfView::NONE;
  }
}
