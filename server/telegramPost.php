<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if (isset($data['name'])) {

  echo json_encode(['status' => 'success', 'message' => 'Message received: ' . $data['name']]);
} else {
  echo json_encode(['status' => 'error', 'message' => 'No message received']);
}

//
//if($_POST['name']) {
//  $param = json_decode($_POST['name']);
//  //$row = get_text($param->id);
//}
//
//// сюда нужно вписать токен вашего бота
//define('TELEGRAM_TOKEN', '6972210628:AAGqBKmbTYZe6YeLdG7YfZXuIBW0AKldO_w');
//
//// сюда нужно вписать ваш внутренний айдишник
//define('TELEGRAM_CHATID', '1753794531');
//
//message_to_telegram('Привет!');
//function message_to_telegram($text)
//{
//  $ch = curl_init();
//  curl_setopt_array(
//    $ch,
//    array(
//      CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
//      CURLOPT_POST => TRUE,
//      CURLOPT_RETURNTRANSFER => TRUE,
//      CURLOPT_TIMEOUT => 10,
//      CURLOPT_POSTFIELDS => array(
//        'chat_id' => TELEGRAM_CHATID,
//        'text' => $text,
//      ),
//    )
//  );
//  curl_exec($ch);
//}
