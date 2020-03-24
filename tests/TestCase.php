<?php
/**
 * Initial Version Created by Danial Panah
 * Web: danialrp.com
 * Email: me@danialrp.com
 * on 3/21/2020 AD - 10:20 PM
 */

namespace DanialPanah\Farapayamak\Tests;

use DanialPanah\Farapayamak\FarapayamakServiceProvider;

/**
 * Class TestCase
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

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