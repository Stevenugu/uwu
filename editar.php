<?php
include 'conexion.php';

if (isset($_GET['numerodecontrol'])) {
    $numerodecontrol = $conexion->real_escape_string($_GET['numerodecontrol']);

    // Obtener datos del registro
    $sql = "SELECT * FROM selectivos WHERE numerodecontrol='$numerodecontrol'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
    } else {
        die("Registro no encontrado.");
    }
} else {
    die("No se especificó ningún registro.");
}

// Guardar cambios
if (isset($_POST['guardar'])) {
    $padecimiento        = $conexion->real_escape_string($_POST['padecimiento']);
    $grupo               = $conexion->real_escape_string($_POST['grupo']);
    $np                  = $conexion->real_escape_string($_POST['np']);
    $selectivo           = $conexion->real_escape_string($_POST['selectivo']);
    $sexo                = $conexion->real_escape_string($_POST['sexo']);
    $CURP                = $conexion->real_escape_string($_POST['CURP']);
    $nombrecompleto      = $conexion->real_escape_string($_POST['nombrecompleto']);
    $correoinstitucional = $conexion->real_escape_string($_POST['correoinstitucional']);
    $fechadenacimiento   = $conexion->real_escape_string($_POST['fechadenacimiento']);
    $turno               = $conexion->real_escape_string($_POST['turno']);
    $carrera             = $conexion->real_escape_string($_POST['carrera']);
    $direccion           = $conexion->real_escape_string($_POST['direccion']);
    $codigopostal        = $conexion->real_escape_string($_POST['codigopostal']);
    $estado              = $conexion->real_escape_string($_POST['estado']);
    $plantel             = $conexion->real_escape_string($_POST['plantel']);
    $numerotelefonico    = $conexion->real_escape_string($_POST['numerotelefonico']);

    $sql_update = "UPDATE selectivos SET
        padecimiento='$padecimiento',
        grupo='$grupo',
        np='$np',
        selectivo='$selectivo',
        sexo='$sexo',
        CURP='$CURP',
        nombrecompleto='$nombrecompleto',
        correoinstitucional='$correoinstitucional',
        fechadenacimiento='$fechadenacimiento',
        turno='$turno',
        carrera='$carrera',
        dirección='$direccion',
        codigopostal='$codigopostal',
        estado='$estado',
        plantel='$plantel',
        numerotelefónico='$numerotelefonico'
        WHERE numerodecontrol='$numerodecontrol'";

    if ($conexion->query($sql_update) === TRUE) {
        echo "<script>alert('Registro actualizado correctamente'); window.location.href='selectivos.php';</script>";
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Selectivo</title>
<style>
body { font-family: Arial; padding: 20px; background-color: #f0f6f2; }
form { max-width: 800px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);}
input, select { width: 100%; padding: 8px; margin: 6px 0 12px; border: 1px solid #ccc; border-radius: 4px;}
button { background-color: #3aa76d; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;}
button:hover { opacity: 0.85; }
</style>
</head>
<body>

<h2>Editar Selectivo: <?php echo $fila['nombrecompleto']; ?></h2>

<form method="POST">
    <label>Padecimiento</label>
    <input type="text" name="padecimiento" value="<?php echo $fila['padecimiento']; ?>" required>

    <label>Grupo</label>
    <input type="text" name="grupo" value="<?php echo $fila['grupo']; ?>" required>

    <label>NP</label>
    <input type="text" name="np" value="<?php echo $fila['np']; ?>" required>

    <label>Selectivo</label>
    <input type="text" name="selectivo" value="<?php echo $fila['selectivo']; ?>" required>

    <label>Sexo</label>
    <select name="sexo" required>
        <option value="Masculino" <?php if($fila['sexo']=="Masculino") echo "selected";?>>Masculino</option>
        <option value="Femenino" <?php if($fila['sexo']=="Femenino") echo "selected";?>>Femenino</option>
        <option value="Otro" <?php if($fila['sexo']=="Otro") echo "selected";?>>Otro</option>
    </select>

    <label>CURP</label>
    <input type="text" name="CURP" value="<?php echo $fila['CURP']; ?>" required>

    <label>Nombre Completo</label>
    <input type="text" name="nombrecompleto" value="<?php echo $fila['nombrecompleto']; ?>" required>

    <label>Correo Institucional</label>
    <input type="email" name="correoinstitucional" value="<?php echo $fila['correoinstitucional']; ?>" required>

    <label>Fecha de Nacimiento</label>
    <input type="date" name="fechadenacimiento" value="<?php echo $fila['fechadenacimiento']; ?>" required>

    <label>Turno</label>
    <input type="text" name="turno" value="<?php echo $fila['turno']; ?>" required>

    <label>Carrera</label>
    <input type="text" name="carrera" value="<?php echo $fila['carrera']; ?>" required>

    <label>Dirección</label>
    <input type="text" name="direccion" value="<?php echo $fila['direccion']; ?>" required>

    <label>Código Postal</label>
    <input type="text" name="codigopostal" value="<?php echo $fila['codigopostal']; ?>" required>

    <label>Estado</label>
    <input type="text" name="estado" value="<?php echo $fila['estado']; ?>" required>

    <label>Plantel</label>
    <input type="text" name="plantel" value="<?php echo $fila['plantel']; ?>" required>

    <label>Número Telefónico</label>
    <input type="text" name="numerotelefonico" value="<?php echo $fila['numerotelefónico']; ?>" required>

    <button type="submit" name="guardar">Guardar Cambios</button>
</form>

</body>
</html>