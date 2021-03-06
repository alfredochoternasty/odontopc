<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Localidad', 'doctrine');

/**
 * BaseLocalidad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property integer $provincia_id
 * @property string $codigo_postal
 * @property Provincia $Provincia
 * @property Doctrine_Collection $Cliente
 * @property Doctrine_Collection $Proveedor
 * @property Doctrine_Collection $ClienteDomicilio
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getNombre()           Returns the current record's "nombre" value
 * @method integer             getProvinciaId()      Returns the current record's "provincia_id" value
 * @method string              getCodigoPostal()     Returns the current record's "codigo_postal" value
 * @method Provincia           getProvincia()        Returns the current record's "Provincia" value
 * @method Doctrine_Collection getCliente()          Returns the current record's "Cliente" collection
 * @method Doctrine_Collection getProveedor()        Returns the current record's "Proveedor" collection
 * @method Doctrine_Collection getClienteDomicilio() Returns the current record's "ClienteDomicilio" collection
 * @method Localidad           setId()               Sets the current record's "id" value
 * @method Localidad           setNombre()           Sets the current record's "nombre" value
 * @method Localidad           setProvinciaId()      Sets the current record's "provincia_id" value
 * @method Localidad           setCodigoPostal()     Sets the current record's "codigo_postal" value
 * @method Localidad           setProvincia()        Sets the current record's "Provincia" value
 * @method Localidad           setCliente()          Sets the current record's "Cliente" collection
 * @method Localidad           setProveedor()        Sets the current record's "Proveedor" collection
 * @method Localidad           setClienteDomicilio() Sets the current record's "ClienteDomicilio" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLocalidad extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('localidad');
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
        $this->hasColumn('provincia_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('codigo_postal', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Provincia', array(
             'local' => 'provincia_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('Cliente', array(
             'local' => 'id',
             'foreign' => 'localidad_id'));

        $this->hasMany('Proveedor', array(
             'local' => 'id',
             'foreign' => 'localidad_id'));

        $this->hasMany('ClienteDomicilio', array(
             'local' => 'id',
             'foreign' => 'localidad_id'));
    }
}