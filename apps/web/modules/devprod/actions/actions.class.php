<?php

require_once dirname(__FILE__).'/../lib/devprodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/devprodGeneratorHelper.class.php';

/**
 * devprod actions.
 *
 * @package    odontopc
 * @subpackage devprod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class devprodActions extends autoDevprodActions
{
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $dev_producto = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'detalle_compra.save', array('object' => $dev_producto)));
      $cobro = new Cobro();
      $cobro->setFecha(date('Y-m-d'));
      $cobro->setClienteId($dev_producto->getClienteId());
      $cobro->setResumenId($dev_producto->getResumenId());
      $cobro->setMonedaId($dev_producto->getResumen()->getMonedaId());
      $cobro->setMonto($dev_producto->getTotal());
      $cobro->setTipoId(5);
      $cobro->setDevprodId($dev_producto->getId());
      $cobro->save();
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@dev_producto_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $dev_producto->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'dev_producto_edit', 'sf_subject' => $dev_producto));
          $this->redirect('@dev_producto');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    
    $objid = $request->getParameter('id');
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    $cobro = Doctrine::getTable('Cobro')->findByDevprodId($objid);
    $this->getRoute()->getObject()->delete();
    $cobro->delete();
    $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $this->getRoute()->getObject())));

    $this->redirect('@dev_producto');
  }
  
  public function executeBuscarprecio(sfWebRequest $request){
    $producto = $request->getParameter('pid');
    $resumen = $request->getParameter('rid');
    if(empty($rid)){
      $rid = $this->getUser()->getAttribute('rid');
    }
    $prec_prod = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($resumen, $producto);
    return $this->renderText(json_encode(sprintf("%01.2f", $prec_prod[0]->getPrecio())));
  }
  
  public function executeGet_vtas_cliente(sfWebRequest $request){
  
    $q = Doctrine_Query::create()
      ->select('res.id, res.fecha, dr.nro_lote')
      ->from('Resumen res')
      ->leftJoin('res.Detalle dr')
      ->where('res.cliente_id = '.$request->getparameter('cid'))
      ->andWhere('dr.producto_id = '.$request->getparameter('pid'))
      ->orderBy('res.fecha desc');
     
    $vtas = $q->fetchArray();  
  
    $options[] = '<option value=""></option>';
    foreach($vtas as $vta){
      //print_r($vta);
      $options[] = '<option value="'.$vta['id'].'">Nro: '.$vta['id'].' - Fecha: '.implode('/', array_reverse(explode('-', $vta['fecha']))).' - Nro_lote:'.$vta['Detalle'][0]['nro_lote'].'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_prod_vta(sfWebRequest $request){
    $vtas = Doctrine::getTable('DetalleResumen')->findByResumenId($request->getparameter('rid'));
    $options[] = '<option value=""></option>';
    foreach($vtas as $vta){
      $options[] = '<option value="'.$vta->getProductoId().'">'.$vta->getProducto().'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_vta_lotes(sfWebRequest $request){
    $lotes = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($request->getparameter('rid'), $request->getparameter('pid'));  
    $cantidad = $lotes[0]['cantidad'];
    $options[] = '<option value="">1</option>';
    for($i = 2; $i <= $cantidad; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }  
}
