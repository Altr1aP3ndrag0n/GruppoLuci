<?php
include_once 'db_connect.php';
$db = $conn;

$s = "ciao";
$file = fopen('csv.csv', 'r');
$data = fgetcsv($file, 1000, ";"); 
$pesi = [];
$PesoUtilizzatos = [];
while (($data = fgetcsv($file, 1024,";"))!== FALSE) {
    $Codice = $data[0];
    $weight = (int)$data[1]; 
    if (!isset($pesi[$Codice])) {
        $pesi[$Codice] = [];
        $PesoUtilizzatos[$Codice] = $weight;
    }
    $pesi[$Codice][] = $weight;
}



fclose($file);

foreach ($pesi as $Codice => $ListaPesi) {
    $PesoPulito = array_sum($ListaPesi) / count($ListaPesi);
    $PesoUtilizzato = $PesoUtilizzatos[$Codice];
    $material_collected = $PesoPulito - (int)$PesoUtilizzato;
    
    
    if (!is_int($Codice)) {
        continue;
    }

    $stmt = $db->prepare("INSERT INTO Filtri (Codice, PesoPulito, PesoUtilizzato) VALUES (?,?,?)");
    $stmt->bind_param("iff", $Codice, $PesoPulito, $PesoUtilizzato);
    $stmt->execute();    
}
//echo "Codice: $Codice, Average weight: $PesoPulito, Material collected: $material_collected\n"; se volete vedere cosa stampa
?>
