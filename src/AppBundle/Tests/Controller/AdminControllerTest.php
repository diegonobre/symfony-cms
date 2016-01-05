<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Tests\Util\AuthenticatedClient;

/**
 * Class AdminControllerTest
 * @package AppBundle\Tests\Controller
 *
 * @see http://stackoverflow.com/questions/19015385/how-to-log-in-user-in-session-within-a-functional-test-in-symfony-2-3
 * @see http://symfony.com/doc/2.8/cookbook/testing/http_authentication.html
 */
class AdminControllerTest extends WebTestCase
{
    private $client = null;
    private $container = null;

    public function setUp()
    {
        $this->client = AuthenticatedClient::login();
        $this->container = static::$kernel->getContainer();
    }

    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/admin');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull($crawler->filter('h1')->text());
    }
}
