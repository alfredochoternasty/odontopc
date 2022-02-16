<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Zona', 'doctrine');

/**
 * BaseZona
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property integer $cliente_id
 * @property Cliente $Cliente
 * @property Doctrine_Collection $sfGuardUser
 * @property Doctrine_Collection $Usuario
 * @property Doctrine_Collection $Compra
 * @property Doctrine_Collection $Resumen
 * @property Doctrine_Collection $Cobro
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $MovimientoProducto
 * @property Doctrine_Collection $ListadoCobros
 * @property Doctrine_Collection $DevProducto
 * @property Doctrine_Collection $Presupuesto
 * @property Doctrine_Collection $Pedido
 * @property Doctrine_Collection $Lote
 * @property Doctrine_Collection $ClienteUltimaCompra
 * @property Doctrine_Collection $ListadoCompras
 * @property Doctrine_Collection $ControlStock
 * @property Doctrine_Collection $Curso
 * @property Doctrine_Collection $ClienteSaldo
 * @property Doctrine_Collection $FacturasAfip
 * @property Doctrine_Collection $UsuarioZona
 * @property Doctrine_Collection $DescuentoZona
 * @property Doctrine_Collection $VentasZona
 * @property Doctrine_Collection $LoteAjuste
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getNombre()              Returns the current record's "nombre" value
 * @method integer             getClienteId()           Returns the current record's "cliente_id" value
 * @method Cliente             getCliente()             Returns the current record's "Cliente" value
 * @method Doctrine_Collection getSfGuardUser()         Returns the current record's "sfGuardUser" collection
 * @method Doctrine_Collection getUsuario()             Returns the current record's "Usuario" collection
 * @method Doctrine_Collection getCompra()              Returns the current record's "Compra" collection
 * @method Doctrine_Collection getResumen()             Returns the current record's "Resumen" collection
 * @method Doctrine_Collection getCobro()               Returns the current record's "Cobro" collection
 * @method Doctrine_Collection getListadoVentas()       Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getMovimientoProducto()  Returns the current record's "MovimientoProducto" collection
 * @method Doctrine_Collection getListadoCobros()       Returns the current record's "ListadoCobros" collection
 * @method Doctrine_Collection getDevProducto()         Returns the current record's "DevProducto" collection
 * @method Doctrine_Collection getPresupuesto()         Returns the current record's "Presupuesto" collection
 * @method Doctrine_Collection getPedido()              Returns the current record's "Pedido" collection
 * @method Doctrine_Collection getLote()                Returns the current record's "Lote" collection
 * @method Doctrine_Collection getClienteUltimaCompra() Returns the current record's "ClienteUltimaCompra" collection
 * @method Doctrine_Collection getListadoCompras()      Returns the current record's "ListadoCompras" collection
 * @method Doctrine_Collection getControlStock()        Returns the current record's "ControlStock" collection
 * @method Doctrine_Collection getCurso()               Returns the current record's "Curso" collection
 * @method Doctrine_Collection getClienteSaldo()        Returns the current record's "ClienteSaldo" collection
 * @method Doctrine_Collection getFacturasAfip()        Returns the current record's "FacturasAfip" collection
 * @method Doctrine_Collection getUsuarioZona()         Returns the current record's "UsuarioZona" collection
 * @method Doctrine_Collection getDescuentoZona()       Returns the current record's "DescuentoZona" collection
 * @method Doctrine_Collection getVentasZona()          Returns the current record's "VentasZona" collection
 * @method Doctrine_Collection getLoteAjuste()          Returns the current record's "LoteAjuste" collection
 * @method Zona                setId()                  Sets the current record's "id" value
 * @method Zona                setNombre()              Sets the current record's "nombre" value
 * @method Zona                setClienteId()           Sets the current record's "cliente_id" value
 * @method Zona                setCliente()             Sets the current record's "Cliente" value
 * @method Zona                setSfGuardUser()         Sets the current record's "sfGuardUser" collection
 * @method Zona                setUsuario()             Sets the current record's "Usuario" collection
 * @method Zona                setCompra()              Sets the current record's "Compra" collection
 * @method Zona                setResumen()             Sets the current record's "Resumen" collection
 * @method Zona                setCobro()               Sets the current record's "Cobro" collection
 * @method Zona                setListadoVentas()       Sets the current record's "ListadoVentas" collection
 * @method Zona                setMovimientoProducto()  Sets the current record's "MovimientoProducto" collection
 * @method Zona                setListadoCobros()       Sets the current record's "ListadoCobros" collection
 * @method Zona                setDevProducto()         Sets the current record's "DevProducto" collection
 * @method Zona                setPresupuesto()         Sets the current record's "Presupuesto" collection
 * @method Zona                setPedido()              Sets the current record's "Pedido" collection
 * @method Zona                setLote()                Sets the current record's "Lote" collection
 * @method Zona                setClienteUltimaCompra() Sets the current record's "ClienteUltimaCompra" collection
 * @method Zona                setListadoCompras()      Sets the current record's "ListadoCompras" collection
 * @method Zona                setControlStock()        Sets the current record's "ControlStock" collection
 * @method Zona                setCurso()               Sets the current record's "Curso" collection
 * @method Zona                setClienteSaldo()        Sets the current record's "ClienteSaldo" collection
 * @method Zona                setFacturasAfip()        Sets the current record's "FacturasAfip" collection
 * @method Zona                setUsuarioZona()         Sets the current record's "UsuarioZona" collection
 * @method Zona                setDescuentoZona()       Sets the current record's "DescuentoZona" collection
 * @method Zona                setVentasZona()          Sets the current record's "VentasZona" collection
 * @method Zona                setLoteAjuste()          Sets the current record's "LoteAjuste" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseZona extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('zona');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('cliente_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'cliente_id',
             'foreign' => 'id'));

        $this->hasMany('sfGuardUser', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('sfGuardUser as Usuario', array(
             'refClass' => 'UsuarioZona',
             'local' => 'zona_id',
             'foreign' => 'usuario'));

        $this->hasMany('Compra', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Resumen', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Cobro', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('MovimientoProducto', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ListadoCobros', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Presupuesto', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Pedido', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Lote', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ClienteUltimaCompra', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ListadoCompras', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ControlStock', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('Curso', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('ClienteSaldo', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('FacturasAfip', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('UsuarioZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('DescuentoZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('VentasZona', array(
             'local' => 'id',
             'foreign' => 'zona_id'));

        $this->hasMany('LoteAjuste', array(
             'local' => 'id',
             'foreign' => 'zona_id'));
    }
}