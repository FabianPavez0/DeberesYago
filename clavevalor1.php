<?php

$code = $_GET['code'];

$fila = 0;
$fila1 = 0;

$array1 = [];


$file = fopen('iata_airlines.csv', 'r');
while (($line = fgetcsv($file,2000,'^')) !== FALSE) {

$array1[$fila] = $line;
$fila ++;
}
fclose($file);

$array2 = [];

$file1 = fopen('airport.csv', 'r');
while (($line1 = fgetcsv($file1)) !== FALSE) {

$array2[$fila1] = $line1;
$fila1 ++;
}
fclose($file1);

for($i=0;$i<count($array1);$i++)

if($code == $array1[$i][0])
{
echo $array1[$i][2];
}
for($i=0;$i<count($array2);$i++)
{

if($code == $array2[$i][9])
{
echo $array2[$i][2];
}
}

?>
