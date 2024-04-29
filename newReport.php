<?php
include_once 'db_connect.php';
$db = $conn;

$s = "ciao";
$file = fopen('csv.csv', 'r');
$data = fgetcsv($file, 1000, ";"); 
$all_record_array = [];
$pesi = [];
$PesoUtilizzatos = [];
while (($data = fgetcsv($file, 1024,";"))!== FALSE) {
    $all_record_array[] = $data;
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

    $stmt = $db->prepare("INSERT INTO Filtri (Codice, PesoPulito, PesoUtilizzato) VALUES (:Codice, :PesoPulito, :PesoUtilizzato)");
    $stmt->bindParam(':PesoUtilizzato', $PesoUtilizzato);
    $stmt->bindParam(':Codice', $Codice);
    $stmt->bindParam(':PesoPulito', $PesoPulito);
    $stmt->execute();
 
    echo "Codice: $Codice, PesoPulito: $PesoPulito, Peso utilizzato: $PesoUtilizzaton";
    }
?>
