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
<form method="post" name="crear">
  <div width="400" border="0" align="center">
    <div class="col-md-12">
      <div style="margin-top:150px;" align="center">
        <h2 class="text-danger">Registrar Nuevo Formulario</h2>
      </div>
    </div>
    <div class="col-md-12" align="center">
      <div style="margin:auto; width:350px; margin-top:20px;" align="center">
        <input type="text" class="form-control" name="cn_formulario" placeholder="INGRESA EL NOMBRE DEL FORMULARIO" required>
      </div>
    </div>
    <div class="col-md-12" align="center">
      <div style="margin:auto; width:350px; margin-top:20px;" align="center">
        <input type="submit" class="btn btn-success btn-block" name="AGREGARFORMULARIO" value="AGREGAR FORMULARIO" >
      </div>
    </div>
    <div class="col-md-12" align="center">
      <div style="margin:auto; width:350px; margin-top:20px;" align="center"> <a href="../index.php" class="btn btn-danger btn-block">Regresar</a> </div>
    </div>
  </div>
</form>
<table width="600" border="0" align="center">
  <tr>
    <td width="300" align="center">&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td width="600" align="center"><font face="Arial black" color="#22FF00" size="3">Formularios</font></td>
  </tr>
  <?php
if(isset($_POST['AGREGARFORMULARIO'])){
			require_once("conexion.php");
			$query="SELECT * FROM  `formulario` where nombre ='".$_POST['cn_formulario']."'";
			$result = $con-> query($query);
			if(mysqli_num_rows($result)>0){
				echo("<script>
 swal({   title: 'Advertencia',   text: 'ESTE FORMULARIO YA EXISTE',   type: 'warning',   showCancelButton: false,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Aceptar',   closeOnConfirm: false }, function(){javascript:history.back();});</script>");
			}else{
				$query="INSERT INTO formulario(nombre) VALUES ('".$_POST['cn_formulario']."')";
				$result = $con-> query($query);
				echo("<script>
swal({  title: 'Aceptada',   text:'TU FORMULARIO HA SIDO AGREGADO CORRECTAMENTE' ,   type: 'success',   showCancelButton: false,   confirmButtonColor:'#8CD4F5',   confirmButtonText:'Ok',   closeOnConfirm: false,   closeOnCancel: false }, function(){document.location.href='?menu=200&tarea=RHLE';});</script>");
			}
		}	
$query="SELECT * FROM formulario";
	require_once("conexion.php");
	$result = $con-> query($query);
	mysqli_close($con);
	if(mysqli_num_rows($result)>0)
		while($formulario=mysqli_fetch_array($result)){
	?>
  <tr>
    <td width="600" align="center"><a href="agregar.php?id=<?php echo (utf8_encode($formulario['id_formulario']));?>" class="btn btn-warning btn-block">Agregar Campos a Formulario <?php echo utf8_encode($formulario[1]);?></a></td>
  </tr>
  <?php
}
	?>
</table>
</body>
</html>
