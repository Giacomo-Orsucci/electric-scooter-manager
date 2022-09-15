<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Monopattini in uso</title>
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

    <div div style="margin: auto; padding-top: auto; width: 70%;">
        <?php
        $query = "select monopattino.id, utente.cf, utente.nome, utente.cognome, noleggio.idstazionenoleggio from noleggio inner join monopattino on noleggio.id = monopattino.id inner join utente on noleggio.cfutente = utente.cf where noleggio.idstazionerestituzione is null";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
        ?> <br>
            <h3 class="text-center"> Non vi sono monopattini attualmente in uso </h3> <?php
        } else { ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">CF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Stazione di prelievo</th>
                    </tr>
                </thead>
                <tbody> <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                            <th scope='row'> <?php echo $row['id']; ?> </th>
                            <td><?php echo $row['cf']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cognome']; ?></td>
                            <td><?php echo $row['idstazionenoleggio']; ?></td>
                        </tr>
                <?php   }
            } ?>
                </tbody>
            </table>
    </div>
</body>
</html>