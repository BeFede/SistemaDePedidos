<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaDePedidos/config.php';
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Registrar pedido</title>
     <!--Se incluyen todas las librerías comunes-->
     <?php
      require_once $SERVER_PATH . 'include_libraries.php';
     ?>
     <link href="<?php echo $WEB_PATH;?>css/registro_pedido.css" rel="stylesheet">
     <script src="<?php echo $WEB_PATH; ?>js/tabla.js"></script>
     <script src="<?php echo $WEB_PATH; ?>js/registro_pedido.js"></script>


    </head>
  <body>

    <div class="container">
      <?php
        require_once $SERVER_PATH . 'tmpl/marcos/header.php';
      ?>
      <div class="div-title">
        <h1>Nuevo Pedido</h1>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div id="div-tabla-articulos"></div>
        </div>
        <div class="col-xs-12 col-sm-6">
        <form action="#" method="POST">
            <div id="div-tabla-articulos">
              <h3>Articulos pedidos</h3>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <td>Artículo</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Galleta</td>
                    <td>2</td>
                    <td>30</td>
                  </tr>
                  <tr>
                    <td>Avena</td>
                    <td>3,5</td>
                    <td>69</td>
                  </tr>
                </tbody>
              </table>
              <div id="div-articulos-pedidos">
                <label>Monto: </label>
              </div>
              <div class="row">
                <input class="btn btn-default btn-md btn-block" type="submit" value="Realizar pedido" style="margin-left: 5%; width: 90%;">
              </div>


            </div>
        </form>
        </div>


      </div>
      <?php
        require_once $SERVER_PATH . 'tmpl/marcos/footer.php';
      ?>
    </div>
   </body>
 </html>
