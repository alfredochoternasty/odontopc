<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TipoCliente', 'doctrine');

/**
 * BaseTipoCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property Doctrine_Collection $Clientes
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $ListadoCobros
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getNombre()        Returns the current record's "nombre" value
 * @method Doctrine_Collection getClientes()      Returns the current record's "Clientes" collection
 * @method Doctrine_Collection getListadoVentas() Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getListadoCobros() Returns the current record's "ListadoCobros" collection
 * @method TipoCliente         setId()            Sets the current record's "id" value
 * @method TipoCliente         setNombre()        Sets the current record's "nombre" value
 * @method TipoCliente         setClientes()      Sets the current record's "Clientes" collection
 * @method TipoCliente         setListadoVentas() Sets the current record's "ListadoVentas" collection
 * @method TipoCliente         setListadoCobros() Sets the current record's "ListadoCobros" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoCliente extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_cliente');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Cliente as Clientes', array(
             'local' => 'id',
             'foreign' => 'tipo_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'tipo_id'));

        $this->hasMany('ListadoCobros', array(
             'local' => 'id',
             'foreign' => 'tipo_cliente'));
    }
}