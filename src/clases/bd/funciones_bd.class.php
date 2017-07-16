<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/SistemaDePedidos/config.php";
require_once "conexion.class.php";

  /**
  * Clase conexion para bases de datos MySQL
  */

class ConnectionDb{

  /* Demilitador de comienzo de parámetro */
  const START_PARAMETER = '{';
  /* Demilitador de fin de parámetro */
  const END_PARAMETER = '}';

    private $_host;
    private $_data_base;
    private $_user;
    private $_password;

    private $_port;
    private $_charset;

    private $_connection;
    private $_transaction;

    public function __construct($host, $db, $user, $pw, $port = 3306, $charset = 'utf8'){
        $this->_host = $host;
        $this->_data_base = $db;
        $this->_user = $user;
        $this->_password = $pw;
        $this->_port = $port;
        $this->_charset = $charset;
    }

    public function get_host(){
      return $this->_host;
    }

    public function get_data_base(){
      $this->_data_base;
    }

    public function get_user(){
        return $this->_user;
    }

    public function get_charset(){
      return $this->charset;
    }
    /**
    * Ejecuta una consulta a la base de datos
    * Los parametros en la sentencia se representan con ":nombreDelParametro"
    * @param $sentencia SQL para la consulta
    * @param $parametros array con nombreDelParametro => valor, tipo
    * @param array con los datos obtenidos
    */
    public function query($sentencia, $parametros = array()){
      $db = Connection::get_connection();
      $sql = $this->replace($sentencia, $parametros);
      $result_db = $db->query();
      if ($result_db == FALSE){
        throw new Exception("La sentencia: $sql tiene errores");
      }
      $result = $result_db->fetch_all(MYSQLI_ASSOC);
      $Connection::close_connection($db);
      return $result;
    }

    /**
    * Realiza una inserción en la base de datos
    * Los parametros en la sentencia se representan con ":nombreDelParametro"
    * @param $sentencia SQL para la consulta
    * @param $parametros array con nombreDelParametro => valor, tipo
    * @return ultimo id ingresado
    */
    public function insert($sentencia, $paramentros){
      $db = Connection::get_connection();
      $sql = $this->replace($sentencia, $parametros);
      $result_db = $db->query($sql);
      if ($result_db == FALSE){
        throw new Exception("La sentencia: $sql tiene errores");
      }
      $id = $db->insert_id;
      Connection::close_connection($db);
      return $id;
    }

    /**
    * Realiza una actualización en la base de datos
    * Los parametros en la sentencia se representan con ":nombreDelParametro"
    * @param $sentencia SQL para la consulta
    * @param $parametros array con nombreDelParametro => valor, tipo
    * @return cantidad de filas afectadas
    */
    public function update($sentencia, $paramentros){
        $db = Connection::get_connection();
        $sql = $this->replace($sentencia, $parametros);
        $result_db = $db->query($sql);
        if ($result_db == FALSE){
          throw new Exception("La sentencia: $sql tiene errores");
        }
        $cant_rows = $db->affected_rows;
        Connection::close_connection($db);
        return $cant_rows;;
    }

    /**
    * Inicia una transacción desactivando el autocommit
    */
    public function begin_transaction(){
      $this->_connection = Connection::get_connection;
      $this->_transaction = TRUE;
      $res = $this->_connection->begin_transaction();
      if (!$res){
        throw new Exception("Erro al inicializar la transacción");
      }
      $this->_connection->autocommit(FALSE);
    }

    /**
    * Ejecuta y da por finalizada una transacción
    */
    public function commit(){
      if ($this->_transaction){
        $this->_connection->commit();
        Connection::close_connection($this->_connection);
        $this->_transaction = FALSE;
      }
    }

    /**
    * Vuelve el estado de la base de datos al último punto de control
    */
    public function rollback(){
      if ($this->_transaction){
        $this->_connection->rollback();
        Connection::close_connection($this->_connection);
        $this->_transaction = FALSE;
      }
    }


    /**
    * Reemplaza todos los parámetros de la consulta por los que se especifican
    * en $parametros
    * @param $sentencia SQl con los parámetros entre {}
    * @param $parametros array (nombre => [valor, tipo])
    * @param return string de la sentencia SQl lista
    */
    public function replace($sentencia, $parametros){
      if (!is_array($parametros)){
        throw new Exception("Error en el array de parámetros");
      }
      $sentencia_auxiliar = '';
      for ($i=0; $i < strlen($sentencia); $i++) {
        if($sentencia[$i] === static::START_PARAMETER){
          $id_parametro = '';
          $i++;
          while($i < strlen($sentencia) && $sentencia[$i] !== static::END_PARAMETER){
              $id_parametro .= $sentencia[$i];
              $i++;
          }

          if ($id_parametro === ''){
            throw new Exception("No se permiten nombres de parámetros vacíos");
          }
          if (!isset($parametros[$id_parametro])){
             throw new Exception("El parámetro no existe");
          }

          $valor = $parametros[$id_parametro][0];
          $valor = $this->sanitize($valor);
          $tipo = $parametros[$id_parametro][1];
          $this->valid_type($valor, $tipo);
          $sentencia_auxiliar .= $valor;

        }
        else if($sentencia[$i] !== static::END_PARAMETER){
          $sentencia_auxiliar .= $sentencia[$i];
        }
      }
      return $sentencia_auxiliar;
    }

    private function valid_type($valor, $tipo){
      $value = '';
      switch ($tipo) {
        case 'i':
          if(!is_numeric($valor)){
            throw new Exception("$valor no es numérico");
          }
          if ($valor != (int) $valor){
            throw new Exception("$valor no es entero");
          }

          $value = $valor;
          break;
        case 'd':
          if(!is_numeric($valor)){
              throw new Exception("$valor no es numérico.");
          }
          $value = floatval($valor);
          if(!is_float($value)){
            throw new Exception("$value no es decimal");
          }
          break;
        case 's':
          $value = "'" . $valor . "'";
          break;
      }
      return $value;
    }

    public function sanitize($input) {
        $mysql = new mysqli($this->_host, $this->_user, $this->_password);
        $sanitize = $mysql->real_escape_string($input);
        $mysql->close();
        return $sanitize;
    }

}

?>
