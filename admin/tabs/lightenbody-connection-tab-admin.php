<?php

$uuid = get_lightenbody_option('uuid');
$apiGuid = get_lightenbody_option('api_guid');
$apiKey = get_lightenbody_option('api_key');
$apiSource = get_lightenbody_option('api_source');

$lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);

try
{
	$result = $lightenbodyService
		->get('/ping')
	;

	$url = $lightenbodyService->getApiUrl();
	$responseCode = $lightenbodyService->getResponseCode();
}
catch(\Exception $error)
{

}
