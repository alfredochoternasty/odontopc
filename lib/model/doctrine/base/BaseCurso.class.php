<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Curso', 'doctrine');

/**
 * BaseCurso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property date $fecha
 * @property string $hora
 * @property string $lugar
 * @property decimal $precio
 * @property string $mostrar_precio
 * @property string $logo
 * @property string $link_mapa
 * @property string $sitio_web
 * @property date $ini_insc
 * @property date $fin_insc
 * @property string $habilitado
 * @property string $permite_insc
 * @property string $foto1
 * @property string $foto2
 * @property string $foto3
 * @property string $foto4
 * @property Doctrine_Collection $CursoInscripcion
 * @property Doctrine_Collection $CursoMailEnviado
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getNombre()           Returns the current record's "nombre" value
 * @method string              getDescripcion()      Returns the current record's "descripcion" value
 * @method date                getFecha()            Returns the current record's "fecha" value
 * @method string              getHora()             Returns the current record's "hora" value
 * @method string              getLugar()            Returns the current record's "lugar" value
 * @method decimal             getPrecio()           Returns the current record's "precio" value
 * @method string              getMostrarPrecio()    Returns the current record's "mostrar_precio" value
 * @method string              getLogo()             Returns the current record's "logo" value
 * @method string              getLinkMapa()         Returns the current record's "link_mapa" value
 * @method string              getSitioWeb()         Returns the current record's "sitio_web" value
 * @method date                getIniInsc()          Returns the current record's "ini_insc" value
 * @method date                getFinInsc()          Returns the current record's "fin_insc" value
 * @method string              getHabilitado()       Returns the current record's "habilitado" value
 * @method string              getPermiteInsc()      Returns the current record's "permite_insc" value
 * @method string              getFoto1()            Returns the current record's "foto1" value
 * @method string              getFoto2()            Returns the current record's "foto2" value
 * @method string              getFoto3()            Returns the current record's "foto3" value
 * @method string              getFoto4()            Returns the current record's "foto4" value
 * @method Doctrine_Collection getCursoInscripcion() Returns the current record's "CursoInscripcion" collection
 * @method Doctrine_Collection getCursoMailEnviado() Returns the current record's "CursoMailEnviado" collection
 * @method Curso               setId()               Sets the current record's "id" value
 * @method Curso               setNombre()           Sets the current record's "nombre" value
 * @method Curso               setDescripcion()      Sets the current record's "descripcion" value
 * @method Curso               setFecha()            Sets the current record's "fecha" value
 * @method Curso               setHora()             Sets the current record's "hora" value
 * @method Curso               setLugar()            Sets the current record's "lugar" value
 * @method Curso               setPrecio()           Sets the current record's "precio" value
 * @method Curso               setMostrarPrecio()    Sets the current record's "mostrar_precio" value
 * @method Curso               setLogo()             Sets the current record's "logo" value
 * @method Curso               setLinkMapa()         Sets the current record's "link_mapa" value
 * @method Curso               setSitioWeb()         Sets the current record's "sitio_web" value
 * @method Curso               setIniInsc()          Sets the current record's "ini_insc" value
 * @method Curso               setFinInsc()          Sets the current record's "fin_insc" value
 * @method Curso               setHabilitado()       Sets the current record's "habilitado" value
 * @method Curso               setPermiteInsc()      Sets the current record's "permite_insc" value
 * @method Curso               setFoto1()            Sets the current record's "foto1" value
 * @method Curso               setFoto2()            Sets the current record's "foto2" value
 * @method Curso               setFoto3()            Sets the current record's "foto3" value
 * @method Curso               setFoto4()            Sets the current record's "foto4" value
 * @method Curso               setCursoInscripcion() Sets the current record's "CursoInscripcion" collection
 * @method Curso               setCursoMailEnviado() Sets the current record's "CursoMailEnviado" collection
 * 
 * @package    odontopc
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurso extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('curso');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('descripcion', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
        $this->hasColumn('fecha', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('hora', 'string', 5, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5,
             ));
        $this->hasColumn('lugar', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('precio', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'default' => 0,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('mostrar_precio', 'string', 2, array(
             'type' => 'string',
             'fixed' => 1,
             'default' => 'SI',
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('logo', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('link_mapa', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
        $this->hasColumn('sitio_web', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('ini_insc', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('fin_insc', 'date', 25, array(
             'type' => 'date',
             'notnull' => true,
             'length' => 25,
             ));
        $this->hasColumn('habilitado', 'string', 2, array(
             'type' => 'string',
             'fixed' => 1,
             'default' => 'SI',
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('permite_insc', 'string', 2, array(
             'type' => 'string',
             'fixed' => 1,
             'default' => 'SI',
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('foto1', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('foto2', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('foto3', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('foto4', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('CursoInscripcion', array(
             'local' => 'id',
             'foreign' => 'curso_id'));

        $this->hasMany('CursoMailEnviado', array(
             'local' => 'id',
             'foreign' => 'curso_id'));
    }
}