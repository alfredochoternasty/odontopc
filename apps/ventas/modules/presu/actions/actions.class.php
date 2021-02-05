<?php

require_once dirname(__FILE__).'/../lib/presuGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/presuGeneratorHelper.class.php';

/**
 * presu actions.
 *
 * @package    odontopc
 * @subpackage presu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class presuActions extends autoPresuActions
{
  public function executeListDetalle(sfWebRequest $request){
    $this->redirect( 'detpresu/index?pid='.$this->getRequestParameter('id'));
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $presupuesto = $form->save();
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $presupuesto)));
      if ($request->hasParameter('_save_and_add')){
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
        $presu = $form->save();      
        $this->redirect( 'detpresu/new?pid='.$presu->getId());
      }else{
        if ($request->hasParameter('rtn')){
          return $presupuesto->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'presupuesto_edit', 'sf_subject' => $presupuesto));
          $this->redirect('@presupuesto');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeListImprimir(sfWebRequest $request){
    $pid = $this->getRequestParameter('id');
    $presupuesto = Doctrine::getTable('Presupuesto')->find($pid);
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("detpresu/imprimir", array("presupuesto" => $presupuesto)));
    $dompdf->set_paper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("presupuesto.pdf");    
    return sfView::NONE;
  }

  public function executeListMail(sfWebRequest $request){
    $presu = Doctrine::getTable('Presupuesto')->find($this->getRequestParameter('id'));
    if (!empty($presu->email)) {
      $mensaje = Swift_Message::newInstance();
      $mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
      $mensaje->setTo($presu->email);
      $mensaje->setSubject('Presupuesto - NTI Implantes');

      $dompdf = new DOMPDF();
      $dompdf->load_html($this->getPartial("detpresu/imprimir", array("presupuesto" => $presu)));
      $dompdf->set_paper('A4','portrait');
      $dompdf->render();
    
      $presupuesto = $dompdf->output();
      $adjunto = new Swift_Attachment($presupuesto, 'presupuesto.pdf', 'application/pdf');
      $mensaje->attach($adjunto);
      $this->getMailer()->send($mensaje);
      
      $this->getUser()->setFlash('notice', 'El mail se enviado correctamente a la direccion '.$presu->email);
    } else {
      $this->getUser()->setFlash('error', 'El presupues no tiene una Email a donde enviarlo');
    }
    $this->redirect('presupuesto');
  }
  
  public function executeNew(sfWebRequest $request)
  {
		$zid = $this->getUser()->getGuardUser()->getZonaId();
		$this->form = $this->configuration->getForm(null, array('zona_id' => $zid));
		$this->presupuesto = $this->form->getObject();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
		$zid = $this->getUser()->getGuardUser()->getZonaId();
    $this->presupuesto = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->presupuesto, array('zona_id' => $zid));
  }
}
