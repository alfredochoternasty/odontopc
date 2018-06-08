<?php

/**
 * cursos actions.
 *
 * @package    odontopc
 * @subpackage cursos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cursosActions extends sfActions
{
  private function enviarMailInscripcion($p_email, $p_id_curso){
    $o_curso = Doctrine_Core::getTable('Curso')->find($p_id_curso);
    $mensaje = Swift_Message::newInstance();
    $mensaje->setFrom(array('implantesnti@gmail.com' => 'NTI implantes'));
    $mensaje->setTo($p_email);
    $mensaje->setSubject('Inscripcion a Curso');
    $headers = $mensaje->getHeaders();
    $headers->addTextHeader('Content-Type', 'text/html');    
    $msj = '<html><head><meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body>';
    $msj .= "Felicitaciones!. Su inscripcion a : <b>".$o_curso->getNombre()."</b> se realizó con éxito! <br>";
    $msj .= "Este evento comienza el dia: <b>".implode('/', array_reverse(explode('-', $o_curso->getFecha())))."</b> a la hora: <b>".$o_curso->getHora()."</b><br>";
    $msj .= "A realizarce en : <b>".$o_curso->getLugar()."</b><br>";
    $msj .= "</body></html>";
    $mensaje->setBody($msj, "text/html");
    $this->getMailer()->send($mensaje);
  }

  private function verificaremail($email){
    /*if(preg_match("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$", $email)){ 
      return false; 
    }else{ */
      return true; 
    //} 
  } 

  public function executeInscribir(sfWebRequest $request){
    $r_email = $request->getParameter('email');
    $r_nombre = $request->getParameter('nombre');
    $r_curso_id = $request->getParameter('cid');
    $r_verif = $request->getParameter('verif');
    
    $r_captcha = $this->getUser()->getAttribute('resultado_captcha');
    if($r_verif != $r_captcha){
      $this->getUser()->setFlash('error', 'El resultado de la suna es incorrecto');
      $this->getUser()->setAttribute('email', $r_email);
      $this->getUser()->setAttribute('nombre', $r_nombre);        
      $this->redirect('cursos/show?id='.$r_curso_id);
    }  
    
    if(empty($r_email) || empty($r_nombre)){
      $this->getUser()->setFlash('error', 'Para poder inscribirse debe ingresar los datos solicitados');
      $this->getUser()->setAttribute('email', $r_email);
      $this->getUser()->setAttribute('nombre', $r_nombre);
      $this->redirect('cursos/show?id='.$r_curso_id);
    }else{
      $inscripto = Doctrine_Core::getTable('CursoInscripcion')->findOneByCorreo($r_email);
      if(empty($inscripto)){
        if(!$this->verificaremail($r_email)){
          $this->getUser()->setFlash('error', 'El Email ingresado no tiene el formato correcto');
          $this->getUser()->setAttribute('email', $r_email);
          $this->getUser()->setAttribute('nombre', $r_nombre);        
          $this->redirect('cursos/show?id='.$r_curso_id);        
        }
        $cliente = Doctrine_Core::getTable('Cliente')->findOneByEmail($r_email);
        if(empty($cliente)){
          $id_cli = 0;
          $es_cli = 'NO';
        }else{
          $id_cli = $cliente->getId();
          $es_cli = 'SI';
        }
        
        $envio = Doctrine_Core::getTable('CursoMailEnviado')->find($this->getUser()->getAttribute('envio_id', 0));
        if($envio != 0){
          $envio->setSeInscribio('SI');
          $envio->save();
        }
    
        $insc = new CursoInscripcion();
        $insc->setCursoId($r_curso_id);
        $insc->setClienteId($id_cli);
        $insc->setNombre($r_nombre);
        $insc->setCorreo($r_email);
        $insc->setFecha(date('Y-m-d'));
        $insc->setTipoInscId(1);
        $insc->setEsCliente($es_cli);
        $insc->save();
        $this->enviarMailInscripcion($r_email, $r_curso_id);

        $this->getUser()->setFlash('notice', 'Usted se ha inscripto en forma exitosa');
        $this->redirect('cursos/show?id='.$request->getParameter('cid'));
      }else{
        $this->getUser()->setFlash('error', 'Usted ya se encuentra inscripto a este curso');
        $this->redirect('cursos/show?id='.$request->getParameter('cid'));
      }
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->cursos = Doctrine_Core::getTable('Curso')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    if($request->hasParameter('envio')){
      $envio = Doctrine_Core::getTable('CursoMailEnviado')->find($request->getParameter('envio'));
      $envio->setLoVio('SI');
      $envio->save();
    }
    $a = rand(0, 5);
    $b = rand(0, 5);
    $this->getUser()->setAttribute("captcha", "Resultado de $a + $b ?");
    $this->getUser()->setAttribute("resultado_captcha", $a+$b);
    $this->getUser()->setAttribute("envio_id", $request->getParameter('envio'));
    $this->curso = Doctrine_Core::getTable('Curso')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->curso);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->forward404Unless(0);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless(0);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless(0);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless(0);
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless(0);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $this->forward404Unless(0);
  }
}
