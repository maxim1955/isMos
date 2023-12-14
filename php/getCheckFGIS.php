<?php
$id = file_get_contents('php://input');
$post = $_POST[''];
echo $post;

function get_fgis($myVar)
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://fgis.gost.ru/fundmetrology/cm/xcdb/vri/select?fq=mi.number:*' . $myVar .'*&q=*&fl=vri_id,org_title,mi.mitnumber,mi.mititle,mi.mitype,mi.modification,mi.number,verification_date,valid_date,applicability,result_docnum,sticker_num&sort=verification_date+desc,org_title+asc&rows=20&start=0',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_POST  => false,
	));
	$response = curl_exec($curl);
	return $response;
};
