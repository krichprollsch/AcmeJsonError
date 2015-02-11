<?php

namespace Acme\JsonErrorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeJsonErrorBundle:Default:index.html.twig', array('name' => $name));
    }
}
