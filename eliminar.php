<?php
include 'conexion.php';

if (isset($_GET['numerodecontrol'])) {
    $numerodecontrol = $conexion->real_escape_string($_GET['numerodecontrol']);

    $sql = "DELETE FROM selectivos WHERE numerodecontrol='$numerodecontrol'";
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Registro eliminado correctamente'); window.location.href='selectivos.php';</script>";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
} else {
    echo "No se especificó ningún registro.";
}

$conexion->close();
?>