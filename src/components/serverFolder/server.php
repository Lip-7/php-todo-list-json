<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With");

$productsString = file_get_contents('./store.json');
$products = json_decode($productsString, true);

if (!empty($_POST['item'])) {
    $todoItem = $_POST['item'];
    if (!empty($todoItem['action'])) {
        if ($todoItem['action'] == 'delete') {
            $products = array_filter($products, function ($val) {
                $todoItem = $_POST['item'];
                return $val['itemContent'] == $todoItem['itemContent'] ? true : false;
            });
        } else {
            foreach ($products as $obj) {
                if ($obj['itemContent'] == $todoItem['itemContent']) {
                    $todoItem['state'] = !$todoItem['state'];
                }
            }
        }
    } else {
        array_push($products, $todoItem);
        file_put_contents('./store.json', json_encode($products));
    }
}

header('Content-Type: application/json');
echo json_encode($products);
