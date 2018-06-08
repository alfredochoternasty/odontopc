<?php

require_once dirname(__FILE__).'/../lib/detvtaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detvtaGeneratorHelper.class.php';

/**
 * detvta actions.
 *
 * @package    odontopc
 * @subpackage detvta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detvtaActions extends autoDetvtaActions
{
  public function executeNew(sfWebRequest $request)
  {
    $detvta = new DetalleVenta();
    if($request->hasParameter('vid')){
      $vid = $request->getParameter('vid');
      $this->getUser()->setAttribute('vid', $vid);
    }else{
      $vid = $this->getUser()->getAttribute('vid');
    }
    $detvta->setVentaId($vid);
    $this->form = new DetalleVentaForm($detvta);
    $this->detalle_venta = $this->form->getObject();
  }
  
  public function executeActprecio(sfWebRequest $request){
    $producto = $request->getParameter('pid');

    $q = Doctrine_Query::create()
      ->from('Producto')
      ->whereIn('id', $producto);
    $prod = $q->execute();
    return $this->renderText(json_encode($prod[0]['precio_vta']));
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('vid')){
      $vid = $request->getParameter('vid');
      $this->getUser()->setAttribute('vid', $vid);
      $this->setFilters(array("venta_id" => $vid));
    }else{
      $vid = $this->getUser()->getAttribute('vid');
      $this->setFilters(array("venta_id" => $vid));
    } 
    parent::executeIndex($request);
  }  
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $detalle_venta = $form->save();
      //guardar tambien en detalle resumen
      $detres = new DetalleResumen();
      $detres->setResumenId($detalle_venta->getVenta()->getResumenId());
      $detres->setProductoId($detalle_venta->getProductoId());
      $detres->setPrecio($detalle_venta->getIva());
      $detres->setCantidad($detalle_venta->getCantidad());
      $detres->setTotal($detalle_venta->getIva());
      $detres->setObservacion('IVA');
      $detres->save();
      //sigue con detalle venta
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $detalle_venta)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@detalle_venta_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $detalle_venta->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'detalle_venta_edit', 'sf_subject' => $detalle_venta));
          $this->redirect('@detalle_venta');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)  {
    $request->checkCSRFProtection();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
    $obj = $this->getRoute()->getObject();
    $relations = $obj->getTable()->getRelations();
    
    $borrar = true;
    foreach ($relations as $name => $relation) {
        if($relation->getType() == 1){
          $rel = $relation->getTable()->findOneBy($relation->getForeign(), $obj->get($relation->getLocal()));
          if($rel){
            $borrar = false;
            break;
          }
        }
    }
        
    if($borrar){
      $p = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoIdAndObservacion($this->getRoute()->getObject()->getVenta()->getResumenId(), $this->getRoute()->getObject()->getProductoId(), 'IVA');
      $p->Delete();
      $this->getRoute()->getObject()->delete();
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }else{
      $this->getUser()->setFlash('error', 'No se puede borrar, el registro esta siendo referenciado.');
    }

    $this->redirect('@detalle_venta');
  }  
}
