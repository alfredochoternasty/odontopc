<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Zona', 'doctrine');

/**
 * BaseZona
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property Doctrine_Collection $Cliente
 * @property Doctrine_Collection $Compra
 * @property Doctrine_Collection $Lote
 * @property Doctrine_Collection $ClienteSaldo
 * @property Doctrine_Collection $UsuarioZona
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getNombre()       Returns the current record's "nombre" value
 * @method Doctrine_Collection getCliente()      Returns the current record's "Cliente" collection
 * @method Doctrine_Collection getCompra()       Returns the current record's "Compra" collection
 * @method Doctrine_Collection getLote()         Returns the current record's "Lote" collection
 * @method Doctrine_Collection getClienteSaldo() Returns the current record's "ClienteSaldo" collection
 * @method Doctrine_Collection getUsuarioZona()  Returns the current record's "UsuarioZona" collection
 * @method Zona                setId()           Sets the current record's "id" value
 * @method Zona                setNombre()       Sets the current record's "nombre" value
 * @method Zona                setCliente()      Sets the current record's "Cliente" collection
 * @method Zona                setCompra()       Sets the current record's "Compra" collection
 * @method Zona                setLote()         Sets the current record's "Lote" collection
 * @method Zona                setClienteSaldo() Sets the current record's "ClienteSaldo" collection
 * @method Zona                setUsuarioZona()  Sets the current record's "UsuarioZona" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseZona extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('zona');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Cliente', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Compra', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Lote', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ClienteSaldo', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('UsuarioZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));
    }
}