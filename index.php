<?php

// Nome repo: php-hotel
// Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
// Stampare una tabella con tutti gli hotel e i relativi dati disponibili.

// Iniziate in modo graduale.
// Prima stampate in pagina i dati, senza preoccuparvi dello stile.
// Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.

// Bonus:

//     Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
//     Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)

// NOTA:
// deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore).
// Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel.

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- importo bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>PHP Hotel</title>
</head>

<body>
    <h1 class="text-center m-4">Lista Hotel</h1>
    <hr>

    <!-- form con selezione parcheggio e inserimento voto dell'hotel -->
    <form class="d-flex align-items-center justify-content-center gap-3 mb-3" action="" method=GET>
        <div class="form-check">
            <label for="parking" class="form-check-label">Parcheggio</label>
            <input type="checkbox" class="form-check-input" name="parking" id="parking" <?php echo isset($_GET['parking']) ? 'checked' : '' ?>>
        </div>

        <div class="input-group input-group-sm" style="width: 150px;">
            <label for="vote" class="input-group-text">Voto Min</label>
            <input type="number" name="vote" id="vote" min=0 max=5 <?php echo isset($_GET['vote'])  ?? ''; ?>>
        </div>

        <button class="btn btn-outline-primary btn-sm" type="submit">Cerca</button>
    </form>
    <hr>


    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $filtered = $hotels;

                // imposto la condizione se è selezionato il checkbox oppure c'è un voto
                if (isset($_GET["parking"]) || isset($_GET["vote"])) {
                    $filtered = array_filter($hotels, function ($hotel) {
                        $pass = true;

                        // se c'è il parcheggio pass resta vera
                        if (isset($_GET["parking"])) {
                            $pass = $pass && $hotel["parking"] === true;
                        }

                        // se il voto inserito è maggiore uguale di quello dell'hotel pass resta vera
                        if (isset($_GET["vote"]) && is_numeric($_GET["vote"])) {
                            $pass = $pass && $hotel["vote"] >= $_GET["vote"];
                        }

                        return $pass;
                    });
                }

                // ciclo su tutti gli hotel
                foreach ($filtered as $hotel) {

                    // per ogni hotel stampa la riga con il valore della chiave corrispondente
                    echo "<tr>";
                    foreach ($hotel as $key => $value) {
                        echo "<td>";
                        // se la chiave è 'parking', controlla il valore booleano
                        if ($key === 'parking') {
                            echo $value ? " Presente" : "Assente";
                        } else {
                            echo $value;
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

</body>

</html>