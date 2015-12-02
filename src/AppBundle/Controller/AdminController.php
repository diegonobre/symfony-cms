<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        $helloWorld = $this->get('translator')->trans('Hello World!');
        return $this->render('AppBundle:admin:index.html.twig', array('helloWorld' => $helloWorld));
    }
}
