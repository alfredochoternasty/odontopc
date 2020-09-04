<?php

require_once dirname(__FILE__).'/../lib/cliGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cliGeneratorHelper.class.php';

/**
 * cli actions.
 *
 * @package    odontopc
 * @subpackage cli
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cliActions extends autoCliActions
{
	
	public function executeListGenerarUsuario(sfWebRequest $request)
	{
		$this->GenerarUsuario($request);
		$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
	}
	
	public function executeListUsuario(sfWebRequest $request)
	{
		$this->GenerarUsuario($request);
		$this->redirect(array('sf_route' => 'cliente'));
	}
	
  private function GenerarUsuario(sfWebRequest $request)
  {
    $cliente = Doctrine::getTable('Cliente')->find($request->getParameter('id'));
    
		$correo = trim($cliente->email);
		$usuario = $cliente->cuit;
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$clave = substr(str_shuffle($chars),0,8);
    
		if(empty($usuario)){
      $this->getUser()->setFlash('error', 'El cliente debe tener cargado un CUIT');
      $this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
		}
		
		if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
			$this->getUser()->setFlash('error', 'El usuario no posee Email correcto - '.$correo);
			$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));		
		}
		
    if(empty($correo)){
      $this->getUser()->setFlash('error', 'El usuario no posee Email');
      $this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
    }
		
		$user = Doctrine::getTable('sfGuardUser')->findByUsername($usuario);
		if(empty($user[0])){
			$user = new sfGuardUser();
			$accion = 'generado';
			$user->setEmailAddress($correo);				
			$user->setUsername($usuario); 
			$user->setIsActive(true);
			$user->setIsSuperAdmin(false);
			$user->setFirstName($cliente->nombre);
			$user->setLastName($cliente->apellido);
			$user->setPassword($clave);
			$user->setEsCliente(true);
			$user->setZonaId($this->getUser()->getGuardUser()->getZonaId());
			$user->save();			
			$cliente->setUsuarioId($user->getId());
			$cliente->save();
		}else{
			$user = $user[0];
			$accion = 'actualizado';
			$user->setPassword($clave);
			$user->save();      	  
		}

		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
		$mensaje->setTo($correo);
		$mensaje->setSubject('NTI Sistema de Pedidos');
		$headers = $mensaje->getHeaders();
		$headers->addTextHeader('Content-Type', 'text/html');
		$msj = $this->getPartial('mail_usuario', array('cliente' => $cliente, 'clave' => $clave));
		$mensaje->setBody($msj, "text/html");
		$this->getMailer()->send($mensaje);    
		$this->getUser()->setFlash('notice', 'Usuario '.$accion.'. Se enviaron los datos a '.$cliente->getEmail());
		$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
  }

  public function executeAutocomplete(sfWebRequest $request){
    $result = Doctrine_Core::getTable('Cliente')
      ->findClientexNombre($request['q'])
      ->toKeyValueArray('id', 'ayn');
    return $this->renderText(json_encode($result));
  }

  public function executeNew(sfWebRequest $request)
  {
		$zid = $this->getUser()->getGuardUser()->getZonaId();
		$this->form = $this->configuration->getForm(null, array('zona_id' => $zid));
		$this->cliente = $this->form->getObject();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
		$zid = $this->getUser()->getGuardUser()->getZonaId();
    $this->cliente = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->cliente, array('zona_id' => $zid));
  }
  
  public function executeGuardarnuevalocalidad(sfWebRequest $request){
    $nom_loc = $request->getParameter('loc');
    $prov_loc = $request->getParameter('prov');
    $objLoc = new Localidad();
    $objLoc->setNombre($nom_loc);
    $objLoc->setProvinciaId($prov_loc);
    $objLoc->save();
    return $this->renderText(json_encode($objLoc->getId()));
  }
	
	public function getModoImpresion()
	{
		return 'landscape';
	}
	
  public function executeCargar(sfWebRequest $request){
    $this->form = new ClienteForm();
    $this->cliente = $this->form->getObject();    
    $this->setTemplate('new_cli');
  } 
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $es_nuevo = $form->getObject()->isNew();
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $cliente = $form->save();
      
			if ($this->getUser()->getVarConfig('enviar_cliente') == 'S') {
				$a_cliente = $cliente->toArray();
				$enviado = $this->enviar_cliente($a_cliente);
				if($enviado == true){
					$this->getUser()->setFlash('notice', 'Cliente tambien agregado en el otro sistema');
				} else {
					$this->getUser()->setFlash('notice', 'Error: '.$enviado);
				}
			}
			
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $cliente)));
      if ($request->hasParameter('generar_usuario')){
        $this->getUser()->setFlash('notice', ' Usuario.');
      }
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@cliente_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $cliente->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          //$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
          $this->redirect('@cliente');
        }
      }
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  protected function executeBatchDesactivar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = Doctrine_Query::create()
      ->update('Cliente c')
      ->set('c.activo', '?', 0)
      ->whereIn('id', $ids)
      ->execute();

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@cliente');
  }  
  
  protected function executeBatchActivar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = Doctrine_Query::create()
      ->update('Cliente c')
      ->set('c.activo', '?', 1)
      ->whereIn('id', $ids)
      ->execute();

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@cliente');
  }  
  
  protected function enviar_cliente($arr_datos)
  {
		unset($arr_datos['id']);
    foreach($arr_datos as $k => $v){
      $vars[] = $k.'='.urlencode($v);
    }
		$url = $this->getUser()->getVarConfig('enviar_cliente_url').'?'.implode('&', $vars);
		if (!empty($url) && $url != 'http://') echo file_get_contents($url);
  }

}