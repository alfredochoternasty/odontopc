<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ListadoCompras', 'doctrine');

/**
 * BaseListadoCompras
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $compra_id
 * @property integer $numero
 * @property date $fecha
 * @property integer $moneda_id
 * @property string $moneda_nombre
 * @property integer $prov_id
 * @property string $prov_raz_soc
 * @property integer $producto_id
 * @property decimal $precio
 * @property integer $cantidad
 * @property decimal $total
 * @property string $producto_nombre
 * @property integer $grupoprod_id
 * @property string $grupo_nombre
 * @property string $nro_lote
 * @property integer $grupo2
 * @property integer $grupo3
 * @property DetalleCompra $Detalle
 * @property Proveedor $Proveedor
 * @property Producto $Producto
 * @property Grupoprod $Grupo
 * @property TipoMoneda $Moneda
 * @property Grupoprod $GrupoDos
 * @property Grupoprod $GrupoTres
 * 
 * @method integer        getId()              Returns the current record's "id" value
 * @method integer        getCompraId()        Returns the current record's "compra_id" value
 * @method integer        getNumero()          Returns the current record's "numero" value
 * @method date           getFecha()           Returns the current record's "fecha" value
 * @method integer        getMonedaId()        Returns the current record's "moneda_id" value
 * @method string         getMonedaNombre()    Returns the current record's "moneda_nombre" value
 * @method integer        getProvId()          Returns the current record's "prov_id" value
 * @method string         getProvRazSoc()      Returns the current record's "prov_raz_soc" value
 * @method integer        getProductoId()      Returns the current record's "producto_id" value
 * @method decimal        getPrecio()          Returns the current record's "precio" value
 * @method integer        getCantidad()        Returns the current record's "cantidad" value
 * @method decimal        getTotal()           Returns the current record's "total" value
 * @method string         getProductoNombre()  Returns the current record's "producto_nombre" value
 * @method integer        getGrupoprodId()     Returns the current record's "grupoprod_id" value
 * @method string         getGrupoNombre()     Returns the current record's "grupo_nombre" value
 * @method string         getNroLote()         Returns the current record's "nro_lote" value
 * @method integer        getGrupo2()          Returns the current record's "grupo2" value
 * @method integer        getGrupo3()          Returns the current record's "grupo3" value
 * @method DetalleCompra  getDetalle()         Returns the current record's "Detalle" value
 * @method Proveedor      getProveedor()       Returns the current record's "Proveedor" value
 * @method Producto       getProducto()        Returns the current record's "Producto" value
 * @method Grupoprod      getGrupo()           Returns the current record's "Grupo" value
 * @method TipoMoneda     getMoneda()          Returns the current record's "Moneda" value
 * @method Grupoprod      getGrupoDos()        Returns the current record's "GrupoDos" value
 * @method Grupoprod      getGrupoTres()       Returns the current record's "GrupoTres" value
 * @method ListadoCompras setId()              Sets the current record's "id" value
 * @method ListadoCompras setCompraId()        Sets the current record's "compra_id" value
 * @method ListadoCompras setNumero()          Sets the current record's "numero" value
 * @method ListadoCompras setFecha()           Sets the current record's "fecha" value
 * @method ListadoCompras setMonedaId()        Sets the current record's "moneda_id" value
 * @method ListadoCompras setMonedaNombre()    Sets the current record's "moneda_nombre" value
 * @method ListadoCompras setProvId()          Sets the current record's "prov_id" value
 * @method ListadoCompras setProvRazSoc()      Sets the current record's "prov_raz_soc" value
 * @method ListadoCompras setProductoId()      Sets the current record's "producto_id" value
 * @method ListadoCompras setPrecio()          Sets the current record's "precio" value
 * @method ListadoCompras setCantidad()        Sets the current record's "cantidad" value
 * @method ListadoCompras setTotal()           Sets the current record's "total" value
 * @method ListadoCompras setProductoNombre()  Sets the current record's "producto_nombre" value
 * @method ListadoCompras setGrupoprodId()     Sets the current record's "grupoprod_id" value
 * @method ListadoCompras setGrupoNombre()     Sets the current record's "grupo_nombre" value
 * @method ListadoCompras setNroLote()         Sets the current record's "nro_lote" value
 * @method ListadoCompras setGrupo2()          Sets the current record's "grupo2" value
 * @method ListadoCompras setGrupo3()          Sets the current record's "grupo3" value
 * @method ListadoCompras setDetalle()         Sets the current record's "Detalle" value
 * @method ListadoCompras setProveedor()       Sets the current record's "Proveedor" value
 * @method ListadoCompras setProducto()        Sets the current record's "Producto" value
 * @method ListadoCompras setGrupo()           Sets the current record's "Grupo" value
 * @method ListadoCompras setMoneda()          Sets the current record's "Moneda" value
 * @method ListadoCompras setGrupoDos()        Sets the current record's "GrupoDos" value
 * @method ListadoCompras setGrupoTres()       Sets the current record's "GrupoTres" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseListadoCompras extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('listado_compras');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('compra_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('moneda_nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('prov_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('prov_raz_soc', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('producto_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('precio', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('cantidad', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('total', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('producto_nombre', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('grupoprod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('grupo_nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('nro_lote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
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
        $this->hasOne('DetalleCompra as Detalle', array(
             'local' => 'compra_id',
             'foreign' => 'id'));

        $this->hasOne('Proveedor', array(
             'local' => 'prov_id',
             'foreign' => 'id'));

        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id'));

        $this->hasOne('Grupoprod as Grupo', array(
             'local' => 'grupoprod_id',
             'foreign' => 'id'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
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