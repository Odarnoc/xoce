<?php
session_start();
$cliente = $_SESSION['cliente_id'];
$infoCliente = R::getAll('SELECT * FROM clientes WHERE id = '.$cliente);
$bonoDisponible = R::getAll('SELECT ventas FROM bonos where cliente_id = '.$cliente);
?>
<nav id="sidebar">
    <div id="dismiss">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="sidebar-header">
        <div class="clearfix">
            <!-- <img src="images/profile-brayam-morando.png" alt=""> -->
            <p class="t1"> <?php echo $infoCliente[0]['nombre'] . " " . $infoCliente[0]['apellido']; ?></p>
            <p class="t2"> <?php echo $infoCliente[0]['email']; ?></p>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a class="active" href="inicio-movil.php">Inicio</a>
        </li>
        <li>
            <a href="productos.php">Productos</a>
        </li>
        <li>
            <a href="mis-pedidos-movil.php">Pedidos</a>
        </li>
        <li>
            <a href="referencias.php?id=<?php echo $cliente;?>">Referencias</a>
        </li>
        <li>
            <a href="perfil-movil.php">Mi cuenta</a>
        </li>
        <li>
            <a href="chat/">Chat</a>
        </li>
        <?php
        if($bonoDisponible[0]['ventas'] >= 256){
        ?>
            <li>
                <a href="pagar-bono.php">Reclamar bono</a>
            </li>
        <?php
        }
        ?>
    </ul>
    <div class="sidebar-footer">
        <a href="../ajax/logout-movil.php">Cerrar sesión</a>
    </div>
</nav>