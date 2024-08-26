<?php
// Leggi il file JSON e decodifica in un array associativo
$json_str = file_get_contents('viaggi.json');
$travel_list = json_decode($json_str, true);

if (isset($_POST['title']) && isset($_POST['day']) && isset($_POST['vote'])) {
    $new_vote = $_POST['vote'];
    $title = $_POST['title'];
    $day = $_POST['day'];

    // Il codice originale con &$travel modifica l'array $travel_list direttamente. Dopo l'esecuzione del codice, se $title è 'Viaggio 1' e $day è 1, il valore di vote sarà aggiornato nell'array originale.
    foreach ($travel_list as &$travel) {
        if ($travel['title'] === $title) {
            foreach ($travel['tappe'] as &$tappa) {
                if ($tappa['day'] === $day) {
                    $tappa['vote'] = $new_vote;
                }
            }
        }
    }

    file_put_contents('viaggi.json', json_encode($travel_list, JSON_PRETTY_PRINT));
    header('Content-Type: application/json');
    echo json_encode($travel_list);
};


if (isset($_POST['title']) && isset($_POST['day']) && isset($_POST['visited'])) {
    $title = $_POST['title'];
    $day = $_POST['day'];
    $visited = filter_var($_POST['visited'], FILTER_VALIDATE_BOOLEAN); // Converte la stringa in booleano

    // Il codice originale con &$travel modifica l'array $travel_list direttamente. Dopo l'esecuzione del codice, se $title è 'Viaggio 1' e $day è 1, il valore di vote sarà aggiornato nell'array originale.
    foreach ($travel_list as &$travel) {
        if ($travel['title'] === $title) {
            foreach ($travel['tappe'] as &$tappa) {
                if ($tappa['day'] === $day) {
                    $tappa['visited'] = $visited;
                }
            }
        }
    }

    file_put_contents('viaggi.json', json_encode($travel_list, JSON_PRETTY_PRINT));
    header('Content-Type: application/json');
    echo json_encode($travel_list);
};

header('Content-Type: application/json');
echo json_encode($travel_list);
?>
