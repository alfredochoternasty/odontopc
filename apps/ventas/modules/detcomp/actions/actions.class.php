<?php

require_once dirname(__FILE__).'/../lib/detcompGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detcompGeneratorHelper.class.php';

/**
 * detcomp actions.
 *
 * @package    odontopc
 * @subpackage detcomp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detcompActions extends autoDetcompActions
{
  public function executeNew(sfWebRequest $request)
  {
    $detcmp = new DetalleCompra();
    if($request->hasParameter('cid')){
      $cid = $request->getParameter('cid');
      $this->getUser()->setAttribute('cid', $cid);
    }else{
      $cid = $this->getUser()->getAttribute('cid', 1);
    }
    $detcmp->setCompraId($cid);
    $this->form = new DetalleCompraForm($detcmp);
    $this->detalle_compra = $this->form->getObject();
    
    $this->pager2 = Doctrine::getTable('DetalleCompra')->findByCompraId($cid);    
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('cid')){
      $cid = $request->getParameter('cid');
      $this->getUser()->setAttribute('cid', $cid);
    }else{
      $cid = $this->getUser()->getAttribute('cid');
    }  
    $this->setFilters(array("compra_id" => $cid));
    $this->compra_datos = Doctrine::getTable('Compra')->find($cid);
    parent::executeIndex($request);
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->dispatcher->notify(new sfEvent($this, 'detalle_compra.delete', array('object' => $this->getRoute()->getObject())));
    $cid = $this->getRoute()->getObject()->getCompraId();    
    $this->getRoute()->getObject()->delete();
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    $this->redirect('detcomp/index?cid='.$cid);
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $detalle_compra = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'detalle_compra.save', array('object' => $detalle_compra)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@detalle_compra_new');
      }else{
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('detcomp/index?cid='.$detalle_compra->getCompraId());
      }      
    }
  }  
  
  public function executeBatchFacturar(sfWebRequest $request){
    $ids = $request->getParameter('ids');
    $detalle_compra = Doctrine::getTable('DetalleCompra')->find($ids[0]);
    $venta = new FactCompra();
    $id_resumen = $detalle_compra->getResumenId();
    $venta->setResumenId($id_resumen);
    $venta->setNumero(0);
    //$tipo_factura = Doctrine::getTable('TipoFactura')->find(1);
    $venta->setTipofacturaId(1);
    $venta->setFecha(date("Y-m-d"));
    $venta->save();
    foreach($ids as $k => $v){
      $detalle_compra = Doctrine::getTable('DetalleResumen')->find($v);
      $detalle_venta = new DetalleVenta();
      $detalle_venta->setVenta($venta);
      $detalle_venta->setProductoId($detalle_compra->getProductoId());
      //$producto = Doctrine::getTable('Producto')->find($detalle_resumen->getProductoId());
      $detalle_venta->setPrecio($detalle_compra->getPrecio());
      $detalle_venta->setCantidad($detalle_compra->getCantidad());
      $detalle_venta->setTotal(round($detalle_compra->getPrecio() * $detalle_compra->getCantidad(), 2));
      $detalle_venta->save();
    }
    $detalle_resumen = new DetalleResumen();
    $detalle_resumen->setResumenId($id_resumen);
    $detalle_resumen->setProductoId(31);
    $detalle_resumen->setCantidad(1);
    $detalle_resumen->setPrecio($venta->getIva());
    $detalle_resumen->setTotal($venta->getIva());
    $detalle_resumen->save();
    $this->redirect('vta/edit?id='.$venta->getId());
  }  
  
  public function executeGuardarnuevoproducto(sfWebRequest $request){
    $objProd = new Producto();
    $datos = $request->getParameter('producto');
    
    $objProd->setNombre($datos['nombre']);
    $objProd->setCodigo($datos['codigo']);
    $objProd->setGrupoprod_id($datos['grupoprod_id']);
    $objProd->setPrecioVta($datos['precio_vta']);
    $objProd->setGeneraComision($datos['genera_comision']);
    $objProd->setMinimoStock($datos['minimo_stock']);
    $objProd->setStockActual($datos['stock_actual']);
    $objProd->setCtrFactGrupo($datos['ctr_fact_grupo']);
    
    $objProd->save();
    
    return $this->renderText(json_encode($objProd->getId()));
  }  
  
  public function executeListImprimir(sfWebRequest $request){
    $cid = $this->getUser()->getAttribute('cid', 1);
    $detcompra = Doctrine::getTable('DetalleCompra')->findByCompraId($cid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("detcomp" => $detcompra)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("detalle_compra.pdf");    
    return sfView::NONE;
  }  
}
