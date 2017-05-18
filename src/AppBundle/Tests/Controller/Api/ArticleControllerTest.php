<?php

namespace AppBundle\Tests\Controller\Api;

use Faker\Factory;

class ArticleControllerTest extends ApiTestCase
{
    public function testPOST()
    {
        // Generate Fake Data
        $faker = Factory::create();
        $title = $faker->sentence(6);
        $content = $faker->text();

        $data = array(
            'title' =>  $title,
            'content' => $content
        );

        $response = $this->client->post('/api/articles', [
           'body' => \GuzzleHttp\json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));

        $responseData = \GuzzleHttp\json_decode($response->getBody(true), true);
        $this->assertSame($title, $responseData['title']);
        $this->assertSame($content, $responseData['content']);
        $this->assertArrayHasKey('title', $responseData);
        $this->assertArrayHasKey('content', $responseData);
    }
}
