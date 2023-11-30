<?
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/..");
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];



@set_time_limit(0);
@ignore_user_abort(true);



if(!($_REQUEST['key'] == 'sI-xr9_W' || $argv[1] == 'sI-xr9_W')) die('Нет доступа');

$request = array();



	$request[] = array(
		'Сайт'			=> 'is-mos.ru',
		'НомерЗаявки'	=> 'IS'.$element['ID'],
		'Дата'			=> $element['DATE_CREATE'],
		'ВидУслуги'		=> $service,
		'Сумма'			=> $element['PROPERTY_SUM_VALUE'],
		'Количество'	=> $element['PROPERTY_COUNT_VALUE'],
		'Имя'			=> $element['NAME'],
		'Телефон'		=> $element['PROPERTY_PHONE_VALUE'],
		'Адрес'			=> $element['PREVIEW_TEXT'],
		'Комментарий'	=> $element['DETAIL_TEXT']
	);



if(!empty($request)){
	/*$file = fopen($_SERVER['DOCUMENT_ROOT'].'/cli/requests_log.txt', 'a+');
	fwrite($file, print_r($request, true));
	fclose($file);
	*/

	//отправляем все заявки
	//$curl = curl_init('http://api.is-mos.ru:8088/poverka/hs/WebAddZakaz/iozVkvXqNKmA');
  $curl = curl_init('http://api.is-mos.ru:8088/poverka/hs/WebAddZakaz/iozVkvXqNKmA');
	curl_setopt($curl, CURLOPT_TIMEOUT, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($curl, CURLOPT_TIMEOUT, 300);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));

	$curl_response = json_decode(curl_exec($curl), true);
	curl_close($curl);

	$count = 0;
	$e = 0;

	//TG REPORT
	//$token = "727903411:AAFq4myWi8-zfWqElwRwyuBmPmF7KSkhW_E";

	foreach ($curl_response as $response){
		if ($response['Загружен'] == 1){
			CIBlockElement::SetPropertyValuesEx(str_replace("IS", "",$response['НомерЗаявки']), false, array(52 => 9)); //для заявок услуг
			CIBlockElement::SetPropertyValuesEx(str_replace("IS", "",$response['НомерЗаявки']), false, array(102 => 20)); //для обратного звонка
			$count++;
		} else {
			$count++;
			$e++;

			//Уведомление в ТГ об ошибке
			$data = [
				'text' => 'Ошибка отправки заявки #' . $response['НомерЗаявки'] . ' в 1С',
				'chat_id' => '515975595',
			];
			file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

		}


		//Пишем лог
		$file = fopen($_SERVER['DOCUMENT_ROOT'].'/cli/response_log.txt', 'a+');
		fwrite($file, print_r($response, true));
		fclose($file);
	}

	echo "В очереди заявок: ".$count.", из них ошибок: ".$e;
}
?>
