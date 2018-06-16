<?php

require_once dirname(__FILE__).'/../lib/detresGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/detresGeneratorHelper.class.php';

/**
 * detres actions.
 *
 * @package    odontopc
 * @subpackage detres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detresActions extends autoDetresActions
{

  public function executeBatch(sfWebRequest $request){
    $request->checkCSRFProtection();
    if (!$ids = $request->getParameter('ids')){
      $this->getUser()->setFlash('error', 'You must at least select one item.');
      $this->redirect('@detalle_resumen');
    }

    if (!$action = $request->getParameter('batch_action')){
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');
      $this->redirect('@detalle_resumen');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action))){
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action))){
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }
    
    $this->$method($request);
    $this->redirect('@detalle_resumen');
  }
    
  public function executeActprecio(sfWebRequest $request){
    $producto = $request->getParameter('pid');
    $rid = $request->getParameter('rid');
    if(empty($rid)){
      $rid = $this->getUser()->getAttribute('rid');
    }
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    $lis = $resumen->getCliente()->getListaPrecio();
    $prec_prod = Doctrine::getTable('Producto')->find($producto)->getPrecioFinal($lis);
    return $this->renderText(json_encode(sprintf("%01.2f", $prec_prod)));
  }
  
  public function executeLote(sfWebRequest $request){
    $prod = null;
    $prod = $request->getParameter('pid');
    if(!empty($prod)){
      $q = Doctrine_Query::create()
          ->from('lote l')
          ->where('l.producto_id = ?', $prod)
          ->andWhere('l.stock > 0')
          ->andWhere('l.fecha_vto > ?', date("Y-m-d"))
          ->orderBy('fecha_vto desc');
      $lotes = $q->execute();
      $nro_lote = '#';
      foreach($lotes as $lote){
        $nro_lote = $lote->getNroLote().' == '.$lote->getStock();
      }
    }else{
      $nro_lote = '#';
    }
    return $this->renderText(json_encode($nro_lote));
  }  
  
  public function executeNew(sfWebRequest $request)
  {
    $detres = new DetalleResumen();
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->getUser()->setAttribute('rid', $rid);
    }else{
      $rid = $this->getUser()->getAttribute('rid');
    }
    $detres->setResumenId($rid);
    $this->form = new DetalleResumenForm($detres);
    $this->detalle_resumen = $this->form->getObject();
    
    $this->pager2 = Doctrine::getTable('DetalleResumen')->findByResumenId($rid);
  }
  
  public function executeIndex(sfWebRequest $request){
    if($request->hasParameter('rid')){
      $rid = $request->getParameter('rid');
      $this->getUser()->setAttribute('rid', $rid);
    }else{
      $rid = $this->getUser()->getAttribute('rid');
    } 
    $this->setFilters(array("resumen_id" => $rid));
    parent::executeIndex($request);
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.delete', array('object' => $this->getRoute()->getObject())));
    $rid = $this->getRoute()->getObject()->getResumenId();
    $this->getRoute()->getObject()->delete();
    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    $this->redirect('detres/index?rid='.$rid);
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $detalle_resumen = $form->save();
			
			$lista_id = $detalle_resumen->getProducto()->getListaId();
			$moneda_id = $detalle_resumen->getProducto()->getLista()->getMonedaId();
			if (empty($lista_id)) {
				$lista_id = $detalle_resumen->getResumen()->getCliente()->getListaId();
				$moneda_id = $detalle_resumen->getResumen()->getCliente()->getLista()->getMonedaId();
			}
			$detalle_resumen->setListaId($lista_id);
			$detalle_resumen->setMonedaId($moneda_id);
			$detalle_resumen->save();
			
      $this->dispatcher->notify(new sfEvent($this, 'detalle_resumen.save', array('object' => $detalle_resumen)));
      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('detres/new?rid='.$detalle_resumen->getResumenId());
      } else {
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('detres/index?rid='.$detalle_resumen->getResumenId());
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $rid = $this->getUser()->getAttribute('rid', 1);
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("reporte.pdf");    
    return sfView::NONE;
  }
  
  public function executeGet_lotes_producto(sfWebRequest $request){
  
    $q = Doctrine_Query::create()
      ->select('l.nro_lote, l.fecha_vto, l.stock')
      ->from('Lote l')
      ->where('l.producto_id = '.$request->getparameter('pid'))
      ->andWhere('l.stock > 0 ')
      ->andWhere('l.fecha_vto > '.date('Y-m-d'))
      ->orderBy('l.fecha_vto asc');
     
    $lotes = $q->fetchArray();  
  
    $options[] = '<option value=""></option>';
    foreach($lotes as $lote){
      $options[] = '<option value="'.$lote['nro_lote'].'">'.$lote['nro_lote'].' - Vto: '.implode('/', array_reverse(explode('-', $lote['fecha_vto']))).' - Stock: '.$lote['stock'].'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeGet_cantidad_lote(sfWebRequest $request){
  
    $q = Doctrine_Query::create()
      ->select('l.stock')
      ->from('Lote l')
      ->where('l.nro_lote = \''.$request->getparameter('lid').'\'')
      ->andWhere('l.producto_id = \''.$request->getparameter('pid').'\'')
      ->andWhere('l.stock > 0 ')
      ->andWhere('l.fecha_vto > '.date('Y-m-d'));
     
    $lotes = $q->fetchArray();  
    $cantidad = $lotes[0]['stock'];
    $options[] = '<option value="0">0</option>';
    for($i = 1; $i <= $cantidad; $i++){
      $options[] = '<option value="'.$i.'">'.$i.'</option>';
    }
    echo implode($options);
    return sfView::NONE;
  }
  
  public function executeListRemito(sfWebRequest $request){
    $rid = $this->getUser()->getAttribute('rid', 1);
    $resumen = Doctrine::getTable('Resumen')->find($rid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("remito", array("resumen" => $resumen)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("remito.pdf");    
    return sfView::NONE;
  }  
}