<?php

// grab all options
$options = get_option($this->plugin_name);

$uuid = $options['uuid'];
$apiGuid = $options['api_guid'];
$apiKey = $options['api_key'];
$apiSource = $options['api_source'];

$lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);

try
{
	$result = $lightenbodyService
		->get('/test')
	;

	$url = $lightenbodyService->getApiUrl();
	$responseCode = $lightenbodyService->getResponseCode();
}
catch(\Exception $error)
{

}