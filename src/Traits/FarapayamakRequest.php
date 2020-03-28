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

    private $notNullableParams = [];

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
    }

    /**
     * Set not nullable array values
     */
    private function setNotNullableParams(): void
    {
        $this->notNullableParams = [
            'Farapayamak Username is not set.' => $this->credentials['username'],
            'Farapayamak Password is not set.' => $this->credentials['password'],
            'Farapayamak Number is not set.' => $this->fromNumber
        ];
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
            'username' => isset($credentials['username']) ? $credentials['username'] : config('farapayamak.username'),
            'password' => isset($credentials['password']) ? $credentials['password'] : config('farapayamak.password')
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
        $this->apiUrl = isset($apiUrl) ? $apiUrl : 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
    }

    /**
     * Set default client
     *
     * @param $client
     * @return void
     */
    private function setClient($client = null): void
    {
        $this->client = isset($client) ? $client : new Client();
    }

    /**
     * Check default values before sending Http request
     *
     * @param array $args
     * @throws Exception
     */
    private function checkDefaultConfigValues($args = []): void
    {
        foreach ($args as $key => $value) {
            if (empty($value)) {
                throw new Exception($key);
            }
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
        $this->checkDefaultConfigValues($this->notNullableParams);

        try {
            return json_decode($this->client->request('post', $this->apiUrl, $this->httpBodyParams)
                ->getBody());
        } catch (ClientException $exception) {
            throw $exception;
        }
    }

}
