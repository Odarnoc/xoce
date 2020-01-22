<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light navbar-top">
        <a class="navbar-brand" href="#"><img id="imgnavtop" src="images/logoxoce.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Administrador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btnnavtop" href="ajax/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<section id="secnavheader">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-header">
            <a class="navbar-brand" href="admin.php"><img id="imgdash" src="images/dash.png" alt=""> Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link dropdown-submenu" href="admin.php#secclientes">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php#secproductos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php#seccategorias">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ventas.php">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventario.php">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">Usuarios Administradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bonos.php">Bonos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes.php">Reportes</a>
                    </li>
                    <?php
                    if ($permisos != 3) 
                    {
                    ?>

                        <li class="nav-item">
                            <a class="nav-link" href="chat/">Chat</a>
                        </li>

                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="tickets.php">Tickets</a>
                    </li>

                    <!--
                    <li id="linklogout" class="nav-item">
                        <a class="nav-link" href="#">Cerrar sesión</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </div>
</section>