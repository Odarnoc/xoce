<?php

session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}
$permisos = $_SESSION['rol_user'];

 require '../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );


	if(isset($_GET["search"])){
	
	$usuarios=R::find('usuarios','(user LIKE ?) or (pass LIKE ?) or (permiso LIKE ?)',             
         array( '%'. $_GET['search'] .'%',
                '%'. $_GET['search']  .'%',
                '%'. $_GET['search']   .'%')
       );	
	}else{
		$usuarios  = R::find( 'usuarios', '');
	}
 
?>


<div class="table-responsive">
    <table id="tableclientes" class="table table-borderless table-hover table-centered m-0 tables">

        <thead class="thead-light">
            <tr>
                <th id="thtelcli">id</th>
                <th id="thnamecli">Usuario</th>
                <th id="thmailcli">Contraseña</th>
                <th id="thdomiciliocli">Permiso</th>
                <?php if($permisos=== '1') { ?>
                    <th id="theditarcli" style="text-align: center;">Editar</th>
                    <th id="theliminarcli" style="text-align: center;">Eliminar</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>

     <?php 
foreach ($usuarios as $user){
//    echo $user->name.'<br>';

?>	 
            <tr id="">
                <td style="display: none;">
                   
                </td>

                <td id="tdtelcli">
                   <?php echo $user->id; ?>
                </td>


                <td id="tdnamecli" style="text-transform: none !important;">

                   <?php echo $user->user; ?>
                </td>

                <td id="tdcorreocli" style="text-transform: none !important;">
					<?php echo $user->pass; ?>

                </td>

                <td id="tddomiciliocli" style="text-transform: none !important;">
                 <?php if ($user->permiso==1){
							echo "Administrador";
				     }else{
						 echo "Empleado";
					 }
				 ?>
                    
                </td>

                <?php if($permisos=== '1') { ?>
                    <td class="tdeditcli" id="tdbtnedit">
                        <button onclick="fill(<?php echo $user->id; ?>,'<?php echo $user->user; ?>','<?php echo $user->pass; ?>',<?php echo $user->permiso; ?>);"  type="button" class="btn btnedittable" data-toggle="modal" data-target="#addUsuario"> <i class="fas fa-pencil-alt"></i></button>
    
                    </td>
    
                    <td class="tddeletecli" id="tdbtndelete">
                        <a class="btn btndeletetable" onclick="borrar(<?php echo $user->id; ?>,'<?php echo $user->user; ?>');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                <?php } ?>

            </tr>
            
            
				<?php }?>           

        </tbody>


    </table>
</div> <!-- end .table-responsive-->