<?php

namespace AppBundle\Tests\Controller\Api;

use GuzzleHttp\Client;

class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    private static $staticClient;
    protected $client;

    public static function setUpBeforeClass()
    {
        self::$staticClient = new Client([
            'base_uri' => 'http://blog.app',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    protected function setUp()
    {
        $this->client = self::$staticClient;
    }

}