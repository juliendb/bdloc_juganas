<?php

namespace Bdloc\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfilControllerTest extends WebTestCase
{
    public function testAccount()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/account');
    }

}
