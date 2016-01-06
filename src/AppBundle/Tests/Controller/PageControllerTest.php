<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\Util\AuthenticatedClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = AuthenticatedClient::login();
    }

    public function testCompleteScenario()
    {
        // Create a new entry in the database
        $crawler = $this->client->request('GET', '/cms/page/');
        $this->assertEquals(200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET /cms/page/");

        $crawler = $this->client->click(
            $crawler->selectLink('Create a new entry')->link()
        );

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_page[title]'  => 'Test title',
            'appbundle_page[content]' => 'Test content'
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0,
            $crawler->filter('td:contains("Test title")')->count(),
            'Missing element td:contains("Test title")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_page[title]'  => 'Test title update',
            'appbundle_page[content]' => 'Test content update'
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0,
            $crawler->filter('[value="Test title update"]')->count(),
            'Missing element [value="Test title update"]');

        // Delete the entity
        $this->client->submit($crawler->selectButton('Delete')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Test+title+update/',
            $this->client->getResponse()->getContent());
    }
}
