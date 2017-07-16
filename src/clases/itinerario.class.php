<?php

class Itinerario{

  $_fecha;
  //Array con las visitas que debe hacer el vendedor
  $_visitas;

  public function __constructor($fecha, $visitas = array()){
    $this->_fecha = $fecha;
    $this->visitas = $visitas;
  }

}

?>
