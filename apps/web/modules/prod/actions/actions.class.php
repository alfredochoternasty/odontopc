<?php

require_once dirname(__FILE__).'/../lib/prodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/prodGeneratorHelper.class.php';

/**
 * prod actions.
 *
 * @package    odontopc
 * @subpackage prod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class prodActions extends autoProdActions
{
  protected function executeBatchDesactivar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = Doctrine_Query::create()
      ->update('Producto p')
      ->set('p.activo', '?', 0)
      ->whereIn('id', $ids)
      ->execute();

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@producto');
  }
  
  protected function executeBatchActivar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = Doctrine_Query::create()
      ->update('Producto p')
      ->set('p.activo', '?', 1)
      ->whereIn('id', $ids)
      ->execute();

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@producto');
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
	$consulta->leftJoin('r.Grupo gr');
    $consulta->addWhere('grupoprod_id <> 1');
    $consulta->andWhere('grupoprod_id <> 15');
    $consulta->andWhere('activo = 1');
    $consulta->orderBy('gr.nombre asc, r.orden_grupo asc, r.nombre asc');
    $productos = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("productos" => $productos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("productos.pdf");    
    return sfView::NONE;
  }
  
  public function executeListLista(sfWebRequest $request){
    $filtro = new ProductoFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
    $consulta->leftJoin('r.Grupo gr');
    $consulta->addWhere('grupoprod_id <> 1');
    $consulta->andWhere('grupoprod_id <> 15');
    $consulta->andWhere('activo = 1');
    $consulta->orderBy('gr.nombre asc, r.orden_grupo asc, r.nombre asc');
    $productos = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("lista_precio", array("productos" => $productos)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("productos.pdf");    
    return sfView::NONE;
  }
}
