<option value="-1">Seleccione</option>
<?php 
/**
 * 
 * @author Hector CyC Twitter: @hektorc 
 * Mysnetwork.com
 */
	foreach($productos as $row):
	
		echo '<option value="'.$row['id'].'">'.$row['item_name'].'   | Precio: '.$row['precio'].'</option>';
	
?>
<?php endforeach;?>