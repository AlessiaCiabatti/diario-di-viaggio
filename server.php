<?php
// Leggi il file JSON e decodifica in un array associativo
$json_str = file_get_contents('viaggi.json');
$travel_list = json_decode($json_str, true);

// Controlla se il metodo di richiesta è POST e se sono stati passati i parametri necessari
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['day'], $_POST['vote'])) {
    $title = $_POST['title'];
    $day = $_POST['day'];
    $vote = intval($_POST['vote']);  // Converti il voto a un numero intero

    // Trova il viaggio con il titolo specificato
    foreach ($travel_list as &$travel) {
        if ($travel['title'] === $title) {
            // Trova il giorno specificato e aggiorna il voto
            foreach ($travel['tappe'] as &$tappa) {
                if ($tappa['day'] === $day) {
                    $tappa['vote'] = $vote;
                    break;
                }
            }
            break;
        }
    }

    // Codifica nuovamente l'array in JSON e salva il file
    file_put_contents('viaggi.json', json_encode($travel_list, JSON_PRETTY_PRINT));

    // Restituisci il nuovo JSON come risposta
    header('Content-Type: application/json');
    echo json_encode($travel_list);
} else {
    // Se la richiesta non è valida, restituisci un messaggio di errore
    header('Content-Type: application/json', true, 400);
    echo json_encode(['error' => 'Invalid request']);
}
?>
