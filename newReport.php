<?php
$s = "ciao";
$file = fopen('csv.csv', 'r');
$data = fgetcsv($file, 1000, ";"); 
$all_record_array = [];
while (($data = fgetcsv($file, 1024,";")) !== FALSE) {
    $all_record_array[] = $data;
}
fclose($file);

//echo "<pre>"; print_r($all_record_array);
//header("location:reports.php?s=$s&data=$data");
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
            <?php foreach($all_record_array as $record){ ?>
                <tr><td><?=$record[0]?></td><td><?=$record[1]?></td><td><?=$record[2]?></td></tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
