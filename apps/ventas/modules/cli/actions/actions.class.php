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
		$this->executeEdit($request);
		$this->setTemplate('edit');
	}
	
	public function executeListUsuario(sfWebRequest $request)
	{
		$this->GenerarUsuario($request);
		$this->executeIndex($request);
		$this->setTemplate('index');
	}
	
  private function GenerarUsuario(sfWebRequest $request)
  {
		$cliente = $this->getRoute()->getObject();
		$user = empty($cliente->usuario_id)?0:$cliente->getUsuario();
		
		$correo = trim($cliente->email);
    if(empty($correo)){
      $this->getUser()->setFlash('error', 'El usuario no tiene cargado un email');
      $this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
    } elseif(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
			$this->getUser()->setFlash('error', 'El email del cliente no tiene un formato correcto - '.$correo);
			$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));		
		}
		
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$clave = substr(str_shuffle($chars),0,8);
		
		if(!$user){
			$usuario = $cliente->cuit;
			if(empty($usuario)){
				$this->getUser()->setFlash('error', 'El cliente debe tener cargado un CUIT');
				$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
			}
			
			$GuardUser = Doctrine::getTable('SfGuardUser')->findByUsername($usuario);
			if(!empty($GuardUser[0])){
				$this->getUser()->setFlash('error', 'Ya existe un usuario con el CUIT '.$usuario);
				$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
			}			
			
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
			$accion = 'actualizado';
			$usuario = $user->username;
			$user->setPassword($clave);
			$user->save();
		}

		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array($this->getUser()->getVarConfig('mail_from') => $this->getUser()->getVarConfig('mail_from_nombre')));
		$mensaje->setTo($correo);
		$mensaje->setSubject('NTI Sistema de Pedidos');
		$headers = $mensaje->getHeaders();
		$headers->addTextHeader('Content-Type', 'text/html');
		$msj = $this->getPartial('mail_usuario', array('cliente' => $cliente, 'usuario' => $usuario, 'clave' => $clave));
		$mensaje->setBody($msj, "text/html");
		$this->getMailer()->send($mensaje);    
		$this->getUser()->setFlash('notice', 'Usuario '.$accion.'. Se enviaron los datos a '.$cliente->getEmail());
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
		$parametros = array(
			'zona_id' => $zid, 
			'image_url' => !empty($this->cliente->foto_matricula)?'GetImagen?img='.$this->cliente->foto_matricula:''
		);
    $this->form = $this->configuration->getForm($this->cliente, $parametros);
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
			
			$cliente->setModoAlta('sistema');
			$cliente->setFechaAlta(date('Y-m-d'));
			$cliente->save();
      
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
  
  public function executeGetImagen(sfWebRequest $request)
  {
	  $img = $request->getParameter('img');
	  list($nom, $ext) = explode('.', $img);
	  $img = new sfImage(sfConfig::get('sf_upload_dir').'/matriculas/'.$img, 'image/'.$ext);
	  $response = $this->getResponse();
	  $response->setContentType($img->getMIMEType());
		$img->thumbnail(100,100);
		$img->setQuality(50);
	  $response->setContent($img);
	  return sfView::NONE;
  }

  public function executeVerMatricula(sfWebRequest $request)
  {
	  $img = $request->getParameter('img');
	  list($nom, $ext) = explode('.', $img);
	  $img = new sfImage(sfConfig::get('sf_upload_dir').'/matriculas/'.$img, 'image/'.$ext);
	  $response = $this->getResponse();
	  $response->setContentType($img->getMIMEType());
	  $response->setContent($img);
	  return sfView::NONE;
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