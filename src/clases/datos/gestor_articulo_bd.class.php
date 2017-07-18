<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/SistemaDePedidos/config.php";
require_once $SERVER_PATH . "src/clases/bd/conexion_mysql.class.php";


class GestorArticuloBD{

  private $sistema_pedido_db;

  public function __construct(){
    global $DB_HOST;
    global $DB_NAME;
    global $DB_USER;
    global $DB_PASS;
    $this->sistema_pedido_db = new ConnectionDb($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);

  }

  public function consultar_articulos($tam_page, $num_page, $nombre_articulo){

    $error = false;
    $datos = [];
    $datos_error = array("id" => -1, "descripcion" => "");

    try {
        $inicio = $tam_page * ($num_page-1);
       $resultado = $this->consultar_articulos_bd($inicio, $tam_page, $nombre_articulo);
       $articulos = array();
       for ($i=0; $i < count($resultado); $i++) {

           $articulos[] = array(
               "id" => $resultado[$i]['id'],
               "nombre" => $resultado[$i]['nombre'],
               "precio_bulto" => $resultado[$i]['precio_bulto'],
               "precio_unidad" => $resultado[$i]['precio_unidad'],
               "stock" => $resultado[$i]['stock_actual']
           );
       }
       if (!empty($articulos)){
           $datos = $articulos;
       }
    }

    catch (Exception $e) {
      $error = true;
      $datos_error = array("id" => 1, "descripcion" => "No se ha podido realizar la conuslta a la base de datos");
    }

 $retorno = [];
 if ($error === false){
     $retorno = $datos;
 }

 else {
     $retorno = $datos_error;
 }

return $retorno;
}


function consultar_articulos_bd($inicio, $tamano, $nombre_articulo){
  //Consulta inicial base!

   $query_obtencion_de_tablas = <<<SQL
      SELECT a.id as "id", a.nombre as "nombre", a.stock_actual as "stock_actual",
      SUM(CASE WHEN e.nombre = 'bulto' THEN pa_x_lp_x_e.precio ELSE 0 END) AS 'precio_bulto',
      SUM(CASE WHEN e.nombre = 'unidad' THEN pa_x_lp_x_e.precio ELSE 0 END) AS 'precio_unidad'
      FROM articulos a
      INNER JOIN precios_articulos_x_listas_precio_x_empaque pa_x_lp_x_e
      ON pa_x_lp_x_e.id_articulo = a.id
      INNER JOIN empaques e
      ON e.id = pa_x_lp_x_e.empaque
SQL;
    $query_group_by = <<<SQL
        GROUP BY a.id
SQL;

    $query_limit = "LIMIT {inicio},{tamano}";
    $query_filtro = "";
    $parametros = array("inicio" => [$inicio, 'i'], "tamano" => [$tamano, 'i']);

    if ($nombre_articulo !== NULL){
      $query_filtro = "WHERE a.nombre LIKE '%{nombre_articulo}%' ";
      $parametros['nombre_articulo'] =  [$nombre_articulo, 's'];
    }

    $query = $query_obtencion_de_tablas . " " . $query_filtro . " " . $query_group_by . " " . $query_limit;

    return $this->sistema_pedido_db->query($query,$parametros);
}

public function contar_articulos($nombre_articulo=NULL){
  $query_count_pages = <<<SQL
  SELECT COUNT(*) AS 'cant_articulos'
  FROM articulos
SQL;

$parametros = array();
$query_filtro = "";
if ($nombre_articulo !== NULL){
  $query_filtro = "WHERE nombre LIKE '%{nombre_articulo}%' ";
  $parametros['nombre_articulo'] =  [$nombre_articulo, 's'];
}

$query = $query_count_pages . " " . $query_filtro;
$resultado = $this->sistema_pedido_db->query($query, $parametros);

  return $resultado[0]['cant_articulos'];
}

}

?>
