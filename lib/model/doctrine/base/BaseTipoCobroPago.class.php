<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TipoCobroPago', 'doctrine');

/**
 * BaseTipoCobroPago
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property Doctrine_Collection $Cobros
 * @property Doctrine_Collection $pagos
 * @property Doctrine_Collection $ListadoCobros
 * @property Doctrine_Collection $PagoComision
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getNombre()        Returns the current record's "nombre" value
 * @method Doctrine_Collection getCobros()        Returns the current record's "Cobros" collection
 * @method Doctrine_Collection getPagos()         Returns the current record's "pagos" collection
 * @method Doctrine_Collection getListadoCobros() Returns the current record's "ListadoCobros" collection
 * @method Doctrine_Collection getPagoComision()  Returns the current record's "PagoComision" collection
 * @method TipoCobroPago       setId()            Sets the current record's "id" value
 * @method TipoCobroPago       setNombre()        Sets the current record's "nombre" value
 * @method TipoCobroPago       setCobros()        Sets the current record's "Cobros" collection
 * @method TipoCobroPago       setPagos()         Sets the current record's "pagos" collection
 * @method TipoCobroPago       setListadoCobros() Sets the current record's "ListadoCobros" collection
 * @method TipoCobroPago       setPagoComision()  Sets the current record's "PagoComision" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoCobroPago extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_cobro_pago');
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
        $this->hasMany('Cobro as Cobros', array(
             'local' => 'id',
             'foreign' => 'tipo_id'));

        $this->hasMany('Pago as pagos', array(
             'local' => 'id',
             'foreign' => 'tipo_id'));

        $this->hasMany('ListadoCobros', array(
             'local' => 'id',
             'foreign' => 'tipo_cobro'));

        $this->hasMany('PagoComision', array(
             'local' => 'id',
             'foreign' => 'tipo_id'));
    }
}