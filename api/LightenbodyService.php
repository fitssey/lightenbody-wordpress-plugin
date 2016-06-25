<?php

class LightenbodyService
{
    private $apiKey;
    private $apiSource;
    private $uuid;
    private $host;
    private $responseCode;

    public function __construct($uuid, $apiGuid, $apiKey, $apiSource)
    {
        $this->uuid = $uuid;
        $this->apiGuid = $apiGuid;
        $this->apiKey = $apiKey;
        $this->apiSource = $apiSource;
        $this->host = "http://local.studio/app_dev.php/$uuid";
    }

    public function getSchedule()
    {
        return $this->call("$this->host/api/schedule");
    }

    public function testConnection()
    {
        return $this->call("$this->host/api/test");
    }

    private function call($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "X-lightenbody-api-key: $this->apiKey",
            "X-lightenbody-api-source: $this->apiSource",
            "X-lightenbody-api-guid: $this->apiGuid"
        ]);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        $this->setResponseCode($info['http_code']);

        return json_decode($result);
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiSource()
    {
        return $this->apiSource;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }

    public function setResponseCode($code)
    {
        $this->responseCode = $code;
        return $this;
    }
}