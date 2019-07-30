<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestSecurityController extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'zalé',
            'PHP_AUTH_PW'=>'test123'
        ]);
        $crawler = $client->request('POST', '/api/wari/transfertArgent',[],[],['CONTENT_TYPE'=>'application/json'],
        '{
                              
            "roles":"ROLE_ADMIN",
            "password":"test123",
            "tel":"775904744",
            "adresse":"unite24")

        }');

        $reponse = $client->getResponse();
        var_dump($reponse);
        $this->assertResponseIsSuccessful();
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
}
