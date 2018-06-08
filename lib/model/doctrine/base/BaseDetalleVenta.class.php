<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DetalleVenta', 'doctrine');

/**
 * BaseDetalleVenta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $venta_id
 * @property integer $producto_id
 * @property decimal $precio
 * @property integer $cantidad
 * @property decimal $subtotal
 * @property decimal $iva
 * @property decimal $total
 * @property string $observacion
 * @property string $nro_lote
 * @property Venta $Venta
 * @property Producto $Producto
 * 
 * @method integer      getId()          Returns the current record's "id" value
 * @method integer      getVentaId()     Returns the current record's "venta_id" value
 * @method integer      getProductoId()  Returns the current record's "producto_id" value
 * @method decimal      getPrecio()      Returns the current record's "precio" value
 * @method integer      getCantidad()    Returns the current record's "cantidad" value
 * @method decimal      getSubtotal()    Returns the current record's "subtotal" value
 * @method decimal      getIva()         Returns the current record's "iva" value
 * @method decimal      getTotal()       Returns the current record's "total" value
 * @method string       getObservacion() Returns the current record's "observacion" value
 * @method string       getNroLote()     Returns the current record's "nro_lote" value
 * @method Venta        getVenta()       Returns the current record's "Venta" value
 * @method Producto     getProducto()    Returns the current record's "Producto" value
 * @method DetalleVenta setId()          Sets the current record's "id" value
 * @method DetalleVenta setVentaId()     Sets the current record's "venta_id" value
 * @method DetalleVenta setProductoId()  Sets the current record's "producto_id" value
 * @method DetalleVenta setPrecio()      Sets the current record's "precio" value
 * @method DetalleVenta setCantidad()    Sets the current record's "cantidad" value
 * @method DetalleVenta setSubtotal()    Sets the current record's "subtotal" value
 * @method DetalleVenta setIva()         Sets the current record's "iva" value
 * @method DetalleVenta setTotal()       Sets the current record's "total" value
 * @method DetalleVenta setObservacion() Sets the current record's "observacion" value
 * @method DetalleVenta setNroLote()     Sets the current record's "nro_lote" value
 * @method DetalleVenta setVenta()       Sets the current record's "Venta" value
 * @method DetalleVenta setProducto()    Sets the current record's "Producto" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDetalleVenta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('detalle_venta');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('venta_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('precio', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('cantidad', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => 4,
             ));
        $this->hasColumn('subtotal', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('iva', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('nro_lote', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Venta', array(
             'local' => 'venta_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}