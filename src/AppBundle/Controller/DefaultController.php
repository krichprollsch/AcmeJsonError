<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/exception")
     */
    public function exceptionAction()
    {
        throw new \RuntimeException('This is a runtime exception');
    }

    /**
     * @Route("/error")
     */
    public function errorAction()
    {
        trigger_error('This is an error');
    }

    /**
     * @Route("/notfound")
     */
    public function notfoundAction()
    {
        throw new NotFoundHttpException('This is not found');
    }
}
