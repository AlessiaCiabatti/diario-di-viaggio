<?php
// richiamo il file json lo salvo in variabile e lo legge come stringa
$json_str = file_get_contents('viaggi.json');
// var_dump($json_str);

// da stringa la trasformo in un oggetto PHP
$travel_list = json_decode($json_str);
// var_dump($travel_list);



//trasformo il file PHP come se fosse un file json
header('Content-Type: application/json');

//stampo la lista nuovamente trasformata in stringa
echo json_encode($travel_list);
?>