<?php
include_once 'db_connect.php';
$db = $conn;

$s = "ciao";
$file = fopen('csv.csv', 'r');
$data = fgetcsv($file, 1000, ";"); 
$pesi = [];
$PesoUtilizzatos = [];

$Codice = $data[1];
while (($data = fgetcsv($file, 1024,";"))!== FALSE) {
    if ($data[1]) {
        echo $data[1]. 'parte iniziale'. "\n";
        if (strtolower(substr($Codice, 0, 1)) === 'c') {
            echo 'parte secondaria'. "\n";
        }
        $Codice = $data[1];
    }
    $weight = (int)$data[1];
    if (!isset($pesi[$Codice])) {
        $pesi[$Codice] = [];
        $PesoUtilizzatos[$Codice] = $weight;
    }
    $pesi[$Codice][] = $weight;
    var_dump($data[1]);
}

fclose($file);

foreach ($pesi as $Codice => $ListaPesi) {
    $PesoPulito = array_sum($ListaPesi) / count($ListaPesi);
    $PesoUtilizzato = $PesoUtilizzatos[$Codice];
    $material_collected = $PesoPulito - (int)$PesoUtilizzato;

    $stmt = $db->prepare("INSERT INTO Filtri (Codice, PesoPulito, PesoUtilizzato) VALUES (?,?,?)");
    $stmt->bind_param("sii", $Codice, $PesoPulito, $PesoUtilizzato);
    $stmt->execute();    
}

$sql = "SELECT * FROM Filtri";
$query = mysqli_prepare($db, $sql);
mysqli_stmt_execute($query);
$ris = mysqli_stmt_get_result($query);

if (mysqli_num_rows($ris) > 0) {
    while ($row = mysqli_fetch_assoc($ris)) {
    }
} else {
    echo "No data found in the Filtri table.\n";
}
?>
