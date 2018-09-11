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
	
	public function executeList_usuario(sfWebRequest $request)
	{
		$this->GenerarUsuario($request);
		$this->redirect(array('sf_route' => 'cliente'));
	}
	
  private function GenerarUsuario(sfWebRequest $request)
  {
    $cliente = Doctrine::getTable('Cliente')->find($request->getParameter('id'));
    $correo = trim($cliente->getEmail());
		if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
				$this->getUser()->setFlash('error', 'El usuario no posee Email correcto - '.$correo);
				$this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));		
		}
    if(empty($correo)){
      $this->getUser()->setFlash('error', 'El usuario no posee Email');
      $this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
    }else{
      $usuario = $cliente->getUsuarioId();
      $nombres = explode(' ', $cliente->getNombre()); // exploto x si tiene 2 nombres cargado
      $clave = strtolower($nombres[0]).rand(1, 9999); //para la clave uso el primer nombre que tenga guardado	
			$nom_usuario = strtolower(str_replace(' ', '', substr($cliente->getNombre(), 0, 2).$cliente->getApellido()));//para el usuario, uso las 2 primeras letras del nombre y el apellido, todo junto y en minuscula
			$usuario_existe = Doctrine::getTable('sfGuardUser')->findByUsername($nom_usuario);
			if (!empty($usuario_existe)) {
				$nom_usuario = strtolower(str_replace(' ', '', substr($cliente->getNombre(), 0, 3).$cliente->getApellido()));
			}
			
      if(empty($usuario)){
        $user = new sfGuardUser();
        $accion = 'generado';
        $user->setEmailAddress($correo);				
        $user->setUsername($nom_usuario); 
        $user->setIsActive(true);
        $user->setIsSuperAdmin(false);
        $user->setFirstName($cliente->getNombre());
        $user->setLastName($cliente->getApellido());
        $user->setPassword($clave);
        $user->save();      

        $perfil = new sfGuardUserGroup();
        $perfil->setUserId($user->getId());
        $perfil->setGroupId(4);
        $perfil->save();
      }else{
        $user = Doctrine::getTable('sfGuardUser')->find($usuario);
        $usuario = $user->getUsername();
        $accion = 'actualizado';
        $user->setPassword($clave);
        $user->save();      	  
      }
      
      $cliente->setUsuarioId($user->getId());
      $cliente->save();

      $mensaje = Swift_Message::newInstance();
      $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
      $mensaje->setTo($correo);
      $mensaje->setSubject('NTI Sistema de Pedidos');
      $headers = $mensaje->getHeaders();
      $headers->addTextHeader('Content-Type', 'text/html');    
      $msj = '<html><head><meta http-equiv="content-type" content="text/html; charset=WINDOWS-1252"></head><body>';
      $msj .= "<b>Nuevo Sistema para realizar pedidos de productos</b> </br>";
      $msj .= "Para ingresar a este sistema haga click en el siguiente enlace <a href=\"sistema.ntiimplantes.com.ar/web\">sistema.ntiimplantes.com.ar/web</a> </br>";
      $msj .= "<b>USUARIO: </b> ".$usuario." <br>";
      $msj .= "<b>CLAVE: </b> ".$clave." <br>";
      $msj .= "</body></html>";
      $mensaje->setBody($msj, "text/html");
      
      $entorno = sfConfig::get('sf_environment');
      echo $entorno;
      if($entorno != 'dev'){
        $this->getMailer()->send($mensaje);            
        $this->getUser()->setFlash('notice', 'Usuario '.$accion.'. Se enviaron los datos a '.$cliente->getEmail());
      }else{
        $this->getUser()->setFlash('notice', $accion.' - Usuario: '.$usuario.' - Clave: '.$clave );
      }
    }
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
      
      /* esto es para enviar al otro sistema*/
      $a_cliente['tipo_id'] = $cliente->tipo_id;
      $a_cliente['dni'] = $cliente->dni;
      $a_cliente['cuit'] = $cliente->cuit;
      $a_cliente['condicionfiscal_id'] = $cliente->condicionfiscal_id;
      $a_cliente['sexo'] = $cliente->sexo;
      $a_cliente['apellido'] = $cliente->apellido;
      $a_cliente['nombre'] = $cliente->nombre;
      $a_cliente['domicilio'] = $cliente->domicilio;
      $a_cliente['localidad_id'] = $cliente->localidad_id;
      $a_cliente['telefono'] = $cliente->telefono;
      $a_cliente['celular'] = $cliente->celular;
      $a_cliente['fax'] = $cliente->fax;
      $a_cliente['email'] = $cliente->email;
      $a_cliente['observacion'] = $cliente->observacion;
      $a_cliente['lista_id'] = $cliente->lista_id;
      $a_cliente['activo'] = $cliente->activo;
      
      if ($es_nuevo) {
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
    foreach($arr_datos as $k => $v){
      $vars[] = $k.'='.urlencode($v);
    }
		
		if ($this->getUser()->hasGroup('Blanco')) {
				$url = 'http://sistema.ntiimplantes.com.ar/web/cliente.php?'.implode('&', $vars);
		} else {
				$url = 'http://ventas.ntiimplantes.com.ar/web/cliente.php?'.implode('&', $vars);
		}
    
    return file_get_contents($url);
  }
}