<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('TipoFactura', 'doctrine');

/**
 * BaseTipoFactura
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property integer $cod_tipo_afip
 * @property string $letra
 * @property integer $id_fact_cancela
 * @property string $modelo_impresion
 * @property Doctrine_Collection $Ventas
 * @property Doctrine_Collection $Compras
 * @property Doctrine_Collection $Resumen
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $MovimientoProducto
 * @property Doctrine_Collection $DevProducto
 * @property Doctrine_Collection $FacturasAfip
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getNombre()             Returns the current record's "nombre" value
 * @method integer             getCodTipoAfip()        Returns the current record's "cod_tipo_afip" value
 * @method string              getLetra()              Returns the current record's "letra" value
 * @method integer             getIdFactCancela()      Returns the current record's "id_fact_cancela" value
 * @method string              getModeloImpresion()    Returns the current record's "modelo_impresion" value
 * @method Doctrine_Collection getVentas()             Returns the current record's "Ventas" collection
 * @method Doctrine_Collection getCompras()            Returns the current record's "Compras" collection
 * @method Doctrine_Collection getResumen()            Returns the current record's "Resumen" collection
 * @method Doctrine_Collection getListadoVentas()      Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getMovimientoProducto() Returns the current record's "MovimientoProducto" collection
 * @method Doctrine_Collection getDevProducto()        Returns the current record's "DevProducto" collection
 * @method Doctrine_Collection getFacturasAfip()       Returns the current record's "FacturasAfip" collection
 * @method TipoFactura         setId()                 Sets the current record's "id" value
 * @method TipoFactura         setNombre()             Sets the current record's "nombre" value
 * @method TipoFactura         setCodTipoAfip()        Sets the current record's "cod_tipo_afip" value
 * @method TipoFactura         setLetra()              Sets the current record's "letra" value
 * @method TipoFactura         setIdFactCancela()      Sets the current record's "id_fact_cancela" value
 * @method TipoFactura         setModeloImpresion()    Sets the current record's "modelo_impresion" value
 * @method TipoFactura         setVentas()             Sets the current record's "Ventas" collection
 * @method TipoFactura         setCompras()            Sets the current record's "Compras" collection
 * @method TipoFactura         setResumen()            Sets the current record's "Resumen" collection
 * @method TipoFactura         setListadoVentas()      Sets the current record's "ListadoVentas" collection
 * @method TipoFactura         setMovimientoProducto() Sets the current record's "MovimientoProducto" collection
 * @method TipoFactura         setDevProducto()        Sets the current record's "DevProducto" collection
 * @method TipoFactura         setFacturasAfip()       Sets the current record's "FacturasAfip" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoFactura extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_factura');
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
        $this->hasColumn('cod_tipo_afip', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('letra', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('id_fact_cancela', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('modelo_impresion', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Venta as Ventas', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));

        $this->hasMany('Compra as Compras', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));

        $this->hasMany('Resumen', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));

        $this->hasMany('MovimientoProducto', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));

        $this->hasMany('FacturasAfip', array(
             'local' => 'id',
             'foreign' => 'tipofactura_id'));
    }
}