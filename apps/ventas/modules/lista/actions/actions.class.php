<?php

require_once dirname(__FILE__).'/../lib/listaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listaGeneratorHelper.class.php';

/**
 * lista actions.
 *
 * @package    odontopc
 * @subpackage lista
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listaActions extends autoListaActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detlis/index?lid='.$this->getRequestParameter('id'));
  }
  
  public function executeListImprimir(sfWebRequest $request){
		$consulta = Doctrine_Query::create()
			->from('ListaPrecioDetalle')
			->where('lista_id = ?', $this->getRequestParameter('id'));
			//->orderBy('grupo_nombre asc, grupo_producto_nombre asc, producto_nombre asc');
    $listas = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("listas" => $listas)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("lista.pdf");    
    return sfView::NONE;
  }
	
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $lista_precio = $form->save();
	  Doctrine_Query::create()
		  ->update('ListaPrecio l')
		  ->set('l.defecto', '?', 0)
		  ->where('l.id <> ?', $lista_precio->getId())
		  ->execute();
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $lista_precio)));
      $this->redirect('detlis/new?lid='.$lista_precio->getId());
    }
    else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
