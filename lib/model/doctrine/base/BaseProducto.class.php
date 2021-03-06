<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Producto', 'doctrine');

/**
 * BaseProducto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property integer $grupoprod_id
 * @property decimal $precio_vta
 * @property integer $moneda_id
 * @property boolean $genera_comision
 * @property boolean $mueve_stock
 * @property integer $minimo_stock
 * @property integer $stock_actual
 * @property boolean $ctr_fact_grupo
 * @property integer $orden_grupo
 * @property boolean $activo
 * @property integer $grupo2
 * @property integer $grupo3
 * @property integer $lista_id
 * @property string $foto
 * @property string $foto_chica
 * @property text $descripcion
 * @property Grupoprod $Grupo
 * @property Grupoprod $GrupoDos
 * @property Grupoprod $GrupoTres
 * @property TipoMoneda $Moneda
 * @property ListaPrecio $Lista
 * @property Doctrine_Collection $DetalleCompra
 * @property Doctrine_Collection $DetalleResumen
 * @property Doctrine_Collection $DetLisPrecio
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $MovimientoProducto
 * @property Doctrine_Collection $DevProducto
 * @property Doctrine_Collection $DetallePresupuesto
 * @property Doctrine_Collection $DetallePedido
 * @property Doctrine_Collection $DetallePedidoOriginal
 * @property Doctrine_Collection $ProductoTraza
 * @property Doctrine_Collection $Lote
 * @property Doctrine_Collection $ListadoCompras
 * @property Doctrine_Collection $ControlStock
 * @property Doctrine_Collection $ListaPrecioDetalle
 * @property Doctrine_Collection $DescuentoZona
 * @property Doctrine_Collection $VentasZona
 * @property Doctrine_Collection $PromocionProducto
 * @property Doctrine_Collection $PromocionRegalo
 * @property Doctrine_Collection $LoteAjuste
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method string              getCodigo()                Returns the current record's "codigo" value
 * @method string              getNombre()                Returns the current record's "nombre" value
 * @method integer             getGrupoprodId()           Returns the current record's "grupoprod_id" value
 * @method decimal             getPrecioVta()             Returns the current record's "precio_vta" value
 * @method integer             getMonedaId()              Returns the current record's "moneda_id" value
 * @method boolean             getGeneraComision()        Returns the current record's "genera_comision" value
 * @method boolean             getMueveStock()            Returns the current record's "mueve_stock" value
 * @method integer             getMinimoStock()           Returns the current record's "minimo_stock" value
 * @method integer             getStockActual()           Returns the current record's "stock_actual" value
 * @method boolean             getCtrFactGrupo()          Returns the current record's "ctr_fact_grupo" value
 * @method integer             getOrdenGrupo()            Returns the current record's "orden_grupo" value
 * @method boolean             getActivo()                Returns the current record's "activo" value
 * @method integer             getGrupo2()                Returns the current record's "grupo2" value
 * @method integer             getGrupo3()                Returns the current record's "grupo3" value
 * @method integer             getListaId()               Returns the current record's "lista_id" value
 * @method string              getFoto()                  Returns the current record's "foto" value
 * @method string              getFotoChica()             Returns the current record's "foto_chica" value
 * @method text                getDescripcion()           Returns the current record's "descripcion" value
 * @method Grupoprod           getGrupo()                 Returns the current record's "Grupo" value
 * @method Grupoprod           getGrupoDos()              Returns the current record's "GrupoDos" value
 * @method Grupoprod           getGrupoTres()             Returns the current record's "GrupoTres" value
 * @method TipoMoneda          getMoneda()                Returns the current record's "Moneda" value
 * @method ListaPrecio         getLista()                 Returns the current record's "Lista" value
 * @method Doctrine_Collection getDetalleCompra()         Returns the current record's "DetalleCompra" collection
 * @method Doctrine_Collection getDetalleResumen()        Returns the current record's "DetalleResumen" collection
 * @method Doctrine_Collection getDetLisPrecio()          Returns the current record's "DetLisPrecio" collection
 * @method Doctrine_Collection getListadoVentas()         Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getMovimientoProducto()    Returns the current record's "MovimientoProducto" collection
 * @method Doctrine_Collection getDevProducto()           Returns the current record's "DevProducto" collection
 * @method Doctrine_Collection getDetallePresupuesto()    Returns the current record's "DetallePresupuesto" collection
 * @method Doctrine_Collection getDetallePedido()         Returns the current record's "DetallePedido" collection
 * @method Doctrine_Collection getDetallePedidoOriginal() Returns the current record's "DetallePedidoOriginal" collection
 * @method Doctrine_Collection getProductoTraza()         Returns the current record's "ProductoTraza" collection
 * @method Doctrine_Collection getLote()                  Returns the current record's "Lote" collection
 * @method Doctrine_Collection getListadoCompras()        Returns the current record's "ListadoCompras" collection
 * @method Doctrine_Collection getControlStock()          Returns the current record's "ControlStock" collection
 * @method Doctrine_Collection getListaPrecioDetalle()    Returns the current record's "ListaPrecioDetalle" collection
 * @method Doctrine_Collection getDescuentoZona()         Returns the current record's "DescuentoZona" collection
 * @method Doctrine_Collection getVentasZona()            Returns the current record's "VentasZona" collection
 * @method Doctrine_Collection getPromocionProducto()     Returns the current record's "PromocionProducto" collection
 * @method Doctrine_Collection getPromocionRegalo()       Returns the current record's "PromocionRegalo" collection
 * @method Doctrine_Collection getLoteAjuste()            Returns the current record's "LoteAjuste" collection
 * @method Producto            setId()                    Sets the current record's "id" value
 * @method Producto            setCodigo()                Sets the current record's "codigo" value
 * @method Producto            setNombre()                Sets the current record's "nombre" value
 * @method Producto            setGrupoprodId()           Sets the current record's "grupoprod_id" value
 * @method Producto            setPrecioVta()             Sets the current record's "precio_vta" value
 * @method Producto            setMonedaId()              Sets the current record's "moneda_id" value
 * @method Producto            setGeneraComision()        Sets the current record's "genera_comision" value
 * @method Producto            setMueveStock()            Sets the current record's "mueve_stock" value
 * @method Producto            setMinimoStock()           Sets the current record's "minimo_stock" value
 * @method Producto            setStockActual()           Sets the current record's "stock_actual" value
 * @method Producto            setCtrFactGrupo()          Sets the current record's "ctr_fact_grupo" value
 * @method Producto            setOrdenGrupo()            Sets the current record's "orden_grupo" value
 * @method Producto            setActivo()                Sets the current record's "activo" value
 * @method Producto            setGrupo2()                Sets the current record's "grupo2" value
 * @method Producto            setGrupo3()                Sets the current record's "grupo3" value
 * @method Producto            setListaId()               Sets the current record's "lista_id" value
 * @method Producto            setFoto()                  Sets the current record's "foto" value
 * @method Producto            setFotoChica()             Sets the current record's "foto_chica" value
 * @method Producto            setDescripcion()           Sets the current record's "descripcion" value
 * @method Producto            setGrupo()                 Sets the current record's "Grupo" value
 * @method Producto            setGrupoDos()              Sets the current record's "GrupoDos" value
 * @method Producto            setGrupoTres()             Sets the current record's "GrupoTres" value
 * @method Producto            setMoneda()                Sets the current record's "Moneda" value
 * @method Producto            setLista()                 Sets the current record's "Lista" value
 * @method Producto            setDetalleCompra()         Sets the current record's "DetalleCompra" collection
 * @method Producto            setDetalleResumen()        Sets the current record's "DetalleResumen" collection
 * @method Producto            setDetLisPrecio()          Sets the current record's "DetLisPrecio" collection
 * @method Producto            setListadoVentas()         Sets the current record's "ListadoVentas" collection
 * @method Producto            setMovimientoProducto()    Sets the current record's "MovimientoProducto" collection
 * @method Producto            setDevProducto()           Sets the current record's "DevProducto" collection
 * @method Producto            setDetallePresupuesto()    Sets the current record's "DetallePresupuesto" collection
 * @method Producto            setDetallePedido()         Sets the current record's "DetallePedido" collection
 * @method Producto            setDetallePedidoOriginal() Sets the current record's "DetallePedidoOriginal" collection
 * @method Producto            setProductoTraza()         Sets the current record's "ProductoTraza" collection
 * @method Producto            setLote()                  Sets the current record's "Lote" collection
 * @method Producto            setListadoCompras()        Sets the current record's "ListadoCompras" collection
 * @method Producto            setControlStock()          Sets the current record's "ControlStock" collection
 * @method Producto            setListaPrecioDetalle()    Sets the current record's "ListaPrecioDetalle" collection
 * @method Producto            setDescuentoZona()         Sets the current record's "DescuentoZona" collection
 * @method Producto            setVentasZona()            Sets the current record's "VentasZona" collection
 * @method Producto            setPromocionProducto()     Sets the current record's "PromocionProducto" collection
 * @method Producto            setPromocionRegalo()       Sets the current record's "PromocionRegalo" collection
 * @method Producto            setLoteAjuste()            Sets the current record's "LoteAjuste" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProducto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('producto');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('codigo', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('grupoprod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('precio_vta', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('genera_comision', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('mueve_stock', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('minimo_stock', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('stock_actual', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('ctr_fact_grupo', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('orden_grupo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('grupo2', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('grupo3', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('lista_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('foto', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('foto_chica', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('descripcion', 'text', null, array(
             'type' => 'text',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Grupoprod as Grupo', array(
             'local' => 'grupoprod_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Grupoprod as GrupoDos', array(
             'local' => 'grupo2',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Grupoprod as GrupoTres', array(
             'local' => 'grupo3',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('ListaPrecio as Lista', array(
             'local' => 'lista_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('DetalleCompra', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DetalleResumen', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DetLisPrecio', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('MovimientoProducto', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DetallePresupuesto', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DetallePedido', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DetallePedidoOriginal', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('ProductoTraza', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('Lote', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('ListadoCompras', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('ControlStock', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('ListaPrecioDetalle', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('DescuentoZona', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('VentasZona', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('PromocionProducto', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('PromocionRegalo', array(
             'local' => 'id',
             'foreign' => 'producto_id'));

        $this->hasMany('LoteAjuste', array(
             'local' => 'id',
             'foreign' => 'producto_id'));
    }
}