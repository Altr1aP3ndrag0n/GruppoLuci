<?php
    include_once 'db_connect.php';

    $sql = "SELECT * FROM Filtri";
    $query = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($query);

    $ris = mysqli_stmt_get_result($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reports</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header class="header">
            <div class="div-logo">
                <img src="gesteco.png" alt="logo" id="logo">
            </div>
            <div class="form_ricerca">
                <form name="ordinamento" action="" method="get">
                    <select name="ordinare" id="ordinamento">
                        <option value="Codice">Codice</option>
                        <option value="PesoPulito">Peso Pulito</option>
                        <option value="PesoUtilizzato">Peso Utilizzato</option>
                    </select>
                    <input type="submit" value="Ordina">
                </form>

                <form name="ricerca" action="#" method="get">


                    <input type="text" name="ricerca" id="ricerca" placeholder="Cerca">
                    <input type="submit" value="Cerca">

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
            </div>
        </header>

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

    </body>
</html>