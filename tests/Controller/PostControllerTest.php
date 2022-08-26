<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testPostsByCategory(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/category/10/posts');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__ . '/responses/PostControllerTest_testPostsByCategory.json',
            $responseContent
        );
    }
}
