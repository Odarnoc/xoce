<?php
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}

 require '../rb.php';
 R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );

	$productos  = R::getAll( 'SELECT p.*,a.cantidad as almacen,a.id as almacen_id FROM productos as p JOIN almacen as a ON p.id = a.id_producto' );
	$permisos = $_SESSION['rol_user'];

?>


<div class="table-responsive">
    <table id="tableproductos" class="table table-borderless table-hover table-centered m-0 tables">

        <thead class="thead-light">
            <tr>
                <th id="thcodigopro">Código</th>
                <th id="thnombrepro">Nombre</th>
                <th id="thcategoriapro">Categoria</th>
                <th id="thdescpro">Descripción</th>
                <th id="thinventariopro">Inventario</th>
                <th id="thinventariopro">Almacén</th>
                <th id="thpreciopro">Precio</th>
                <?php if($permisos=== '1') { ?>
                    <th id="thagregarcli" style="text-align: center;">Agregar</th>
                    <th id="thtransferircli" style="text-align: center;">Transferir</th>
                    <th id="theditarcli" style="text-align: center;">Editar</th>
                    <th id="theliminarcli" style="text-align: center;">Eliminar</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
		 <?php 
			foreach ($productos as $prod){
//    echo $user->name.'<br>';

				?>	 

            <tr  class="hoverprod">
                <td style="display: none;">

                </td>

                <td id="tdcodigopro">
                    <?php echo $prod['codigo'];?>
                </td>

                <td id="tdnombrepro">
                    <?php echo $prod['nombre'];?>
					<img id="imgp<?php echo $prod['id'];?>" src="productos_img/<?php echo $prod['foto'];?>" class="hide-image" style="z-index: 100; position: absolute;display:none;" width="120px" height="120px" />
                </td>

                <td id="tdcategoriapro">
                <?php 
				$categoria  = R::findOne( 'categorias', ' id = ? ', [$prod['idcategoria']] );
				echo $categoria->nombre;
				?>
                </td>

                <td id="tddescpro">
                    <?php echo $prod['descripcion'];?>
                </td>

                <td id="tdinventariopro">
                    <?php echo $prod['inventario'];?>
                </td>

                <td id="tdinventariopro">
                    <?php echo $prod['almacen'];?>
                </td>

                <td id="tdpreciopro">
                    $<?php echo $prod['precio'];?>
                </td>
                
                <?php if($permisos=== '1') { ?>
                    <td class="tdagregarcli" id="tdbtnedit">
                        <button type="button" class="btn btnedittable" onclick="agregarProducto('<?php echo $prod['nombre'];?>',<?php echo $prod['id'];?>,<?php echo $prod['almacen'];?>,<?php echo $prod['almacen_id'];?>)"> <i class="fas fa-plus"></i></button>
                    </td>

                    <td class="tdtransferircli" id="tdbtnedit">
                        <button type="button" class="btn btnedittable" onclick="tranferirProducto('<?php echo $prod['nombre'];?>',<?php echo $prod['id'];?>,<?php echo $prod['almacen'];?>,<?php echo $prod['almacen_id'];?>)"> <i class="fas fa-exchange-alt"></i></button>
                    </td>

                    <td class="tdeditcli" id="tdbtnedit">
                        <button type="button" class="btn btnedittable" onclick="window.location.href='registro-productos.php?accion=editar&id=<?php echo $prod['id'];?>'"> <i class="fas fa-pencil-alt"></i></button>
                    </td>
    
                    <td class="tddeletecli" id="tdbtndelete">
                        <a class="btn btndeletetable " onclick="borrarProducto('<?php echo $prod['nombre'];?>',<?php echo $prod['id'];?>)"><i class="fas fa-trash-alt"></i></a>
                        
                    </td>
                <?php } ?>
            </tr>
			<?php } ?>
        </tbody>


    </table>
</div> 

<!-- end .table-responsive-->
