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
 * @property integer $cliente_id
 * @property Cliente $Cliente
 * @property Doctrine_Collection $Compra
 * @property Doctrine_Collection $Resumen
 * @property Doctrine_Collection $Cobro
 * @property Doctrine_Collection $DevProducto
 * @property Doctrine_Collection $Lote
 * @property Doctrine_Collection $ClienteSaldo
 * @property Doctrine_Collection $FacturasAfip
 * @property Doctrine_Collection $UsuarioZona
 * @property Doctrine_Collection $DescuentoZona
 * @property Doctrine_Collection $VentasZona
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getNombre()        Returns the current record's "nombre" value
 * @method integer             getClienteId()     Returns the current record's "cliente_id" value
 * @method Cliente             getCliente()       Returns the current record's "Cliente" value
 * @method Doctrine_Collection getCompra()        Returns the current record's "Compra" collection
 * @method Doctrine_Collection getResumen()       Returns the current record's "Resumen" collection
 * @method Doctrine_Collection getCobro()         Returns the current record's "Cobro" collection
 * @method Doctrine_Collection getDevProducto()   Returns the current record's "DevProducto" collection
 * @method Doctrine_Collection getLote()          Returns the current record's "Lote" collection
 * @method Doctrine_Collection getClienteSaldo()  Returns the current record's "ClienteSaldo" collection
 * @method Doctrine_Collection getFacturasAfip()  Returns the current record's "FacturasAfip" collection
 * @method Doctrine_Collection getUsuarioZona()   Returns the current record's "UsuarioZona" collection
 * @method Doctrine_Collection getDescuentoZona() Returns the current record's "DescuentoZona" collection
 * @method Doctrine_Collection getVentasZona()    Returns the current record's "VentasZona" collection
 * @method Zona                setId()            Sets the current record's "id" value
 * @method Zona                setNombre()        Sets the current record's "nombre" value
 * @method Zona                setClienteId()     Sets the current record's "cliente_id" value
 * @method Zona                setCliente()       Sets the current record's "Cliente" value
 * @method Zona                setCompra()        Sets the current record's "Compra" collection
 * @method Zona                setResumen()       Sets the current record's "Resumen" collection
 * @method Zona                setCobro()         Sets the current record's "Cobro" collection
 * @method Zona                setDevProducto()   Sets the current record's "DevProducto" collection
 * @method Zona                setLote()          Sets the current record's "Lote" collection
 * @method Zona                setClienteSaldo()  Sets the current record's "ClienteSaldo" collection
 * @method Zona                setFacturasAfip()  Sets the current record's "FacturasAfip" collection
 * @method Zona                setUsuarioZona()   Sets the current record's "UsuarioZona" collection
 * @method Zona                setDescuentoZona() Sets the current record's "DescuentoZona" collection
 * @method Zona                setVentasZona()    Sets the current record's "VentasZona" collection
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
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id'));

        $this->hasMany('Compra', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Resumen', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Cobro', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Lote', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ClienteSaldo', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('FacturasAfip', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('UsuarioZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('DescuentoZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('VentasZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));
    }
}