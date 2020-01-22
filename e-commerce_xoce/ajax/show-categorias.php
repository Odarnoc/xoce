<?php
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}


 require '../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );

	$categorias  = R::find( 'categorias', '');
?>

<div class="table-responsive">
    <table id="tablecategorias" class="table table-borderless table-hover table-centered m-0 tables">

        <thead class="thead-light">
            <tr>
                <th id="thnamecat">Nombre</th>
                <th id="theditcat">Editar</th>
                <th id="thdeletecat">Eliminar</th>
            </tr>
        </thead>
        <tbody>
		
		 <?php 
			foreach ($categorias as $cat){
//    echo $user->name.'<br>';

				?>	 

		
            <tr id="">
                <td style="display: none;">
                    
                </td>
                
                <td id="tdnamecategorias">
                    <?php echo $cat->nombre; ?>
                </td>

                <td id="tdeditcat">
                   <button type="button" class="btn btnedittable" onclick="editarCategoria(<?php echo $cat->id; ?>,'<?php echo $cat->nombre; ?>');"><i class="fas fa-pencil-alt"></i></button>
                   
                </td>

                <td id="tddeletecat">
                    <a class="btn btndeletetable" onclick="borrarCategoria(<?php echo $cat->id; ?>,'<?php echo $cat->nombre; ?>');"><i class="fas fa-trash-alt"></i></a>
                </td>

            </tr>
            <?php } ?>
            
        </tbody>
    </table>
</div> <!-- end .table-responsive-->
