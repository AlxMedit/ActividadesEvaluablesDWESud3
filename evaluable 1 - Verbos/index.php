<?php
/**
 * 
 * @author Alejandro Vaquero Abad
 * @date 04/11/2023
 * @activity Evaluable 1
 * 
 */
include("config/verbos.php");

$indexVerbos = [];
$solicitarniveles = isset($_POST['solicitartest']);
$inputs = [];

if ($solicitarniveles) {
    $cantidadverbos = $_POST['cantidadverbos'];
    $niveldificultad = $_POST['niveldificultad'];
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alejandro Vaquero Abad</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>
    <h1>Actividad verbos irregulares</h1>
    <form action="generartest.php" method="post">
        <label for="cantidadverbos">¿Cuántos verbos quieres adivinar? </label>
        <input type="number" name="cantidadverbos" value="<?php echo $cantidadverbos ?? '' ?>"><br>
        <label for="niveldificultad">¿Qué nivel de dificultad quieres? </label>
        <select name="niveldificultad">
            <option value=1>1</option>
            <option value=2 selected>2</option>
            <option value=3>3</option>
        </select><br><br>
        <input type="submit" name="solicitartest" value="Generar test"><br><br>
    </form>
</body>

</html>