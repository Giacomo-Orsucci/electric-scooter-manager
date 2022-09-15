<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Resoconto utilizzo monopattini</title>
</head>

<body>
    <?php

        require "funzioni.php";

        controlloSessione();

        $conn = connessione();

    ?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="/monopattino/gestione.php">
            <img src="/monopattino/immagini/stemmaPistoia.png" alt="Logo" style="width:100px;">
        </a>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/monopattino/gestioneAdmin.php">Gestione admin</a>
            </li>
            <li class="nav-item active mr-auto">
                <a class="nav-link" href="/monopattino/gestioneStazioni.php">Gestione stazioni</a>
            </li>
            <li class="nav-item active mr-auto">
                <a class="nav-link" href="/monopattino/monopattiniUso.php">Monopattini in uso </a>
            </li>
            <li class="nav-item active mr-auto">
                <a class="nav-link" href="/monopattino/resocontoMonopattino.php">Utilizzo monopattino </a>
            </li>
            <li class="nav-item active mr-auto">
                <a class="nav-link" href="/monopattino/logout.php">Logout</a>
            </li>
        </ul>
    </nav> <br> <br>

        <!-- verifica utilizzo monopattino selezionato nel mese corrente -->

    <h2 class="text-center"> Seleziona un monopattino e verifica quali utenti lo hanno utilizzato nel mese corrente</h2>
    <br> <br>
    <div style='margin: auto; padding-top: auto; width: 30%;'>
        <form action="" method="GET">
            <select id='inputState' class='form-control' name='filtro'>

                <option selected value=-1>Seleziona...</option>

                <?php

                $query = "Select id from monopattino";

                $result = @mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                    echo "<option value = $row[id]> ID monopattino: &nbsp " . $row['id'];
                }
                
                ?>
            </select> <br>
            <div class="float-right">
                <input type="submit" class="button btn-success" name="verifica" value="verifica" />
            </div>
        </form>
    </div>
    <?php
        if (isset($_GET['verifica'])) {

            $idMonopattino = $_GET['filtro'];

        if ($_GET['filtro'] == -1) {
    ?> <script>
                alert("Non è stata selezionato nessun monopattino");
        </script>
    <?php
        }else{

        $query = "select cfutente, nome, cognome from noleggio inner join utente on cfutente=cf where idMonopattino = $idMonopattino and month(dataorainizio) = month(curdate())";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0){ // se il monopattino non è stato usato nel mese corrente si segnala
            ?> <br><br><h3 class="text-center"> Il monopattino selezionato non è stato usato </h3> <?php
        }else{ // altrimenti si stampa la tabella con il resoconto degli utenti che lo hanno utilizzato
        ?>
        <div div style="margin: auto; padding-top: auto; width: 70%;"> <br> <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo $row['cfutente']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cognome']; ?></td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php }}} ?>
</body>
</html>