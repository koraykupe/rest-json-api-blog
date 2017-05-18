<?php

namespace AppBundle\Tests\Controller\Api;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use Faker\Factory;
use GuzzleHttp\Client;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ArticleControllerTest extends ApiTestCase
{
    public function testPOSTArticle()
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

    public function testGETArticle()
    {
        $article = $this->createArticle();

        $response = $this->client->get('/api/articles/'.$article->getId());
        $this->assertEquals(200, $response->getStatusCode());
        $data = \GuzzleHttp\json_decode($response->getBody(), true);
        
        $this->assertEquals(array(
            'title',
            'content'
        ), array_keys($data));
    }

    protected function createArticle()
    {
        // Generate Fake Data
        $faker = Factory::create();
        $title = $faker->sentence(6);
        $content = $faker->text();

        $data = array(
            'title' =>  $title,
            'content' => $content
        );

        $accessor = PropertyAccess::createPropertyAccessor();
        $article = new Article();
        foreach ($data as $key => $value) {
            $accessor->setValue($article, $key, $value);
        }
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
        return $article;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager() :EntityManager
    {
        return $this->getService('doctrine.orm.entity_manager');
    }
}
