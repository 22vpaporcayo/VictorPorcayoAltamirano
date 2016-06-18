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
<form method="post" name="agregam">
  <table width="800" border="0" align="center" style="margin-top:100px;">
    <tbody>
      <tr>
        <td align="center" colspan="4"><font face="Impact" color="#EFFF52" size="3">Agregar Campo</font><br/></td>
      </tr>
      <tr>
        <td align="center" width="160"><h4 class="text-danger">Tipo de Campo</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Nombre</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Etiqueta</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Valor</h4></td>
      </tr>
      <tr>
        <td align="center" width="160">
        	<input type="text" name="tipo" class="form-control" value="<?php echo $_REQUEST['tipo'];?>"/>
        </td>
        <td align="center" width="160">
        	<input type="text" name="nombre" class="form-control" value="<?php echo $_REQUEST['nombre'];?>"/>
        </td>
        <td align="center" width="160">
        	<input type="text" name="etiqueta" class="form-control" placeholder="Ingresa Etiqueta"/>        	
        </td>
        <td align="center" width="160">
        	<input type="text" name="valor" class="form-control" placeholder="Ingresa Valor"/>        	
        </td>
		<input type="hidden" name="dependencia" value="<?php echo $_REQUEST['id'] ?>"/>
        
      </tr>      
      <tr>
        <td align="center" colspan="5"><input type="submit" class="btn btn-success btn-block" name="AGREGARDEPENDENCIA" value="AGREGAR CAMPO" ></td>
      </tr>
      <tr>
        <td align="center" colspan="5"><a href="agregar.php?id=<?php echo($_REQUEST['formulario']);?>" class="btn btn-block btn-danger">Regresar</a></td>
      </tr>
    </tbody>
  </table>
</form>
<?php
if(isset($_REQUEST['AGREGARDEPENDENCIA'])){
		require_once("conexion.php");
		$tipo=$_REQUEST["tipo"];
		$nombre=$_REQUEST["nombre"];
		$etiqueta=utf8_decode($_REQUEST["etiqueta"]);
		$valor=$_REQUEST["valor"];
		$dependencia=$_REQUEST["dependencia"];
		$query="INSERT INTO `formulario`.`dependencia` (`id_componente`, `tipo`, `nombre`, `valor`, `etiqueta`) VALUES ('$dependencia', '$tipo', '$nombre', '$valor', '$etiqueta');";
		$result = $con-> query($query);
		if($result){
			echo("<script>
swal({  title: 'Aceptada',   text:'TU CAMPO HA SIDO AGREGADO CORRECTAMENTE' ,   type: 'success',   showCancelButton: false,   confirmButtonColor:'#8CD4F5',   confirmButtonText:'Ok',   closeOnConfirm: false,   closeOnCancel: false }, function(){document.location.href='';});</script>");
		}else{
			echo("<script>
 swal({   title: 'Advertencia',   text: 'SELECCIONA UN TIPO DE CAPO',   type: 'warning',   showCancelButton: false,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Aceptar',   closeOnConfirm: false }, function(){javascript:history.back();});</script>");
		}
}
	$query="SELECT * FROM dependencia where id_componente='".$_REQUEST['id']."'";
	require_once("conexion.php");
	$result = $con-> query($query);
	mysqli_close($con);
	echo ('<br><br><table width="600" border="1" align="center">');
	if(mysqli_num_rows($result)>0)
		while($campo=mysqli_fetch_array($result)){
	?>
  <tr>
    <td width="600" align="center"><span class="btn btn-warning btn-block">Campo <?php echo utf8_encode($campo['etiqueta']);?></span></td>
  </tr>
  <?php
}
	?>
</table>

</body>
</html>
