<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Tests\Util\AuthenticatedClient;

class CategoryControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = AuthenticatedClient::login();
    }

    public function testCompleteScenario()
    {
        // Create a new entry in the database
        $crawler = $this->client->request('GET', '/cms/category/');
        $this->assertEquals(200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET /cms/category/");
        $crawler = $this->client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_category[name]'  => 'Test',
            // ... other fields to fill
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0,
            $crawler->filter('td:contains("Test")')->count(),
            'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_category[name]'  => 'Foo',
            // ... other fields to fill
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0,
            $crawler->filter('[value="Foo"]')->count(),
            'Missing element [value="Foo"]');

        // Delete the entity
        $this->client->submit($crawler->selectButton('Delete')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $this->client->getResponse()->getContent());
    }
}
