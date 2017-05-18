<?php
declare(strict_types=1);

namespace AppBundle\Tests\Controller\Api;

class TokenControllerTest extends ApiTestCase
{
    public function testPOSTCreateToken()
    {
        // $this->createUser('koray', 'küpe');
        $response = $this->client->post('/api/tokens', [
            'auth' => ['koray', 'küpe']
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->asserter()->assertResponsePropertyExists(
            $response,
            'token'
        );
    }
}
