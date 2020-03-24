<?php

namespace DanialPanah\Farapayamak\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait FarapayamakRequest
{
    use FarapayamakMessage;
    /**
     * Http Client object
     *
     * @var Client
     */
    private $client;

    /**
     * Api url address
     *
     * @var string
     */
    private $apiUrl;

    /**
     * Http Request body
     *
     * @var array
     */
    private $httpBodyParams;

    /**
     * Api credentials
     *
     * @var array
     */
    private $credentials;

    /**
     * Flash SMS message
     *
     * @var bool
     */
    private $flashMessage;

    /**
     * Farapayamak selected number
     *
     * @var string
     */
    private $fromNumber;

    /**
     * Initial configuration for sending Http request
     *
     * @param array $params
     * @return void
     * @throws Exception
     */
    private function requestConfiguration(array $params = []): void
    {
        $this->setClient();
        $this->setApiUrl();
        $this->setCredentials();

        $this->setRecipients($params['to']);
        $this->text = $params['text'];
        $this->fromNumber = isset($params['from']) ? $params['from'] : config('farapayamak.from');
        $this->flashMessage = isset($params['flash']) ? $params['flash'] : false;

        $this->httpBodyParams = [
            'form_params' => [
                'username' => $this->credentials['username'],
                'password' => $this->credentials['password'],
                'to' => $this->recipients,
                'from' => $this->fromNumber,
                'text' => $this->text,
                'flash' => $this->flashMessage
            ]
        ];

        $this->checkDefaultConfigValues();
    }

    /**
     * Set API credentials
     *
     * @param $credentials
     * @return void
     */
    private function setCredentials($credentials = null): void
    {
        $this->credentials = [
            'username' => config('farapayamak.username'),
            'password' => config('farapayamak.password')
        ];
    }

    /**
     * Set Farapayamak API URL
     *
     * @param $apiUrl
     * @return void
     */
    private function setApiUrl($apiUrl = null): void
    {
        $this->apiUrl = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
    }

    /**
     * Set default client
     *
     * @param $client
     * @return void
     */
    private function setClient($client = null): void
    {
        $this->client = new Client();
    }

    /**
     * Check default values before sending Http request
     *
     * @throws Exception
     */
    private function checkDefaultConfigValues() :void
    {
        if (empty($this->credentials['username'])) {
            throw new Exception('Farapayamak Username is not set.');
        }
        if (empty($this->credentials['password'])) {
            throw new Exception('Farapayamak Password is not set.');
        }
        if (empty($this->fromNumber)) {
            throw new Exception('Farapayamak Number is not set.');
        }
    }

    /**
     * Send Http Request to Farapayamak API
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    protected function sendRequest(array $data = [])
    {
        $this->requestConfiguration($data);

        try {
            return json_decode($this->client->request('post', $this->apiUrl, $this->httpBodyParams)
                ->getBody());
        } catch (ClientException $exception) {
            throw $exception;
        }
    }

}
