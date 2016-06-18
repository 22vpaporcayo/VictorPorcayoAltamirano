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
<script type="text/javascript">
function cargar(){
	var tipo=document.agregam.tipo.value;
	var dep=document.agregam.dependencia.value;
	var nom=document.agregam.nombre.value;
	if(tipo=='radio' || tipo=='select' || tipo=='checkbox'){
		document.agregam.dependencia.value=dep+nom;
	}else{
		document.agregam.dependencia.value=0;
	}	
};
</script>
</head>

<body background="../img/fondo<?php echo rand(1, 5);?>.jpg">
<form method="post" name="agregam">
  <table width="800" border="0" align="center" style="margin-top:100px;">
    <tbody>
      <tr>
        <td align="center" colspan="5"><font face="Impact" color="#EFFF52" size="3">Agregar Campo</font><br/></td>
      </tr>
      <tr>
        <td align="center" width="160"><h4 class="text-danger">Tipo de Campo</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Nombre</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Etiqueta</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Place Holder</h4></td>
        <td align="center" width="160"><h4 class="text-danger">Dependencia</h4></td>
      </tr>
      <tr>
        <td align="center" width="160">
        	<select name="tipo" class="form-control">
            	<option value="0">Selecciona</option>
                <option value="text">Campo de Texto</option>
                <option value="textarea">Area de Texto</option>
                <option value="radio">Boton de Opcion</option>
                <option value="select">Lista de Seleccion</option>
                <option value="checkbox">Casilla de Verificacion</option>
                <option value="date">Fecha</option>
                <option value="password">Contraseña</option>
                <option value="mail">Correo Electronico</option>
            </select>	
        </td>
        <td align="center" width="160"><input type="text" name="nombre" class="form-control" placeholder="Nombre"/></td>
        <td align="center" width="160">
        	<input type="text" name="etiqueta" class="form-control" placeholder="Etiqueta" onClick="cargar()"/>
        </td>
        <td align="center" width="160"><input type="text" name="leyenda" class="form-control" placeholder="Leyenda"/></td>
        <td align="center" width="160">
        	<input type="text" name="dependencia" class="form-control" value="<?php echo $_REQUEST['id'] ?>"/>
            <input type="hidden" name="formulario" value="<?php echo $_REQUEST['id'] ?>"/>
        </td>
      </tr>      
      <tr>
        <td align="center" colspan="5"><input type="submit" class="btn btn-success btn-block" name="AGREGARCAMPO" value="AGREGAR CAMPO" ></td>
      </tr>
      <tr>
        <td align="center" colspan="5"><a href="crear.php" class="btn btn-block btn-danger">Regresar</a></td>
      </tr>
    </tbody>
  </table>
</form>
<?php
if(isset($_REQUEST['tipo']))
	if($_REQUEST['tipo']!='0'){
		require_once("conexion.php");
		$tipo=$_REQUEST["tipo"];
		$nombre=$_REQUEST["nombre"];
		$etiqueta=utf8_decode($_REQUEST["etiqueta"]);
		$place_holder=$_REQUEST["leyenda"];
		$dependencia=$_REQUEST["dependencia"];
		$formulario=$_REQUEST["formulario"];
		$query="INSERT INTO `formulario`.`campos` (`etiqueta`, `nombre`, `tipo`, `place_holder`, `formulario_r`, `dependencia_r`) VALUES ('$etiqueta', '$nombre', '$tipo', '$place_holder', '$formulario', '$dependencia');";
		$result = $con-> query($query);
		if($result)
		echo("<script>
swal({  title: 'Aceptada',   text:'TU CAMPO HA SIDO AGREGADO CORRECTAMENTE' ,   type: 'success',   showCancelButton: false,   confirmButtonColor:'#8CD4F5',   confirmButtonText:'Ok',   closeOnConfirm: false,   closeOnCancel: false }, function(){document.location.href='';});</script>");
	}else{
		echo("<script>
 swal({   title: 'Advertencia',   text: 'SELECCIONA UN TIPO DE CAPO',   type: 'warning',   showCancelButton: false,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Aceptar',   closeOnConfirm: false }, function(){javascript:history.back();});</script>");
		}
	$query="SELECT * FROM campos where formulario_r=".$_REQUEST['id'];
	require_once("conexion.php");
	$result = $con-> query($query);
	mysqli_close($con);
	echo ('<br><br><table width="600" border="1" align="center">');
	if(mysqli_num_rows($result)>0)
		while($campo=mysqli_fetch_array($result)){
			echo('<tr>');
  			echo('<td width="600" align="center">');
			if($campo['dependencia_r']==0)
    			echo('<span class="btn btn-warning btn-block">Campo '.utf8_encode($campo['etiqueta']).'</span>');
			else
				echo('<a href="agregarDependencia.php?id='.$campo['dependencia_r'].'&nombre='.$campo['nombre'].'&tipo='.$campo['tipo'].'&formulario='.$_REQUEST['id'].'" class="btn btn-warning btn-block">Agrega Dependencias al Campo '.utf8_encode($campo['etiqueta']).'</a>');
    		echo('</td>');
			echo('</tr>');
}
	?>
</table>

</body>
</html>
