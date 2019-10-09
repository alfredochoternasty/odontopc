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
		$usuario = $cliente->dni;
		$clave = 'abc123456';
    
		if(empty($usuario)){
      $this->getUser()->setFlash('error', 'El cliente debe tener cargado un DNI');
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
		
		if(empty($cliente->usuario_id)){
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
			$user->save();      

			$perfil = new sfGuardUserGroup();
			$perfil->setUserId($user->getId());
			$perfil->setGroupId(4);
			$perfil->save();
			
			$perfil = new sfGuardUserGroup();
			$perfil->setUserId($user->getId());
			$perfil->setGroupId(7);
			$perfil->save();
			
			$permiso = new sfGuardUserPermission();
			$permiso->setUserId($user->getId());
			$permiso->setPermissionId(81);
			$permiso->save();
			
			$permiso = new sfGuardUserPermission();
			$permiso->setUserId($user->getId());
			$permiso->setPermissionId(82);
			$permiso->save();
			
			$permiso = new sfGuardUserPermission();
			$permiso->setUserId($user->getId());
			$permiso->setPermissionId(83);
			$permiso->save();
			
			$cliente->setUsuarioId($user->getId());
			$cliente->save();
			
		}else{
			$user = Doctrine::getTable('sfGuardUser')->find($cliente->usuario_id);
			$accion = 'actualizado';
			$user->setPassword($clave);
			$user->save();      	  
		}

		$mensaje = Swift_Message::newInstance();
		$mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
		$mensaje->setTo($correo);
		$mensaje->setSubject('NTI Sistema de Pedidos');
		$headers = $mensaje->getHeaders();
		$headers->addTextHeader('Content-Type', 'text/html');
		$msj = $this->getPartial('mail_usuario', array('cliente' => $cliente));			
		$mensaje->setBody($msj, "text/html");
		$this->getMailer()->send($mensaje);    
		
		$entorno = sfConfig::get('sf_environment');
		if($entorno != 'dev'){
			$this->getUser()->setFlash('notice', 'Usuario '.$accion.'. Se enviaron los datos a '.$cliente->getEmail());
		}else{
			$this->getUser()->setFlash('notice', $accion.' - Usuario: '.$usuario.' - Clave: '.$clave );
		}
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
    $this->form = $this->configuration->getForm();
    $this->cliente = $this->form->getObject();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->cliente = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->cliente);
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
  
  public function executeListImprimir(sfWebRequest $request){
    $filtro = new ClienteFormFilter();
    $consulta = $filtro->buildQuery($this->getFilters());
		$consulta->andWhere('activo = 1');
		$consulta->addOrderBy('apellido');
    $clientes = $consulta->execute();
    
    header("Content-Disposition: attachment; filename=\"clientes.xls\"");
    header("Content-Type: application/vnd.ms-excel");
    
    echo 'Listado de Clientes Activos' . "\r\n";
    $titulos = array('Tipo', 'Apellido', 'Nombre', 'Tel.', 'Celular', 'Email', 'Localidad');
    $flag = false;
    foreach($clientes as $cliente):
          if (!$flag) {
              echo implode("\t", $titulos) . "\r\n";
              $flag = true;
          }  
          $fila = array($cliente->getTipo(), $cliente->getApellido(), $cliente->getNombre(), $cliente->getTelefono(), $cliente->getCelular(), $cliente->getEmail(), $cliente->getLocalidad());
          $string = implode("\t", array_values($fila));
          echo utf8_decode($string)."\r\n"; 
    endforeach;
    
    /*$dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("clientes" => $clientes)));
    $dompdf->set_paper('letter','landscape');
    $dompdf->render();
    $dompdf->stream("clientes.pdf"); 
    */
    return sfView::NONE;
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
      
			$a_cliente = $cliente->toArray();
			$enviado = $this->enviar_cliente($a_cliente);
			if($enviado == true){
				$this->getUser()->setFlash('notice', 'Cliente tambien agregado en el otro sistema');
			} else {
				$this->getUser()->setFlash('notice', 'Error: '.$enviado);
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
		
		if ($this->getUser()->hasGroup('Blanco')) {
				$url = 'http://sistema.ntiimplantes.com.ar/web/cliente.php?'.implode('&', $vars);
				// $url = 'http://localhost/odontopc/web/cliente.php?'.implode('&', $vars);
		} else {
				$url = 'http://ventas.ntiimplantes.com.ar/web/cliente.php?'.implode('&', $vars);
		}
    
    echo file_get_contents($url);
  }
}