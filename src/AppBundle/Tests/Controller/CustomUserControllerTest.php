<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\Util\AuthenticatedClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomUserControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = AuthenticatedClient::login();
    }

    public function testCompleteScenario()
    {
        // Create a new entry in the database
        $crawler = $this->client->request('GET', '/cms/user/');
        $this->assertEquals(200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET /cms/user/");
        $crawler = $this->client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_customuser[username]' => 'user@test.com',
            'appbundle_customuser[password]' => '123'
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0,
            $crawler->filter('td:contains("user@test.com")')->count(),
            'Missing element td:contains("user@test.com")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_customuser[username]'  => 'user@testupdate.com',
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0,
            $crawler->filter('[value="user@testupdate.com"]')->count(),
            'Missing element [value="user@testupdate.com"]');

        // Delete the entity
        $this->client->submit($crawler->selectButton('Delete')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/user@testupdate.com/', $this->client->getResponse()->getContent());
    }
}
