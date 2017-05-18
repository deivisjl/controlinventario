<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a class="navbar-brand" href="./index.php">CONTROL DE LIBRERIA</a></li>
      <?php if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){ ?>
      <li><a href="./proveedor.php"><span class="fa fa-address-book fa-2x"></span> Proveedor</a></li>
      <li><a href="./producto.php"><span class="fa fa-archive fa-2x"></span> Producto</a></li>
      <li><a href="./compra.php"><span class="fa fa-briefcase fa-2x"></span> Compras</a></li>
      <?php } ?>
      <?php if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2 || $_SESSION["login"]["Rol_Id"] == 3){ ?>
      <li><a href="./inventario.php"><span class="fa fa-search fa-2x"></span> Busqueda</a></li>
      <li><a href="./cliente.php"><span class="fa fa-vcard fa-2x"></span> Clientes</a></li>
      <li><a href="./venta.php"><span class="fa fa-cart-arrow-down fa-2x"></span> Ventas</a></li>
      <?php } ?>
      <?php if($_SESSION["login"]["Rol_Id"] == 1){ ?>
      <li><a href="./reportes.php"><span class="fa fa-table fa-2x"></span> Reportes</a></li>
      <?php } ?>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">     
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">  </span><?= $_SESSION["login"]["Username"]  ?>
          <span class="fa fa-user-circle fa-2x">
        </a>
        <ul class="dropdown-menu pull-right">
			<?php if($_SESSION["login"]["Rol_Id"] == 1){ ?>
	          <li><a href="../usuarios.php"><span class="fa fa-users fa-1x"></span> Usuarios</a></li>
            <li><a href=""><span class="fa fa-cog fa-1x"></span> Backup</a></li>
         	<?php } ?>
          <li><a href="../actualizarPass.php"><span class="fa fa-unlock-alt fa-1x"></span> Cambiar contraseña</a></li>
          <li><a href="../logout.php"><span class="fa fa-sign-out fa-1x"></span> Salir</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
  </div>
</nav>



