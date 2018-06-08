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

  private function enviarMail($p_email, $p_id_curso, $p_id_envio){
    $o_curso = Doctrine_Core::getTable('Curso')->find($p_id_curso);
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
    $mensaje->setTo($p_email);
    $mensaje->setSubject('Inscripcion a Curso');
    $headers = $mensaje->getHeaders();
    $headers->addTextHeader('Content-Type', 'text/html');    
    $msj = '<html><head><meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body>';
    $msj .= "Hola!. Desde NTI Implantes estamos promocionando un el curso : <b>".$o_curso->getNombre()."</b><br>";
    $msj .= "Este evento comienza el dia: <b>".implode('/', array_reverse(explode('-', $o_curso->getFecha())))."</b> a la hora: <b>".$o_curso->getHora()."</b><br>";
    $msj .= "A realizarce en : <b>".$o_curso->getLugar()."</b><br>";
    $msj .= "Para mas informacion ingrese en el siguiente enlace: <a href=\"sistema.ntiimplantes.com.ar/web/curso.php/ver/".$p_id_curso."/".$p_id_envio."\">sistema.ntiimplantes.com.ar/web/curso/ver/".$p_id_curso."/".$p_id_envio."</a><br>";
    $msj .= "</body></html>";
    $mensaje->setBody($msj, "text/html");
    $this->getMailer()->send($mensaje);
  }
  
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
}
