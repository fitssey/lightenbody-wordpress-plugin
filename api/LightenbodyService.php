<?php

/**
 * Class LightenbodyService
 *
 * This class helps connecting to lightenbody Service.
 *
 * It consists of a several methods to exchange data from and to lightenbody Service.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version GPL v2.0 or later of the gnu.org license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @author     Grzegorz Tomasiak <grzegorz@lightenbody.com>
 * @copyright  (c) 2016 lightenbody
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GPL v2.0 or later
 * @version    0.10
 * @link       http://lightenbody.com
 */
class LightenbodyService
{
    const LIGHTENBODY_PROD_HOST = 'http://studio.lightenbody.com';
    const LIGHTENBODY_DEV_HOST = 'http://studio-dev.lightenbody.com';

    private $apiKey;
    private $apiSource;
    private $uuid;
    private $host;
    private $responseCode;

    /**
     * LightenbodyService constructor requires a several variables to be able to connect to the Service.
     * Each of the required parameters can be obtain in your Studio settings.
     *
     * @param string $uuid Unique Identifier (UUID) of the Studio.
     * @param string $apiGuid Globally Unique Identifier (GUID) of the Api credentials.
     * @param string $apiKey Key retrieved from the API credentials.
     * @param string $apiSource Source retrieved from the Api credentials.
     * @param string $host You can override the default host setting, only if you know what you're doing.
     */
    public function __construct($uuid, $apiGuid, $apiKey, $apiSource, $host = null)
    {
        $this->uuid = $uuid;
        $this->apiGuid = $apiGuid;
        $this->apiKey = $apiKey;
        $this->apiSource = $apiSource;

        if($host) $this->host = $host;
        else $this->host = self::LIGHTENBODY_DEV_HOST . "/$uuid";
    }

    /**
     * Returns a Schedule of the Studio by the given range of dates and filters.
     *
     * @param DateTime $startDate Start date of the Schedule.
     * @param DateTime $endDate End date of the Schedule.
     * @param array $filters An array with filters.
     * @see http://studio.lightenbody.com/api/doc#post--{uuid}-api-schedule
     * @return array
     */
    public function getSchedule(\DateTime $startDate, \DateTime $endDate, array $filters = array())
    {
        $data = array(
            'filters'   => http_build_query($filters),
            'startDate' => $startDate->format('Y-m-d'),
            'endDate'   => $endDate->format('Y-m-d')
        );
        
        return $this->call("$this->host/api/schedule", $data);
    }

    /**
     * Performs a test connection against the Api.
     * It returns 200 OK status whether the connection was successful.
     *
     * @return array
     */
    public function testConnection()
    {
        $result = $this->call("$this->host/api/test");
        return $result;
    }

    /**
     * Internal method that calls the Service of lightenbody with the given data.
     *
     * @param string $url Url of the Service.
     * @param array $data An array with data to send along with the call.
     * @return array|mixed|object
     */
    private function call($url, array $data = array())
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "X-lightenbody-api-key: $this->apiKey",
            "X-lightenbody-api-source: $this->apiSource",
            "X-lightenbody-api-guid: $this->apiGuid"
        ));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        $this->setResponseCode($info['http_code']);

        $data = json_decode($result);
        
        if($data) return $data;
        else return $result;
    }

    /**
     * Returns the Api Key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Returns the Api Source.
     *
     * @return string
     */
    public function getApiSource()
    {
        return $this->apiSource;
    }

    /**
     * Returns Studio Unique Identifier (UUID)
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Returns the last response code of the call.
     *
     * @return integer
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * Sets the response code internally.
     *
     * @param $code
     * @return $this
     */
    private function setResponseCode($code)
    {
        $this->responseCode = $code;
        return $this;
    }
}