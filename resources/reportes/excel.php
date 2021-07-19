<?php
	include_once "../../includes/connect.php";
  	
  	$connect = new ConnectionDB();
  	$conn = $connect->iniciarDB();

  	$query = "SELECT * FROM lista_socios ORDER BY socio_id DESC";
  	$res = $conn->query($query);

  	$doc = "Lista de Socios.xls";

  	header('Content-type: application/xls; charset=UTF-8'); //no se mostrara por pantalla, sino que se exportará
  	header('Content-Disposition: attachment; filename='.$doc); //se genera como archivo de descarga, con nombre
  	header('Pragma: no-cache');
  	header('Expires: 0');
?>
	<table class="table table-hover table-dark table-striped">
		<thead>
			<tr>
				<th colspan="11">Reporte de Socios</th>
			</tr>
			<tr>
	            <th>#ID</th>
	            <th>Nombres</th>
	            <th>Apellidos</th>
	            <th>DNI</th>
	            <th>F. Nacimientó</th>
	            <th>Correo</th>
	            <th><?php echo utf8_decode("Dirección")?></th>
	            <th>Celular</th>
	            <th><?php echo utf8_decode("Contraseña")?></th>
	            <th><?php echo utf8_decode("Fecha - Creación")?></th>
	            <th><?php echo utf8_decode("Fecha - Actualizacón")?></th>
			</tr>
		</thead>
		<tbody>
			<?php

            if(!mysqli_num_rows($res) == 0){
                while($data = $res->fetch_array()){?>
                    <tr>
                        <td><?php echo utf8_decode($data[0]) ?></td>
                        <td><?php echo utf8_decode($data[1]) ?></td>
                        <td><?php echo utf8_decode($data[2]) ?></td>
                        <td><?php echo utf8_decode($data[3]) ?></td>
                        <td><?php echo utf8_decode($data[4]) ?></td>
                        <td><?php echo utf8_decode($data[5]) ?></td>
                        <td><?php echo utf8_decode($data[6]) ?></td>
                        <td><?php echo utf8_decode($data[7]) ?></td>
                        <td><?php echo utf8_decode($data[8]) ?></td>
                        <td><?php echo utf8_decode($data[9]) ?></td>
                        <td><?php echo utf8_decode($data[10]) ?></td>
                    </tr>
            <?php } 
            }else { ?>
                <tr>
                    <td colspan="9">No hay resultados :c</td>
                </tr>
            <?php } mysqli_close($conn); ?>
		</tbody>
	</table>