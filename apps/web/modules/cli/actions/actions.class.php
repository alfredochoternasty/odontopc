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
    $cliente = Doctrine::getTable('Cliente')->find($request->getParameter('id'));
    $correo = $cliente->getEmail();
    if(empty($correo)){
      $this->getUser()->setFlash('error', 'El usuario no posee Email - '.$correo);
      $this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
    }else{
      $usuario = $cliente->getUsuarioId();
      $nombres = explode(' ', $cliente->getNombre()); // exploto x si tiene 2 nombres cargado
      $clave = strtolower($nombres[0]).rand(1, 9999); //para la clave uso el primer nombre que tenga guardado	
      if(empty($usuario)){
        $user = new sfGuardUser();
        $accion = 'generado';
        $user->setEmailAddress($cliente->getEmail());
        $usuario = strtolower(str_replace(" ", "", substr($cliente->getNombre(), 0, 2).$cliente->getApellido()));//para el usuario, uso las 2 primeras letras del nombre y el apellido, todo junto y en minuscula		
        $user->setUsername($usuario); 
        $user->setIsActive(true);
        $user->setIsSuperAdmin(false);
        $user->setFirstName($cliente->getNombre());
        $user->setLastName($cliente->getApellido());
        $user->setPassword($clave);
        $user->save();      

        $perfil = new sfGuardUserPermission();
        $perfil->setUserId($user->getId());
        $perfil->setPermissionId(4);
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
      $mensaje->setTo($cliente->getEmail());
      $mensaje->setSubject('NTI Sistema de Pedidos');
      $headers = $mensaje->getHeaders();
      $headers->addTextHeader('Content-Type', 'text/html');    
      $msj = '<html><head><meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body>';
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
      
      $this->redirect(array('sf_route' => 'cliente_edit', 'sf_subject' => $cliente));
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
    $clientes = $consulta->execute();
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($this->getPartial("imprimir", array("clientes" => $clientes)));
    $dompdf->set_paper('letter','landscape');
    $dompdf->render();
    $dompdf->stream("clientes.pdf");    
    return sfView::NONE;
  }
  
  public function executeCargar(sfWebRequest $request){
    $this->form = new ClienteForm();
    $this->cliente = $this->form->getObject();    
    $this->setTemplate('new_cli');
  } 
  
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $cliente = $form->save();
      $enviado = $this->enviar_cliente($cliete);
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
  
  protected function enviar_cliente($p_obj)
  {
    
    $postdata = http_build_query(array('obj' => get_object_vars($p_obj)));
    $opts = array('http' => 
      array (
        'method' => 'POST',
        'header' => 'Content-type: application/xwww-form-urlencoded',
        'content' => $postdata
      )
    );
    $context  = stream_context_create($opts);
    $url = 'http://www.example.com/api/do/something/';
    return file_get_contents($url, false, $context);    
  }
}