

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Selectivos</title>
<?php
include 'conexion.php';
?>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f6f2;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #2c6e49;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #3aa76d;
    color: white;
}

tr:nth-child(even) {
    background-color: #e6f2e9;
}

button {
    padding: 6px 12px;
    margin: 2px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
}

.btn-modificar { background-color: #f0ad4e; }
.btn-borrar { background-color: #d9534f; }
.btn-imprimir { background-color: #5bc0de; }

button:hover { opacity: 0.85; }
</style>
</head>
<body>

<h1>Lista de Selectivos</h1>

<table>
    <thead>
        <tr>
            <th>Padecimiento</th>
            <th>Grupo</th>
            <th>Número de Control</th>
            <th>NP</th>
            <th>Selectivo</th>
            <th>Sexo</th>
            <th>CURP</th>
            <th>Nombre Completo</th>
            <th>Correo Institucional</th>
            <th>Fecha de Nacimiento</th>
            <th>Turno</th>
            <th>Carrera</th>
            <th>Dirección</th>
            <th>Código Postal</th>
            <th>Estado</th>
            <th>Plantel</th>
            <th>Número Telefónico</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $consulta = "SELECT * FROM selectivos";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['padecimiento']}</td>
                        <td>{$fila['grupo']}</td>
                        <td>{$fila['numerodecontrol']}</td>
                        <td>{$fila['np']}</td>
                        <td>{$fila['selectivo']}</td>
                        <td>{$fila['sexo']}</td>
                        <td>{$fila['CURP']}</td>
                        <td>{$fila['nombrecompleto']}</td>
                        <td>{$fila['correoinstitucional']}</td>
                        <td>{$fila['fechadenacimiento']}</td>
                        <td>{$fila['turno']}</td>
                        <td>{$fila['carrera']}</td>
                        <td>{$fila['dirección']}</td>
                        <td>{$fila['codigopostal']}</td>
                        <td>{$fila['estado']}</td>
                        <td>{$fila['plantel']}</td>
                        <td>{$fila['numerotelefónico']}</td>
                        <td>
                            <a href='editar.php?numerodecontrol={$fila['numerodecontrol']}'><button class='btn-modificar'>Modificar</button></a>
                            <a href='eliminar.php?numerodecontrol={$fila['numerodecontrol']}' onclick=\"return confirm('¿Seguro que quieres eliminar este registro?');\"><button class='btn-borrar'>Borrar</button></a>
                            <a href='imprimir.php?numerodecontrol={$fila['numerodecontrol']}' target='_blank'><button class='btn-imprimir'>Imprimir</button></a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='18' style='text-align:center;'>No hay registros aún.</td></tr>";
        }

        $conexion->close();
        ?>
    </tbody>
</table>

</body>
</html>
