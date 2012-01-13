<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){	
		$("#categorias").change(function(){
			if($(this).val()!=""){
				var dato=$(this).val();

				$.ajax({
					type:"POST",
					dataType:"html",
					url:base_url+"main/getProductos",
					data:"categorias="+dato,
                                       beforeSend:function()
					{
  						$("#results").html("Cargando...");
					},
					success:function(msg){
						$("#productos").empty().removeAttr("disabled").html(msg);	
                                                $("#results").html("Cargado!");
					}
				});
			}else{
				$("#grades_id").empty().attr("disabled","disabled");
				$("#groups_id").empty().attr("disabled","disabled");
			}	
		});
		$("#grades_id").change(function(){
                        $("#students").hide();
			if($(this).val()!=""){
				var dato=$(this).val();

				$.ajax({
					type:"POST",
					dataType:"html",
					url:base_url+"student/groups_select",
					data:"groups_id="+dato,
                    beforeSend: function()
					{
  						$("#loading").show();
					},
					success:function(msg){
                        $("#groups_id").empty().removeAttr("disabled").html(msg);
                      	$("#loading").hide();	
					}
				});
			}else{
				$("#groups_id").empty().attr("disabled","disabled");
			}	
		});
                  $("#groups_id").change(function(){
                  $("#students").hide();
			if($(this).val()!=""){
				var dato=$(this).val();
				$.ajax({
					type:"POST",
					dataType:"html",
					url:base_url+"student/students_select",
					data:"group_id="+dato,
                    beforeSend:function()
					{
						$("#loading").show();
					},
					success:function(msg)
                                        {       
						$("#students").show("slow",function(){
                                                    $("#students").html(msg);
                                                });
                                                
                                                $("#loading").hide();
					}
				});
			}else{
				$("#grades_id").empty().attr("disabled","disabled");
				$("#groups_id").empty().attr("disabled","disabled");
			}	
		});
	});
			base_url='<?php echo base_url(); ?>index.php/';	
</script>
<script type="text/javascript"> 
    $(document).ready(function(){
        
                  $("#vender").click(function(){
                      
                     alert ("Confirma la venta?");
                  }
              )
        
    }

)
</script>
</head>

<body>
	<div>
<?php $this->load->view('includes/header');?>
	</div>
	<div style='height:20px;'></div>  
    <?php if (isset($cantidad) && ($productos)):?>

       <?php echo 'Acabas de vender el producto con ID: '.$productos.' y cantidad de '.$cantidad.'';?>
                <?php foreach ($operacion as $row):?>
        <br><b>Favor de cobrar <h1>$<?php echo $row['precio']*$cantidad;?></h1></b></br>
        <?php endforeach;?>
                        <?php else:?>
<form id="form1" name="form1" method="post" action="<?php echo base_url('index.php/main/vender');?>">
Categoria
  <select name="categorias" id="categorias">
		<option value="-1">Seleccione</option> 
<?php 
			foreach($categorias as $row)
			{
                                echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
			}
		?>
              </select>
Articulo
	<select name="productos" id="productos"  disabled="disabled">
   	</select>
  Cantidad
  <input type="text" name="cantidad" id="cantidad" />
  <input type="submit" name="vender" id="vender" value="Enviar" />
</form>
    <?php endif;?>
        <div id="results"></div>
</body>
</html>
