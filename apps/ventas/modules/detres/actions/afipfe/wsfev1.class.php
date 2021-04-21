<?php
class WSFEV1 {
	//const CUIT 	= 20135893901; // CUIT del emisor de las facturas. Solo numeros sin comillas.
	const CUIT 	= 30712272461; // CUIT del emisor de las facturas. Solo numeros sin comillas.
	const TA 	= "/afipfe/xml/TA.xml"; // Archivo con el Token y Sign
	const WSDL = "/afipfe/wsfev1.wsdl"; //Archivo WSDL del web service, se puede obtener de https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL
	const LOGS_DIR = "/afipfe/xml/"; //Archivo WSDL del web service, se puede obtener de https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL
	const LOG_XMLS = true; // Para debug, genera unos xml con la respuesta del web service


	const WSFEURL = "https://servicios1.afip.gov.ar/wsfev1/service.asmx"; // produccion
	//const WSFEURL = "https://wswhomo.afip.gov.ar/wsfev1/service.asmx"; // homologacion
	
	
	const Obligatorios = '';
  
	private $path = './'; // path real del directorio principal terminado en /
	public $client; // Cliente SOAP
	private $TA; // objeto que va a contener el xml de TA
  
	// manejo de errores
	public $Error = '';
	public $Code = array();
	public $Msg = array();

	public function __construct($path = './') {
		
		$this->path = $path;
		ini_set("soap.wsdl_cache_enabled", "0");        
		if (!file_exists($this->path.self::WSDL)) {
			throw new Exception('WSFE class - Erro al abrir '.self::WSDL);
		}
		
		$ta = $this->openTA();
		if(!$ta){
			die('WSFE class - Error al abrir el ticket de acceso');
		}
    
		$this->client = new SoapClient($this->path.self::WSDL, array( 
			'soap_version' => SOAP_1_2,
			'location'     => self::WSFEURL,
			'exceptions'   => 0,
			'trace'        => 1)
		); 
	}
  
	private function _checkErrors($results, $method) {//retorna true si encuentra algun error.
    if ($method == 'FEDummy') {// este es un metodo del web services para verificar que funciona
      return;
    }
    
    if (self::LOG_XMLS) {//guarda lo que se envía al web services y lo que responde, todo en xml
			$fh = date('Ymd_his');
      // file_put_contents($this->path.self::LOGS_DIR.$fh."request-".$method.".xml",$this->client->__getLastRequest());
      file_put_contents($this->path.self::LOGS_DIR.$fh."response-".$method.".xml",$this->client->__getLastResponse());
    }
    
    if (is_soap_fault($results)) {// chequea si es erro de conexion de SOAP
      $this->Error = 'Error en la conexion'.'<br>';
      $this->Code[] = $results->faultcode;
      $this->Msg[] = $results->faultstring;
      return true;
    }
    
    $x = $method.'Result';
    if (!empty($results->$x->Errors)) {
      if ($results->$x->Errors->Err->Code != 0) {
        $this->Error = 'Error en '.$method.'<br>';
        $this->Code[] = $results->$x->Errors->Err->Code;
        $this->Msg[] = $results->$x->Errors->Err->Msg;
        return true;
      }
    }
    
    if ($method == 'FECAESolicitar') {// este metodo puede devolver mas de 1 observacion
      if(!empty($results->$x->FeDetResp->FECAEDetResponse->Observaciones)){
        $this->Error = 'Error en '.$method.'<br>';
        if (is_array($results->$x->FeDetResp->FECAEDetResponse->Observaciones->Obs)) {
          foreach($results->$x->FeDetResp->FECAEDetResponse->Observaciones->Obs as $obs){
            $this->Code[] = $obs->Code;
            $this->Msg[] = $obs->Msg;
          }
        } else {
          $this->Code[] = $results->$x->FeDetResp->FECAEDetResponse->Observaciones->Obs->Code;
          $this->Msg[] = $results->$x->FeDetResp->FECAEDetResponse->Observaciones->Obs->Msg;
        }
      }
    }
    
    if (!empty($results->$x->Errors)) {
      $this->Error = 'Error en '.$method.'<br>';
			if (is_array($results->$x->Errors->Err)) {
				foreach ($results->$x->Errors->Err as $Err) {
					$this->Code[] = $Err->Code;
					$this->Msg[] = $Err->Msg;
				}
			} else {
				$this->Code[] = $results->$x->Errors->Err->Code;
				$this->Msg[] = $results->$x->Errors->Err->Msg;
			}
    }
    return false;
	}

	public function openTA() {
		@$this->TA = simplexml_load_file($this->path.self::TA);
		return $this->TA == false ? false : true;
	}
  
	// Con esta funcion se pueden ver la opciones que admites los campos de tipo de algo
  // la respuiesta queda en los xml
	public function FEParamGetTipos($x='FEDummy')	{
    $results = $this->client->$x(array(
      'Auth'=>array('Token' => $this->TA->credentials->token,
      'Sign' => $this->TA->credentials->sign,
      'Cuit' => self::CUIT),
    ));
    $e = $this->_checkErrors($results, $x);
    $xx = $x.'Result';
    return $e == false ? $results->$xx->ResultGet : 'error';
    //return $results->$xx->ResultGet;
	}
  
	// Retorna el ultimo número de comprobante autorizado.
	public function FECompUltimoAutorizado($ptovta, $tipo_cbte)	{
	$datos = array(
      'Auth'=>array('Token' => $this->TA->credentials->token,
      'Sign' => $this->TA->credentials->sign,
      'Cuit' => self::CUIT),
      'PtoVta' => $ptovta,
      'CbteTipo' => $tipo_cbte
    );
		
		$fh = date('Ymd_his');
		$txt = "<pre>".print_r($datos, true)."</pre>";
		file_put_contents($this->path.self::LOGS_DIR.$fh."request-FECompUltimoAutorizado.txt", $txt);
		
		$results = $this->client->FECompUltimoAutorizado($datos);
    $e = $this->_checkErrors($results, 'FECompUltimoAutorizado');
    return $e === false? $results->FECompUltimoAutorizadoResult->CbteNro : 'error';
	}
  
  // Retorna el ultimo comprobante autorizado para el tipo de comprobante /cuit / punto de venta ingresado.
	public function recuperaLastCMP ($ptovta, $tipo_cbte)	{
    $results = $this->client->FERecuperaLastCMPRequest(array(
      'argAuth' =>  array('Token' => $this->TA->credentials->token,
      'Sign' => $this->TA->credentials->sign,
      'cuit' => self::CUIT),
      'argTCMP' => array('PtoVta' => $ptovta,'TipoCbte' => $tipo_cbte)
    ));
    $e = $this->_checkErrors($results, 'FERecuperaLastCMPRequest');
    return $e == false ? $results->FERecuperaLastCMPRequestResult->cbte_nro : 'error';
	}

	
  // Solicitud CAE y fecha de vencimiento 
	public function FECAESolicitar($cbte, $ptovta, $regfe, $regfeasoc, $regfetrib, $regfeiva) {  
		if(empty($cbte) || $cbte === 0) return array('error' => 'El nro de comprobante no puede ser 0 o vacio, ahora es '.$cbte);
		if(empty($ptovta) || $ptovta === 0) return array('error' => 'El pto. de venta no puede ser 0 o vacio');
		if(empty($regfe['CbteTipo']) || $regfe['CbteTipo'] === 0) return array('error' => 'El tipo de comprobante no puede ser 0 o vacio');
		foreach($regfe as $k => $v){
		  $FECAEDetRequest[$k] = $v;
		}
		$FECAEDetRequest['CbteDesde'] = $cbte;
		$FECAEDetRequest['CbteHasta'] = $cbte;
		if(!empty($regfeasoc)) $FECAEDetRequest['CbtesAsoc'] = $regfeasoc;
		if(!empty($regfetrib)) $FECAEDetRequest['Tributos']['Tributo'] = $regfetrib;
		if(!empty($regfeiva)) $FECAEDetRequest['Iva']['AlicIva'] = $regfeiva;
		
		$params = array( 
		  'Auth' => array( 'Token' => $this->TA->credentials->token, 'Sign' => $this->TA->credentials->sign, 'Cuit' => self::CUIT ), 
		  'FeCAEReq' => array( 
			'FeCabReq' => array( 'CantReg' => 1, 'PtoVta' => $ptovta, 'CbteTipo' => $regfe['CbteTipo'] ),
			'FeDetReq' => array($FECAEDetRequest) 
		  ) 
		);
		
		$fh = date('Ymd_his');
		$txt = "<pre>".print_r($params, true)."</pre>";
		file_put_contents($this->path.self::LOGS_DIR.$fh."request-FECAESolicitar.txt", $txt);
		
		$results = $this->client->FECAESolicitar($params);
		$e = $this->_checkErrors($results, 'FECAESolicitar');
		if ($e == false) {
			$resp_cae = $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAE;
			$resp_caefvto = $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAEFchVto;
			$resp_resultado = $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Resultado;
			return array( 'cae' => $resp_cae, 'fec_vto' => $resp_caefvto, 'resultado' => $resp_resultado);
		} else {
			return false;
		}
	}
}
?>
