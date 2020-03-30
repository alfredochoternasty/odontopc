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
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $producto = $form->save();
      
      if (!empty($producto->foto)) {
        list($filename, $extension) = explode('.', $producto->foto);
        $ruta = sfConfig::get('sf_upload_dir').'/productos/'.$filename.'.'.$extension;
        $img = new sfImage($ruta, 'image/'.$extension);
        $img->thumbnail(50,50);
        $img->setQuality(50);
        $ruta = sfConfig::get('sf_upload_dir').'/productos/'.$filename.'_chica.'.$extension;
        $img->saveAs($ruta);
        $producto->setFotoChica($filename.'_chica.'.$extension);
        $producto->save();
      }
      
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $producto)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@producto_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $producto->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'producto_edit', 'sf_subject' => $producto));
          $this->redirect('@producto');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $parametros = array(
      'base_url' => $this->getUser()->getVarConfig('base_url'),
      'modulo_factura' => $this->getUser()->getVarConfig('modulo_factura')
    );
		$this->form = $this->configuration->getForm(null, $parametros);
		$this->producto = $this->form->getObject();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $parametros = array(
      'base_url' => $this->getUser()->getVarConfig('base_url'),
      'modulo_factura' => $this->getUser()->getVarConfig('modulo_factura')
    );
    $this->producto = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->producto, $parametros);
  }
}
