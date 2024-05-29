<?php

$curl = curl_init();

$checklistid = 565277; //Checklist do dips, caso for usar outro temos que alterar esse vaor
$limite = 500;


$valor_da_placa = isset($_GET['placa'])?$_GET['placa']:"vazio";
if($valor_da_placa !="vazio")
{
//consulta
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
$hora = date('H:i:s');
$data_agora = $data . 'T' . $hora.'-03:00';  //Caso eu queira usar a data de agora 


//Data inicial: formato 2024-05-13T00:00:01-03:00
$data_inicial = $data.'T00:00:01-03:00';

//Data final
$data_final = $data.'T23:59:00-03:00';


$formularios_encontrados = 0; //Contabilizar quantos foram encontrados
$v_n_formularios = 0; //Total de formularios lancados sem repetir




curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-analytics.checklistfacil.com.br/v1/evaluations/results?checklistId='.$checklistid.'&limit='.$limite.'&pivot[gte]='.$data_inicial.'&pivot[lte]='.$data_final,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept-Language: pt-br',
    'Authorization: Bearer 6nPL7UNPrCK53Ul5Wn9xFosceFyH2zud8e6Vwbfwkhn2ZSj5bk0Bt3LKbuG6y5vUUvW52NwSdERkiWJRAB4V4ZR1WIsQ8CxOwU5nSmp793FIwjHnyp8uabDZbioAkmUv'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//echo "</BR></BR></BR>";
/*

$response = '{"data":[{"evaluationId":104380999,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:41:35+00:00","concludedAt":"2024-05-13T11:42:16+00:00","approvedAt":"2024-05-13T11:41:37+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003250058,"categoryId":3097719,"itemId":21103790,"scaleId":10,"answeredAt":"2024-05-13T11:41:41+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416443,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":0,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:41:37+00:00","updatedAt":"2024-05-13T11:42:30+00:00","deletedAt":null},{"evaluationId":104380999,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:41:35+00:00","concludedAt":"2024-05-13T11:42:16+00:00","approvedAt":"2024-05-13T11:41:37+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003250059,"categoryId":3097719,"itemId":21103809,"scaleId":4,"answeredAt":"2024-05-13T11:41:51+00:00","evaluative":null,"text":"BRU2424","number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":1,"categoryOrder":0,"countItemAttachments":1,"countItemSignatures":0,"createdAt":"2024-05-13T11:41:37+00:00","updatedAt":"2024-05-13T11:42:30+00:00","deletedAt":null},{"evaluationId":104380999,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:41:35+00:00","concludedAt":"2024-05-13T11:42:16+00:00","approvedAt":"2024-05-13T11:41:37+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003250060,"categoryId":3097719,"itemId":21104050,"scaleId":6,"answeredAt":"2024-05-13T11:42:07+00:00","evaluative":null,"text":null,"number":37098482,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":2,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:41:37+00:00","updatedAt":"2024-05-13T11:42:30+00:00","deletedAt":null},{"evaluationId":104380999,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:41:35+00:00","concludedAt":"2024-05-13T11:42:16+00:00","approvedAt":"2024-05-13T11:41:37+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003250061,"categoryId":3097719,"itemId":21104073,"scaleId":10,"answeredAt":"2024-05-13T11:42:11+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416542,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":3,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:41:37+00:00","updatedAt":"2024-05-13T11:42:30+00:00","deletedAt":null},{"evaluationId":104380999,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:41:35+00:00","concludedAt":"2024-05-13T11:42:16+00:00","approvedAt":"2024-05-13T11:41:37+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003250062,"categoryId":3097719,"itemId":21104096,"scaleId":10,"answeredAt":"2024-05-13T11:42:12+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416544,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":4,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:41:37+00:00","updatedAt":"2024-05-13T11:42:30+00:00","deletedAt":null},{"evaluationId":104382188,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:53:19+00:00","concludedAt":"2024-05-13T11:53:59+00:00","approvedAt":"2024-05-13T11:53:21+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003281378,"categoryId":3097719,"itemId":21103790,"scaleId":10,"answeredAt":"2024-05-13T11:53:55+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416443,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":0,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:53:21+00:00","updatedAt":"2024-05-13T11:54:10+00:00","deletedAt":null},{"evaluationId":104382188,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:53:19+00:00","concludedAt":"2024-05-13T11:53:59+00:00","approvedAt":"2024-05-13T11:53:21+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003281379,"categoryId":3097719,"itemId":21103809,"scaleId":4,"answeredAt":"2024-05-13T11:53:29+00:00","evaluative":null,"text":"ABC1234","number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":1,"categoryOrder":0,"countItemAttachments":1,"countItemSignatures":0,"createdAt":"2024-05-13T11:53:21+00:00","updatedAt":"2024-05-13T11:54:10+00:00","deletedAt":null},{"evaluationId":104382188,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:53:19+00:00","concludedAt":"2024-05-13T11:53:59+00:00","approvedAt":"2024-05-13T11:53:21+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003281380,"categoryId":3097719,"itemId":21104050,"scaleId":6,"answeredAt":"2024-05-13T11:53:43+00:00","evaluative":null,"text":null,"number":37098482,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":2,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:53:21+00:00","updatedAt":"2024-05-13T11:54:10+00:00","deletedAt":null},{"evaluationId":104382188,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:53:19+00:00","concludedAt":"2024-05-13T11:53:59+00:00","approvedAt":"2024-05-13T11:53:21+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003281381,"categoryId":3097719,"itemId":21104073,"scaleId":10,"answeredAt":"2024-05-13T11:53:46+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416542,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":3,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:53:21+00:00","updatedAt":"2024-05-13T11:54:10+00:00","deletedAt":null},{"evaluationId":104382188,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T11:53:19+00:00","concludedAt":"2024-05-13T11:53:59+00:00","approvedAt":"2024-05-13T11:53:21+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003281382,"categoryId":3097719,"itemId":21104096,"scaleId":10,"answeredAt":"2024-05-13T11:53:48+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416544,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":4,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T11:53:21+00:00","updatedAt":"2024-05-13T11:54:10+00:00","deletedAt":null},{"evaluationId":104390291,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:05:25+00:00","concludedAt":"2024-05-13T13:06:03+00:00","approvedAt":"2024-05-13T13:05:27+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003462188,"categoryId":3097719,"itemId":21103790,"scaleId":10,"answeredAt":"2024-05-13T13:05:28+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416442,"optionText":"SIM","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":0,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:05:27+00:00","updatedAt":"2024-05-13T13:06:16+00:00","deletedAt":null},{"evaluationId":104390291,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:05:25+00:00","concludedAt":"2024-05-13T13:06:03+00:00","approvedAt":"2024-05-13T13:05:27+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003462193,"categoryId":3097719,"itemId":21103809,"scaleId":4,"answeredAt":"2024-05-13T13:05:44+00:00","evaluative":null,"text":"CBA4321","number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":1,"categoryOrder":0,"countItemAttachments":1,"countItemSignatures":0,"createdAt":"2024-05-13T13:05:27+00:00","updatedAt":"2024-05-13T13:06:16+00:00","deletedAt":null},{"evaluationId":104390291,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:05:25+00:00","concludedAt":"2024-05-13T13:06:03+00:00","approvedAt":"2024-05-13T13:05:27+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003462195,"categoryId":3097719,"itemId":21104050,"scaleId":6,"answeredAt":"2024-05-13T13:05:56+00:00","evaluative":null,"text":null,"number":37098482,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":2,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:05:27+00:00","updatedAt":"2024-05-13T13:06:16+00:00","deletedAt":null},{"evaluationId":104390291,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:05:25+00:00","concludedAt":"2024-05-13T13:06:03+00:00","approvedAt":"2024-05-13T13:05:27+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003462196,"categoryId":3097719,"itemId":21104073,"scaleId":10,"answeredAt":"2024-05-13T13:05:58+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416541,"optionText":"SIM","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":3,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:05:27+00:00","updatedAt":"2024-05-13T13:06:16+00:00","deletedAt":null},{"evaluationId":104390291,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:05:25+00:00","concludedAt":"2024-05-13T13:06:03+00:00","approvedAt":"2024-05-13T13:05:27+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003462197,"categoryId":3097719,"itemId":21104096,"scaleId":10,"answeredAt":"2024-05-13T13:06:00+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416544,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":4,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:05:27+00:00","updatedAt":"2024-05-13T13:06:16+00:00","deletedAt":null},{"evaluationId":104390457,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:06:52+00:00","concludedAt":"2024-05-13T13:08:12+00:00","approvedAt":"2024-05-13T13:06:53+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003467467,"categoryId":3097719,"itemId":21103790,"scaleId":10,"answeredAt":"2024-05-13T13:06:55+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416442,"optionText":"SIM","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":0,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:06:53+00:00","updatedAt":"2024-05-13T13:08:24+00:00","deletedAt":null},{"evaluationId":104390457,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:06:52+00:00","concludedAt":"2024-05-13T13:08:12+00:00","approvedAt":"2024-05-13T13:06:53+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003467468,"categoryId":3097719,"itemId":21103809,"scaleId":4,"answeredAt":"2024-05-13T13:08:01+00:00","evaluative":null,"text":"BCR1212","number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":1,"categoryOrder":0,"countItemAttachments":1,"countItemSignatures":0,"createdAt":"2024-05-13T13:06:53+00:00","updatedAt":"2024-05-13T13:08:24+00:00","deletedAt":null},{"evaluationId":104390457,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:06:52+00:00","concludedAt":"2024-05-13T13:08:12+00:00","approvedAt":"2024-05-13T13:06:53+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003467469,"categoryId":3097719,"itemId":21104050,"scaleId":6,"answeredAt":"2024-05-13T13:08:04+00:00","evaluative":null,"text":null,"number":37098482,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":null,"index":null,"originalWeight":null,"maximumWeight":null,"obtainedWeight":null,"comment":"","itemOrder":2,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:06:53+00:00","updatedAt":"2024-05-13T13:08:24+00:00","deletedAt":null},{"evaluationId":104390457,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:06:52+00:00","concludedAt":"2024-05-13T13:08:12+00:00","approvedAt":"2024-05-13T13:06:53+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003467470,"categoryId":3097719,"itemId":21104073,"scaleId":10,"answeredAt":"2024-05-13T13:08:08+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416542,"optionText":"N\u00c3O","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":3,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:06:53+00:00","updatedAt":"2024-05-13T13:08:24+00:00","deletedAt":null},{"evaluationId":104390457,"status":6,"score":null,"checklistId":565277,"unitId":197520,"userId":92889,"startedAt":"2024-05-13T13:06:52+00:00","concludedAt":"2024-05-13T13:08:12+00:00","approvedAt":"2024-05-13T13:06:53+00:00","platform":2,"scheduled":false,"scheduleStartDate":null,"scheduleEndDate":null,"finalComment":"","sharedTo":"","countAttachments":0,"initialLatitude":-20.286712646484375,"initialLongitude":-43.936561584472656,"finalLatitude":-20.286712646484375,"finalLongitude":-43.936561584472656,"resultId":2003467471,"categoryId":3097719,"itemId":21104096,"scaleId":10,"answeredAt":"2024-05-13T13:08:09+00:00","evaluative":null,"text":null,"number":null,"stateId":null,"cityId":null,"product":null,"competencePeriodId":null,"selectedOptions":[{"optionId":58416543,"optionText":"SIM","optionValue":null}],"index":null,"originalWeight":1,"maximumWeight":0,"obtainedWeight":0,"comment":"","itemOrder":4,"categoryOrder":0,"countItemAttachments":0,"countItemSignatures":0,"createdAt":"2024-05-13T13:06:53+00:00","updatedAt":"2024-05-13T13:08:24+00:00","deletedAt":null}],"meta":{"currentPage":1,"from":1,"path":"https:\/\/api-analytics.checklistfacil.com.br\/v1\/evaluations\/results","perPage":500,"to":20,"hasMore":false}}';

*/

//Tratando o json
$jsonObj = json_decode($response);

//DADOS ***********************************************************
$dados = $jsonObj->meta;
$formularios_encontrados = $dados->to;


$ultimo_id = 0;
$v_id_ultimo = 0;

for($x=0;$x<intval($formularios_encontrados);$x++)
{
    $v_form = $jsonObj->data[$x];
    $v_n = $v_form->evaluationId;
    $v_status = $v_form->status; // Pega o status
    if($v_status ==1)
    {
     $v_status = "Não Iniciado";
    }
    else if($v_status ==2)
    {
     $v_status = "Em Andamento";        
    }
    else if($v_status ==3)
    {
     $v_status = "Em Análise";          
    }        
    else if($v_status ==4)
    {
     $v_status = "Reprovado";             
    }    
    else if($v_status ==5)
    {
     $v_status = "Reaberto";         
    }    
    else if($v_status ==6)
    {
     $v_status = "Concluído";         
    } 
    else
    {
     $v_status = "Não identificado!";
    }   


    $v_placa = $v_form->text; //Atribui a placa
    $v_registro = $v_form->number; //Atribui o registro de quem lancou

    if($valor_da_placa == $v_placa)
    {
     $vvv = $v_n;
     $encontrado_placa = "SIM";
     
     echo "Achou a placa no id = " . $v_n . " para a placa . " . $v_placa." </BR>";
     $v_n_formularios = intval($v_n_formularios) + 1;
     echo "</BR>";
     echo "*********************************************************************************************";
     echo "</BR>";  
     echo "Encontrado formulario com ID = " . $v_n. " e numero = " . $x;  
     $v_id_ultimo = $v_n;
     echo "</BR>";
     echo "Status do formulário = " . $v_status;
     echo "</BR>";  
     $ultimo_id = 1; //Para iniciar o sistema de sincronismo   
    }

    if($vvv == $v_n)
    {
    
  
     if($ultimo_id == 9999) //Nao usa, so para ter o if
     {

     }    
     else if($ultimo_id == 4 && $encontrado_placa =="SIM") // Pego se existe 7 dips faltando no somatorio das rodas
     {
        $ultimo_id  = 5;
        $v_opt = $v_form->selectedOptions[0];
        $v_opt = $v_opt->optionText;
        if($v_opt == "SIM")
        {
            echo "Faltando 7 DIPS no somatorio? = " . $v_opt . " - NOTIFICAR!";
        }
        else
        {
            echo "Faltando 7 DIPS no somatorio? = " . $v_opt;    
        }
        echo "</BR>";
     }
     else if($ultimo_id == 3 && $encontrado_placa =="SIM") // Pego se existe 2 dips faltando na mesma roda
     {
        $ultimo_id  = 4;
        $v_opt = $v_form->selectedOptions[0];
        $v_opt = $v_opt->optionText;
        if($v_opt == "SIM")
        {
            echo "Faltando 2 DIPS na mesma roda? = " . $v_opt. " - NOTIFICAR!";
        }
        else
        {
            echo "Faltando 2 DIPS na mesma roda? = " . $v_opt;
        }
        
        echo "</BR>";
     }     
     else if($ultimo_id == 2 && $encontrado_placa =="SIM") ///Pego quem lancou em "number"
     {
        $ultimo_id  = 3;
        echo "Lançado por = " . $v_registro;
        echo "</BR>";
     }
     else if($ultimo_id == 1 && $encontrado_placa =="SIM") //Pega a placa em "text"
     {
        $ultimo_id  = 2;
        echo "Placa = " . $v_placa;
        echo "</BR>";
     }     
     


    }

  
}
echo "</BR>";
echo "Encontrados = " . $v_n_formularios;
echo "</BR>";echo "</BR>";


}
else
{
 echo "Favor inserir um valor válido para a placa!";   
}

?>