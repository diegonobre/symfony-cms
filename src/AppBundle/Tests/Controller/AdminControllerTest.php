<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
        $this->client = static::createClient();
        $this->container = static::$kernel->getContainer();
    }

    protected function loginAs($username)
    {
        $session = $this->container->get('session');
        $person = self::$kernel->getContainer()->get('doctrine')->getRepository('AppBundle:CustomUser')->findOneByUsername($username);

        $token = new UsernamePasswordToken($person, null, 'main', $person->getRoles());
        $session->set('_security_main', serialize($token));
        $session->save();

        $this->client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));
    }

    public function testIndex()
    {
        $this->loginAs('dcnobre@gmail.com');

        $crawler = $this->client->request('GET', '/admin');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Dashboard', $crawler->filter('h1')->text());
    }
}