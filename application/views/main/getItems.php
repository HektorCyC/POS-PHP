<option value="-1">Seleccione</option>
<?php 
	foreach($productos as $row):
	
		echo '<option value="'.$row['id'].'">'.$row['item_name'].'   | Precio: '.$row['precio'].'</option>';
	
?>
<?php endforeach;?>