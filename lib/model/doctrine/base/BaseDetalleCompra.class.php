<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DetalleCompra', 'doctrine');

/**
 * BaseDetalleCompra
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $compra_id
 * @property integer $producto_id
 * @property decimal $precio
 * @property integer $cantidad
 * @property decimal $total
 * @property string $observacion
 * @property string $nro_lote
 * @property date $fecha_vto
 * @property decimal $iva
 * @property decimal $sub_total
 * @property Compra $Compra
 * @property Producto $Producto
 * @property Doctrine_Collection $ListadoCompras
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method integer             getCompraId()       Returns the current record's "compra_id" value
 * @method integer             getProductoId()     Returns the current record's "producto_id" value
 * @method decimal             getPrecio()         Returns the current record's "precio" value
 * @method integer             getCantidad()       Returns the current record's "cantidad" value
 * @method decimal             getTotal()          Returns the current record's "total" value
 * @method string              getObservacion()    Returns the current record's "observacion" value
 * @method string              getNroLote()        Returns the current record's "nro_lote" value
 * @method date                getFechaVto()       Returns the current record's "fecha_vto" value
 * @method decimal             getIva()            Returns the current record's "iva" value
 * @method decimal             getSubTotal()       Returns the current record's "sub_total" value
 * @method Compra              getCompra()         Returns the current record's "Compra" value
 * @method Producto            getProducto()       Returns the current record's "Producto" value
 * @method Doctrine_Collection getListadoCompras() Returns the current record's "ListadoCompras" collection
 * @method DetalleCompra       setId()             Sets the current record's "id" value
 * @method DetalleCompra       setCompraId()       Sets the current record's "compra_id" value
 * @method DetalleCompra       setProductoId()     Sets the current record's "producto_id" value
 * @method DetalleCompra       setPrecio()         Sets the current record's "precio" value
 * @method DetalleCompra       setCantidad()       Sets the current record's "cantidad" value
 * @method DetalleCompra       setTotal()          Sets the current record's "total" value
 * @method DetalleCompra       setObservacion()    Sets the current record's "observacion" value
 * @method DetalleCompra       setNroLote()        Sets the current record's "nro_lote" value
 * @method DetalleCompra       setFechaVto()       Sets the current record's "fecha_vto" value
 * @method DetalleCompra       setIva()            Sets the current record's "iva" value
 * @method DetalleCompra       setSubTotal()       Sets the current record's "sub_total" value
 * @method DetalleCompra       setCompra()         Sets the current record's "Compra" value
 * @method DetalleCompra       setProducto()       Sets the current record's "Producto" value
 * @method DetalleCompra       setListadoCompras() Sets the current record's "ListadoCompras" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDetalleCompra extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('detalle_compra');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('compra_id', 'integer', 4, array(
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
        $this->hasColumn('fecha_vto', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('iva', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('sub_total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Compra', array(
             'local' => 'compra_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('ListadoCompras', array(
             'local' => 'id',
             'foreign' => 'compra_id'));
    }
}