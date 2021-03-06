<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ListaPrecioDetalle', 'doctrine');

/**
 * BaseListaPrecioDetalle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $lista_id
 * @property string $nombre
 * @property integer $moneda_id
 * @property integer $grupo_id
 * @property integer $producto_grupo_id
 * @property integer $producto_id
 * @property decimal $precio
 * @property Producto $Producto
 * @property Producto $ProductoGrupo
 * @property Grupoprod $Grupo
 * @property TipoMoneda $Moneda
 * 
 * @method integer            getId()                Returns the current record's "id" value
 * @method integer            getListaId()           Returns the current record's "lista_id" value
 * @method string             getNombre()            Returns the current record's "nombre" value
 * @method integer            getMonedaId()          Returns the current record's "moneda_id" value
 * @method integer            getGrupoId()           Returns the current record's "grupo_id" value
 * @method integer            getProductoGrupoId()   Returns the current record's "producto_grupo_id" value
 * @method integer            getProductoId()        Returns the current record's "producto_id" value
 * @method decimal            getPrecio()            Returns the current record's "precio" value
 * @method Producto           getProducto()          Returns the current record's "Producto" value
 * @method Producto           getProductoGrupo()     Returns the current record's "ProductoGrupo" value
 * @method Grupoprod          getGrupo()             Returns the current record's "Grupo" value
 * @method TipoMoneda         getMoneda()            Returns the current record's "Moneda" value
 * @method ListaPrecioDetalle setId()                Sets the current record's "id" value
 * @method ListaPrecioDetalle setListaId()           Sets the current record's "lista_id" value
 * @method ListaPrecioDetalle setNombre()            Sets the current record's "nombre" value
 * @method ListaPrecioDetalle setMonedaId()          Sets the current record's "moneda_id" value
 * @method ListaPrecioDetalle setGrupoId()           Sets the current record's "grupo_id" value
 * @method ListaPrecioDetalle setProductoGrupoId()   Sets the current record's "producto_grupo_id" value
 * @method ListaPrecioDetalle setProductoId()        Sets the current record's "producto_id" value
 * @method ListaPrecioDetalle setPrecio()            Sets the current record's "precio" value
 * @method ListaPrecioDetalle setProducto()          Sets the current record's "Producto" value
 * @method ListaPrecioDetalle setProductoGrupo()     Sets the current record's "ProductoGrupo" value
 * @method ListaPrecioDetalle setGrupo()             Sets the current record's "Grupo" value
 * @method ListaPrecioDetalle setMoneda()            Sets the current record's "Moneda" value
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseListaPrecioDetalle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lista_precio_detalle');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('lista_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('moneda_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('grupo_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('producto_grupo_id', 'integer', 4, array(
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Producto', array(
             'local' => 'producto_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Producto as ProductoGrupo', array(
             'local' => 'producto_grupo_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Grupoprod as Grupo', array(
             'local' => 'grupo_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('TipoMoneda as Moneda', array(
             'local' => 'moneda_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));
    }
}