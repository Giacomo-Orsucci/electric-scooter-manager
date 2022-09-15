<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="funzioni.js"> </script>
    <title>Registrazione</title>
</head>

<body class="bg-primary">
    <div class='container-fluid' style="height: auto;">
        <br><br><br><br><br>
        <div style="margin: auto; padding-top: auto; width: 50%; ">
            <form action="registrazione.php" method="POST" id="validazioneRegistrazione">
                <div class="form-group">
                    <label><b>Nome</b></label>
                    <input class="form-control" type="text" placeholder="Inserisci il nome" id="nome" maxlength="30" name="Nome">

                </div>
                <div class="form-group">
                    <label><b>Cognome</b></label>
                    <input class="form-control" type="text" placeholder="Inserisci il cognome" id="cognome" maxlength="30" name="Cognome">

                </div>
                <div class="form-group">
                    <label><b>Codice Fiscale</b></label>
                    <input class="form-control" type="text" placeholder="Inserisci il Codice Fiscale" id="codiceFiscale" maxlength="16" minlength="16" name="CF">

                </div>
                <div class="form-group">
                    <label><b>Numero di telefono</b></label>
                    <input class="form-control" type="text" placeholder="Inserisci il numero di telefono" id="nTelefono" maxlength="10" minlength="10" name="Numero">

                </div>
                <div class="form-group">
                    <label> <b>Indirizzo email </b></label>
                    <input type="email" class="form-control" id="email" placeholder="Inserisci la tua email" name="Email" maxlength="320">
                </div>
                <div class="form-group">
                    <label><b>Numero carta di credito</b></label>
                    <input type="password" class="form-control" placeholder="Inserisci il numero di carta di credito" id="cartaCredito" maxlength="16" minlength="16" name="NCartaCredito">
                    <small class="form-text "> <b>La sicurezza dei nostri clienti è la nostra priorità! Il numero di carta di credito verrà usato solo per accreditare i noleggi effettuati.</b></small>
                </div>
                    
                <div style="float: right;">
                    <button type="button" class="btn bg-success" onclick="validazioneRegistrazione()" name="btnRegistrazione">Invio</button>
                </div>
            </form>
        </div>
    </div>
<?php 

if($_SERVER['REQUEST_METHOD'] == "POST"){ // se viene inviata la form di registrazione

    require "funzioni.php";
    
    $nome = $_POST['Nome'];
    $cognome = $_POST['Cognome'];
    $CF = $_POST['CF'];
    $nTelefono = $_POST['Numero'];
    $email = $_POST['Email'];
    $nCartaCredito = $_POST['NCartaCredito'];

    $conn = connessione();

    if (mysqli_connect_errno()) {
        die("Connessione fallita: " . mysqli_connect_error());
    }

    $query = "SELECT cf FROM utente WHERE cf='$CF'";
    $result = @mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) { //se l'utente non è già stato registrato si aggiunge
            
        $query = "INSERT INTO utente (cf, nome, cognome, cellulare, mail, ncartacredito) VALUES('$CF','$nome','$cognome','$nTelefono', '$email', md5('$nCartaCredito'))";
        $result = @mysqli_query($conn, $query); 

        if($result){
            
    ?>
    <script> alert("Registrazione avvenuta con successo"); </script>
            
    <?php }else{ ?>
            <script> alert("Si è verificato un errore durante l'inserimento"); </script>
    <?php }

    } else { //altrimenti si avverte l'utente che è già registrato ?>

            <script> alert("Utente (codice fiscale) già registrato"); </script>
        <?php }      
} ?>
</body>
</html>