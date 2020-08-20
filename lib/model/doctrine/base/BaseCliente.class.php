<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Cliente', 'doctrine');

/**
 * BaseCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $tipo_id
 * @property string $dni
 * @property string $cuit
 * @property integer $condicionfiscal_id
 * @property boolean $genera_comision
 * @property string $sexo
 * @property string $apellido
 * @property string $nombre
 * @property date $fecha_nacimiento
 * @property string $domicilio
 * @property integer $localidad_id
 * @property string $telefono
 * @property string $celular
 * @property string $fax
 * @property string $email
 * @property string $observacion
 * @property integer $usuario_id
 * @property integer $lista_id
 * @property boolean $activo
 * @property boolean $recibir_curso
 * @property integer $zona_id
 * @property string $nro_matricula
 * @property string $foto_matricula
 * @property string $modo_alta
 * @property Doctrine_Collection $Resumenes
 * @property Localidad $Localidad
 * @property CondicionFiscal $Condfiscal
 * @property Doctrine_Collection $Cobros
 * @property Doctrine_Collection $Cuenta
 * @property TipoCliente $Tipo
 * @property ListaPrecio $Lista
 * @property sfGuardUser $Usuario
 * @property Zona $Zona
 * @property Doctrine_Collection $Domicilios
 * @property Doctrine_Collection $Venta
 * @property Doctrine_Collection $ListadoVentas
 * @property Doctrine_Collection $MovimientoProducto
 * @property Doctrine_Collection $ListadoCobros
 * @property Doctrine_Collection $DevProducto
 * @property Doctrine_Collection $Pedido
 * @property Doctrine_Collection $ProductoTraza
 * @property Doctrine_Collection $ClienteSeguimiento
 * @property Doctrine_Collection $CursoInscripcion
 * @property Doctrine_Collection $FacturasAfip
 * @property Doctrine_Collection $VentasZona
 * @property Doctrine_Collection $PagoComision
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method integer             getTipoId()             Returns the current record's "tipo_id" value
 * @method string              getDni()                Returns the current record's "dni" value
 * @method string              getCuit()               Returns the current record's "cuit" value
 * @method integer             getCondicionfiscalId()  Returns the current record's "condicionfiscal_id" value
 * @method boolean             getGeneraComision()     Returns the current record's "genera_comision" value
 * @method string              getSexo()               Returns the current record's "sexo" value
 * @method string              getApellido()           Returns the current record's "apellido" value
 * @method string              getNombre()             Returns the current record's "nombre" value
 * @method date                getFechaNacimiento()    Returns the current record's "fecha_nacimiento" value
 * @method string              getDomicilio()          Returns the current record's "domicilio" value
 * @method integer             getLocalidadId()        Returns the current record's "localidad_id" value
 * @method string              getTelefono()           Returns the current record's "telefono" value
 * @method string              getCelular()            Returns the current record's "celular" value
 * @method string              getFax()                Returns the current record's "fax" value
 * @method string              getEmail()              Returns the current record's "email" value
 * @method string              getObservacion()        Returns the current record's "observacion" value
 * @method integer             getUsuarioId()          Returns the current record's "usuario_id" value
 * @method integer             getListaId()            Returns the current record's "lista_id" value
 * @method boolean             getActivo()             Returns the current record's "activo" value
 * @method boolean             getRecibirCurso()       Returns the current record's "recibir_curso" value
 * @method integer             getZonaId()             Returns the current record's "zona_id" value
 * @method string              getNroMatricula()       Returns the current record's "nro_matricula" value
 * @method string              getFotoMatricula()      Returns the current record's "foto_matricula" value
 * @method string              getModoAlta()           Returns the current record's "modo_alta" value
 * @method Doctrine_Collection getResumenes()          Returns the current record's "Resumenes" collection
 * @method Localidad           getLocalidad()          Returns the current record's "Localidad" value
 * @method CondicionFiscal     getCondfiscal()         Returns the current record's "Condfiscal" value
 * @method Doctrine_Collection getCobros()             Returns the current record's "Cobros" collection
 * @method Doctrine_Collection getCuenta()             Returns the current record's "Cuenta" collection
 * @method TipoCliente         getTipo()               Returns the current record's "Tipo" value
 * @method ListaPrecio         getLista()              Returns the current record's "Lista" value
 * @method sfGuardUser         getUsuario()            Returns the current record's "Usuario" value
 * @method Zona                getZona()               Returns the current record's "Zona" value
 * @method Doctrine_Collection getDomicilios()         Returns the current record's "Domicilios" collection
 * @method Doctrine_Collection getVenta()              Returns the current record's "Venta" collection
 * @method Doctrine_Collection getListadoVentas()      Returns the current record's "ListadoVentas" collection
 * @method Doctrine_Collection getMovimientoProducto() Returns the current record's "MovimientoProducto" collection
 * @method Doctrine_Collection getListadoCobros()      Returns the current record's "ListadoCobros" collection
 * @method Doctrine_Collection getDevProducto()        Returns the current record's "DevProducto" collection
 * @method Doctrine_Collection getPedido()             Returns the current record's "Pedido" collection
 * @method Doctrine_Collection getProductoTraza()      Returns the current record's "ProductoTraza" collection
 * @method Doctrine_Collection getClienteSeguimiento() Returns the current record's "ClienteSeguimiento" collection
 * @method Doctrine_Collection getCursoInscripcion()   Returns the current record's "CursoInscripcion" collection
 * @method Doctrine_Collection getFacturasAfip()       Returns the current record's "FacturasAfip" collection
 * @method Doctrine_Collection getVentasZona()         Returns the current record's "VentasZona" collection
 * @method Doctrine_Collection getPagoComision()       Returns the current record's "PagoComision" collection
 * @method Cliente             setId()                 Sets the current record's "id" value
 * @method Cliente             setTipoId()             Sets the current record's "tipo_id" value
 * @method Cliente             setDni()                Sets the current record's "dni" value
 * @method Cliente             setCuit()               Sets the current record's "cuit" value
 * @method Cliente             setCondicionfiscalId()  Sets the current record's "condicionfiscal_id" value
 * @method Cliente             setGeneraComision()     Sets the current record's "genera_comision" value
 * @method Cliente             setSexo()               Sets the current record's "sexo" value
 * @method Cliente             setApellido()           Sets the current record's "apellido" value
 * @method Cliente             setNombre()             Sets the current record's "nombre" value
 * @method Cliente             setFechaNacimiento()    Sets the current record's "fecha_nacimiento" value
 * @method Cliente             setDomicilio()          Sets the current record's "domicilio" value
 * @method Cliente             setLocalidadId()        Sets the current record's "localidad_id" value
 * @method Cliente             setTelefono()           Sets the current record's "telefono" value
 * @method Cliente             setCelular()            Sets the current record's "celular" value
 * @method Cliente             setFax()                Sets the current record's "fax" value
 * @method Cliente             setEmail()              Sets the current record's "email" value
 * @method Cliente             setObservacion()        Sets the current record's "observacion" value
 * @method Cliente             setUsuarioId()          Sets the current record's "usuario_id" value
 * @method Cliente             setListaId()            Sets the current record's "lista_id" value
 * @method Cliente             setActivo()             Sets the current record's "activo" value
 * @method Cliente             setRecibirCurso()       Sets the current record's "recibir_curso" value
 * @method Cliente             setZonaId()             Sets the current record's "zona_id" value
 * @method Cliente             setNroMatricula()       Sets the current record's "nro_matricula" value
 * @method Cliente             setFotoMatricula()      Sets the current record's "foto_matricula" value
 * @method Cliente             setModoAlta()           Sets the current record's "modo_alta" value
 * @method Cliente             setResumenes()          Sets the current record's "Resumenes" collection
 * @method Cliente             setLocalidad()          Sets the current record's "Localidad" value
 * @method Cliente             setCondfiscal()         Sets the current record's "Condfiscal" value
 * @method Cliente             setCobros()             Sets the current record's "Cobros" collection
 * @method Cliente             setCuenta()             Sets the current record's "Cuenta" collection
 * @method Cliente             setTipo()               Sets the current record's "Tipo" value
 * @method Cliente             setLista()              Sets the current record's "Lista" value
 * @method Cliente             setUsuario()            Sets the current record's "Usuario" value
 * @method Cliente             setZona()               Sets the current record's "Zona" value
 * @method Cliente             setDomicilios()         Sets the current record's "Domicilios" collection
 * @method Cliente             setVenta()              Sets the current record's "Venta" collection
 * @method Cliente             setListadoVentas()      Sets the current record's "ListadoVentas" collection
 * @method Cliente             setMovimientoProducto() Sets the current record's "MovimientoProducto" collection
 * @method Cliente             setListadoCobros()      Sets the current record's "ListadoCobros" collection
 * @method Cliente             setDevProducto()        Sets the current record's "DevProducto" collection
 * @method Cliente             setPedido()             Sets the current record's "Pedido" collection
 * @method Cliente             setProductoTraza()      Sets the current record's "ProductoTraza" collection
 * @method Cliente             setClienteSeguimiento() Sets the current record's "ClienteSeguimiento" collection
 * @method Cliente             setCursoInscripcion()   Sets the current record's "CursoInscripcion" collection
 * @method Cliente             setFacturasAfip()       Sets the current record's "FacturasAfip" collection
 * @method Cliente             setVentasZona()         Sets the current record's "VentasZona" collection
 * @method Cliente             setPagoComision()       Sets the current record's "PagoComision" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCliente extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cliente');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('tipo_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('dni', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));
        $this->hasColumn('cuit', 'string', 15, array(
             'type' => 'string',
             'length' => 15,
             ));
        $this->hasColumn('condicionfiscal_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('genera_comision', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('sexo', 'string', 1, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('apellido', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('fecha_nacimiento', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('domicilio', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('localidad_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('telefono', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('celular', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('fax', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('observacion', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('lista_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('recibir_curso', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('zona_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('nro_matricula', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('foto_matricula', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('modo_alta', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Resumen as Resumenes', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasOne('Localidad', array(
             'local' => 'localidad_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('CondicionFiscal as Condfiscal', array(
             'local' => 'condicionfiscal_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('Cobro as Cobros', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('CtaCte as Cuenta', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasOne('TipoCliente as Tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('ListaPrecio as Lista', array(
             'local' => 'lista_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('sfGuardUser as Usuario', array(
             'local' => 'usuario_id',
             'foreign' => 'id'));

        $this->hasOne('Zona', array(
             'local' => 'zona_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasMany('ClienteDomicilio as Domicilios', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('Venta', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('ListadoVentas', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('MovimientoProducto', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('ListadoCobros', array(
             'local' => 'id',
             'foreign' => 'cliente'));

        $this->hasMany('DevProducto', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('Pedido', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('ProductoTraza', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('ClienteSeguimiento', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('CursoInscripcion', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('FacturasAfip', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('VentasZona', array(
             'local' => 'id',
             'foreign' => 'cliente_id'));

        $this->hasMany('PagoComision', array(
             'local' => 'id',
             'foreign' => 'revendedor_id'));
    }
}