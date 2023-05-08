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
                return $val['itemContent'] == $todoItem['itemContent'] ? false : true;
            });
        } else {
            for ($i = 0; $i < count($products); $i++) {
                if ($todoItem['itemContent'] == $products[$i]['itemContent']) {
                    /* $products[$i]['state'] = $todoItem['state'] == 'true' ? 'false' : 'true'; */ /* Mo me devi spiegà perchè sto ternario non workava */
                    if($products[$i]['state'] == 'true') {
                        $products[$i]['state'] = 'false'; 
                    }else{
                        $products[$i]['state'] = 'true';
                    }
                }
            }
        }
    } else {
        array_push($products, $todoItem);
        /* file_put_contents('./store.json', json_encode($products)); */
    }
    file_put_contents('./store.json', json_encode($products));
}

header('Content-Type: application/json');
echo json_encode($products);
