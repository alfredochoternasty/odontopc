<?php

class sfValidatorCUIT extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', '"%value%" no es un CUIT Válido.');
  }

  protected function doClean($value)
  {
    if (!is_numeric($value) || !$this->validarCuit($value)) {
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }

    return $value;
  }
  
  private function validarCuit($cuit){
    $cuit = preg_replace('/[^\d]/', '', (string) $cuit);
    $cuit_tipos = [20, 23, 24, 27, 30, 33, 34];

    if (strlen($cuit) != 11) {
      return FALSE;
    }

    $tipo = (int) substr($cuit, 0, 2);

    if (!in_array($tipo, $cuit_tipos, TRUE)) {
        return FALSE;
      }

    $acumulado = 0;
    $digitos = str_split($cuit); // Convertir en un array
    $digito = array_pop($digitos); // Extraer último elemento del array
    $contador = count($digitos);

    for ($i = 0; $i < $contador; $i++) {
      $acumulado += $digitos[ 9 - $i ] * (2 + ($i % 6));
    }

    $verif = 11 - ($acumulado % 11);

    // Si el resultado es 11, el dígito verificador será 0
    // Sino, será el dígito verificador
    $verif = $verif == 11 ? 0 : $verif;

    return $digito == $verif;
  }
}
