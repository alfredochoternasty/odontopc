<?php

require_once dirname(__FILE__).'/../lib/compraGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/compraGeneratorHelper.class.php';

/**
 * compra actions.
 *
 * @package    odontopc
 * @subpackage compra
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class compraActions extends autoCompraActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detcomp/index?cid='.$this->getRequestParameter('id'));
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $compra = $form->save();
      $this->getUser()->setFlash('notice', $notice);
			
      if ($request->hasParameter('_save_and_add')){
			
				if (!empty($compra->remito_id)) {
					
					$det_remito = Doctrine::getTable('DetalleResumen')->findByResumenId($compra->remito_id);					
					foreach ($det_remito as $det) {
						$det_compra = new DetalleCompra();
						$det_compra->compra_id = $compra->id;
						$det_compra->producto_id = $det->producto_id;
						$det_compra->cantidad = $det->cantidad;
						$det_compra->nro_lote = $det->nro_lote;
						$det_compra->fecha_vto = $det->fecha_vto;
						$det_compra->save();
						$this->dispatcher->notify(new sfEvent($this, 'detalle_compra.save', array('object' => $det_compra)));
					}
				}
        $this->redirect('detcomp/index?cid='.$compra->getId());
      }else{
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
        $this->getUser()->setFlash('notice', $notice);
        $this->redirect('@compra');
      }      
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
  public function executeGetnroremito(sfWebRequest $request){
    $pid = $request->getParameter('pid');
		if ($pid != 99) {
			if(empty($pid)){
				$pid = $this->getUser()->getAttribute('pid');
			}
			$proveedor = Doctrine::getTable('Proveedor')->find($pid);
			$nro = $proveedor->getProxRemito();
		} else {
			$nro = '0';
		}
    return $this->renderText(json_encode($nro));
  }
}
