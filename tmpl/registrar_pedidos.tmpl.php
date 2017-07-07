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
     <script src="<?php echo $WEB_PATH; ?>js/tabla_articulos.js"></script>
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
          <!--<div id="div-tabla-articulos"></div>-->
        </div>


        <div class="col-xs-12 ">
          <form action="#" method="POST">
            <div id="div-articulos-pedidos">
              <div id="div-btn-sumar-articulo">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-articulos">Sumar artículos <i class="fa fa-plus"></i></button>
              </div>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <td>Artículo</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                    <td>Parcial</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Galleta</td>
                    <td>2</td>
                    <td>30</td>
                    <td>30</td>
                    <td><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>

                  </tr>
                  <tr>
                    <td>Avena</td>
                    <td>3,5</td>
                    <td>69</td>
                    <td>99</td>
                    <td><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>

                  </tr>

                </tbody>
              </table>
              <div id="div-monto-total">
                <label>Total: </label>
              </div>
              <div class="row">
                <input class="btn btn-primary btn-md btn-block" type="submit" value="Realizar pedido" style="margin-left: 2%; width: 96%;">
              </div>


            </div>
        </form>
        </div>


      </div>
      <!-- Modal -->
        <div id="modal-articulos" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="text-align: center;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h2 class="modal-title">Lista de Artículos</h2>
              </div>
              <div class="modal-body">
                <div id="div-filtro">
                    <form class="form-horizontal">

                        <input type="text" placeholder="Buscar artículo" id="input-filtro-articulo">
                        <a class="btn btn-default" style="padding: 1%"><i class="fa fa-search"></i> Buscar</a>

                    </form>
                </div>
                <div id="div-tabla-articulos">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

      <?php
        require_once $SERVER_PATH . 'tmpl/marcos/footer.php';
      ?>

    </div>
   </body>
 </html>
