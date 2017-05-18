<?php
declare(strict_types=1);

namespace AppBundle\Tests\Controller\Api;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiTestCase extends KernelTestCase
{
    private static $staticClient;
    protected $client;

    public static function setUpBeforeClass()
    {
        self::$staticClient = new Client([
            'base_uri' => getenv('TEST_BASE_URL'),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        self::bootKernel();
    }

    protected function setUp()
    {
        $this->client = self::$staticClient;

        $this->purgeDatabase();
    }

    /**
     * Clean up Kernel usage in this test.
     */
    protected function tearDown()
    {
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()
            ->get($id);
    }

    /*
     * Purge database after each test executing
     */
    private function purgeDatabase()
    {
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }

}
