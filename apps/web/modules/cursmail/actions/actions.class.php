<?php

require_once dirname(__FILE__).'/../lib/cursmailGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cursmailGeneratorHelper.class.php';

/**
 * cursmail actions.
 *
 * @package    odontopc
 * @subpackage cursmail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cursmailActions extends autoCursmailActions
{

  public function executeNew(sfWebRequest $request)
  {
		
		@$curso_id = $request->getParameter('cid');
		if (!empty($curso_id)) {
			$curso = Doctrine::getTable('Curso')->find($curso_id);		
			$this->form = $this->configuration->getForm();
			$this->form->setDefault('curso_id', $curso->getId());
		} else {
			$this->form = $this->configuration->getForm();
		}
		$this->curso_mail_enviado = $this->form->getObject();
  }
	
  public function executeEnviar(sfWebRequest $request)
  {
		$curso_id = $request->getParameter('cid');
		$tipo_id = $request->getParameter('tid');
		if ($tipo_id == 3) { // a todos los clientes
			$mails_clientes = Doctrine::getTable('Cliente')->getClientesEnviarCurso($curso_id);
			$lista_correo = '';
			foreach($mails_clientes as $fila){
				if (filter_var($fila['email'], FILTER_VALIDATE_EMAIL)) {
						$lista_correo[] = trim($fila['email']);
				}
			}
			if (!empty($lista_correo)) {
				$resultado = $this->enviarMail($lista_correo, $curso_id);
				if ($resultado) {
					foreach($mails_clientes as $fila){
						$curso_mail = new CursoMailEnviado();
						$curso_mail->setCursoId($curso_id);
						$curso_mail->setEMail(trim($fila['email']));
						$curso_mail->setClienteId($fila['id']);
						$curso_mail->setUsuario($this->getUser()->getId());
						$curso_mail->setTipoEnvio($tipo_id);
						$curso_mail->save();					
					}
					$this->setFilters(array("curso_id" => $curso_id));
					$this->getUser()->setFlash('notice', 'Se enviaron correctamente 20 correos, en 5 munutos se volveran enviar otros 20 y así hasta terminar la lista de clientes. POR FAVOR NO CIERRE ESTA VENTANA.');
					$response = $this->getResponse();
					$response->setHttpHeader('refresh', '3; url=enviar?cid='.$curso_id.'&tid='.$tipo_id);
				}
			} else {
				$this->setFilters(array("curso_id" => $curso_id));
				$this->getUser()->setFlash('notice', 'Envio finalizado!. Ya puede cerrar esta ventana.');
			}
		} elseif ($tipo_id == 2) { // a un cliente
			$cliente_id = $request->getParameter('cli');
			$cliente = Doctrine::getTable('Cliente')->find($cliente_id);
			$cli_email = trim($cliente->getEmail());
			if (!empty($cli_email)) {
				$lista_correo = array($cli_email => trim($cliente->getApellido().' '.$cliente->getNombre()));
				$resultado = $this->enviarMail($lista_correo, $curso_id);
				if ($resultado) {
					$curso_mail = new CursoMailEnviado();
					$curso_mail->setCursoId($curso_id);
					$curso_mail->setEMail($cli_email);
					$curso_mail->setClienteId($cliente_id);
					$curso_mail->setUsuario($this->getUser()->getId());
					$curso_mail->setTipoEnvio($tipo_id);
					$curso_mail->save();				
					$this->setFilters(array("curso_id" => $curso_id, "cliente_id" => $cliente_id));
					$this->getUser()->setFlash('notice', 'Correo enviado correctamente a '.trim($cliente->getApellido().' '.$cliente->getNombre()).' ('.$cli_email.')');
				}
			} else {
				$this->getUser()->setFlash('error', 'El cliente seleccionado no posee un Email válido');
			}
		} else { // $tipo_id == 1 // a un email en particular
			$email = trim($request->getParameter('email'));
			if (!empty($email)) {
				$resultado = $this->enviarMail($email, $curso_id);
				if ($resultado) {
					$curso_mail = new CursoMailEnviado();
					$curso_mail->setCursoId($curso_id);
					$curso_mail->setEMail($email);
					$curso_mail->setUsuario($this->getUser()->getId());
					$curso_mail->setTipoEnvio($tipo_id);
					$curso_mail->save();					
					$this->setFilters(array("curso_id" => $curso_id, "e_email" => $email));
					$this->getUser()->setFlash('notice', 'Correo enviado correctamente a '.$email);
				}
			} else {
				$this->getUser()->setFlash('error', 'El correo no es un Email válido');
			}
		}
		$this->hasFilters = $this->getUser()->getAttribute('cursmail.filters', $this->configuration->getFilterDefaults(), 'admin_module');				
		$this->pager = $this->getPager();
		$this->sort = $this->getSort();
		$this->setLayout('layout_enviador_mail');
  }

  private function enviarMail($p_email, $p_id_curso){
    $o_curso = Doctrine_Core::getTable('Curso')->find($p_id_curso);
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
    //$mensaje->setTo($p_email);
    $mensaje->setBcc($p_email);
    $mensaje->setSubject('CURSOS NTI IMPLANTES');
    $headers = $mensaje->getHeaders();
    $headers->addTextHeader('Content-Type', 'text/html');    
    $msj = '<html><head><meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body>';
    $msj .= "Hola!. Desde NTI Implantes estamos promocionando el curso : <b>".$o_curso->getNombre()."</b><br>";
    $msj .= "Este curso comienza el dia: <b>".implode('/', array_reverse(explode('-', $o_curso->getFecha())))."</b> a la hora: <b>".$o_curso->getHora()."</b><br>";
    $msj .= "A realizarce en : <b>".$o_curso->getLugar()."</b><br>";
    //$msj .= "Para mas informacion ingrese en el siguiente enlace: <a href=\"http://sistema.ntiimplantes.com.ar/web/curso.php/ver/1/".$p_id_curso."\">sistema.ntiimplantes.com.ar/web/curso/ver/".$p_id_curso."</a><br>";
		$msj .= '<img src="http://sistema.ntiimplantes.com.ar/web/uploads/cursos/'.$o_curso->getLogo().'" alt="'.$o_curso->getNombre().'">';
		//$msj .= '<br><p style="color: #999999;font-size: 12px;text-align: center;">¿Deseas dejar de recibir estos emails? Click <a href="http://sistema.ntiimplantes.com.ar/web/curso.php/desuscribir/'.$p_email.'">aquí</a></p>';
		//$msj .= '<p style="color: #999999;font-size: 12px;text-align: center;">NTI Implantes | Pascual Palma 666 | Paraná - Entre Ríos | 3100</p>';
    $msj .= "</body></html>";
    $mensaje->setBody($msj, "text/html");
    return $this->getMailer()->send($mensaje);
  }
  
	/*
  protected function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      $valores = $form->getValues();
      $direcciones = explode(';', $valores['e_mail']);
      foreach($direcciones as $k => $v){
        $curso_mail = new CursoMailEnviado();
        $curso_mail->setCursoId($valores['curso_id']);
        $curso_mail->setEMail(trim($v));
        $curso_mail->setFecha(date("Y-m-d"));
        $curso_mail->save();
        $this->enviarMail(trim($v), $curso_mail->getCursoId(), $curso_mail->getId());
      }
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $curso_mail)));
    
      if ($request->hasParameter('_save_and_add')){
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@curso_mail_enviado_new');
      }else{
        if ($request->hasParameter('rtn')){
          return $curso_mail->getId();
        }else{
          $this->getUser()->setFlash('notice', $notice);
          $this->redirect('@curso_mail_enviado');
        }
      }
      
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
	*/
}
