<?php
include("config/verbos.php");

$indexVerbos = [];
$solicitarniveles = true;
$inputs = [];
$cantidadverbos = 0;

if (isset($_POST['cantidadverbos']) && isset($_POST['niveldificultad'])) {
    $cantidadverbos = $_POST['cantidadverbos'];
    $niveldificultad = $_POST['niveldificultad'];
}

if (isset($_POST['resolvernivel'])) {
    for ($auxIndexVerbos = 0; $auxIndexVerbos < 208; $auxIndexVerbos++) {
        for ($aiv = 0; $aiv <= 3; $aiv++) {
            $input = 'input' . $auxIndexVerbos . '_' . $aiv;
            if (isset($_POST[$input])) {
                $inputs[$input] = $_POST[$input];
            }
        }
    }
}

if (isset($_POST['volver'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alejandro Vaquero Abad</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <style>
        <?php
        if (!isset($_POST['resolvernivel'])) {
            $botondisplay = "block";
        } else {
            $botondisplay = "none";
        }
        ?>
    </style>
</head>

<body>
    <form action="" method="post">
        <table border='1px solid black;'>
            <?php
            if ($solicitarniveles) {
                if ($indexVerbos == []) {
                    while (count($indexVerbos) < $cantidadverbos) {
                        $aux = rand(0, 208);
                        if (!in_array($aux, $indexVerbos)) {
                            $indexVerbos[] = $aux;
                        }
                    }
                    for ($i = 0; $i < count($indexVerbos); $i++) {
                        echo "<tr>";
                        $valoresAdivinar = range(0, 3);
                        shuffle($valoresAdivinar);
                        $auxVerbos = array_slice($valoresAdivinar, 0, $niveldificultad);
                        for ($j = 0; $j <= 3; $j++) {
                            if (!in_array($j, $auxVerbos)) {
                                echo "<td>" . $verbosIrregulares[$indexVerbos[$i]][$j] . "</td>";
                            } else {
                                echo '<td><input type="text" name="input' . $indexVerbos[$i] . '_' . $j . '"></td>';
                            }
                        }
                        echo '</tr>';
                    }
                }
                echo '</table><br><br>';
            }

            echo '<input type="submit" name="resolvernivel" value="Comprobar mi test" style="display: ' . $botondisplay . ';">';


            if (isset($_POST['resolvernivel'])) {
                echo "<table border='1px solid black'>";
                $correctas = 0;
                $incorrectas = 0;
                for ($auxIndexVerbos = 0; $auxIndexVerbos < 208; $auxIndexVerbos++) {
                    if (isset($inputs['input' . $auxIndexVerbos . '_0']) || isset($inputs['input' . $auxIndexVerbos . '_1']) || isset($inputs['input' . $auxIndexVerbos . '_2']) || isset($inputs['input' . $auxIndexVerbos . '_3'])) {
                        echo "<tr>";
                        foreach ($verbosIrregulares[$auxIndexVerbos] as $aiv => $verbo) {
                            $idClase = "";
                            $auxAciertoError = "";
                            $nombreInput = 'input' . $auxIndexVerbos . '_' . $aiv;
                            if (isset($inputs[$nombreInput])) {
                                $userInput = $inputs[$nombreInput];
                                if ($userInput === $verbo) {
                                    $correctas++;
                                    $auxAciertoError = ":)";
                                    $idClase = "acierto";
                                } else {
                                    $incorrectas++;
                                    $auxAciertoError = ":(";
                                    $idClase = "error";
                                }
                            }
                            echo '<td id="' . $idClase . '">' . $verbo . " " . $auxAciertoError . "</td>";
                        }
                        echo '</tr>';
                    }
                }
                echo '</table>';
                echo '<div> Has acertado un total de ' . $correctas . ' forma/s verbal/es';
                echo '<div> Has fallado un total de ' . $incorrectas . ' forma/s verbal/es';
            }
            ?>
            <br><input type="submit" name="volver" value="Volver a generar test">
    </form>
</body>

</html>