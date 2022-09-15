<?php 

    require "funzioni.php";

    $conn = connessione();

    if(isset($_POST['logout'])){ //logout "di emergenza"

        $username = $_POST['usernameButton'];
        $query = "UPDATE utenteGestione SET loggato = 0 WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        $_SESSION = array();
        unset($_SESSION);

        echo "Logout effettuato, ora puoi tornare alla pagina di <a href=\"loginGestione.html\">login</a> e connetterti normalmente";
    }
    else{ //controllo sul login

        $username = $_POST["username"];
        $password = $_POST["password"];

        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $passmd5 = md5($password);

        $query = "SELECT * FROM utenteGestione WHERE username='$username' AND password='$passmd5'";
        $result = mysqli_query($conn,$query);
        $conta = mysqli_num_rows($result);

        if($conta==1){ //si controlla se l'utente risulta già connesso
            
            $query = "SELECT loggato FROM utenteGestione WHERE username='$username'";
            $result = mysqli_query($conn,$query);

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if($row['loggato'] == 1){
                
                echo "Siamo spiacenti, non si possono eseguire più connessioni contemporaneamente con lo stesso utente. <br>";
                echo "Torna alla pagina di <a href=\"loginGestione.html\">login</a>. <br>";
                echo "Se hai chiuso il browser senza sloggare ed ora non riesci più ad accedere premi il pulsante sottostante. <br>";
                echo "Prima però assicurati di non essere loggato contemporanemente su atri browser o schede dello stesso browser."

                ?>
                <form action="controlloLogin.php" method="POST">

                <div>
                    <input type='submit' class='btn btn-success' name='logout' value="logout">
                    <input type='text' class='btn btn-success' value = '<?php echo $username; ?>' name='usernameButton' hidden>
                </div>

                </form>

                <?php
            }
            else{ //se il login va a buon fine si setta lo stato dell'utente ad online
                $query = "UPDATE utenteGestione SET loggato = 1 WHERE username='$username'";
                $result = mysqli_query($conn,$query);
                $query = "SELECT ruolo FROM utentegestione WHERE username = '$username'";
                $result = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['ultimo_login'] = time();
                $_SESSION['ruolo'] = $row['ruolo'];
                
                header("Location: gestione.php");   
            } 
        }
        else {
            echo "Identificazione non riuscita: nome utente o password errati <br />";
            echo "Torna alla pagina di <a href=\"loginGestione.html\">login</a>";
        }
    }
?>