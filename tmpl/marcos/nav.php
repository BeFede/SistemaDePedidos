<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $WEB_PATH; ?>index.php">Sistema de Pedidos</a>
    </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="nav navbar-nav">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pedidos<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Registrar</a></li>
          <li><a href="#">Consultar</a></li>
        </ul>
      </li>
      <!-- Si no es cliente -->
      <li><a href="#">Clientes</a></li>
      <li><a href="#">Recorrido</a></li>
      <li><a href="#">Articulos</a></li>
    </ul>
        <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Cerrar sesión <i class="fa fa-sign-out"></i> </a></li>
    </ul>
    </div>
  </div>
</nav>
