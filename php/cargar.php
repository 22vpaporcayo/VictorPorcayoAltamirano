<?php
session_start();
if(isset($_REQUEST['Cargar'])){
	$_SESSION['host']  = $_REQUEST['host'];
	$_SESSION['user'] = $_REQUEST['usu'];
	$_SESSION['contrasena'] = $_REQUEST['contra'];
	$_SESSION['bd']=$_REQUEST['bd'];
}
?>
<form id="form1" name="form1" method="post">
  <table width="400" border="1" align="center">
    <tbody>
      <tr>
        <td><a href="../index.html">Host</a></td>
        <td><input type="text" name="host"/>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="../index.html">Usuario</a></td>
        <td><input type="text" name="usu"/>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="../index.html">Contraseña</a></td>
        <td><input type="text" name="contra"/>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="../index.html">Base de Datos</a></td>
        <td><input type="text" name="bd"/>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="Cargar" id="Cargar" value="Cargar"></td>
      </tr>
    </tbody>
  </table>
</form>

