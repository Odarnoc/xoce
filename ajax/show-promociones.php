<?php
session_start();

 require '../rb.php';
 R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );

	$promociones = R::findAll('promociones');
	$permisos = $_SESSION['rol_user'];

?>


<div class="table-responsive">
    <table id="tablepromociones" class="table table-borderless table-hover table-centered m-0 tables">
        <thead class="thead-light">
            <tr>
                <th id="thproducto">Producto</th>
                <th id="thprecio">Precio</th>
                <th id="thdescuento">Descuento</th>
                <th id="thstatus">Status</th>
                <th id="thinit">Fecha Inicial</th>
                <th id="thend">Fecha Final</th>
                <th id="theditarcli" style="text-align: center;">Editar</th>
                <th id="theliminarcli" style="text-align: center;">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ((array)$promociones as $item) {
            ?>
            <tr id="cliente-<?php echo $item->id; ?>" style="text-transform: capitalize;">
                           
                <td id="tdproducto">
                    <?php echo $item->nombre ?>
                </td>
  
                <td id="tdprecio">
  
                    <?php echo $item->precio ?>
  
                </td>
  
                <td id="tddescuento">
                    <?php echo $item->descuento."%" ?>
  
                </td>
  
                <td id="tdstatus">
  
                    <?php echo $item->status ?>
  
                </td>
                <td id="tdinit">
                    <?php echo $item->initDate ?>
                </td>
                <td id="tdend">
                    <?php echo $item->endDate ?>
                </td>
                <td class="tdeditcli" id="tdbtnedit">
                    <button type="button" class="btn btnedittable" onClick="editarPromocion(<?php echo $item->id; ?>)"> <i class="fas fa-pencil-alt"></i></button>
  
                </td>
                <td class="tddeletecli" id="tdbtndelete">
                    <button type="button" class="btn btndeletetable" onClick="eliminarPromocion(<?php echo $item->id; ?>, '<?php echo $item->nombre; ?>')"><i class="fas fa-trash-alt"></i></button>
                </td>
  
            </tr>
                <?php
                    }
                ?>
        </tbody>
  
    </table>
</div> <!-- end .table-responsive-->
