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
		$lista = '';
		$grupoprods = $this->grupoprod->getProductos();
		foreach ($grupoprods as $prod) $lista[$prod->id] = $prod->nombre;
    $this->form = $this->configuration->getForm($this->grupoprod, array('productos' => $lista, 'base_url' => $this->getUser()->getVarConfig('base_url')));
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
			
      if (!empty($grupoprod->foto)) {
        list($filename, $extension) = explode('.', $grupoprod->foto);
        $ruta = sfConfig::get('sf_upload_dir').'/productos/'.$filename.'.'.$extension;
        $ruta_chica = sfConfig::get('sf_upload_dir').'/productos/'.$filename.'_chica.'.$extension;
        if ($datos_prod['foto_delete'] == 'on') {
          unlink($ruta);
          unlink($ruta_chica);
          $grupoprod->foto = '';
          $grupoprod->foto_chica = '';
          $grupoprod->save();
        } else {
          $img = new sfImage($ruta, 'image/'.$extension);
          $img->thumbnail(50,50);
          $img->setQuality(50);
          $img->saveAs($ruta_chica);
          $grupoprod->setFotoChica($filename.'_chica.'.$extension);
          $grupoprod->save();
        }
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
