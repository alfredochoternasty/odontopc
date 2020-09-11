<?php

/**
 * ctacte actions.
 *
 * @package    odontopc
 * @subpackage ctacte
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ctacteActions extends sfActions
{
  public function executeVer(sfWebRequest $request){
    $id_usuario = $this->getUser()->getGuardUser()->getId();
    $clientes = Doctrine::getTable('Cliente')->findByUsuarioId($id_usuario);
    $id_cliente = $clientes[0]->getId()?:0;
    $this->saldo = $clientes[0]->getSaldoCtaCte(1, null, true);
    $this->ctacte = Doctrine::getTable('CtaCte')->createQuery('c')->where('cliente_id = '.$id_cliente)->orderBy('c.fecha DESC')->execute();
    $this->setLayout('layout_app');
  }
}