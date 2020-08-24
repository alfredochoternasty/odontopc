<?php

require_once dirname(__FILE__).'/../lib/registroGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/registroGeneratorHelper.class.php';

/**
 * registro actions.
 *
 * @package    odontopc
 * @subpackage registro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registroActions extends autoRegistroActions
{
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $cliente = $form->save();
			
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$clave = substr(str_shuffle($chars),0,8);
			$user = new sfGuardUser();
			$user->setEmailAddress($cliente->email);
			$user->setUsername($cliente->dni); 
			$user->setIsActive(true);
			$user->setIsSuperAdmin(false);
			$user->setFirstName($cliente->nombre);
			$user->setLastName($cliente->apellido);
			$user->setPassword($clave);
			$user->setEsCliente(true);
			$user->setZonaId($cliente->zona_id);
			$user->save();
			
			$cliente->setUsuarioId($user->getId());
			$cliente->setModoAlta('web');
			// $cliente->setFechaAlta(date('Y-m-d'));
			$cliente->save();
			
			$mensaje = Swift_Message::newInstance();
			$mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
			$mensaje->setTo($cliente->email);
			$mensaje->setSubject('NTI Sistema de Pedidos');
			$headers = $mensaje->getHeaders();
			$headers->addTextHeader('Content-Type', 'text/html');
			$msj = $this->getPartial('mail_usuario', array('cliente' => $cliente, 'clave' => $clave));
			$mensaje->setBody($msj, "text/html");
			$this->getMailer()->send($mensaje);   
			
			$this->redirect('registro/listo?cid='.$cliente->id);
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	
  public function executeListo(sfWebRequest $request)
  {
		$this->cliente = Doctrine::getTable('Cliente')->find($request->getParameter('cid'));
	}
}
