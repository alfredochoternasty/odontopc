<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DetallePresupuesto', 'doctrine');

/**
 * BaseDetallePresupuesto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $presupuesto_id
 * @property integer $producto_id
 * @property integer $cantidad
 * @property decimal $precio
 * @property decimal $total
 * @property decimal $iva
 * @property integer $descuento
 * @property decimal $sub_total
 * @property string $observacion
 * @property string $nro_lote
 * @property string $asignacion_lote
 * @property Producto $Producto
 * @property Presupuesto $Presupuesto
 * 
 * @method integer            getId()              Returns the current record's "id" value
 * @method integer            getPresupuestoId()   Returns the current record's "presupuesto_id" value
 * @method integer            getProductoId()      Returns the current record's "producto_id" value
 * @method integer            getCantidad()        Returns the current record's "cantidad" value
 * @method decimal            getPrecio()          Returns the current record's "precio" value
 * @method decimal            getTotal()           Returns the current record's "total" value
 * @method decimal            getIva()             Returns the current record's "iva" value
 * @method integer            getDescuento()       Returns the current record's "descuento" value
 * @method decimal            getSubTotal()        Returns the current record's "sub_total" value
 * @method string             getObservacion()     Returns the current record's "observacion" value
 * @method string             getNroLote()         Returns the current record's "nro_lote" value
 * @method string             getAsignacionLote()  Returns the current record's "asignacion_lote" value
 * @method Producto           getProducto()        Returns the current record's "Producto" value
 * @method Presupuesto        getPresupuesto()     Returns the current record's "Presupuesto" value
 * @method DetallePresupuesto setId()              Sets the current record's "id" value
 * @method DetallePresupuesto setPresupuestoId()   Sets the current record's "presupuesto_id" value
 * @method DetallePresupuesto setProductoId()      Sets the current record's "producto_id" value
 * @method DetallePresupuesto setCantidad()        Sets the current record's "cantidad" value
 * @method DetallePresupuesto setPrecio()          Sets the current record's "precio" value
 * @method DetallePresupuesto setTotal()           Sets the current record's "total" value
 * @method DetallePresupuesto setIva()             Sets the current record's "iva" value
 * @method DetallePresupuesto setDescuento()       Sets the current record's "descuento" value
 * @method DetallePresupuesto setSubTotal()        Sets the current record's "sub_total" value
 * @method DetallePresupuesto setObservacion()     Sets the current record's "observacion" value
 * @method DetallePresupuesto setNroLote()         Sets the current record's "nro_lote" value
 * @method DetallePresupuesto setAsignacionLote()  Sets the current record's "asignacion_lote" value
 * @method DetallePresupuesto setProducto()        Sets the current record's "Producto" value
 * @method DetallePresupuesto setPresupuesto()     Sets the current record's "Presupuesto" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDetallePresupuesto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('detalle_presupuesto');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('presupuesto_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('cantidad', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 4,
             ));
        $this->hasColumn('precio', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('iva', 'decimal', 10, array(
             'type' => 'decimal',
             'default' => 0,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('descuento', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('sub_total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('observacion', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('nro_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('asignacion_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Presupuesto', array(
             'local' => 'presupuesto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}