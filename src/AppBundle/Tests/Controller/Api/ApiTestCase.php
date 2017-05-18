<?php
declare(strict_types=1);

namespace AppBundle\Tests\Controller\Api;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiTestCase extends KernelTestCase
{
    /**
     * @var
     */
    private static $staticClient;
    /**
     * @var
     */
    protected $client;

    /**
     * Pre actions
     */
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

    /**
     * Pre actions
     */
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

    /**
     * @param $id
     * @return object
     */
    protected function getService($id)
    {
        return self::$kernel->getContainer()
            ->get($id);
    }

    /**
     * Purge database after each test executing
     */
    private function purgeDatabase()
    {
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }

}
