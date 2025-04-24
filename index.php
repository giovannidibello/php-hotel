<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- importo bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>PHP Hotel</title>
</head>

<?php

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

<body>
    <h1 class="text-center m-4">Lista Hotel</h1>

    <!-- form con selezione parcheggio e inserimento voto dell'hotel -->
    <form class="text-center mb-3" action="" method=GET>
        <label for="">Parcheggio</label>
        <input type="checkbox" name="parking" id="true" <?php echo isset($_GET['parking']) ? 'checked' : '' ?>>
        <label for="">Voto Min</label>
        <input type="number" name="vote" id="" min=0 max=5 <?php echo isset($_GET['vote'])  ?? ''; ?>>
        <button class="btn btn-outline-primary btn-sm" type="submit">Cerca</button>
    </form>


    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Distance to center</th>
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
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

</body>

</html>