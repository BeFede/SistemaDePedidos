<?php

class Connection{
  /**
  * Devuelve una conexión MySQL
  * Si no se está en transacción se retorna una nueva conexión
  * En caso contrario se retorna la conexión actual
  */
  public static function get_connection(){
    $con;
    if ($this->_transaction){
      $con = $this->_connection;
    }
    else {
      $con = new mysqli($this->_host, $this->_user, $this->_password, $this->_data_base, $this->_port);
      if ($con->connect_errno){
        throw new Exception("Error al conectarse a la Base de Datos");
      }
      $con->set_charset($this->_charset);
    }
    return $con;
  }

  /**
  * Cierra la conexion de la base de datos si no se está en transacción
  */
  public static function close_conecction($conexion){
    if (!$this->_transaction){
      $conexion->close();
    }
  }
}

?>
