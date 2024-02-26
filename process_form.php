<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $hidden_field = $_POST['hidden_field'];

    // Проверка на возможность отправки данных второй раз (можно использовать куки или сессии)

    // Далее формируем массив данных для отправки
    $data = [
        'stream_code' => 'iu244',
        'client' => [
            'name' => $name,
            'phone' => $phone,
        ],
        'sub1' => $hidden_field,
    ];

    $url = 'https://order.drcash.sh/v1/order';
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer NWJLZGEWOWETNTGZMS00MZK4LWFIZJUTNJVMOTG0NJQXOTI3',
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpcode == 200) {
        header("Location: thank_you.php");
        exit;
    } else {
        header("Location: error.php");;
        exit;
    }
}
?>