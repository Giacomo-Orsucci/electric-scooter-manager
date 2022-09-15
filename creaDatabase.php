<?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
   
    $conn = @mysqli_connect($host, $user, $pass);

    if (mysqli_connect_errno()) {
        die("Connessione fallita: " . mysqli_connect_error());
    }

    //queries di creazione e popolamento del database di default

    $query = "CREATE DATABASE IF NOT EXISTS monopattino DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";

    $result = mysqli_query($conn, $query);

    $query = "USE monopattino";

    $result = mysqli_query($conn, $query);

    $query = "DROP TABLE IF EXISTS monopattino";

    $result = mysqli_query($conn, $query);

    $query = "CREATE TABLE IF NOT EXISTS monopattino (
    id int(11) NOT NULL AUTO_INCREMENT,
    disponibile tinyint(1) NOT NULL,
    idStazioneSosta int(11) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY idStazioneSosta (idStazioneSosta))"; 

    $result = mysqli_query($conn, $query);

    $query = "INSERT INTO monopattino (id, disponibile, idStazioneSosta) VALUES
    (1, 0, NULL),
    (2, 1, 1),
    (3, 1, 2),
    (4, 1, NULL)";

    $result = mysqli_query($conn, $query);

    $query = "DROP TABLE IF EXISTS noleggio";

    $result = mysqli_query($conn, $query);

    $query = "CREATE TABLE IF NOT EXISTS noleggio (
    id int(11) NOT NULL AUTO_INCREMENT,
    CFUtente varchar(16) NOT NULL,
    IDMonopattino int(11) NOT NULL,
    dataOraInizio datetime NOT NULL,
    dataOraFine datetime DEFAULT NULL,
    idstazionenoleggio int(11) NOT NULL,
    idstazionerestituzione int(11) DEFAULT NULL,
    PRIMARY KEY (id),
    KEY CFUtente (CFUtente),
    KEY IDMonopattino (IDMonopattino),
    KEY idstazionenoleggio (idstazionenoleggio),
    KEY idstazionerestituzione (idstazionerestituzione))";

    $result = mysqli_query($conn, $query);

    $query = "INSERT INTO noleggio (id, CFUtente, IDMonopattino, dataOraInizio, dataOraFine, idstazionenoleggio, idstazionerestituzione) VALUES
    (1, 'PRZCBF88T61A196R', 1, '2021-05-02 16:30:00', NULL, 1, NULL),
    (2, 'PRZCBF88T61A196R', 2, '2021-01-01 16:30:00', '2021-01-01 17:30:00', 1, 1),
    (3, 'PCPGSJ69R20L235Y', 3, '2021-02-01 17:30:00', '2021-02-02 18:30:00', 2, 2),
    (4, 'PCPGSJ69R20L235Y', 4, '2021-05-02 16:50:00', NULL, 2, NULL),
    (5, 'PCPGSJ69R20L235Y', 3, '2021-03-01 15:30:00', '2021-03-01 18:30:00', 2, 2)";

    $result = mysqli_query($conn, $query);

    $query = "DROP TABLE IF EXISTS stazione";

    $result = mysqli_query($conn, $query);

    $query = "CREATE TABLE IF NOT EXISTS stazione (
    id int(11) NOT NULL AUTO_INCREMENT,
    via varchar(38) NOT NULL,
    nSlot int(11) NOT NULL,
    PRIMARY KEY (id))"; 

    $result = mysqli_query($conn, $query);

    $query = "INSERT INTO stazione (id, via, nSlot) VALUES
    (1, 'viale adua', 20),
    (2, 'piazza mazzini', 30)";

    $result = mysqli_query($conn, $query);

    $query = "DROP TABLE IF EXISTS utente";

    $result = mysqli_query($conn, $query);

    $query = "CREATE TABLE IF NOT EXISTS utente (
    cf varchar(16) NOT NULL,
    nome varchar(30) NOT NULL,
    cognome varchar(30) NOT NULL,
    cellulare varchar(10) NOT NULL,
    mail varchar(320) NOT NULL,
    idcarta int(11) NOT NULL AUTO_INCREMENT,
    ncartacredito varchar(32) NOT NULL,
    PRIMARY KEY (cf),
    UNIQUE KEY idcarta (idcarta))"; 

    $result = mysqli_query($conn, $query);

    $query = "INSERT INTO utente (cf, nome, cognome, cellulare, mail, idcarta, ncartacredito) VALUES
    ('PCPGSJ69R20L235Y', 'Mario', 'Rossi', '3568999999', 'mario.rossi@gmail.com', 1, '9587a9638d980f50727297e9a0cca08e'),
    ('PRZCBF88T61A196R', 'Paolo', 'Paoli', '4861351651', 'paolo.paoli@hotmail.it', 2, '13dd492ae82a688990995634f03bede7')";

    $result = mysqli_query($conn, $query);

    $query = "DROP TABLE IF EXISTS utentegestione";

    $result = mysqli_query($conn, $query);

    $query = "CREATE TABLE IF NOT EXISTS utentegestione (
    username varchar(30) NOT NULL,
    password varchar(32) NOT NULL,
    loggato tinyint(1) NOT NULL,
    ruolo enum('admin','superadmin') NOT NULL,
    PRIMARY KEY (username),
    UNIQUE KEY password (password))";

    $result = mysqli_query($conn, $query);

    $query = "INSERT INTO utentegestione (username, password, loggato, ruolo) VALUES
    ('Giacomo Orsucci', '98fe6f1b7042b540f4ee477b8433d789', 0, 'superadmin'),
    ('Mario', '202cb962ac59075b964b07152d234b70', 0, 'admin')";

    $result = mysqli_query($conn, $query);

    if($result){ ?>
        <script> 
        
            alert("Database creato con successo");
            window.location.replace('gestione.php');

        </script> <?php }
    ?>