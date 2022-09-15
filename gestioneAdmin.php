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
    <script src="funzioni.js"></script>
    <title>Gestione admin</title>
</head>

<body>
    <?php
        session_start();
        if (!isset($_SESSION['username']) || $_SESSION['ruolo'] != 'superadmin') {
        ?> <script>
                alert("Non hai le autorizzazioni necessarie per accedere alla pagina");
                window.location.href = 'gestione.php';
            </script> <?php
        }?>

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
    
        <!-- sezione di aggiunta admin -->

    <div style="margin-left: 10%; width: 30%; float:left;">
        <h2> Aggiungi amministratore </h2> <br><br>
        <form action="gestioneAdmin.php" method="POST" id="formAggiuntaAdmin" name="formAggiuntaAdmin">
            <div class="form-group">
                <label><b>USERNAME</b></label>
                <input type="text" class="form-control" placeholder="Inserisci l'username" size="30" name="username" maxlength="30" id="username">
            </div>
            <div class="form-group">
                <label><b>PASSWORD</b></label>
                <input type="password" class="form-control" placeholder="Password" size="32" name="password" maxlength="32" id="password">
            </div>
            <div class="form-group">
                <label><b>RUOLO</b></label>
                <select id='inputState' class='form-control' name='filtroRuolosx'>

                    <option selected value="-1">Seleziona...</option>
                    <option selected value="admin">Admin</option>
                    <option selected value="superadmin">Superadmin</option>

                </select> <br>
            </div>
            <div style="float: right;">
                <input type="submit" class="btn btn-success" onclick="return validazioneAggiuntaAdmin()" name="invioAggiunta"/>
            </div>
        </form>
    </div>
    
        <!-- sezione di modifica admin -->

    <div style="margin-right: 10%; width: 40%; float:right;" class="text-align:center;">
        <h2> Modifica amministratore </h2> <br><br><br>
        <form action="gestioneAdmin.php" method="POST">
            <table>
                <td>
                    <div>
                        <select id='inputState' class='form-control' name='filtroUtentedx'>
                            <option value="-1" selected >Seleziona utente</option>
                            <?php
                                require "funzioni.php";
                                $conn = connessione();
                                $query = "Select username from utentegestione";
                                $result = @mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $row['username']; ?> "> <?php echo $row['username']; ?> 
                                </option>;
                                <?php
                                }
                            ?>
                        </select>
                    </div>
                </td>
                <td>
                    <div>
                        <select id='inputState' class='form-control' name='filtroRuolodx'>
                            <option selected value=-1>Nuovo ruolo</option>
                            
                            <option selected value="admin">Admin</option>
                            <option selected value="superadmin">Superadmin</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input type="password" name="nuovaPassword" maxlength="32" placeholder="Nuova password" />
                </td>
                <td>
                    <div style="float: right;">
                        <input type="submit" class="btn btn-success" onclick="return validazioneModificaAdmin()" name="modifica" value="modifica" />
                    </div>
                </td>
            </table>
        </form> <br> <br>
            <!-- sezione di eliminazione admin -->
            <h2> Elimina amministratore </h2> <br><br>
            <form action="gestioneAdmin.php" method="POST">
            <table style="text-align: center;">
                <td>
                    <div>
                        <select id='inputState' class='form-control' name='filtroUtenteElimina'>
                            <option selected value=-1>Seleziona utente</option>
                            <?php
                            $query = "Select username from utentegestione";
                            $result = @mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row['username']; ?> "> <?php echo $row['username']; ?> 
                            </option>; <?php } ?>
                        </select>
                    </div>
                </td>
                <td>
                    <div style="float: right;">
                        <input type="submit" class="btn btn-success" onclick=" return validazioneEliminaAdmin()" name="elimina" value="elimina" />
                    </div>
                </td>
            </table>
            </form>
        
    </div>
    <?php
    if ( isset($_POST['invioAggiunta']) ) { //se è stata inviata la form di aggiunta

        $username = $_POST['username'];
        $password = $_POST['password'];
        $ruolo = $_POST['filtroRuolosx'];

        $query = "select * from utentegestione where username = '$username'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) != 0) {
    ?> <script>
            alert('Username già registrato');
        </script>
    <?php
        } else {
            $query = "insert into utentegestione values('$username', md5('$password'), 0 , '$ruolo')";
            $result = mysqli_query($conn, $query); ?>
            <script>
                alert('Inserimento avvenuto con successo');
            </script> <?php
        }
    }

    if(isset($_POST['modifica'])){ // se è stata inviata la form di modifica

        $username = $_POST['filtroUtentedx'];
        $ruolo = $_POST['filtroRuolodx'];
        $nuovaPassword = $_POST['nuovaPassword'];

        if($ruolo == -1){
            $query = "update utenteGestione set password = md5('$nuovaPassword') where username = '$username'";
        }
        else if($nuovaPassword == ""){
            $query = "update utenteGestione set ruolo = '$ruolo' where username = '$username'";
        }
        else{
            $query = "update utenteGestione set ruolo = '$ruolo', password = md5('$nuovaPassword') where username = '$username'";
        } 
        $result = mysqli_query($conn, $query);
        if($result){?>
        <script> alert("Modifica effettuata con successo"); </script> <?php }
    }

    if(isset($_POST['elimina'])){ // se è stata inviata la form di eliminazione

        $username = $_POST['filtroUtenteElimina'];
        $query = "DELETE FROM utenteGestione where username = '$username'";
        $result = mysqli_query($conn, $query);
        if($result){?>
            <script> alert("Eliminazione effettuata con successo"); </script> <?php }
        }
    ?>
</body>
</html>