<?php
include 'conexion.php';

if (!isset($_GET['numerodecontrol'])) {
    die("No se especificó un registro.");
}

$numerodecontrol = $conexion->real_escape_string($_GET['numerodecontrol']);
$sql = "SELECT * FROM selectivos WHERE numerodecontrol='$numerodecontrol'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows != 1) {
    die("Registro no encontrado.");
}

$fila = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Imprimir Selectivo</title>
<style>
body { font-family: Arial; padding: 20px; }
h2 { color: #2c6e49; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
td { padding: 8px; border: 1px solid #ddd; }
</style>
</head>
<body>

<h2>Ficha de Selectivo: <?php echo $fila['nombrecompleto']; ?></h2>

<table>
    <tr><td>Padecimiento</td><td><?php echo $fila['padecimiento']; ?></td></tr>
    <tr><td>Grupo</td><td><?php echo $fila['grupo']; ?></td></tr>
    <tr><td>Número de Control</td><td><?php echo $fila['numerodecontrol']; ?></td></tr>
    <tr><td>NP</td><td><?php echo $fila['np']; ?></td></tr>
    <tr><td>Selectivo</td><td><?php echo $fila['selectivo']; ?></td></tr>
    <tr><td>Sexo</td><td><?php echo $fila['sexo']; ?></td></tr>
    <tr><td>CURP</td><td><?php echo $fila['CURP']; ?></td></tr>
    <tr><td>Correo Institucional</td><td><?php echo $fila['correoinstitucional']; ?></td></tr>
    <tr><td>Fecha de Nacimiento</td><td><?php echo $fila['fechadenacimiento']; ?></td></tr>
    <tr><td>Turno</td><td><?php echo $fila['turno']; ?></td></tr>
    <tr><td>Carrera</td><td><?php echo $fila['carrera']; ?></td></tr>
    <tr><td>Dirección</td><td><?php echo $fila['direccion']; ?></td></tr>
    <tr><td>Código Postal</td><td><?php echo $fila['codigopostal']; ?></td></tr>
    <tr><td>Estado</td><td><?php echo $fila['estado']; ?></td></tr>
    <tr><td>Plantel</td><td><?php echo $fila['plantel']; ?></td></tr>
    <tr><td>Número Telefónico</td><td><?php echo $fila['numerotelefónico']; ?></td></tr>
</table>

<br>
<button onclick="window.print()">🖨️ Imprimir</button>

</body>
</html>