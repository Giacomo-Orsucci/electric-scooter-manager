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
    <title>Gestione stazioni</title>

</head>
<body>
    <?php

    require "funzioni.php";

    controlloSessione();

    $conn = connessione();?>
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

        <!-- verifica disponibilità -->

    <h2 class="text-center"> Verifica la disponibilità dei monopattini nelle diverse stazioni </h2>
    <br> <br>
    <div style='margin: auto; padding-top: auto; width: 30%;'>
        <form action="" method="GET">
            <table>
                <td>
                    <div>
                        <select id='inputState' class='form-control' name='filtro'>

                            <option selected value=-1>Seleziona...</option>

                            <?php

                            $query = "Select id, via from stazione";

                            $result = @mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                                echo "<option value = $row[id]> stazione &nbsp " . $row['id'] . " &nbsp via &nbsp" . $row['via']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </td>
                <br>
                <td>
                    <button type="submit" class="btn btn-success" name="verifica">Verifica</button>
                </td>
            </table>
        </form>
        <?php
        if (isset($_GET['verifica'])) { // se viene inviata la form di verifica della disponibilità

            $idStazione = $_GET['filtro'];

            if ($_GET['filtro'] == -1) {
        ?> <script>
                alert("Non è stata selezionata alcuna stazione");
            </script>
            <?php
            } else {

                $query = "select count(*) as occupati from noleggio where idStazionenoleggio = $idStazione and idstazionerestituzione is null";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $occupati = $row['occupati'];

                $query = "select nSlot from stazione where id = $idStazione";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $liberi = $row['nSlot'] - $occupati;
                echo "<br><br><br><h3 class='text-center'>Monopattini noleggiabili: $liberi </h3>";
            }
        }

        ?>

    </div>

    <br> <br>

        <!-- verifica stazione più usata -->

    <h2 class="text-center"> Seleziona il periodo e vedi qual'è stata la stazione più usata</h2>
    <br>
    <div style='margin: auto; padding-top: auto; width: 30%;'>
        <form action="gestioneStazioni.php" method="POST" id="validazioneDate">
            <table>
                <td>
                    <input type="date" placeholder="Seleziona data" name="dataInferiore" id="dataInferiore" />
                </td>
                <td>
                    <input type="date" placeholder="Seleziona data" name="dataSuperiore" id="dataSuperiore" />
                </td>

                <td>
                    <div>
                        <button style="color:white" type="button" class="btn bg-success" onclick="validazioneData()" name="btnRegistrazione">Invio</button>
                    </div>
                </td>
            </table>
        </form>
    </div> 

    <?php

        if ($_SERVER['REQUEST_METHOD'] == "POST") { // se viene inviata la form di verifica della stazione più usata

            $dataInferiore = $_POST['dataInferiore'];
            $dataSuperiore = $_POST['dataSuperiore'];

            $query = "select idstazionenoleggio, count(idStazioneNoleggio) as noleggi from noleggio where date(dataorainizio) between '$dataInferiore' and '$dataSuperiore' group by idStazioneNoleggio order by noleggi desc";
            $result = mysqli_query($conn, $query);
            $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $id1 = $row1['idstazionenoleggio'];
            $id2 = $row2['idstazionenoleggio'];

            $noleggi1 = $row1['noleggi'];
            $noleggi2 = $row2['noleggi'];

            if(mysqli_num_rows($result) == 0){
                ?> <br><h3 class="text-center"> Non vi sono dati disponibili per il periodo indicato </h3> <?php

            }else if($noleggi1 == $noleggi2){
                ?> <br><h3 class="text-center"> ID stazioni più usate: <?php echo "$id1 e $id2"; ?> </h3> <?php

            }
            else{
                ?> <br><h3 class="text-center"> ID stazione più usata: <?php echo $id1; ?> </h3> <?php
            }
        }
    ?>
</body>
</html>