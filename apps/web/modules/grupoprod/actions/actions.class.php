<?php

require_once dirname(__FILE__).'/../lib/grupoprodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/grupoprodGeneratorHelper.class.php';

/**
 * grupoprod actions.
 *
 * @package    odontopc
 * @subpackage grupoprod
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class grupoprodActions extends autoGrupoprodActions
{
	
  public function executeEdit(sfWebRequest $request)
  {
    $this->grupoprod = $this->getRoute()->getObject();
		$productos = Doctrine::getTable('Producto')->findByGrupoprodId($this->grupoprod->id);
		foreach ($productos as $prod) $lista[$prod->id] = $prod->nombre;
    $this->form = $this->configuration->getForm($this->grupoprod, array('productos' => $lista));
  }
	
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
			$datos = $request->getParameter('grupoprod');
      $grupoprod = $form->save();
			
			if (!empty($datos['operacion'])) {
				if ($datos['operacion'] == 'precio') {
					$str_set = "'".$datos['precio_vta']."'";
				} elseif($datos['operacion'] == 'aumento') {
					$str_set = "(precio_vta*".$datos['porcentaje']."/100+precio_vta)";
				} elseif($datos['operacion'] == 'descuento') {
					$str_set = "(precio_vta-".$datos['porcentaje']."*precio_vta/100)";
				}
				Doctrine::getTable('Producto')->createQuery()
					->update()
					->set('precio_vta', $str_set)
					->where('id in ('.implode(', ', $datos['productos']).')')
					->execute();
			}

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $grupoprod)));
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@grupoprod_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $grupoprod->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'grupoprod_edit', 'sf_subject' => $grupoprod));
          $this->redirect('@grupoprod');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
