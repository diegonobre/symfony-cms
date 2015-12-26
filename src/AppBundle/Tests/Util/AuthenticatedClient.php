<?php

namespace AppBundle\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AuthenticatedClient extends WebTestCase
{
    /**
     * Returns authenticated session for specified username
     *
     * @since 26/12/2015
     * @author Diego Nobre <dcnobre@gmail.com)
     *
     * @param $username
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    public static function login($username = 'dcnobre@gmail.com')
    {
        $client = static::createClient();
        $container = static::$kernel->getContainer();

        $session = $container->get('session');
        $user = self::$kernel->getContainer()
            ->get('doctrine')
            ->getRepository('AppBundle:CustomUser')
            ->findOneByUsername($username);

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $session->set('_security_main', serialize($token));
        $session->save();

        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));

        return $client;
    }
}
