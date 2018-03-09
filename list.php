<?php
require_once('inc/db.php');

$type = empty($_GET['type']) ? 'api_name' : $_GET['type'] ;

if($type === 'api_name') {
    $table = 'apis';
    $foreign = 'api_category';
}else {
    echo 'vtf';
}

$query = $pdo->prepare("SELECT * FROM apis WHERE $foreign = ?");
$query->execute([$_GET['filter']]);
$items = $query->fetchAll();
// var_dump($items);
header('Content-Type: application/json');

echo json_encode(array_map(function($item) {
    return [
        'api_id' => $item->api_id,
        'api_name' => $item->api_name,
        'api_type' => $item->api_url
    ];
}, $items));

// array_map(function($item){
//     return [
//         'label' => $item['']
//     ]
// }, items);