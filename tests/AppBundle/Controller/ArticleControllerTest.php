<?php

namespace Tests\AppBundle\Controller;


use Faker\Factory;
use GuzzleHttp\Client;

class ArticleControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testPOST()
    {
        $client = new Client([
            'base_uri' => 'http://blog.app',
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        // Generate Fake Data
        $faker = Factory::create();
        $title = $faker->sentence(6);
        $content = $faker->text();

        $data = array(
            'title' =>  $title,
            'content' => $content
        );

        $response = $client->post('/api/article', [
           'body' => \GuzzleHttp\json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
    }
}
