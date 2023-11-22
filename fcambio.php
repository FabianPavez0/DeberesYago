<!DOCTYPE html>
<html>
    <!-- capçalera-->

    <head>
        <meta charset="UTF-8">
        <title>Cambio de moneda</title>
    </head>
    <!-- cos-->

    <body>
        <?php

// cargamos el contenido del archivo

$arxiu = "moneda.xml";
$me_interesan = ["USD", "JPY", "SEK", "GBP", "CAD"];
$mi_cambio = array("USD"=>0, "JPY"=>0, "SEK"=>0, "GBP"=>0, "CAD"=>0);

if(!$xml = simplexml_load_file($arxiu)){
    echo "No s'ha pogut carregar l'arxiu";
    die();
    } 
$mis_datos = $xml->Cube->Cube;

// carga los datos en el array
foreach ($mis_datos->Cube as $cambio) {
    $rate = (string)$cambio['rate'];
    $currency = (string)$cambio['currency'];
 
    if (in_array($currency, $me_interesan)) {
        $mi_cambio[$currency] = $rate;      
    }

}
// Agafam les variables del get del navegador
$moneda = isset($_GET["moneda"]) ? $_GET["moneda"] : "";
$cantidadEuros = isset($_GET["cantidad"]) ? $_GET["cantidad"] : "";
/// -----------------------------------------
// comprovarem si tenim dades o no ----------
if ($moneda=="" || $cantidadEuros == ""){
$tengo_datos = false;
} else {
$tengo_datos = true;
}
?>
        <form action="fcambio.php" method="get">
            <label for="moneda">¿Qué cambio quieres conocer?:</label>
            <select name="moneda" id="moneda">
                <option value="USD" <?php echo ($moneda=="USD"? "selected": ""); ?>>
                    Dólar Americano</option>
                <option value="SEK" <?php echo ($moneda=="SEK"? "selected": ""); ?>>
                    Corona Sueca</option>
                <option value="GBP" <?php echo ($moneda=="GBP"? "selected": ""); ?>>
                    Libra esterlina</option>
                <option value="JPY" <?php echo ($moneda=="JPY"? "selected": ""); ?>>
                    Yen</option>

            <label for="cantidad">Cantidad de euros:</label>
            <input type="number" name="cantidad" id="cantidad" required>
            </select>
            <p><input type="submit" value="Enviar"></p>
        </form>
        <hr>
        <?php
if($tengo_datos==true) {
echo "Has elegido: $moneda<br>";
echo "Cantidad de euros: $cantidadEuros<br>";
$cambio = $mi_cambio[$moneda] * $cantidadEuros;
echo "Cambio de moneda: $cambio $moneda<br>";
/*echo "Tiene un cambio respecto al euro de :".$mi_cambio[$moneda]."<br>";*/
} 
?>
        <hr>
    </body>

</html>
