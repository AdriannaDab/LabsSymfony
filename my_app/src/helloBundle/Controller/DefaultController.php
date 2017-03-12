<?php

namespace helloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('helloBundle:Default:index.html.twig');
    }

    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function helloAction($name)
    {
        return $this-> render(
            'default/hello.html.twig',
            array(
                'name' => $name
            )
        );
    }
}
