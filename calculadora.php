<?php
$op1 = $_GET['op1'];
$op2 = $_GET['op2'];
$operacion = $_GET['operacion'];

$resultado = null;

if (isset($op1) && isset($op2) && isset($operacion)) {
    switch ($operacion) {
        case 'sumar':
            $resultado = $op1 + $op2;
            break;
        case 'restar':
            $resultado = $op1 - $op2;
            break;
        case 'multiplicar':
            $resultado = $op1 * $op2;
            break;
        case 'dividir':
            $resultado = $op1 / $op2;
            break;
    }
}

if ($resultado !== null) {
        echo "El resultado es: $resultado";
    }
?>

