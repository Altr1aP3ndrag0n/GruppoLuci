<?php
define('ABS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
include_once 'db_connect.php';
$db = $conn;

$s = "ciao";
$namefile = "csv.csv";
$file = fopen($namefile, 'r');
fgetcsv($file, 1000, ";"); // Skip the header row

$pesi = [];
$Pesoutilizzato = [];
$codice = [];

while (($data = fgetcsv($file, 1024, ";"))!== FALSE) {
    $codice[] = $data[1];
    $pesi[] = $data[3];
    $Pesoutilizzato[] = $data[3];
}

fclose($file);
foreach ($pesi as $i => $data) {
    $PesoPulito = $Pesoutilizzato[$i]/count(array_keys($pesi));
    $stmt = $db->prepare("INSERT INTO Filtri (Codice, PesoPulito, PesoUtilizzato) VALUES (?,?,?)");
    $stmt->bind_param("sii", $codice[$i], $PesoPulito, $Pesoutilizzato[$i]);
    $stmt->execute();
}


$file =  ABS_PATH . 'csv.csv';
$dest_path = ABS_PATH . 'archivio';

if(file_exists($dest_path)) {
	if(rename($file, $dest_path . '/csv.csv')) {
        echo "File successfully moved";
    }
    else {
        echo "Error moving file";
    }
}



?>
