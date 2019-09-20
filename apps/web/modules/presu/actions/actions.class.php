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
      $presu = $form->save();      
      $this->redirect( 'detpresu/new?pid='.$presu->getId());
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
    
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI Implantes'));
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
    $this->redirect('presupuesto');
  }
}
