<?php
/**
 * Initial Version Created by Danial Panah
 * Web: danialrp.com
 * Email: me@danialrp.com
 * on 3/25/2020 AD - 4:03 PM
 */

namespace DanialPanah\Farapayamak\Tests\Unit;

use DanialPanah\Farapayamak\Tests\TestCase;
use DanialPanah\Farapayamak\Traits\FarapayamakRequest;
use Exception;
use GuzzleHttp\Client;

/**
 * Class ClientTest
 *
 * @package \DanialPanah\Farapayamak\Tests\Unit
 */
class ClientTest extends TestCase
{
    use FarapayamakRequest;

    public function test_credentials()
    {
        $credentials = [
            'username' => $this->faker->userName,
            'password' => $this->faker->password
        ];

        $this->setCredentials($credentials);

        $this->assertEquals($this->credentials['username'], $credentials['username']);
        $this->assertEquals($this->credentials['password'], $credentials['password']);
    }

    public function test_recipients_and_text()
    {
        $data = [
            'to' => $this->faker->phoneNumber,
            'text' => $this->faker->text(25),
        ];

        $this->requestConfiguration($data);

        $this->assertEquals($this->httpBodyParams['form_params']['to'], $data['to']);
        $this->assertEquals($this->httpBodyParams['form_params']['text'], $data['text']);
    }

    public function test_recipients_type()
    {
        $phoneNumbers = [];
        for ($i = 0; $i < 5; $i++) {
            $phoneNumbers [] = $this->faker->phoneNumber;
        }
        $this->setRecipients($phoneNumbers);
        $recipients = (string)implode(',', $phoneNumbers);
        $this->assertEquals($this->recipients, $recipients);

        $singleNumber = (string)$this->faker->phoneNumber;
        $this->setRecipients($singleNumber);
        $this->assertEquals($this->recipients, $singleNumber);
    }

    public function test_api_url()
    {
        $apiUrl = $this->faker->url;
        $this->setApiUrl($apiUrl);

        $this->assertEquals($this->apiUrl, $apiUrl);
    }

    public function test_client()
    {
        $this->setClient($this->guzzle);

        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function test_username()
    {
        $this->expectException(Exception::class);

        $this->credentials['username'] = null;
        $this->checkDefaultConfigValues($this->setNotNullableParams());
    }

    public function test_password()
    {
        $this->expectException(Exception::class);

        $this->credentials['password'] = null;
        $this->checkDefaultConfigValues($this->setNotNullableParams());
    }

    public function test_from_number()
    {
        $this->expectException(Exception::class);

        $this->credentials['from'] = null;
        $this->checkDefaultConfigValues($this->setNotNullableParams());
    }
}