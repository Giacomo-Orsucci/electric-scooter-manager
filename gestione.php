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
    <title>Gestione</title>
</head>

<body>
    <?php 
        
        require "funzioni.php";

        controlloSessione();

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
    <h2 class="text-center"> Bentornato <?php echo $_SESSION['username']; ?> </h2>
</body>
</html>