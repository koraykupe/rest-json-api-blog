<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
    }

}
