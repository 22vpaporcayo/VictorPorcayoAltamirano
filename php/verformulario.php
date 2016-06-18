<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistema de Examenes</title>
<!-- bootstrap -->
<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Fuesntes -->
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- Sweet alerts -->
<script src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
</head>

<body background="../img/fondo<?php echo rand(1, 5);?>.jpg">
<table width="600" border="0" align="center" style="margin-top:100px;">
<?php
$query="SELECT * FROM formulario";
require("conexion.php");
$result = $con-> query($query);
if(mysqli_num_rows($result)>0)
	while($formulario=mysqli_fetch_array($result)){
?>
  <tr>
    <td>
    	<a href="verformulario.php?genera=<?php echo $formulario['id_formulario'];?>" class="btn btn-warning btn-block">
    		Generar Formulario <?php echo utf8_encode($formulario['nombre']);?>
        </a>
	</td>
  </tr>

<?php }
echo('</table>');
if(isset($_REQUEST['genera'])){
	$query="SELECT * FROM campos where formulario_r=".$_REQUEST['genera'];
	$result = $con-> query($query);
	echo('</br><table width="600" border="0" align="center">');
	if(mysqli_num_rows($result)>0)
		while($campo=mysqli_fetch_array($result)){
			echo('<tr bgcolor="#EFECEC">');
			echo('<td width="300" border="0" align="center" valign="middle">
					<h4><span class="text-info">'.$campo['etiqueta'].'</span></h4>
				</td>');
			switch ($campo['tipo']) {
    			case "radio":
        			$query="SELECT * FROM  dependencia where id_componente='".$campo['dependencia_r']."'";
					$resultado = $con-> query($query);
					echo('<td width="300" border="0" align="center" valign="middle">');
					if(mysqli_num_rows($resultado)>0)
						while($dependencia=mysqli_fetch_array($resultado)){
							echo('<p><label class="text-info">'.$dependencia['etiqueta'].'
&nbsp;<input type="'.$dependencia['tipo'].'" name="'.$dependencia['nombre'].'" valor="'.$dependencia['valor'].'"/>
</label></p>');
							}
					echo('</td>');
        			break;
    			case "select":
        			$query="SELECT * FROM  dependencia where id_componente='".$campo['dependencia_r']."'";
					$resultado = $con-> query($query);
					echo('<td width="300" border="0" align="center" valign="middle">');
					echo('<select name="'.$campo['nombre'].'" class="form-control"/>');
					echo('<option value="0">Selecciona una opcion</option>');
					if(mysqli_num_rows($resultado)>0)
						while($dependencia=mysqli_fetch_array($resultado)){
							 echo('<option value="'.$dependencia['valor'].'">'.$dependencia['etiqueta'].'</option>');
							}
					echo('</select>');
        			break;
    			case "checkbox":
        			$query="SELECT * FROM  dependencia where id_componente='".$campo['dependencia_r']."'";
					$resultado = $con-> query($query);
					echo('<td width="300" border="0" align="center" valign="middle">');
					$i=1;
					if(mysqli_num_rows($resultado)>0)
						while($dependencia=mysqli_fetch_array($resultado)){
							echo('<p><label class="text-info">'.$dependencia['etiqueta'].'
&nbsp;<input type="'.$dependencia['tipo'].'" name="'.$dependencia['nombre'].$i.'" valor="'.$dependencia['valor'].'"/>
</label></p>');
							}
					echo('</td>');
        			break;
				default :
echo('<td width="300" border="0" align="center" valign="middle">
<input type="'.$campo['tipo'].'" name="'.$campo['nombre'].'" placeholder="'.$campo['place_holder'].'" class="form-control"/>
</td>');					
					break;				
			}
			echo('</tr>');
		}
	echo('<tr>
			<td colspan="2">
				<input type="submit" name="guardar" value="Guardar" class="btn btn-block btn-success"/> 
			</td>
		  </tr>');
	echo('</table>');
	echo('<br>
		<table align="center" width="600">
		  	<tr>
				<td>
					<a href="../index.php" class="btn btn-block btn-danger">Regresar</a> 
				</td>
			</tr>
		</table>');
}
mysqli_close($con);
?>

</body>
</html>
