<?php

require_once dirname(__FILE__).'/../lib/stockajusteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stockajusteGeneratorHelper.class.php';

/**
 * stockajuste actions.
 *
 * @package    odontopc
 * @subpackage stockajuste
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stockajusteActions extends autoStockajusteActions
{

	public function executeIndex(sfWebRequest $request){
    if ($request->hasParameter('producto_id')) {
        $filtros = array(
          'producto_id' => $request->getParameter('producto_id'),
          'nro_lote' => array('text' => urldecode($request->getParameter('nro_lote'))),
          'zona_id' => $request->getParameter('zona_id')
        );
        $this->setFilters($filtros);
    }
    parent::executeIndex($request);
  }  
	
	public function executeGet_lotes_producto(sfWebRequest $request){
    $pid = $request->getParameter('pid');
    $zid = $request->getParameter('zid');
		$lotes = Doctrine::getTable('Lote')->getLotesProductoZona($pid, $zid);
		
		echo '<option value=""></option>';
		foreach ($lotes as $lote) {
			echo '<option value="'.$lote->nro_lote.'">'.$lote->nro_lote.'</option>';
		}

    return sfView::NONE;
	}
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $lote_ajuste = $form->save();
			
			// esta fucnion no debiera traer mas de una fila, xq cuando se compra mas cantidad de un mismo lote se actualiza la cantidad
			$lotes = Doctrine::getTable('Lote')->getLotesProductoZona($lote_ajuste->producto_id, $lote_ajuste->zona_id);
			$lote = $lotes[0];
			// la cantidad del ajuste puede ser negativa
			// si tengo 7 comprados y 3 vendidos y en cantidad real de stock tengo 4, el ajuste tiene que ser negativo
			// si tengo 7 comprados y 3 vendidos y en cantidad real de stock tengo 2, esto no deberia haber pasado pero si pasa el ajuste tiene que ser positivo
			$lote->stock += $lote_ajuste->cantidad;
			$lote->save();

      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@lote_ajuste_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $lote_ajuste->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'lote_ajuste_edit', 'sf_subject' => $lote_ajuste));
          $this->redirect('@lote_ajuste');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
	public function executeNew(sfWebRequest $request){
		$parametros_form = array(
			// 'zona_id' => $this->getUser()->getGuardUser()->getZonaId(),
			'usuario_id' => $this->getUser()->getGuardUser()->getId(),
		);
		$this->form = $this->configuration->getForm(null, $parametros_form);
    $this->lote_ajuste = $this->form->getObject();
  }

}