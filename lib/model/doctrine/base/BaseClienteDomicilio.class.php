<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ClienteDomicilio', 'doctrine');

/**
 * BaseClienteDomicilio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $cliente_id
 * @property string $direccion
 * @property string $telefono
 * @property string $correo
 * @property string $observacion
 * @property integer $localidad_id
 * @property Cliente $Cliente
 * @property Localidad $Localidad
 * 
 * @method integer          getId()           Returns the current record's "id" value
 * @method integer          getClienteId()    Returns the current record's "cliente_id" value
 * @method string           getDireccion()    Returns the current record's "direccion" value
 * @method string           getTelefono()     Returns the current record's "telefono" value
 * @method string           getCorreo()       Returns the current record's "correo" value
 * @method string           getObservacion()  Returns the current record's "observacion" value
 * @method integer          getLocalidadId()  Returns the current record's "localidad_id" value
 * @method Cliente          getCliente()      Returns the current record's "Cliente" value
 * @method Localidad        getLocalidad()    Returns the current record's "Localidad" value
 * @method ClienteDomicilio setId()           Sets the current record's "id" value
 * @method ClienteDomicilio setClienteId()    Sets the current record's "cliente_id" value
 * @method ClienteDomicilio setDireccion()    Sets the current record's "direccion" value
 * @method ClienteDomicilio setTelefono()     Sets the current record's "telefono" value
 * @method ClienteDomicilio setCorreo()       Sets the current record's "correo" value
 * @method ClienteDomicilio setObservacion()  Sets the current record's "observacion" value
 * @method ClienteDomicilio setLocalidadId()  Sets the current record's "localidad_id" value
 * @method ClienteDomicilio setCliente()      Sets the current record's "Cliente" value
 * @method ClienteDomicilio setLocalidad()    Sets the current record's "Localidad" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseClienteDomicilio extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cliente_domicilio');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('direccion', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('telefono', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('correo', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('localidad_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Localidad', array(
             'local' => 'localidad_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}