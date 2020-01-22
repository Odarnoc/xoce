<section id="seclogin">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light navbar-login">
            <a class="navbar-brand" href="inicio.php"><img id="imgnavtop" src="assets/img/logoxoce.png" alt="" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicio.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" style="color: rgba(0,0,0,.5);" data-toggle="modal" data-target="#exampleModal">
                            <span class="badge badge-pill badge-danger" id='cant'>0</span>
                            <i class="fas fa-shopping-cart">Carrito</i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mi cuenta</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" onclick='misOrdenes()'>Mis Ordenes</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link btnnavtop" type='button' onclick='logout()'>Cerrar sesión</button>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cart">
                        <div class="scroll">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <h4>Total: $<span id='total'></span></h4>
                    <button type="button" class="btn btn-pay" onclick='check()'>Pagar</button>
                </div>
            </div>
        </div>
    </div>

</section>