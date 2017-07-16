<?php

  class Vendedor{

    $_nombre;
    //El itinerario del día actual
    $_itinerario_actual;
    //Todos los itinerarios
    //$_itinerarios;

    public function __construct($nombre, $itinerario){
      $this->_nombre = $nombre;
      $this->itinerario = $itinerario;
    }


    /**
    * Compara el itinerario que se pasa por parámetro con el recorrido
    * que hizo el vendedor en el día del itinerario
    */
    public function controlar_itinerario(){
      throw new Exception("No implementado");
    }

  }

?>
