    <!--NAVBAR-->
    <div id="encabezado">

        <nav class="navbar navbar-expand-lg ">
            <a href="PaginaPrincipal.php"><h5 class="navbar-brand" >SHOP</h5 ></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                  </svg>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">

            <!--USUARIO-->
                <li class="nav-item Usuario dropdown">               
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php  
                        echo $_SESSION['usuario'];
                      ?>
                      </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">                             
                        <a class="dropdown-item" href="PerfilUsuario.php">Perfil</a>

                       <?php
                    //VENDEDOR
                          if($_SESSION['Rol'] == 1){
                        ?>
                        <a class="dropdown-item" href="HistorialCompra.php">Historial de ventas</a>
                        <a class="dropdown-item" href="ReporteDeVenta.php">Reporte de Ventas</a>
                        <?php
                          }
                        ?>

                        <?php
                    //COMPRADOR
                          if($_SESSION['Rol'] == 2){
                        ?>
                        <a class="dropdown-item" href="HistorialCompra.php">Historial de compras</a>
                        <a class="dropdown-item" href="SeguimientoCompra.php">Seguimiento de Compras</a>
                        <a class="dropdown-item" href="./CONTROLADORES/ConsultaPedido.html">Consulta</a>
                        <?php
                          }
                        ?> 
                    </div>
                </li>



            <!--CATEGORIAS-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categorías
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                    
                    foreach ($categorias as $categoria): ?>
                     <a class="dropdown-item" href="ProductosCategorias.php"><?php echo $categoria['Nombre_Categoria']; ?></a>
                     <?php endforeach; ?>
                </div>
            </li>

            <!--NAV ITEM POR ROL DE USUARIO-->
                <?php
              //VENDEDOR
                  if($_SESSION['Rol'] == 1){
                ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="Producto.php">Mis productos<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="AgregarProducto.php">Agregar Producto<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="AgregarCategoria.php">Agregar Categoria<span class="sr-only">(current)</span></a>
                  </li>
                <?php
                  }
                ?>


                
                <?php
              //COMPRADOR
                  if($_SESSION['Rol'] == 2){
                ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="PaginaPrincipal.php">Nuevos productos<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="SeguimintoCompra.php">Mis compras<span class="sr-only">(current)</span></a>
                  </li>
                <?php
                  }
                ?>
            
                <?php
              //ADMIN
                  if($_SESSION['Rol'] == 3){
                ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="ProductoAutorizar.php">Productos por Autorizar<span class="sr-only">(current)</span></a>
                  </li>
                <?php
                  }
                ?>

                
            <!--AYUDA-->
                <li class="nav-item active">
                    <a class="nav-link" href="Nosotros.php">Nosotros<span class="sr-only">(current)</span></a>
                </li>
        
             
            <!--CARRITO-->
                <li class="nav-item active">
                    <a class="nav-link carrito" href="Carrito.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                         <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg> <span class="sr-only">(current)</span>Carrito
                    </a>
                </li>

            </ul>

            <!--BARRA DE BUSQUEDA-->
              <div class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" id='mi_navbar'>
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" onclick="buscarProducto()">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg></button>
                </div>

            </div>
        </nav>
          
  </div>
        