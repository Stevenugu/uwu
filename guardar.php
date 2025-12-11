<?php
include 'config.php';

// Asegúrate que tu archivo config.php define la conexión como $conn
// if (!$conn) { die("Error de conexión..."); }

if (isset($_FILES['archivo_csv']) && $_FILES['archivo_csv']['error'] === UPLOAD_ERR_OK) {
    $archivo_temporal = $_FILES['archivo_csv']['tmp_name'];

    // 1. Prepara la sentencia SQL una sola vez
    $sql = "INSERT INTO datos 
    (padecimiento, grupo, numerodecontrol, np, selectivo, sexo, CURP, nombrecompleto, correoinstitucional, 
    fechadenacimiento, turno, carrera, direccion, codigopostal, estado, plantel, numerotelefonico)	
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt === FALSE) {
        // Manejo de error si la preparación falla (ej. tabla o columna incorrecta)
        die("Error al preparar la consulta: " . $conn->error);
    }

    // 2. Asocia los parámetros: 'sssssssssssssssss' (17 's' por 17 columnas de tipo string)
    // Ajusta si alguna columna es un número (ej. 'i' para entero)
    $stmt->bind_param('sssssssssssssssss', 
        $padecimiento, $grupo, $numerodecontrol, $np, $selectivo, $sexo, $CURP, $nombrecompleto, 
        $correoinstitucional, $fechadenacimiento, $turno, $carrera, $direccion, $codigopostal, 
        $estado, $plantel, $numerotelefonico
    );


    // Abrir el archivo CSV
    if (($handle = fopen($archivo_temporal, "r")) !== FALSE) {
        // Omitir la primera línea (encabezados)
        fgetcsv($handle, 1000, ",");

        while (($datos = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Asigna los valores a las variables (sin necesidad de real_escape_string)
            $padecimiento        = $datos[0];
            $grupo               = $datos[1];
            $numerodecontrol     = $datos[2];
            $np                  = $datos[3];
            $selectivo           = $datos[4];
            $sexo                = $datos[5];
            $CURP                = $datos[6];
            $nombrecompleto      = $datos[7];
            $correoinstitucional = $datos[8];
            $fechadenacimiento   = $datos[9];
            $turno               = $datos[10];
            $carrera             = $datos[11];
            $direccion           = $datos[12];
            $codigopostal        = $datos[13];
            $estado              = $datos[14];
            $plantel             = $datos[15];
            $numerotelefonico    = $datos[16];
            
            // 3. Ejecuta la sentencia con los nuevos valores
            $stmt->execute();
        }

        fclose($handle);
        $stmt->close(); // Cierra la sentencia preparada
        echo "Datos guardados correctamente.";
    } else {
        echo "No se pudo abrir el archivo.";
    }
} else {
    echo "Error al subir el archivo o no se seleccionó archivo.";
}

$conn->close();
?>