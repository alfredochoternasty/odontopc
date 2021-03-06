<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TipoVenta', 'doctrine');

/**
 * BaseTipoVenta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property integer $porc_recargo
 * @property Doctrine_Collection $Resumen
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getNombre()       Returns the current record's "nombre" value
 * @method integer             getPorcRecargo()  Returns the current record's "porc_recargo" value
 * @method Doctrine_Collection getResumen()      Returns the current record's "Resumen" collection
 * @method TipoVenta           setId()           Sets the current record's "id" value
 * @method TipoVenta           setNombre()       Sets the current record's "nombre" value
 * @method TipoVenta           setPorcRecargo()  Sets the current record's "porc_recargo" value
 * @method TipoVenta           setResumen()      Sets the current record's "Resumen" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoVenta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_venta');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('porc_recargo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Resumen', array(
             'local' => 'id',
             'foreign' => 'tipo_venta_id'));
    }
}