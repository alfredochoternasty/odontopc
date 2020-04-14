<?php

class WSAA {
  const TA = "/afipfe/xml/TA.xml"; 
  const TRA = "/afipfe/xml/TRA.xml";
  
  const TRATMP = "/afipfe/xml/tra.tmp";         # Archivo con el Token y Sign
  //const CERT = "/afipfe/keys/prueba_nti.crt";        # The X.509 certificate in PEM format
  
  const CERT = "/afipfe/keys/ntiimplantes.crt";        # The X.509 certificate in PEM format
  //const PRIVATEKEY = "/afipfe/keys/prueba_nti.key";  # The private key correspoding to CERT (PEM)
  
  const PRIVATEKEY = "/afipfe/keys/ntiimplantes.key";  # The private key correspoding to CERT (PEM)
  const PASSPHRASE = "";         # The passphrase (if any) to sign
  const PROXY_ENABLE = false;
  const LOG_DIR = '/afipfe/'; // Para debug, genera unos xml con la respuesta del web service
  const LOG_XMLS = true; // Para debug, genera unos xml con la respuesta del web service

  const WSDL = "/afipfe/wsaa.wsdl";      # The WSDL corresponding to WSAA
	//const WSDL = "wsdl_afip.xml";      # The WSDL corresponding to WSAA
  
  CONST URL = "https://wsaa.afip.gov.ar/ws/services/LoginCms"; // produccion  
  //const URL = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms"; // testing
  
  private $path = './'; //el path relativo, terminado en /
  public $error = '';//manejo de errores
  private $client; // Cliente SOAP
  private $service; //servicio del cual queremos obtener la autorizacion
  
  public function __construct($path = './', $service = 'wsfe') 
  {
    $this->path = $path;
    $this->service = $service;    
    
    // seteos en php
    ini_set("soap.wsdl_cache_enabled", "0");    
    
    // validar archivos necesarios
    $this->error = '';
    if (!file_exists($this->path.self::CERT)) $this->error .= " - Error al abrir ".$this->path.self::CERT;
    if (!file_exists($this->path.self::PRIVATEKEY)) $this->error .= " - Error al abrir ".$this->path.self::PRIVATEKEY;
    if (!file_exists($this->path.self::WSDL)) $this->error .= " - Error al abrir ".$this->path.self::WSDL;
    
    if(!empty($this->error)) {
      die('WSAA class. Faltan archivos necesarios para el funcionamiento. '.$this->error);
    }
    
    $this->client = new SoapClient($this->path.self::WSDL, array(
              'soap_version'   => SOAP_1_1,
              'location'       => self::URL,
              'trace'          => 1,
              'exceptions'     => 0
            )
    );
  }
  
  /*** Esta funcion crea el archivo TRA: este sirve para pedir el ticket de acceso al wsaa  */
  private function create_TRA() {
    $TRA = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><loginTicketRequest version="1.0"></loginTicketRequest>');
    $TRA->addChild('header');
    $TRA->header->addChild('uniqueId', date('U'));
    $TRA->header->addChild('generationTime', date('c',date('U')-60));
    $TRA->header->addChild('expirationTime', date('c',date('U')+60));
    $TRA->addChild('service', $this->service);
    $TRA->asXML($this->path.self::TRA);
  }
  
  /* Esta funcion firma el archivo TRA para luego hacer el pedido CMS  */
  private function sign_TRA() {
    $f = fopen($this->path.self::TRATMP, 'w+');
    fclose($f);
    
    @$estado = openssl_pkcs7_sign(realpath($this->path.self::TRA), realpath($this->path.self::TRATMP), file_get_contents($this->path.self::CERT),
      array(file_get_contents($this->path.self::PRIVATEKEY), self::PASSPHRASE),
      array(),
      !PKCS7_DETACHED
    );

    if (!$estado) {
      die("WSAA class. ERROR al firmar el TRA");
    }
    
    // con esto saco las primeras 5 lineas del archivo tra.tmp
    $inf = fopen($this->path.self::TRATMP, "r");
    $i = 0;
    $CMS = "";
    while (!feof($inf)) { 
        $buffer = fgets($inf);
        if ( $i++ >= 4 ) $CMS .= $buffer;
    }
    
    fclose($inf);
    return $CMS;
  }
  
  /**
   * Esta funcion conecta con el web service y obtiene el token y sign
   */
  private function call_WSAA($cms) {     
    @$results = $this->client->loginCms(array('in0' => $cms));

    if (!$results) {
        return false;
    }   
    
    if (is_soap_fault($results)) {
      $this->error = "SOAP Error ".$results->faultcode.': '.$results->faultstring;
      return false;
    } 
    
    if (self::LOG_XMLS) {//guarda lo que se envía al web services y lo que responde, todo en xml
      file_put_contents($this->path.self::LOG_DIR."xml/request-loginCms.xml", $this->client->__getLastRequest());
      file_put_contents($this->path.self::LOG_DIR."xml/response-loginCms.xml", $this->client->__getLastResponse());
    }
    
    return $results->loginCmsReturn;
  }
  
  private function xml2array($xml) {    
    $json = json_encode( simplexml_load_string($xml));
    return json_decode($json, TRUE);
  }    
  
  public function generar_TA() {
    $this->create_TRA();
    $tra_firmado = $this->sign_TRA();
    
    if (!$tra_firmado) {
        return false;
    }
    
    $TA = $this->call_WSAA($tra_firmado);

    if (!$TA) {
        return false;
    }
    
    if (!file_put_contents($this->path.self::TA, $TA)) {
      $this->error = "Error al generar al archivo TA.xml";
      return false;
    }
    
    $this->TA = $this->xml2Array($TA);
    return 'true';
  }
  
  // Obtener la fecha de expiracion del TA, si no existe el archivo, devuelve false
  public function get_expiration() 
  { 
    if(empty($this->TA)) {             
      $ta_file = @file($this->path.self::TA, FILE_IGNORE_NEW_LINES);
      
      if($ta_file) {
        $ta_xml = '';
        for($i=0; $i < sizeof($ta_file); $i++)
          $ta_xml.= $ta_file[$i];        
        $this->TA = $this->xml2Array($ta_xml);
        $r = $this->TA['header']['expirationTime'];
      } else {
        $r = false;
      }      
    } else {
      $r = $this->TA['header']['expirationTime'];
    }
     
    return $r;
  }
   
}


?>
