<?php

require_once dirname(__FILE__).'/../lib/promoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/promoGeneratorHelper.class.php';

/**
 * promo actions.
 *
 * @package    odontopc
 * @subpackage promo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class promoActions extends autoPromoActions
{
	public function executeGetProductosGrupo(sfWebRequest $request)
	{
		$gid = $request->getParameter('gid');
		$productos = Doctrine::getTable('Producto')->findByGrupoprodIdAndActivo($gid, 1);
		$prods = array();
		foreach ($productos as $producto) {
			$prods[] = '<input type="checkbox" name="promocion[productos][]" value="'.$producto->id.'" id="promocion_productos_'.$producto->id.'">&nbsp;<label for="promocion_productos_'.$producto->id.'">'.$producto->nombre.'</label>';
		}
		return $this->renderText('<li class="ui-corner-all" style="margin-left:50px;">'.implode('</li><li class="ui-corner-all" style="margin-left:50px;">', $prods).'</li>');
	}
	
  public function executeEdit(sfWebRequest $request)
  {
    $this->promocion = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->promocion);
		$this->productos_requisitos = Doctrine::getTable('PromocionProducto')->findByPromocionId($this->promocion->id);
		$this->productos_promo = Doctrine::getTable('PromocionRegalo')->findByPromocionId($this->promocion->id);
  }
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
			$datos = $request->getParameter('promocion');
      $promocion = $form->save();
			
			// pregunto si hay productos selecionados en la promocion
			if (!empty($datos['productos'])) {
				foreach ($datos['productos'] as $producto_id) {
					
					if ($datos['agregar_como'] == 3) // selecciono poner el producto como requisito y como promocion
						$modelos = array('PromocionProducto', 'PromocionRegalo');
					else // eligió una sola opcion
						$modelos[] = ($datos['agregar_como'] == 1)?'PromocionProducto':'PromocionRegalo';
					
					foreach ($modelos as $modelo) {
						$prods = Doctrine::getTable($modelo)->findByPromocionIdAndProductoId($promocion->id, $producto_id);
						if (!count($prods)) {
							$pp = new $modelo;
							$pp->promocion_id = $promocion->getId();
							$pp->producto_id = $producto_id;
							$pp->save();
						}
					}
				}
			}
			
			$this->getUser()->setFlash('notice', $notice);
			$this->redirect('promo/edit?id='.$promocion->getId().'#sf_fieldset_agregar_productos');
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
	public function executeListBorrarProdRequisito(sfWebRequest $request)
	{
		$pid = $request->getParameter('pid');
		$pp = Doctrine::getTable('PromocionProducto')->find($pid);
		$promo_id = $pp->promocion_id;
		$pp->delete();
		$this->getUser()->setFlash('notice', 'The item was deleted successfully.');
		$this->redirect('promo/edit?id='.$promo_id);
	}
	
	public function executeListBorrarProdPromo(sfWebRequest $request)
	{
		$pid = $request->getParameter('pid');
		$pp = Doctrine::getTable('PromocionRegalo')->find($pid);
		$promo_id = $pp->promocion_id;
		$pp->delete();
		$this->getUser()->setFlash('notice', 'The item was deleted successfully.');
		$this->redirect('promo/edit?id='.$promo_id);
	}
}
