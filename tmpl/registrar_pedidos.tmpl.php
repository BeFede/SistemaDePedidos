<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaDePedidos/config.php';
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Registrar pedido</title>
     <!--Se incluyen todas las librerías comunes-->
     <?php
      require_once $SERVER_PATH . 'include_libraries.php';
     ?>
     <link href="<?php echo $WEB_PATH;?>css/registro_pedido.css" rel="stylesheet">
     <script src="<?php echo $WEB_PATH; ?>js/tabla_articulos.js"></script>
     <script src="<?php echo $WEB_PATH; ?>js/registro_pedido.js"></script>
     <script src="<?php echo $WEB_PATH; ?>js/articulo.js"></script>


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
                <button class="btn btn-primary" id="btn-vis-modal" type="button" data-toggle="modal" data-target="#modal-articulos">Sumar artículos <i class="fa fa-plus"></i></button>
              </div>
              <table class="table table-responsive table-striped" id="tabla-articulos-pedidos">
                <thead>
                  <tr>
                    <td>Artículo</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Parcial</td>
                    <td>Empaque</td>
                    <td>Acción</td>
                  </tr>
                </thead>
                <tbody id="tabla-articulos-pedidos-cuerpo"><tbody>
              </table>
              <div id="div-monto-total">
                Total: $<label id="lbl-monto-total">0.00</label>
              </div>
              <div class="row">
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Realizar pedido" style="margin-left: 2%; width: 96%;">
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
                        <a class="btn btn-default" id="btn-filtro-articulos" style="padding: 1%"><i class="fa fa-search"></i> Buscar</a>

                    </form>
                </div>
                <div id="div-tabla-articulos">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
