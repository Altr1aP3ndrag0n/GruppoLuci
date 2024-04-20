<?php
$s = "ciao";
$file = fopen('csv.csv', 'r');
$data = fgetcsv($file, 1000, ";"); 
$all_record_array = [];
$pesi = [];
$pesoIniziale = [];
while (($data = fgetcsv($file, 1024,";"))!== FALSE) {
    $all_record_array[] = $data;
    $code = $data[0];
    peso = (int)$data[1];
    if (!isset($pesi[$code])) {
        $pesi[$code] = [];
        $pesoIniziale[$code] = $peso;
    }
    $pesi[$code][] = $peso;
}
fclose($file);

foreach ($pesi as $code => $listaDelPeso) {
    $peso_medio = array_sum($listaDelPeso) / count($listaDelPeso);
    $pesoIniziale = $pesoIniziale[$code];
    $tuttiMateriale = $peso_medio - (int)$pesoIniziale;
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th>EMS</th> <th>PESO</th> <th>MISURA</th>
        </thead>
        <tbody>
            <?php foreach($all_record_array as $record){?>
                <tr><td><?=$record[0]?></td><td><?=$record[1]?></td><td><?=$record[2]?></td></tr>
            <?php }?>

            <tr><td><?=$code ?></td><td><?=$peso_medio?></td><td><?=$record[2]?></td></tr>
        </tbody>
    </table>
</body>
</html>
