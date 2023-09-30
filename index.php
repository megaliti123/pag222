<!DOCTYPE html>
<html>
<head>
    <title>Registro de Alumnos</title>
</head>
<body>

<h2>Registro de Alumnos</h2>

<form method="post">
    <label for="num_alumnos">Número de Alumnos:</label>
    <input type="number" name="num_alumnos" required>
    <br><br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num_alumnos = $_POST["num_alumnos"];
        
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Física</th><th>Matemáticas</th><th>Programación</th></tr>";

        for ($i = 1; $i <= $num_alumnos; $i++) {
            echo "<tr>";
            echo "<td><input type='text' name='id[]' required></td>";
            echo "<td><input type='text' name='nombre[]' required></td>";
            echo "<td><input type='text' name='apellido[]' required></td>";
            echo "<td><input type='number' name='fisica[]' required></td>";
            echo "<td><input type='number' name='matematicas[]' required></td>";
            echo "<td><input type='number' name='programacion[]' required></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<br><br>";

        echo "<input type='submit' value='Calcular Resultados'>";
    }
    ?>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fisica = $_POST["fisica"];
    $matematicas = $_POST["matematicas"];
    $programacion = $_POST["programacion"];

    $aprobados_fisica = $aprobados_matematicas = $aprobados_programacion = 0;
    $aplazados_fisica = $aplazados_matematicas = $aplazados_programacion = 0;
    $aprobados_todas = $aprobados_una = 0;
    $nota_maxima_fisica = $nota_maxima_matematicas = $nota_maxima_programacion = 0;

    for ($i = 0; $i < count($fisica); $i++) {
        $promedio = ($fisica[$i] + $matematicas[$i] + $programacion[$i]) / 3;

        if ($fisica[$i] >= 6) {
            $aprobados_fisica++;
        } else {
            $aplazados_fisica++;
        }

        if ($matematicas[$i] >= 6) {
            $aprobados_matematicas++;
        } else {
            $aplazados_matematicas++;
        }

        if ($programacion[$i] >= 6) {
            $aprobados_programacion++;
        } else {
            $aplazados_programacion++;
        }

        if ($promedio >= 6) {
            $aprobados_todas++;
        }

        $num_aprobadas = 0;
        if ($fisica[$i] >= 6) $num_aprobadas++;
        if ($matematicas[$i] >= 6) $num_aprobadas++;
        if ($programacion[$i] >= 6) $num_aprobadas++;

        if ($num_aprobadas == 1) {
            $aprobados_una++;
        }

        $nota_maxima_fisica = max($nota_maxima_fisica, $fisica[$i]);
        $nota_maxima_matematicas = max($nota_maxima_matematicas, $matematicas[$i]);
        $nota_maxima_programacion = max($nota_maxima_programacion, $programacion[$i]);
    }

    echo "<h2>Resultados</h2>";
    echo "<p>Número de alumnos aprobados en Física: $aprobados_fisica</p>";
    echo "<p>Número de alumnos aplazados en Física: $aplazados_fisica</p>";
    echo "<p>Número de alumnos aprobados en Matemáticas: $aprobados_matematicas</p>";
    echo "<p>Número de alumnos aplazados en Matemáticas: $aplazados_matematicas</p>";
    echo "<p>Número de alumnos aprobados en Programación: $aprobados_programacion</p>";
    echo "<p>Número de alumnos aplazados en Programación: $aplazados_programacion</p>";
    echo "<p>Número de alumnos que aprobaron todas las materias: $aprobados_todas</p>";
    echo "<p>Número de alumnos que aprobaron una sola materia: $aprobados_una</p>";
    echo "<p>Nota máxima en Física: $nota_maxima_fisica</p>";
    echo "<p>Nota máxima en Matemáticas: $nota_maxima_matematicas</p>";
    echo "<p>Nota máxima en Programación: $nota_maxima_programacion</p>";
}
?>

</body>
</html>
