<?php
$dir = opendir('');
$countFiles = 0;
while($file = readdir($dir)){
  if($file == '.txt'){
    continue;
  }
  $countFiles++;
}
echo 'Количество файлов: ' . $countFiles;
const TELEGRAM_TOKEN = '6972210628:AAGqBKmbTYZe6YeLdG7YfZXuIBW0AKldO_w';
const TELEGRAM_CHATID = '1753794531';
    $entityBody = file_get_contents('php://input');
    $body  = json_decode($entityBody,true);
    echo($body);
    echo $entityBody;
    $filename = '_info.txt';

    $info = "ID: {$body['id']}  Имя: {$body['name']} phone: {$body['phone']}";
    $sendID =['ID' => $body['id'] , 'Имя:'=> $body['name'] , 'Phone' => $body['phone']];
message_to_telegram($body,$filename,json_encode($sendID),$body,$countFiles);


function message_to_telegram($text,$filename,$info,$body,$countFiles)
{
  if ($body['id']>=4){
    $fp = fopen("'_info'.$countFiles.'-'.'.txt'", "w");
  }
    file_put_contents($filename,$info,FILE_APPEND);
    $message = "заявка № {$text['id']}\n Тип заявки :{$text['title']}  \n Имя: {$text['name']}\n Номер Телефона: {$text['phone']}";
  $ch = curl_init();
  curl_setopt_array(
    $ch,
    array(
      CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
      CURLOPT_POST => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_TIMEOUT => 10,
      CURLOPT_POSTFIELDS => array(
        'chat_id' => TELEGRAM_CHATID,
        'text' => $message,
      ),
    )
  );
  curl_exec($ch);
}

