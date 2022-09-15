<?php

    function controlloSessione(){ //funzione di controllo sulle sessioni
        session_start(); 
        if(!isset($_SESSION['username'])){
            header("Location: loginGestione.html");
        }
    }

    function connessione(){ //funzione di creazione della connessione al DB

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "Monopattino";
        
        $conn = @mysqli_connect($host, $user, $pass, $db);

        if (mysqli_connect_errno()) {
            die("Connessione fallita: " . mysqli_connect_error());
        }
        return $conn;
    }
?>