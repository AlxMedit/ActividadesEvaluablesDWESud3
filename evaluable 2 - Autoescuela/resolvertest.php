<?php
include 'config/tests_cnf.php';

if (isset($_POST['resolvertest'])) {
    $aciertos = 0;
    $numpreguntas = 0;
    $numtest = $_POST['numtest'];
    foreach ($aTests[$numtest]["Preguntas"] as $id => $pregunta) {
        $numpreguntas++;
        if (isset($_POST['respuesta' . $numtest . $pregunta['idPregunta']])) {
            if ($_POST['respuesta' . $numtest . $pregunta['idPregunta']] == $aTests[$numtest]["Corrector"][$id]) {
                $aciertos++;
            }
        }
    }
    #Necesitas un 7 o mas para aprobar, por lo tanto, +6 aciertos
    if ($aciertos > 6) {
        echo '<h2>Has aprobado con una puntuación de ' . $aciertos . '/' . $numpreguntas . '&#128079 </h2>';
        echo 'Por lo que has tenido ' . $aciertos . ' aciertos y ' . 10-$aciertos . ' errores';

    } else {
        echo '<h2>Has suspendido con una puntuación de ' . $aciertos . '/' . $numpreguntas . '&#128534 </h2>';
        echo 'Por lo que has tenido ' . $aciertos . ' aciertos y ' . 10-$aciertos . ' errores' ;
        ;
    }
} else {
    header("Location: index.php");
}
?>