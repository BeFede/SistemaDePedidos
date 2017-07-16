<?php

public class Articulo{

  $_id;
  $_nombre;
  $_descripcion;
  $_IVA;

  public function __constructor($nombre, $descripcion, $IVA, $id=-1){
    $this->_id = $id;
    $this->_nombre = $nombre;
    $this->_descripcion = $descripcion;
    $this->_IVA = $IVA;
  }

}

?>
