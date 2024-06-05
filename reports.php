<?php
    include_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Reports</title>
</head>
    <body>
        <img src="gesteco.png" alt="logo di gesteco" id="logo">
        <form name="ordinamento" action="" method="get">
            <select name="ordinare">
                <option value="Codice">Codice</option>
                <option value="PesoPulito">Peso Pulito</option>
                <option value="PesoUtilizzato">Peso Utilizzato</option>
            </select>
            <input type="submit" value="">
        </form>

        <form name="ricerca" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            
        
            <input type="text" name="ricerca" id="ricerca" placeholder="cerca">
            <input type="submit" value="cerca">


            <?php if(isset($_GET['ricerca'])) {
                $ricerca = $_GET['ricerca'];
                // Prepara la query SQL con il filtro di ricerca
                $sql = "SELECT * FROM Filtri WHERE Codice LIKE '%$ricerca%' OR PesoPulito LIKE '%$ricerca%' OR PesoUtilizzato LIKE '%$ricerca%'";
            } else {
                // Query per selezionare tutti i record se non è stata eseguita una ricerca
                $sql = "SELECT * FROM Filtri";
            }

            $query = mysqli_prepare($conn, $sql);
             mysqli_stmt_execute($query);
             $ris = mysqli_stmt_get_result($query);
            ?>

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
                if(mysqli_num_rows($ris) >= 0) {
                    $i = 0;    
                    while($row = mysqli_fetch_assoc($ris)) {
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
        </form>

    </body>
</html>
