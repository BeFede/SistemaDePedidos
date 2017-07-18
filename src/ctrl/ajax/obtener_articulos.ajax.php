<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/SistemaDePedidos/config.php";
	require_once $SERVER_PATH . "src/clases/datos/gestor_articulo_bd.class.php";

  if (!empty($_POST) && $_POST['data'] == 'articulos'){

    $tam_pag = (!empty($_POST['tamano_pagina']) ) ? $_POST['tamano_pagina'] : 5;
    $num_pag = (!empty($_POST['numero_pagina']) ) ? $_POST['numero_pagina'] : 1;
    $nombre_articulo = (isset($_POST['nombre_articulo']) && !empty($_POST['nombre_articulo'])) ? $_POST['nombre_articulo'] : NULL;



    $datos = array();
    $gestor_articulos = new GestorArticuloBD();
    $datos['articulos'] = $gestor_articulos->consultar_articulos($tam_pag, $num_pag, $nombre_articulo);
    $cantidad_de_paginas = ($gestor_articulos->contar_articulos($nombre_articulo) / $tam_pag);
    $datos['paginas'] = ceil($cantidad_de_paginas);
    $datos['pag_active'] = $num_pag;
    echo json_encode($datos);
  }




 ?>
