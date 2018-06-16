<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ClienteSaldo', 'doctrine');

/**
 * BaseClienteSaldo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $dni
 * @property string $apellido
 * @property string $nombre
 * @property string $tipo_cliente
 * @property string $simbolo
 * @property string $moneda
 * @property decimal $saldo
 * @property date $fecha
 * @property string $concepto
 * 
 * @method integer      getId()           Returns the current record's "id" value
 * @method integer      getDni()          Returns the current record's "dni" value
 * @method string       getApellido()     Returns the current record's "apellido" value
 * @method string       getNombre()       Returns the current record's "nombre" value
 * @method string       getTipoCliente()  Returns the current record's "tipo_cliente" value
 * @method string       getSimbolo()      Returns the current record's "simbolo" value
 * @method string       getMoneda()       Returns the current record's "moneda" value
 * @method decimal      getSaldo()        Returns the current record's "saldo" value
 * @method date         getFecha()        Returns the current record's "fecha" value
 * @method string       getConcepto()     Returns the current record's "concepto" value
 * @method ClienteSaldo setId()           Sets the current record's "id" value
 * @method ClienteSaldo setDni()          Sets the current record's "dni" value
 * @method ClienteSaldo setApellido()     Sets the current record's "apellido" value
 * @method ClienteSaldo setNombre()       Sets the current record's "nombre" value
 * @method ClienteSaldo setTipoCliente()  Sets the current record's "tipo_cliente" value
 * @method ClienteSaldo setSimbolo()      Sets the current record's "simbolo" value
 * @method ClienteSaldo setMoneda()       Sets the current record's "moneda" value
 * @method ClienteSaldo setSaldo()        Sets the current record's "saldo" value
 * @method ClienteSaldo setFecha()        Sets the current record's "fecha" value
 * @method ClienteSaldo setConcepto()     Sets the current record's "concepto" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseClienteSaldo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cliente_saldo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('dni', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('apellido', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('tipo_cliente', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('simbolo', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('moneda', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('saldo', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('concepto', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}