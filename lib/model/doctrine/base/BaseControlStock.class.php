<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ControlStock', 'doctrine');

/**
 * BaseControlStock
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $producto_id
 * @property integer $grupoprod_id
 * @property string $producto_nombre
 * @property integer $resumen_id
 * @property date $fecha_vta
 * @property string $nro_lote
 * @property integer $cantidad_vendida
 * @property integer $cantidad_bonificados
 * @property integer $cantidad_total
 * @property integer $stock_actual
 * @property date $stock_sin_lote
 * @property integer $grupo2
 * @property integer $grupo3
 * @property Resumen $Resumen
 * @property Producto $Producto
 * @property Grupoprod $Grupo
 * @property Grupoprod $GrupoDos
 * @property Grupoprod $GrupoTres
 * 
 * @method integer      getId()                   Returns the current record's "id" value
 * @method integer      getProductoId()           Returns the current record's "producto_id" value
 * @method integer      getGrupoprodId()          Returns the current record's "grupoprod_id" value
 * @method string       getProductoNombre()       Returns the current record's "producto_nombre" value
 * @method integer      getResumenId()            Returns the current record's "resumen_id" value
 * @method date         getFechaVta()             Returns the current record's "fecha_vta" value
 * @method string       getNroLote()              Returns the current record's "nro_lote" value
 * @method integer      getCantidadVendida()      Returns the current record's "cantidad_vendida" value
 * @method integer      getCantidadBonificados()  Returns the current record's "cantidad_bonificados" value
 * @method integer      getCantidadTotal()        Returns the current record's "cantidad_total" value
 * @method integer      getStockActual()          Returns the current record's "stock_actual" value
 * @method date         getStockSinLote()         Returns the current record's "stock_sin_lote" value
 * @method integer      getGrupo2()               Returns the current record's "grupo2" value
 * @method integer      getGrupo3()               Returns the current record's "grupo3" value
 * @method Resumen      getResumen()              Returns the current record's "Resumen" value
 * @method Producto     getProducto()             Returns the current record's "Producto" value
 * @method Grupoprod    getGrupo()                Returns the current record's "Grupo" value
 * @method Grupoprod    getGrupoDos()             Returns the current record's "GrupoDos" value
 * @method Grupoprod    getGrupoTres()            Returns the current record's "GrupoTres" value
 * @method ControlStock setId()                   Sets the current record's "id" value
 * @method ControlStock setProductoId()           Sets the current record's "producto_id" value
 * @method ControlStock setGrupoprodId()          Sets the current record's "grupoprod_id" value
 * @method ControlStock setProductoNombre()       Sets the current record's "producto_nombre" value
 * @method ControlStock setResumenId()            Sets the current record's "resumen_id" value
 * @method ControlStock setFechaVta()             Sets the current record's "fecha_vta" value
 * @method ControlStock setNroLote()              Sets the current record's "nro_lote" value
 * @method ControlStock setCantidadVendida()      Sets the current record's "cantidad_vendida" value
 * @method ControlStock setCantidadBonificados()  Sets the current record's "cantidad_bonificados" value
 * @method ControlStock setCantidadTotal()        Sets the current record's "cantidad_total" value
 * @method ControlStock setStockActual()          Sets the current record's "stock_actual" value
 * @method ControlStock setStockSinLote()         Sets the current record's "stock_sin_lote" value
 * @method ControlStock setGrupo2()               Sets the current record's "grupo2" value
 * @method ControlStock setGrupo3()               Sets the current record's "grupo3" value
 * @method ControlStock setResumen()              Sets the current record's "Resumen" value
 * @method ControlStock setProducto()             Sets the current record's "Producto" value
 * @method ControlStock setGrupo()                Sets the current record's "Grupo" value
 * @method ControlStock setGrupoDos()             Sets the current record's "GrupoDos" value
 * @method ControlStock setGrupoTres()            Sets the current record's "GrupoTres" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseControlStock extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control_stock');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('grupoprod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('producto_nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('resumen_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('fecha_vta', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('nro_lote', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('cantidad_vendida', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('cantidad_bonificados', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('cantidad_total', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('stock_actual', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('stock_sin_lote', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('grupo2', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('grupo3', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Resumen', array(
             'local' => 'resumen_id',
             'foreign' => 'id'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id'));

        $this->hasOne('Grupoprod as Grupo', array(
             'local' => 'grupoprod_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Grupoprod as GrupoDos', array(
             'local' => 'grupo2',
             'foreign' => 'id'));

        $this->hasOne('Grupoprod as GrupoTres', array(
             'local' => 'grupo3',
             'foreign' => 'id'));
    }
}