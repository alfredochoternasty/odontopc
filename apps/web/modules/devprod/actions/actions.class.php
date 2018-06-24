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
  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
		$cliente_id = $this->getUser()->getAttribute('cliente_id');
		if (!empty($cliente_id)) $this->form->setDefault('cliente_id', $cliente_id);
    $this->dev_producto = $this->form->getObject();
  }	
	
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
			$detalle_resumen = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($dev_producto->getResumenId(), $dev_producto->getProductoId());			
      $cobro->setMonedaId($detalle_resumen[0]->getMonedaId());
      $cobro->setMonto($dev_producto->getTotal());
      $cobro->setTipoId(5);
      $cobro->setDevprodId($dev_producto->getId());
      $cobro->save();
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->getUser()->setAttribute('cliente_id', $dev_producto->getClienteId());
        $this->redirect('@dev_producto_new');
      }else{
				$this->getUser()->setAttribute('cliente_id', 0);
        if ($request->hasParameter('rtn')){
          return $dev_producto->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
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
    $datos['precio'] = sprintf("%01.2f", $prec_prod[0]->getPrecio());
    $datos['iva'] = sprintf("%01.2f", $prec_prod[0]->getIva()/$prec_prod[0]->getCantidad());
    $datos['cant'] = sprintf("%01.2f", $prec_prod[0]->getCantidad());
		$total = $datos['iva'] + $datos['precio'];
    $datos['total'] = sprintf("%01.2f", $total);
    return $this->renderText(json_encode($datos));
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
    $options[] = '<option value="1" selected >1</option>';
    for($i = 2; $i <= $cantidad; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
    public function executeGet_lote(sfWebRequest $request){
    $prods = Doctrine::getTable('DetalleResumen')->findByResumenIdAndProductoId($request->getparameter('rid'), $request->getparameter('pid'));  
    echo $prods[0]['nro_lote'];
    return sfView::NONE;
  }
}
