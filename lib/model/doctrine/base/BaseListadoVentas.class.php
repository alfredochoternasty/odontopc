<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ListadoVentas', 'doctrine');

/**
 * BaseListadoVentas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $res_id
 * @property date $fecha
 * @property integer $moneda_id
 * @property string $moneda_nombre
 * @property integer $cliente_id
 * @property string $cliente_apellido
 * @property string $cliente_nombre
 * @property integer $tipo_id
 * @property string $tipo_cliente_nombre
 * @property boolean $cliente_genera_comision
 * @property integer $resumen_id
 * @property integer $producto_id
 * @property decimal $precio
 * @property integer $cantidad
 * @property integer $bonificados
 * @property decimal $total
 * @property string $producto_nombre
 * @property boolean $producto_genera_comision
 * @property integer $grupoprod_id
 * @property string $grupo_nombre
 * @property string $nro_lote
 * @property integer $grupo2
 * @property integer $grupo3
 * @property date $fecha_vto
 * @property DetalleResumen $Detalle
 * @property Cliente $Cliente
 * @property TipoCliente $Tipo
 * @property Producto $Producto
 * @property Grupoprod $Grupo
 * @property TipoMoneda $Moneda
 * @property Grupoprod $GrupoDos
 * @property Grupoprod $GrupoTres
 * 
 * @method integer        getId()                       Returns the current record's "id" value
 * @method integer        getResId()                    Returns the current record's "res_id" value
 * @method date           getFecha()                    Returns the current record's "fecha" value
 * @method integer        getMonedaId()                 Returns the current record's "moneda_id" value
 * @method string         getMonedaNombre()             Returns the current record's "moneda_nombre" value
 * @method integer        getClienteId()                Returns the current record's "cliente_id" value
 * @method string         getClienteApellido()          Returns the current record's "cliente_apellido" value
 * @method string         getClienteNombre()            Returns the current record's "cliente_nombre" value
 * @method integer        getTipoId()                   Returns the current record's "tipo_id" value
 * @method string         getTipoClienteNombre()        Returns the current record's "tipo_cliente_nombre" value
 * @method boolean        getClienteGeneraComision()    Returns the current record's "cliente_genera_comision" value
 * @method integer        getResumenId()                Returns the current record's "resumen_id" value
 * @method integer        getProductoId()               Returns the current record's "producto_id" value
 * @method decimal        getPrecio()                   Returns the current record's "precio" value
 * @method integer        getCantidad()                 Returns the current record's "cantidad" value
 * @method integer        getBonificados()              Returns the current record's "bonificados" value
 * @method decimal        getTotal()                    Returns the current record's "total" value
 * @method string         getProductoNombre()           Returns the current record's "producto_nombre" value
 * @method boolean        getProductoGeneraComision()   Returns the current record's "producto_genera_comision" value
 * @method integer        getGrupoprodId()              Returns the current record's "grupoprod_id" value
 * @method string         getGrupoNombre()              Returns the current record's "grupo_nombre" value
 * @method string         getNroLote()                  Returns the current record's "nro_lote" value
 * @method integer        getGrupo2()                   Returns the current record's "grupo2" value
 * @method integer        getGrupo3()                   Returns the current record's "grupo3" value
 * @method date           getFechaVto()                 Returns the current record's "fecha_vto" value
 * @method DetalleResumen getDetalle()                  Returns the current record's "Detalle" value
 * @method Cliente        getCliente()                  Returns the current record's "Cliente" value
 * @method TipoCliente    getTipo()                     Returns the current record's "Tipo" value
 * @method Producto       getProducto()                 Returns the current record's "Producto" value
 * @method Grupoprod      getGrupo()                    Returns the current record's "Grupo" value
 * @method TipoMoneda     getMoneda()                   Returns the current record's "Moneda" value
 * @method Grupoprod      getGrupoDos()                 Returns the current record's "GrupoDos" value
 * @method Grupoprod      getGrupoTres()                Returns the current record's "GrupoTres" value
 * @method ListadoVentas  setId()                       Sets the current record's "id" value
 * @method ListadoVentas  setResId()                    Sets the current record's "res_id" value
 * @method ListadoVentas  setFecha()                    Sets the current record's "fecha" value
 * @method ListadoVentas  setMonedaId()                 Sets the current record's "moneda_id" value
 * @method ListadoVentas  setMonedaNombre()             Sets the current record's "moneda_nombre" value
 * @method ListadoVentas  setClienteId()                Sets the current record's "cliente_id" value
 * @method ListadoVentas  setClienteApellido()          Sets the current record's "cliente_apellido" value
 * @method ListadoVentas  setClienteNombre()            Sets the current record's "cliente_nombre" value
 * @method ListadoVentas  setTipoId()                   Sets the current record's "tipo_id" value
 * @method ListadoVentas  setTipoClienteNombre()        Sets the current record's "tipo_cliente_nombre" value
 * @method ListadoVentas  setClienteGeneraComision()    Sets the current record's "cliente_genera_comision" value
 * @method ListadoVentas  setResumenId()                Sets the current record's "resumen_id" value
 * @method ListadoVentas  setProductoId()               Sets the current record's "producto_id" value
 * @method ListadoVentas  setPrecio()                   Sets the current record's "precio" value
 * @method ListadoVentas  setCantidad()                 Sets the current record's "cantidad" value
 * @method ListadoVentas  setBonificados()              Sets the current record's "bonificados" value
 * @method ListadoVentas  setTotal()                    Sets the current record's "total" value
 * @method ListadoVentas  setProductoNombre()           Sets the current record's "producto_nombre" value
 * @method ListadoVentas  setProductoGeneraComision()   Sets the current record's "producto_genera_comision" value
 * @method ListadoVentas  setGrupoprodId()              Sets the current record's "grupoprod_id" value
 * @method ListadoVentas  setGrupoNombre()              Sets the current record's "grupo_nombre" value
 * @method ListadoVentas  setNroLote()                  Sets the current record's "nro_lote" value
 * @method ListadoVentas  setGrupo2()                   Sets the current record's "grupo2" value
 * @method ListadoVentas  setGrupo3()                   Sets the current record's "grupo3" value
 * @method ListadoVentas  setFechaVto()                 Sets the current record's "fecha_vto" value
 * @method ListadoVentas  setDetalle()                  Sets the current record's "Detalle" value
 * @method ListadoVentas  setCliente()                  Sets the current record's "Cliente" value
 * @method ListadoVentas  setTipo()                     Sets the current record's "Tipo" value
 * @method ListadoVentas  setProducto()                 Sets the current record's "Producto" value
 * @method ListadoVentas  setGrupo()                    Sets the current record's "Grupo" value
 * @method ListadoVentas  setMoneda()                   Sets the current record's "Moneda" value
 * @method ListadoVentas  setGrupoDos()                 Sets the current record's "GrupoDos" value
 * @method ListadoVentas  setGrupoTres()                Sets the current record's "GrupoTres" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseListadoVentas extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('listado_ventas');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('res_id', 'integer', 4, array(
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
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('cliente_apellido', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('cliente_nombre', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('tipo_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('tipo_cliente_nombre', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('cliente_genera_comision', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('resumen_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
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
        $this->hasColumn('bonificados', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
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
        $this->hasColumn('producto_genera_comision', 'boolean', null, array(
             'type' => 'boolean',
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
        $this->hasColumn('fecha_vto', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DetalleResumen as Detalle', array(
             'local' => 'resumen_id',
             'foreign' => 'id'));

        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id'));

        $this->hasOne('TipoCliente as Tipo', array(
             'local' => 'tipo_id',
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