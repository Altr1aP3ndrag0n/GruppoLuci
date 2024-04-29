<?php
    include_once 'db_connect.php';
    
    $sql = "SELECT * FROM Filtri";
    $query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports</title>
</head>
    <body>
        <form name="ordinamento" action="" method="get">
            <select name="ordinare">
                <option value="Codice">Codice</option>
                <option value="PesoPulito">Peso Pulito</option>
                <option value="PesoUtilizzato">Peso Utilizzato</option>
            </select>
            <input type="submit" value="">
        </form>

        <form name="ricerca" action="">
            <input type="text" name="" id="">
            <input type="submit" value="">
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Codice</th>
                    <th>Peso Pulito</th>
                    <th>Peso Utilizzato</th>     
                </tr>
            </thead>
            <tbody>
            <?php 
                if(mysqli_num_rows($query) >= 0) {
                    $i = 0;    
                    while($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?php echo $row["Codice"] ?></td>
                        <td><?php echo $row["PesoPulito"] ?></td>
                        <td><?php echo $row["PesoUtilizzato"] ?></td>
                    </tr>   
                <?php
                        $i++;
                    }
                    }
                ?>
            </tbody>
        </table>
        <form name="esportazione" action=""><input type="submit" value="Esporta"></form>

    </body>
</html>