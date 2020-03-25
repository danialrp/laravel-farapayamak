<?php
/**
 * Initial Version Created by Danial Panah
 * Web: danialrp.com
 * Email: me@danialrp.com
 * on 3/21/2020 AD - 10:20 PM
 */

namespace DanialPanah\Farapayamak\Tests;

use DanialPanah\Farapayamak\FarapayamakServiceProvider;
use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;

/**
 * Class TestCase
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @var Generator A Faker fake data generator.
     */
    protected $faker;

    /**
     * @var Client A Guzzle HTTP client.
     */
    protected $guzzle;

    /**
     * Setup a test
     */
    public function setUp(): void
    {
        //Create a faker instance
        $this->faker = Factory::create();

        //Create a guzzle client instance
        $this->guzzle = new Client();

        parent::setUp();
    }

    /**
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            FarapayamakServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        //
    }
}